//angular.module('userApp', ['ui.bootstrap', 'firebase'])
app.controller('userCtrl', ['$scope', '$http', function($scope, $http){
        $scope.items = JSON.parse('<?=$table?>');

        $scope.tt = 'ds';
        $scope.radioModel = 'on';

        $scope.selBan = function(id, value){
            $http({
                method: 'POST',
                url: '/users/ban',
                data: "id="+id+"&value="+value,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response) {
                console.clear();
            });
        }

        $scope.selExpertOnMain = function(id, value){
            //console.log(id, value);
            //$http.post({url:'/users/expertOnMain', data: "id="+id+"&value="+value});
            $http({
                method: 'POST',
                url: '/users/expertOnMain',
                data: "id="+id+"&value="+value,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response) {
                //$scope.myWelcome = response.data;
                console.clear();
            });
        }

    }]);
