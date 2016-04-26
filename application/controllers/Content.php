<?php
class Content extends MY_Controller{

    public function _remap($method, $params = []){
        switch ($method){
            case 'view': //для всех
                $this->$method($params[0]);
                break;
            case 'insupd': //для админов
                if(Ci::user()['role'] == 'admin')
                    if(isset($params[0]))
                        $this->$method($params[0]);
                    else
                        $this->$method();
                else
                    redirect('/');
                break;
            default://все методы запрещены гостям
                if (Ci::user()['role'] == 'admin')
                    $this->$method();
                else
                    redirect('/');//все методы запрещены гостям
                break;
        }
    }

    public function admin(){
        if(IS_AJAX){
            echo json_encode(self::jquery(), JSON_NUMERIC_CHECK);
        }else{
            $this->title = 'Менеджер статей';
            $this->scriptJs = 'admin.js';
            $this->render('admin');
        }
    }

    private function jquery(){
        $content = Model::readAll('content', [
            'column' => [
                'id', 'title', 'menuId', 'itemId', 'status', 'slider'
            ],
            'orderBy' => 'id desc'
        ]);

        if($content){
            $menu = Model::readAll('menu');
            $items = Model::readAll('items');

            foreach($content as $row){
                foreach($menu as $value){
                    if($value['id'] == $row['menuId'])
                        $menuId = $value['name'];
                    if($row['menuId'] == 0)
                        $menuId = '';
                }
                foreach($items as $value){
                    if($value['id'] == $row['itemId'])
                        $itemId = strip_tags($value['name']);
                    if($row['itemId'] == 0)
                        $itemId = '';
                }
                $model[] = ['id' => $row['id'], 'title' => $row['title'], 'menuId' => $menuId, 'itemId' => $itemId, 'status' => $row['status'], 'slider' => $row['slider']];
            }
        }else
            $model = false;

        return $model;
    }

    public function insupd($id = false){
        if(IS_AJAX){
            $data['menu']  = Model::readAll('menu');
            $data['items'] = Model::readAll('items');
            if($id){
                $content = Model::read('content', ['where' => ['id' => $id], 'column' => ['menuId', 'itemId']]);
                //$data['menuSel'] = $menuId;
                $data['menuSel'] = Model::read('menu', ['where' => ['id' => $content['menuId']]]);
                $data['itemSel'] = Model::read('items', ['where' => ['id' => $content['itemId']], 'column' => ['id', 'name']]);
            }

            echo json_encode($data, JSON_NUMERIC_CHECK);
        }else{
            $this->scriptJs = 'insupd.js';

            if (!$id)
                $this->title = 'Создать статью';
            else{
                $this->title = 'Редактировать статью';
                $this->data = Model::read('content', ['where' => ['id' => $id]]);
            }

            $items = ['title'];
            if (!Ci::validate('Content', $items))
                $this->render('insupd');
            else {
                $post = $this->input->post('Content');
                $url = strtolower($this->input->post('Content')['title']);
                $post = array_merge($this->input->post('Content'), ['url' => translit($url), 'dataC' => time()]);

                /**************создаем thumb для главной**********************/
                $itemId = $this->input->post('Content')['itemId'];
                $text = $this->input->post('Content')['text'];

                //3-спорт, 4-Экономика, 5-Наука и IT
                if($itemId == '3' || $itemId == '4' || $itemId == '5' && !empty($text)){
                    $this->load->helper('simple_html_dom');
                    $html = str_get_html($text);
                    $e = $html->find('img', 0)->src;
                    preg_match('|.*/(.*)$|', $e, $nameImg);
                    $this->load->helper('resize_crop');
                    createThumbnail('img/content/'.$nameImg[1], 'img/content/thumb/'.$nameImg[1], 224, 120);
                }

                //3-спорт, 4-Экономика, 5-Наука и IT
                if($itemId == '6' && !empty($text)){
                    $this->load->helper('simple_html_dom');
                    $html = str_get_html($text);
                    $e = $html->find('img', 0)->src;
                    preg_match('|.*/(.*)$|', $e, $nameImg);
                    $this->load->helper('resize_crop');
                    //createThumbnail('img/content/'.$nameImg[1], 'img/content/thumb/'.$nameImg[1], 70, 70);
                    thumb_create('img/content/'.$nameImg[1], 'img/content/thumb/'.$nameImg[1], 70, 70);
                    $post = array_merge($post, ['img' => $nameImg[1]]);
                }
                /**************создаем thumb для главной**********************/

                if(!$id)
                    Model::save('content', $post);
                else
                    Model::save('content', $post, ['id' => $id]);
                redirect('/content/admin');
            }
        }
    }

    public function del(){
        //header("Access-Control-Allow-Origin: *");
        //header("Content-Type: application/json; charset=UTF-8");
        $id = $this->input->post('id');
        $this->db->delete('content', ['id' => $id]);
        echo json_encode(self::jquery(), JSON_NUMERIC_CHECK);
    }

    public function status(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        Model::save('content', ['status' => $status], ['id' => $id]);
        //$this->db->delete('content', ['id' => $id]);
        echo json_encode(self::jquery(), JSON_NUMERIC_CHECK);
    }

    public function slider(){
        $id = $this->input->post('id');
        $slider = $this->input->post('slider');

        /**************создаем thumb для главной**********************/
        $nameImg[1] = '';
        if($slider == 1){
            $text = Model::read('content', ['where' => ['id' => $id], 'column' => ['text']])['text'];

            if(!empty($text)){
                $this->load->helper('simple_html_dom');
                $html = str_get_html($text);
                $e = $html->find('img', 0)->src;
                if($e){
                    preg_match('|.*/(.*)$|', $e, $nameImg);
                    $this->load->helper('resize_crop');
                    createThumbnail('img/content/'.$nameImg[1], 'img/slider/'.$nameImg[1], 630, 290);
                }
            }
        }
        /**************создаем thumb для главной**********************/

        Model::save('content', ['slider' => $slider, 'imgSlider' => $nameImg[1]], ['id' => $id]);
        echo json_encode(self::jquery(), JSON_NUMERIC_CHECK);
    }

    public function view($url){
        if($url > 0)
            $data = Model::read('content', ['where' => ['id' => $url, 'status' => 1]]);
        else
            $data = Model::read('content', ['where' => ['url' => $url, 'status' => 1]]);

        if(!$data['title']){
            $this->title = 'Ошибка 404';
            $data['text'] = '<div style="text-align: center;"><img src="/img/404.png"></div>';
        }else
            $this->title = $data['title'];

        $this->render('view', $data);
    }
}