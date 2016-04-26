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

<form role="form" method="post" action="/users/login">

    <?=input('Users', 'login', ['vh' => [4, 4]])?>

    <?=input('Users', 'password', ['vh' => [4, 4]])?>

    <p class="text-danger" style="text-align: center;"><?=$this->error?></p>

    <p align="center">
        <button type="submit" class="btn btn-default">Вход</button>
    </p>
</form>

<p style="text-align: right;">
    <a href="/users/restart">Забыли пароль?</a>
    <span style="margin: 0 10px;">|</span>
    <a href="/users/create">Регистрация нового аккаунта</a>
</p>
