var app = angular.module('app');

app.controller('serverController', function($scope,  $interval, variableFactory) {
   
    $scope.init = function() {
        variableFactory.server.$promise.then(function() {
            $scope.server = variableFactory.server.data[0]; 
        });
    };

    $scope.init();
});