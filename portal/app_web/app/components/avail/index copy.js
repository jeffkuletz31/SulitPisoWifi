var app = angular.module('app');

app.controller('accessController', function (
    $scope, $interval,
    variableFactory,
    HelperService,
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

                var dt = new Date(HelperService.parseDatetime($scope.access.dtExpired));
                console.log(dt);
                var now = Date.getUTCDate();
                console.log(now);

                if (dt.getTime() < now.getTime()) 
                    $scope.alerts.push({ type: 'danger', message : "Access is expired."});
                
                if ($scope.status.value == 1) 
                    $scope.alerts.push({ type: 'danger', message : "Access is blocked."});

                if ($scope.status.value == 2) 
                    $scope.alerts.push({ type: 'danger', message : "Access is suspended."});
                
                if ($scope.status.value == 3) 
                    $scope.alerts.push({ type: 'danger', message : "Access is pending."});
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