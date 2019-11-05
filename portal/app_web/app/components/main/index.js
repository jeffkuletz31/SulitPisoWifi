var app = angular.module('app');

app.controller('mainController', function ($scope) {

    $scope.activeMenu = 0;
    
    $scope.click = function(){
        alert($scope.activeMenu);
    }

    $scope.init = function() {
        
    };
    

    $scope.init();
});