<?php
class Ci{

    public static function user($id = false){
        /* метод для работы с данными пользователя
         * если не указан id и пользователь авторизовался
         * то показывает данные текущего user -а иначе false
         * примеры вызова <?=Ci::user()?Ci::user()->login:'guest'?>
         */
        $CI = &get_instance();
        if(!$id && $CI->session->userdata('usId')) $id = $CI->session->userdata('usId');
        if($id) return Model::read('users', ['where' => ['id' => $id]]);
        else return false;
    }

    public static function pagination($rows, $limit){
        /*
         * примеры вызова Ci::pagination($total_rows, $limit);
         * <?=$this->pagination->create_links()?>
         */
        $CI = &get_instance();
        $CI->load->library('pagination');
        $config['base_url'] = site_url($CI->uri->segment(1).'/'.$CI->uri->segment(2));
        $config['total_rows'] = ceil($rows/$limit);
        $CI->pagination->initialize($config);
    }

    public static function validate($model, $items){
        $model = $model.'_model';
        $CI = &get_instance();
        $CI->load->library('form_validation');//валидация
        $CI->load->model($model);
        $config = $CI->$model->rules($items);//массив для валидации
        $CI->form_validation->set_rules($config);

        if($CI->form_validation->run() == FALSE)
            return false;
        else
            return true;
    }

    public static function captcha(){
        $CI = &get_instance();
        $CI->load->helper('captcha');

        $vals = array(
            'word'          => '',
            'img_path'      => './img/captcha/',
            'img_url'       => site_url('img/captcha'),
            'font_path'     => './css/fonts/RobotoLight/RobotoLight.ttf',
            'img_width'     => '120',
            'img_height'    => 34,
            'expiration'    => 10,
            'word_length'   => 4,
            'font_size'     => 18,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyz',

            // White background and border, black text and red grid
            'colors'        => array(
                'background' => array(52, 57, 58),
                'border' => array(255, 255, 255),
                'text' => array(250, 250, 200),
                'grid' => array(150, 180, 180)
            )
        );

        $cap = create_captcha($vals);
        $CI->session->set_userdata('word', $cap['word']);
        return site_url('img/captcha/'.$cap['time'].'.jpg');
    }
}