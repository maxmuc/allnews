<?php
class Users extends MY_Controller{

    public function _remap($method, $params = []){
        switch ($method){
            case 'admin'://только для админов
            case 'expertOnMain':
            case 'ban':
                if(Ci::user()['role'] == 'admin')
                    $this->$method();
                else
                    redirect('/');
                break;
            case 'logout': //только для пользователей
            case 'changePass':
                if(Ci::user())
                    $this->$method();
                else
                    redirect('/');
                break;
            case 'sendActivate': //только для пользователей, с параметром
                if(Ci::user())
                    $this->$method($params[0]);
                else
                    redirect('/');
                break;
            case 'login'://только для гостей
            case 'restart':
            case 'create':
                if(!Ci::user())
                    $this->$method();
                else
                    redirect('/');
                break;
            case 'restorpass'://all guest
                if(!Ci::user())
                    $this->$method($params[0]);
                else
                    redirect('/');
                break;
            case 'fireCreate': //для всех
                $this->$method();
                break;
            case 'activate': //для всех
                $this->$method($params[0]);
                break;
            default:
                redirect('/');
                break;
        }
    }

    public function login(){
        $this->title = 'Авторизация';

        $items = ['login2', 'password'];
        if(!Ci::validate('Users', $items))
            $this->render('login');
        else{
            $model = Model::read('users', ['where' => ['login' => $this->input->post('Users[login]')]]);
            $password = md5($this->input->post('Users[password]').$model['salt']);
            if($model && $model['password'] == $password){
                Model::save('users', ['onoff' => 1], ['id' => $model['id']]);
                $this->session->set_userdata('usId', $model['id']);
                redirect('');
            }else{
                $this->error = 'Не правильно заполненные данные';
                $this->render('login');
            }
        }
    }

    public function create(){
        $this->title = 'Регистрация пользователя';

        $items = ['login', 'password', 'password_repeat', 'email', 'captcha'];

        if(!Ci::validate('Users', $items))
            $this->session->set_flashdata('okno', '');
        else{
            $this->session->set_flashdata('okno', $this->input->post('Users[login]').', Вам необходимо подтвердить регистрацию пользователя.<br />
На Ваш емейл адрес '.$this->input->post('Users[email]').' отправлено письмо с кодом активации.');
            //Не получали письмо? Отправить еще раз. Если письмо с кодом подтверждения не пришло, напишите об этом в поддержку support@sport-expert.biz с Вашего емейл адреса

            $salt = md5(uniqid(rand(),1));
            $activate = md5('48fds9s'.time().'8j4h9gkj');
            $password = md5($this->input->post('Users[password]').$salt);
            //выбираем нужные поля
            $post = arrayFilter($this->input->post('Users'), ['login', 'password', 'email']);
            //добавляем нужные поля по default
            $post = array_merge($post, ['dataC' => time(), 'dataU' => time(), 'password' => $password, 'salt' => $salt, 'role' => 'user', 'activate' => $activate]);
            Model::save('users', $post);
            self::sendActivate($activate);
        }
        $this->render('create');
    }

    public function sendActivate($activate){
        $this->load->library('email');
        $this->email->from($this->support, $this->siteName);
        $model = Model::read('users', ['where' => ['activate' => $activate], 'column' => ['email']]);
        $this->email->to($model['email']);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject('Регистрация пользователя');
        $this->email->message('На сайте '.$this->siteHttp.' заполнена форма
"Регистрация пользователя". Перейдите на указанную страницу, для активации Вашего аккаунта:
'.$this->siteHttp.'/users/activate/'.$activate);

        $this->email->send();
    }

    public function restart(){
        $this->title = 'Воcстановления пароля';

        $items = ['email2', 'captcha'];

        if(!Ci::validate('Users', $items))
            $this->session->set_flashdata('okno', '');
        else{
            $this->session->set_flashdata('okno', 'Информация о новом пароле выслана на ваш e-mail.');

            $page = md5($this->input->post('Users[email]').time());
            $newPass = generate_password(8);
            Model::save('users', ['restorpass' => $page, 'newpass' => md5($newPass)], ['email' => $this->input->post('Users[email]')]);

            $message = 'Здравствуйте!

Для восстановления пароля, перейдите по ссылке '.$this->siteHttp.'/users/restorpass/'.$page.' и используйте для входа временный пароль: '.$newPass.'

После этого, поменяйте временный пароль на свой на странице '.$this->siteHttp.'/office/index

С уважением, '.$this->siteNameSmall.'';

            $this->load->library('email');
            $this->email->from($this->support, $this->siteName);
            //$model = Model::read('users', ['where' => ['activate' => $activate], 'column' => ['email']]);
            $this->email->to($this->input->post('Users[email]'));
            //$this->email->cc('another@another-example.com');
            //$this->email->bcc('them@their-example.com');

            $this->email->subject('Востановление пароля на '.$this->siteNameSmall);
            $this->email->message($message);

            $this->email->send();
        }
        $this->render('restart');
    }

    public function restorpass($restorpass){
        $model = Model::read('users', ['where' => ['restorpass' => $restorpass]]);
        if($model){
            $this->title = 'Воcстановления пароля';
            $password = md5($model['newpass'].$model['salt']);
            Model::save('users', ['password' => $password], ['restorpass' => $restorpass]);
            $this->render('restorpass');
        }else{
            show_404();
        }
    }

    public function activate($id = false){
        $this->title = 'Активация аккаунта';

        if($id){
            $model = Model::read('users', ['where' => ['activate' => $id]]);
            if(!$model)
                $data['rez'] = 'Ошибка! Не найдено соответствие!';
            else{
                if($model['status'] == null){
                    Model::save('users', ['status' => 1], ['id' => $model['id']]); //меняем статус на 1 - обзначает активацию пользователя
                    $data['rez'] = 'Активация аккаунта успешно пройдена';
                }else
                    $data['rez'] = 'Активация аккаунта пройдена ранее';
            }
            $this->render('activate', $data);
        }else
            show_404();
    }

    public function logout(){
        $this->session->sess_destroy();
        Model::save('users', ['onoff' => 0], ['id' => Ci::user()['id']]);
        redirect('/');
    }

    public function changePass(){
        if (!Ci::user()) redirect('/'); //для гостей - на выход

        if(!empty($this->input->post('newPass'))){
            $newPass = md5($this->input->post('newPass'));
            Model::save('users', ['password' => md5($newPass.Ci::user()['salt'])], ['id' => Ci::user()['id']]);
        }
    }
}