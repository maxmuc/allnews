<style>
    .warning th{
        background-color: rgb(192, 2, 6) !important;
        color: #fff;
    }
    thead th{
        cursor: pointer;
    }
    .pagination-sm{
        margin: 0;
    }
    .rud a{
        color: #727476;
    }
    .rud i{
        font-size: 130%;
        margin: 0 5px;
        cursor: pointer;
    }
    .rud i:hover{
        color: #1b5693;
    }
</style>

<div ng-app="mainApp" ng-controller="adminCtrl">

    <div style="position: absolute; right: 12px; top: 6px;">
        <a class="btn btn-default btn-sm" href="insupd" role="button">Создать</a>
    </div>

    <div class="row">
        <div class="col-xs-3">
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="stroki" class="col-xs-3 control-label">Строки: </label>
                    <div class="col-xs-5">
                        <select class="form-control input-sm" ng-model="contentsPerPage" ng-options="item for item in [5,10,25,50,100]"></select>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-xs-4 col-xs-offset-5">
            <div class="input-group input-group-sm">
                    <span class="input-group-addon" id="sizing-addon3">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </span>
                <input type="text" class="form-control" ng-model="search" placeholder="Search" aria-describedby="sizing-addon3" />
            </div>
        </div>
    </div>

    <table class="table table-striped table-hover" style="margin-top: 10px;">
        <thead>
        <tr class="warning">
            <th style="width: 40px;">вкл</th>
            <th style="width: 40px;">Слайдер</th>
            <th ng-click="sort('title')">Заголовок
                <span class="glyphicon sort-icon" ng-show="predicate=='title'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
            </th>
            <th style="width: 122px;">Меню</th>
            <th style="width: 90px;">Пункты</th>
            <th style="width: 104px;"></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="content in contents | orderBy:predicate:reverse | filter:search | limitTo:contentsPerPage:step" ng-class-even="'active'" ng-click="select(content)" ng-class="{info: isActive(content)}">
            <td style="text-align: center;">
                <input type="checkbox" ng-model="content.status" ng-true-value="1" ng-false-value="0" ng-change="changeStatus(content.id, content.status)">
            </td>
            <td style="text-align: center;">
                <input type="checkbox" ng-model="content.slider" ng-true-value="1" ng-false-value="0" ng-change="changeSlider(content.id, content.slider)">
            </td>
            <td>{{content.title}}</td>
            <td>{{content.menuId}}</td>
            <td>{{content.itemId}}</td>
            <td class="rud">
                <a href="/content/view/{{content.id}}">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a>
                <a href="/content/insupd/{{content.id}}">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
                <i data-toggle="modal" data-target="#delContent" ng-click="select(content)" class="fa fa-trash-o" aria-hidden="true"></i>
            </td>
        </tr>
        </tbody>
    </table>

    <div>
        <span>Страница: {{currentPage}} / {{numPages}} из {{totalItems}} значений</span>
        <uib-pagination total-items="totalItems" ng-model="currentPage" ng-change="pageChanged()" style="float: right;" boundary-links="true" class="pagination-sm" previous-text="&lsaquo;" next-text="&rsaquo;" first-text="&laquo;" last-text="&raquo;" items-per-page="contentsPerPage" max-size="maxSize"></uib-pagination>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="delContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Удалить статью</h4>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Внимание! Статья с заголовком "{{selected.title}}" будет удалена!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" ng-click="delContent(selected.id)">Удалить</button>
                </div>
            </div>
        </div>
    </div>

</div>