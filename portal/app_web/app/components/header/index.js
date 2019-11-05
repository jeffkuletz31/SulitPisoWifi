var app = angular.module('app');

app.controller('headerController', function ($scope, $interval) {

    $scope.init = function() {

        $interval(function() {
            $scope.data = new Date().toLocaleString();
        }, 1000);
    };    

    $scope.init();
});