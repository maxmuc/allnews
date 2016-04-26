app.controller('insupdCtrl', ['$scope', '$http', function($scope, $http){
    $scope.items = [];

    $scope.selMenu = function(idMenu){
        if(idMenu !== undefined){
            var arr = [];
            for(var tt in $scope.itemsMain){
                if($scope.itemsMain[tt].menuId == idMenu)
                    arr.push($scope.itemsMain[tt]);
            }
            $scope.items = arr;
        }else
            $scope.items = [];

    }

    $http({
        method: 'POST',
        url: '',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    }).then(function(response){
        $scope.itemsMain = response.data.items;
        //console.log(response.data);
        $scope.menu = response.data.menu;
        if(response.data.menuSel){
            $scope.selectedMenu = response.data.menuSel;
            //console.log(response.data.menuSel.id);
            $scope.selMenu(response.data.menuSel.id);
        }
        if(response.data.itemSel){
            $scope.selectedItem = response.data.itemSel;
            //console.log(response.data.menuSel.id);
            //$scope.selMenu(response.data.menuSel.id);
        }

        //console.clear();
    });
}]);