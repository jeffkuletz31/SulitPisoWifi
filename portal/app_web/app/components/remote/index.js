var app = angular.module('app');

app.controller('remoteController', function ($scope, $interval, variableFactory) {

    $scope.init = function() {
        variableFactory.remote.$promise.then(function() {
            $scope.remote = variableFactory.remote.data[0]; 
        });
    };

    $scope.init();
});