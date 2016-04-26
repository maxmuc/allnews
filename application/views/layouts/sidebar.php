<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(207, 2, 6, 1), rgba(183, 0, 3, 1)) repeat scroll 0 0; border-radius: 0; color: #ffffff;">Дополнительные категории</div>

    <div class="list-group">
        <?php foreach(Model::readAll('items', ['where' => ['menuId' => 2]]) as $row): ?>
            <a href="/<?=$row['url']?>" class="list-group-item">
                <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                <?=$row['name']?>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(207, 2, 6, 1), rgba(183, 0, 3, 1)) repeat scroll 0 0; border-radius: 0; color: #ffffff;">Информация</div>

    <div class="list-group" style="background: #ff0000;">
        <?php $n = 0; foreach(Model::readAll('items', ['where' => ['menuId' => 3]]) as $row): $n++; ?>

            <a href="/<?=$row['url']?>" class="list-group-item">
                <div style="vertical-align: top; display: table-cell;">
                    <img src="<?=site_url('img/info/'.$n.'.jpg')?>" style="float: left; margin-right: 5px;">
                    <span style=""><?=$row['name']?></span>
                </div>
            </a>
            <div style="clear: both;"></div>
        <?php endforeach; ?>
    </div>
</div>

<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading" style="background: rgba(0, 0, 0, 0) linear-gradient(to bottom, rgba(207, 2, 6, 1), rgba(183, 0, 3, 1)) repeat scroll 0 0; border-radius: 0; color: #ffffff;">Разное</div>

    <div class="list-group">
        <?php foreach(Model::readAll('items', ['where' => ['menuId' => 5]]) as $row): ?>
            <a href="/<?=$row['url']?>" class="list-group-item">
                <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
                <?=$row['name']?>
            </a>
        <?php endforeach; ?>
    </div>
</div>