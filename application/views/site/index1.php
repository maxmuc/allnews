<script type="text/javascript" src="js/lib/jssor.slider.mini.js"></script>

<link rel="stylesheet" href="/css/siteindex.css">

<div class="row firstRow">
    <div class="col-xs-8">
        <div class="block"><?=$slider?></div>
    </div>
    <div class="col-xs-4">
        <div class="block" style="max-height: 311px;">
            <div class="zag">Политика / <span>Politics</span></div>
            <div class="entre">
                <?php foreach($politics as $row): ?>

                    <div class="title"><?=mb_substr(strip_tags($row['title']), 0, 58, 'UTF-8')?></div>
                    <div class="text"><?=mb_substr(strip_tags($row['text']), 0, 100, 'UTF-8')?></div>
                    <div style="text-align: right;">
                        <a style="margin-bottom: 5px;" class="btn btn-default btn-xs readMore" href="<?=$row['url']?>" role="button">Подробнее...</a>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="row firstRow">
    <div class="col-xs-12">
        <div class="block" style="padding: 0;">
            <table class="block3">
                <tr>
                    <td style="width: 46px; padding: 0 10px; vertical-align: middle;">
                        <div class="prev"></div>
                    </td>
                    <td>
                        <div class="row cur">
                            <?php foreach($curious as $row): ?>
                            <div class="col-xs-4">
                                <table style="height: 90px;">
                                    <tr>
                                        <td style="padding-right: 10px;"><img src="img/content/thumb/<?=$row['img']?>" alt="" class="img-thumbnail"></td>
                                        <td style="font-size: 90%; vertical-align: middle;">
                                            <div><?=rus_date("M d, Y", time($row['dataC']))?></div>
                                            <div style="text-transform: uppercase;">
                                                <a href="<?=$row['url']?>">
                                                    <?php $title = mb_substr($row['title'], 0, 48, 'UTF-8');
                                                    $strLength = iconv_strlen($row['title'], 'UTF-8');
                                                    if($strLength < 46)
                                                        echo $title;
                                                    else
                                                        echo substr($title, 0, strrpos($title,' ')).'...';

                                                    ?>
                                                </a>
                                            </div>
                                            <div>Рубрика Курьёзы</div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </td>
                    <td style="width: 46px; padding: 0 10px; vertical-align: middle;">
                        <div class="next"></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row firstRow">
    <div class="col-xs-3">
        <div class="block r3">
            <div class="zag">Экономика / <span>economics</span></div>
            <div class="dImg"><?=$economics['img']?></div>
            <div class="text"><?=mb_substr(strip_tags($economics['title']), 0, 58, 'UTF-8')?></div>
            <div class="dReadMore">
                <a style="margin-bottom: 5px;" class="btn btn-default btn-xs readMore" href="<?=$economics['url']?>" role="button">Подробнее...</a>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="block r3">
            <div class="zag">Спорт / <span>sport</span></div>
            <div class="dImg"><?=$sport['img']?></div>
            <div class="text"><?=mb_substr(strip_tags($sport['title']), 0, 58, 'UTF-8')?></div>
            <div class="dReadMore">
                <a style="margin-bottom: 5px;" class="btn btn-default btn-xs readMore" href="<?=$sport['url']?>" role="button">Подробнее...</a>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="block r3">
            <div class="zag">Наука & <span>IT</span></div>
            <div class="dImg"><?=$it['img']?></div>
            <div class="text"><?=mb_substr(strip_tags($it['title']), 0, 58, 'UTF-8')?></div>
            <div class="dReadMore">
                <a style="margin-bottom: 5px;" class="btn btn-default btn-xs readMore" href="<?=$it['url']?>" role="button">Подробнее...</a>
            </div>
        </div>
    </div>
    <div class="col-xs-3">
        <div class="block">
            <div class="zag">Курсы <span>валют</span></div>

            <div style="margin: 10px 0;">
                <!--Kurs.com.ua main-ukraine 200x130 blue-->
                <div id='kurs-com-ua-informer-main-ukraine-200x130-blue-container'><a href="//kurs.com.ua/informer" id="kurs-com-ua-informer-main-ukraine-200x130-blue" title="Курс валют информер Украина" target="_blank">Информер курса валют</a></div>
                <script type='text/javascript'>
                    (function() {var iframe = '<ifr'+'ame src="//kurs.com.ua/informer/inf2?color=blue" width="225" height="130" frameborder="0" vspace="0" scrolling="no" hspace="0"></ifr'+'ame>';var container = document.getElementById('kurs-com-ua-informer-main-ukraine-200x130-blue');container.parentNode.innerHTML = iframe;})();
                </script>
                <noscript><img src='//kurs.com.ua/static/images/informer/kurs.png' width='52' height='26' alt='kurs.com.ua: курс валют в Украине!' title='Курс валют' border='0' /></noscript>
                <!--//Kurs.com.ua main-ukraine 200x130 blue-->
            </div>
        </div>

        <div class="block weather">
            <div id="SinoptikInformer" style="width:244px;" class="SinoptikInformer type2c1">
                <div class="siBody1">
                    <table style="width: 100%;">
                        <tbody><tr><td class="siCityV11" style="width:100%;"><div class="siCityName11"><a onmousedown="siClickCount();" href="https://sinoptik.ua/погода-геническ" target="_blank" style="font-size: 110% !important;">Погода в <span style="font-size: 110% !important;">Геническе</span></a></div></tr><tr><td style="width:100%;"><div class="siCityV211"><div id="siCont0" class="siBodyContent"><div class="siLeft"><div class="siTerm"></div><div class="siT" id="siT0" style="color: #fff !important;"></div><div id="weatherIco0"></div></div><div class="siInf" style="width: 102px !important;"><p style="color: #fff !important; font-size: 110% !important;">влажность: <span id="vl0" style="color: #fff !important; font-size: 110% !important;"></span></p><p style="color: #fff !important; font-size: 110% !important;">давление: <span id="dav0" style="color: #fff !important;"></span></p><p style="color: #fff !important; font-size: 110% !important;">ветер: <span id="wind0" style="color: #fff !important;"></span></p></div></div></div></td></tr></tbody></table>
                </div>
            </div>
            <script type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=3&amp;wind=3&amp;cities=303005243&amp;lang=ru"></script>
        </div>
    </div>
</div>

<div class="row firstRow">
    <div class="col-xs-12">
        <div class="block">dsfds</div>
    </div>
</div>