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
                console.clear();
                return false;
            });
        });
    </script>

    <p>Для для востановления пароля на sport-expert.biz просто введите ваш e-mail. В течении 1–2 минут мы вышлем на него пароль доступа.</p>

    <form role="form" method="post">

        <?=input('Users', 'email', ['vh' => [4, 5]])?>

        <?=input('Users', 'captcha', ['vh' => [4, 8]])?>

        <p style="text-align: center;">
            <button type="submit" class="btn btn-default">Отправить</button>
        </p>

    </form>
<?php endif; ?>