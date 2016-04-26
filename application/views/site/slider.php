<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="js/lib/wowslider/engine0/style.css" />
<script type="text/javascript" src="js/lib/wowslider/engine0/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->

<!-- Start WOWSlider.com BODY section -->
<div id="wowslider-container0">
    <div class="ws_images">
        <ul>
            <?php foreach($slider as $row): ?>
            <li><img src="img/slider/<?=$row['imgSlider']?>" alt="slider" title="<?=$row['title']?>" id="wows0_0"/></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com/vi">slider</a> by WOWSlider.com v8.7</div>
    <div class="ws_shadow"></div>
</div>
<script type="text/javascript" src="js/lib/wowslider/engine0/wowslider.js"></script>
<script type="text/javascript" src="js/lib/wowslider/engine0/script.js"></script>
<!-- End WOWSlider.com BODY section -->