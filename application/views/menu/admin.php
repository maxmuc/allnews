<style>
    #sortable{
        border: 1px solid #e0dfe3;
        border-radius: 3px;
        height: 175px;
        margin: 0;
        padding: 8px 12px;
        overflow: auto;
        list-style: none;
    }
    #sortable li{
        cursor: move;
        border: 1px solid #e2be3b;
        border-radius: 1px;
        background: #e2c868;
        padding: 3px 6px;
        margin: 2px 0;
        color: #806501;
    }
</style>

<div class="btn-group btn-group-sm" role="group" aria-label="Создать меню" style="float: right; margin-top: -50px;">
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#menuModal" id="buttonOpenModalMenu">Создать меню</button>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#itemModal" id="buttonOpenModalItem">Создать пункт</button>
</div>

<div class="row">
    <div class="col-md-6">
        <div style="text-align: center;">Список меню</div>
        <div id="menuSelect">
            <select multiple class="form-control" style="height: 175px;">
                <?php foreach(Model::readAll('menu') as $row): ?>
                    <option value="<?=$row['id']?>">
                        <?=$row['name']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div style="text-align: center;">Список пунктов</div>
        <ul id="sortable" style=""></ul>
    </div>
</div>
<br />
<p class="text-muted">*Двойной клик по любой ячейке - вход в "Редактирование ячейки"</p>
<p class="text-muted">*Для изменения последовательности пунктов, перетяните ячейку-пункта в нужное место</p>

<!--модальное окно меню-->
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Создание меню</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Ввести название..." aria-describedby="basic-addon1" id="nameMenu" menuId="">
                <p class="text-danger"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="float: left; display: none;" data-dismiss="modal" id="buttonDeleteMenu" >Удалить меню</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save">Сохранить изменения</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--модальное окно пунктов-->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Создание пункта</h4>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Ввести название..." aria-describedby="basic-addon1" id="nameItem" itemId="" menuId="">
                <p class="text-danger"></p>
                <input type="text" class="form-control" placeholder="URL пункта/страницы..." aria-describedby="basic-addon1" id="url">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" >Статический URL
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" style="float: left; display: none;" data-dismiss="modal" id="buttonDeleteItem" >Удалить меню</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="save">Сохранить изменения</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
