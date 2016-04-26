<style>
    .even{
        background-color: rgb(238, 238, 238);
    }
    .thead{
        background-color: rgb(195, 3, 6);
        color: #fff;
    }
</style>

<div ng-controller="userCtrl">

    <table class="table table-striped table-hover">
        <thead>
        <tr class="thead">
            <th ng-click="sort('ban')">БАН
                <span class="glyphicon sort-icon" ng-show="predicate=='ban'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
            </th>
            <th ng-click="sort('expertOnMain')">ЭКСПЕРТ НА ГЛАВНОЙ
                <span class="glyphicon sort-icon" ng-show="predicate=='expertOnMain'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
            </th>
            <th ng-click="sort('login')">ЛОГИН
                <span class="glyphicon sort-icon" ng-show="predicate=='login'" ng-class="{'glyphicon-chevron-up':reverse,'glyphicon-chevron-down':!reverse}"></span>
            </th>
            <th>
                EMAIL
            </th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="item in items" ng-class-even="'even'">
            <td>
                <div class="btn-group">
                    <label class="btn btn-xs" ng-model="item.ban" ng-change="selBan(item.id, '1')" uib-btn-radio="'1'" ng-class="{'btn-primary': item.ban == 1, 'btn-default': item.ban == 0}">on</label>
                    <label class="btn btn-xs" ng-model="item.ban" ng-change="selBan(item.id, '0')" uib-btn-radio="'0'" ng-class="{'btn-default': item.ban == 1, 'btn-danger': item.ban == 0}">off</label>
                </div>
            </td>
            <td>
                <div class="btn-group">
                    <label class="btn btn-xs" ng-model="item.expertOnMain" ng-change="selExpertOnMain(item.id, '1')" uib-btn-radio="'1'" ng-class="{'btn-primary': item.expertOnMain == 1, 'btn-default': item.expertOnMain == 0}">on</label>
                    <label class="btn btn-xs" ng-model="item.expertOnMain" ng-change="selExpertOnMain(item.id, '0')" uib-btn-radio="'0'" ng-class="{'btn-default': item.expertOnMain == 1, 'btn-danger': item.expertOnMain == 0}">off</label>
                </div>
            </td>
            <td ng-bind="item.login"></td>
            <td ng-bind="item.email"></td>
        </tr>
        </tbody>
    </table>
</div>
