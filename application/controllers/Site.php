<?php
class Site extends MY_Controller{

    public function index(){
        $this->scriptJs = 'index.js';

        $arr['slider'] = Model::readAll('content', ['where' => ['slider' => 1], 'orderBy' => 'id Desc', 'limit' => 5, 'column' => ['title', 'imgSlider']]);
        $data['slider'] = $this->load->view('site/slider', $arr, true);

        $data['politics'] = Model::readAll('content', ['where' => ['itemId' => 2], 'limit' => '2', 'orderBy' => 'id DESC']);

        $data['it'] = Model::read('content', ['where' => ['itemId' => 5], 'orderBy' => 'id DESC']);
        $data['sport'] = Model::read('content', ['where' => ['itemId' => 4], 'orderBy' => 'id DESC']);
        $data['economics'] = Model::read('content', ['where' => ['itemId' => 3], 'orderBy' => 'id DESC']);
        $data['curious'] = Model::readAll('content', ['where' => ['itemId' => 6], 'orderBy' => 'id DESC', 'limit' => '4']);


        $this->load->helper('simple_html_dom');

        $html = str_get_html($data['it']['text']);
        $e = $html->find('img', 0)->src;
        preg_match('|.*/(.*)$|', $e, $nameImg);
        $data['it']['img'] = '<img src="img/content/thumb/'.$nameImg[1].'">';

        $html = str_get_html($data['sport']['text']);
        $e = $html->find('img', 0)->src;
        preg_match('|.*/(.*)$|', $e, $nameImg);
        $data['sport']['img'] = '<img src="img/content/thumb/'.$nameImg[1].'">';

        $html = str_get_html($data['economics']['text']);
        $e = $html->find('img', 0)->src;
        preg_match('|.*/(.*)$|', $e, $nameImg);
        $data['economics']['img'] = '<img src="img/content/thumb/'.$nameImg[1].'">';

        /*$html = str_get_html($data['curious'][0]['text']);
        $e = $html->find('img', 0)->src;

        /*$data['curious']['img'] = '<img src="img/content/thumb/'.$nameImg[1].'">';*/

        $this->render('index', $data);
    }

    public function captcha_reload(){
        echo Ci::captcha();
    }


}