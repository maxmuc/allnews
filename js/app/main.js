var app = angular.module('mainApp', []);

app.config(['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers
        .common['X-Requested-With'] = 'XMLHttpRequest';
}]);

app.controller('mainCtrl', ['$scope', '$timeout', function($scope, $timeout){
    $scope.clock = "loading clock..."; // initialise the time variable
    $scope.tickInterval = 1000 //ms

    var tick = function() {
        $scope.clock = Date.now() // get the current time
        $timeout(tick, $scope.tickInterval); // reset the timer
    }

    // Start the timer
    $timeout(tick, $scope.tickInterval);
}]);