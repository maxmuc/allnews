<?php
class Users_model extends CI_Model {

    private function name($key){
        $arr = [
            'login'    => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Подтверждение пароля',
            'email'    => 'E-mail',
            'captcha'  => 'Код проверки',
            'fname'    => 'Фамилия',
            'name'     => 'Имя',
            'oname'    => 'Отчество',
            'birth'    => 'День рождения',
            'country'  => 'Страна',
            'region'   => 'Регион',
            'city'     => 'Город',
            'levelmaster' => 'Уровень мастерства',
            'staj'     => 'Стаж работы',
            'vidsportaid' => 'Вид спорта',
            'pact'     => 'Фактом регистрации Вы принимаете <span class="sogl">Соглашение поставщика услуг</span>',

        ];
        return $arr[$key];
    }

    public function items($key){
        $arr = [
            'login'    => ['type' => 'text', 'name' => self::name('login'), 'required' => true],
            'password' => ['type' => 'password', 'name' => self::name('password'), 'required' => true],
            'password_repeat' => ['type' => 'password', 'name' => self::name('password_repeat'), 'required' => true],
            'email'    => ['type' => 'email', 'name' => self::name('email'), 'required' => true],
            'captcha'  => ['type' => 'captcha', 'name' => self::name('captcha'), 'required' => true],

            'fname'   => ['type' => 'text', 'name' => self::name('fname'), 'required' => true],
            'name'    => ['type' => 'text', 'name' => self::name('name'), 'required' => true],
            'oname'   => ['type' => 'text', 'name' => self::name('oname'), 'required' => true],
            'birth'   => ['type' => 'text', 'name' => self::name('birth'), 'required' => true],
            'country' => ['type' => 'select', 'name' => self::name('country'), 'required' => true],
            'region'  => ['type' => 'select', 'name' => self::name('region'), 'required' => true],
            'city'    => ['type' => 'select', 'name' => self::name('city'), 'required' => true],
            'levelmaster' => ['type' => 'select', 'name' => self::name('levelmaster'), 'required' => true],
            'staj'    => ['type' => 'text', 'name' => self::name('staj'), 'required' => true],
            'vidsportaid'    => ['type' => 'select', 'name' => self::name('vidsportaid'), 'required' => true],
        ];
        return $arr[$key];
    }

    public function rules($items){
        $rez = [];

        $data = [
            'login' => [
                'field' => 'Users[login]',
                'label' => self::name('login'),
                'rules' => 'trim|required|min_length[6]|max_length[128]|is_unique[users.login]'
            ],
            'login2' => [//для авторизации
                'field' => 'Users[login]',
                'label' => self::name('login'),//проверка по name в inpute
                'rules' => 'trim|required|min_length[6]|max_length[128]'
            ],
            'password' => [
                'field' => 'Users[password]',
                'label' => self::name('password'),
                'rules' => 'trim|required|min_length[6]|max_length[32]|md5'
            ],
            'password_repeat' => [
                'field' => 'Users[password_repeat]',
                'label' => self::name('password_repeat'),
                'rules' => 'trim|required|min_length[6]|max_length[32]|md5|matches[Users[password]]'
            ],
            'email' => [
                'field' => 'Users[email]',
                'label' => self::name('email'),
                'rules' => 'trim|required|valid_email|is_unique[users.email]'
            ],
            'email2' => [
                'field' => 'Users[email]',
                'label' => self::name('email'),
                'rules' => 'trim|required|valid_email|callback_isset_email'
            ],
            'captcha' => [
                'field' => 'Users[captcha]',
                'label' => self::name('captcha'),
                'rules' => 'trim|required|callback_captcha_check'
            ],

            'fname' => [
                'field' => 'Users[fname]',
                'label' => self::name('fname'),
                'rules' => 'trim|required|min_length[2]|max_length[128]'
            ],

        ];

        foreach($items as $row){
            $rez[$row] = $data[$row];
        }

        return $rez;
    }
}