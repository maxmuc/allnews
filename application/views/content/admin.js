app.controller('adminCtrl', ['$scope', '$http', function($scope, $http){
    $scope.test = Date.now();

    $http({
        method: 'POST',
        //url: '/chat/insupd',
        url: '',
        //data: 'text='+$scope.text+'&expertId='+userId+'&url='+$scope.localUrl,
        //data: 'text='+$scope.text,
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function(response){
        console.log(response.data);
        $scope.contents = response.data;
        ///$scope.arr.messages = response.data.messages;
        //console.clear();
    });

    $scope.select= function(item) {
        $scope.selected = item;
        //console.log($scope.selected.title);
    };

    $scope.delContent = function(id){
        $http({
            method: 'POST',
            url: '/content/del',
            data: "id="+id,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            $scope.contents = response.data;
            //console.clear();
        });
    };

    $scope.changeStatus = function(id, status){
        $http({
            method: 'POST',
            url: '/content/status',
            data: "id="+id+'&status='+status,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            $scope.contents = response.data;
            //console.clear();
        });
    };

    $scope.changeSlider = function(id, slider){
        $http({
            method: 'POST',
            url: '/content/slider',
            data: "id="+id+'&slider='+slider,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            $scope.contents = response.data;
            //console.clear();
        });
    };
}]);