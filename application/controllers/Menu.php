<?php
class Menu extends MY_Controller{

    public function _remap($method, $params = []){
        switch ($method){
            case 'admin'://только для админов
            case 'createMenu':
            case 'deleteMenu':
            case 'menuSelect':
            case 'createItem':
            case 'deleteItem':
            case 'itemSort':
                if(Ci::user()['role'] == 'admin')
                    $this->$method();
                else
                    redirect('/');
                break;
            case 'view': //для всех, с параметром
                $this->$method($params[0]);
                break;
            default:
                redirect('/');
                break;
        }
    }

    public function admin(){
        $this->title    = 'Менеджер меню/пунктов';
        $this->scriptJs = 'admin.js';
        $this->render('admin');
    }

    public function view($name){
        $itemId = Model::read('items', ['where' => ['url' => $name]])['id'];

        if(!empty($itemId))
            $items  = Model::read('content', ['where' => ['itemId' => $itemId, 'status' => 1]]);

        if(!isset($items) || !$items){
            $this->title = 'Ошибка 404';
            $data['text'] = '<div style="text-align: center;"><img src="img/404.png"></div>';
        }else{
            $this->title = $items['title'];
            $data['text'] = $items['text'];
            if(isset($items['description']))
                $this->description = $items['description'];
            if(isset($items['keywords']))
                $this->keywords = $items['keywords'];
        }
        $this->render('view', $data);
    }

    public function createMenu(){
        $nameMenu = $this->input->post('nameMenu');
        $id = $this->input->post('id');
        if(!empty($id))
            Model::save('menu', ['name' => $nameMenu], ['id' => $id]);
        else
            Model::save('menu', ['name' => $nameMenu]);
        echo json_encode(Model::readAll('menu'));
    }

    public function deleteMenu(){
        $id = $this->input->post('id');
        $this->db->delete('menu', ['id' => $id]);
        echo json_encode(Model::readAll('menu'));
    }

    public function menuSelect(){
        echo json_encode(Model::readAll('items', [
            'where' => [
                'menuId' => $this->input->post('id')
            ],
            'column' => ['id', 'name', 'url', 'static'],
            'orderBy' => 'sort asc'
        ]));
    }

    public function createItem(){
        $nameItem = $this->input->post('nameItem');
        $id = $this->input->post('id');
        $idMenu = $this->input->post('idMenu');

        $static = $this->input->post('static');
        if($static != 1)
            $url = translit(strip_tags($nameItem));
        else
            $url = $this->input->post('url');

        $sort = Model::read('items', ['selectMax' => 'sort'])['sort']+1;

        if(!empty($id))
            Model::save('items', ['name' => $nameItem, 'menuId' => $idMenu, 'url' => $url, 'static' => $static], ['id' => $id]);
        else
            Model::save('items', ['name' => $nameItem, 'menuId' => $idMenu, 'url' => $url, 'sort' => $sort]);
        echo json_encode(Model::readAll('items', ['where' => ['menuId' => $idMenu], 'orderBy' => 'sort asc']));
    }

    public function deleteItem(){
        $id = $this->input->post('id');
        $idMenu = $this->input->post('idMenu');

        $this->db->delete('items', ['id' => $id]);
        echo json_encode(Model::readAll('items', ['where' => ['menuId' => $idMenu]]));
    }

    public function itemSort(){
        $arr = $this->input->post('arr');
        foreach($arr as $key => $value){
            Model::save('items', ['sort' => $key], ['id' => $value]);
        }
    }
}