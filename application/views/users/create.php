<?php
if($this->session->flashdata('okno')):
    echo $this->session->flashdata('okno');
else:
    ?>

    <script>
        $(document).ready(function(){
            $('.captcha').on('click', function(){
                $.ajax({
                    url: '/site/captcha_reload',
                    success: function(data){
                        $('#Imageid').attr('src', data);
                    }
                });
            });
        });
    </script>

    <form role="form" method="post" action="/users/create">

        <?=input('Users', 'login', ['vh' => [4, 5]])?>

        <?=input('Users', 'password', ['vh' => [4, 5]])?>

        <?=input('Users', 'password_repeat', ['vh' => [4, 5]])?>

        <?=input('Users', 'email', ['vh' => [4, 5]])?>

        <?=input('Users', 'captcha', ['vh' => [4, 5]])?>

        <p style="text-align: center;">
            <button type="submit" class="btn btn-default">Зарегистрироваться</button>
        </p>
    </form>
    <p style="text-align: right;"><a href="/users/login">Вход</a> в существующий аккаунт</p>

<?php endif; ?>