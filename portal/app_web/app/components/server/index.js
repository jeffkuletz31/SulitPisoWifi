var app = angular.module('app');

app.controller('serverController', function($scope,  $interval, variableFactory) {
   
    $scope.server = variableFactory.server;

    $scope.init = function() {
        $interval(function() {
            $scope.server = variableFactory.server;
            variableFactory.load('server');
        }, 3000);
    };

    $scope.init();
});