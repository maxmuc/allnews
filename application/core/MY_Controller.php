<?php
class MY_Controller extends CI_Controller{

    public $title = 'AllNews - новостной портал';
    public $scriptJs;
    public $adminBar;
    public $error = false;
    public $data;
    public $description = 'AllNews - новостной портал';
    public $keywords = 'AllNews - новостной портал';
    public $siteName = 'ALLNEWS.MACY-PAN.BIZ';
    public $siteHttp = 'http://allnews.macy-pan.biz';
    public $support = 'support@allnews.macy-pan.biz';
    public $siteNameSmall = 'allnews.macy-pan.biz';



    public function render($page, $data = false){
        //error_reporting(0);
        //controller & page
        $controller_name = $this->router->fetch_class().'/'.$page;

        $data['content'] = $this->load->view($controller_name, $data, true);
        $data['sidebar'] = $this->load->view('layouts/sidebar', '', true);

        if(!empty($this->scriptJs))
            $data['scriptJs'] = $this->load->view($this->router->fetch_class().'/'.$this->scriptJs, $data, true);

        //if(CI::user() && CI::user()['id'] == 13 || CI::user()['id'] == 14)
        if(CI::user() && CI::user()['role'] == 'admin')
            $this->adminBar = $this->load->view('layouts/_admin_bar', $data, true);

        $this->load->view('layouts/main', $data);
    }

    public function captcha_check($str){
        if ($str != $this->session->userdata('word')){
            $this->form_validation->set_message('captcha_check', 'Неверно введена капча');
            return FALSE;
        }else
            return TRUE;
    }

    public function isset_email($str){
        if(!Model::read('users', ['where' => ['email' => $str]])){
            $this->form_validation->set_message('isset_email', 'Нет такого значения в базе');
            return FALSE;
        }else
            return TRUE;
    }

    //http://yootheme.com/demo/themes/joomla/2012/revista/
}