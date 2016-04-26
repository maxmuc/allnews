<!DOCTYPE html>
<html lang="ru" ng-app="mainApp">
<head>
    <meta charset="UTF-8">
    <meta content="<?=$this->description?>" name="description">
    <meta content="<?=$this->keywords?>" name="keywords">

    <title><?=$this->title?></title>

    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/js/lib/bootstrap-3.3.6-dist/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="/js/lib/bootstrap-3.3.6-dist/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="/css/font-awesome-4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/style.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/js/lib/jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="/js/lib/jquery-ui-1.11.4.custom/jquery-ui.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="/js/lib/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

    <script src="/js/lib/angular-1.5.3-min.js"></script>
    <script src="/js/app/main.js"></script>
    <?php if(isset($scriptJs)):?>
        <script><?=$scriptJs?></script>
    <?php endif; ?>
</head>
<body <?=isset($this->adminBar)?'style="margin-top: 34px;"':false?>>
<?=$this->adminBar?>
<div class="mainDiv">

    <div class="row firstRow">
        <div class="col-xs-12">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <a href="<?=site_url('/')?>">
                            <img src="<?=site_url('img/logo.png')?>" style="margin: 16px 0;">
                        </a>
                    </td>
                    <td style="vertical-align: middle; text-align: right;">
                        <form class="form-inline">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail3">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Поиск по сайту...">
                            </div>
                            <button type="submit" class="btn btn-default myBtnSearch">Найти</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row firstRow">
        <div class="col-xs-12">
            <div class="block">
                <div class="contactMenu">
                    <ul>
                        <?php if(Ci::user()): ?>
                            <li>Здравствуйте, <?=Ci::user()['login']?></li>
                            <li><a href="/office/index" style="margin: 10px 0;">Личный кабинет</a></li>
                            <li><a href="/users/logout">Выход</a></li>
                        <?php else: ?>
                            <li><a href="/users/create">Регистрация</a></li>
                            <li><a href="/users/login">Вход</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <ul id="mainMenu">
                    <?php
                    $items = Model::readAll('items', ['where' => ['menuId' => 1], 'orderBy' => 'sort asc']);
                    if(empty($items)):?>
                        <li class="active">
                            <a href="/">Главная</a>
                        </li>
                    <?php else:
                        foreach($items as $row):
                            $active = '';
                            if($this->uri->segment(1) == $row['url']){ $active = 'class="active"'; } ?>
                            <li <?=$active?>>
                                <a href="<?=site_url($row['url'])?>"><?=$row['name']?></a>
                            </li>
                        <?php endforeach; endif; ?>
                </ul>
                <div style="padding: 0 4px;">
                    <div style="display: inline;">Главная » </div>
                    <div style="float: right;" ng-controller="mainCtrl"><?=allNewsTime()?> {{ clock  | date:'HH:mm:ss'}}</div>
                </div>
            </div>
        </div>
    </div>

    <?php if($this->uri->segment(1)):?>
        <div class="row firstRow">
            <div class="col-xs-12">
                <div class="panel panel-default block" style="padding: 0; position: relative;">
                    <div class="panel-heading"><?=$this->title?></div>
                    <div class="panel-body">
                        <?=$content?>
                    </div>
                </div>
            </div>
        </div>


    <?php else:  echo $content; endif; ?>

    <div class="row firstRow">
        <div class="col-xs-12">
            <div style="margin: 10px 0; text-align: right;" class="footer">
                Copyright &copy; <?=date('Y')?> by VAN<br>
                All Rights Reserved<br>
                Создано на <a rel="external" href="https://codeigniter.com/">CodeIgniter Framework</a>
                <a id="totop-scroller" href="#page"></a>
            </div>
        </div>
    </div>

</div>
</body>
</html>