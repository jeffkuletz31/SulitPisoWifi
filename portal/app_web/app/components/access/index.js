var app = angular.module('app');

app.controller('accessController', function (
    $scope, $interval,
    variableFactory,
    Access) {

    $scope.code = "";
    $scope.result = "";
    $scope.message = "";
    $scope.alerts = [];



    $scope.check = function(){
        $scope.alerts = [];
        Access.getByCode({code : $scope.code}, 
            function(result) {
                $scope.access = result;

                var dt = new Date(result.dtExpired * 1000);
                console.log(dt.getTime());
                var now = new Date();
                console.log(now.getTime());

                if (dt.getTime() <= now.getTime()) $scope.alerts.push({ type: 'danger', message : "Access is expired."});
                
                if (result.status.value == 1) $scope.alerts.push({ type: 'danger', message : "Access is blocked."});
                if (result.status.value == 2) $scope.alerts.push({ type: 'danger', message : "Access is suspended."});
                if (result.status.value == 3) $scope.alerts.push({ type: 'danger', message : "Access is pending."});
            },
            function(result) {
                $scope.alerts.push({ type: 'danger', message : "Access code doesnt exist."});
            });
    };
    
    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };

    $scope.init = function() {
 
    };

    $scope.init();
});