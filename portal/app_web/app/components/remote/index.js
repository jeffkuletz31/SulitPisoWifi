var app = angular.module('app');

app.controller('remoteController', function ($scope, $interval, variableFactory) {

    $scope.remote = variableFactory.remote;

    $scope.init = function() {
        $scope.remote = variableFactory.remote;
    };

    $scope.init();
});