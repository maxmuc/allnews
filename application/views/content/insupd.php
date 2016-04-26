<?php $id = $this->uri->segment(3, 0); ?>

<div ng-controller="insupdCtrl">

    <form method="post" action="/content/insupd/<?=$id?$id:false?>">

        <div class="btn-group btn-group-sm" role="group" aria-label="Сохранить" style="position: absolute; top: 6px; right: 12px;">
            <button class="btn btn-default">Сохранить</button>
        </div>

        <?=input('Content', 'title', ['label' => false])?>

        <div class="row">
            <div class="col-md-6">
                <select class="form-control" name="Content[menuId]" id="Content_menuId" ng-model="selectedMenu" ng-change="selMenu(selectedMenu.id)" ng-options="tt.name for tt in menu track by tt.id">
                    <option value="">Выбрать меню...</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-control" name="Content[itemId]" id="Content_itemId" ng-model="selectedItem" ng-options="tt.name for tt in items track by tt.id">
                    <option value="">Выбрать пункт...</option>
                </select>
            </div>
        </div><br />

        <?=input('Content', 'text', ['textarea', 'placeholder' => false, 'label' => false])?>

    </form>
</div>

<script type="text/javascript" src="/js/lib/tinymce/tinymce.min.js"></script>
<script>
    $(function() {
        tinyMCE.init({
            selector: '#Content_text',
            height: 500,
            plugins: [
                "link textcolor colorpicker image code table media nonbreaking emoticons hr"
            ],
            toolbar: 'undo redo | bold italic removeformat | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | hr | code',
            file_browser_callback: RoxyFileBrowser,
            menubar: false,
            image_advtab: true,
            apply_source_formatting : false
        });
    });

    function RoxyFileBrowser(field_name, url, type, win) {
        var roxyFileman = '/js/lib/fileman/index.html';
        if (roxyFileman.indexOf("?") < 0) {
            roxyFileman += "?type=" + type;
        }
        else {
            roxyFileman += "&type=" + type;
        }
        roxyFileman += '&input=' + field_name + '&value=' + win.document.getElementById(field_name).value;
        if(tinyMCE.activeEditor.settings.language){
            roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
        }
        tinyMCE.activeEditor.windowManager.open({
            file: roxyFileman,
            title: 'Roxy Fileman',
            width: 850,
            height: 650,
            resizable: "yes",
            plugins: "media",
            inline: "yes",
            close_previous: "no"
        }, {     window: win,     input: field_name    });
        return false;
    }
</script>

