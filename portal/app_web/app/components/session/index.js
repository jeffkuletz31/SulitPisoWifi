var app = angular.module('app');

app.controller('sessionController', function (
    $scope, $interval,
    variableFactory,
    Session) {


    $scope.init = function() {
        $interval(function(){ 
            variableFactory.client.$promise.then(function(result) {
                    Session.getByClient({client :  variableFactory.client.data.id}, 
                        function(result){
                            if (result.status == 'SUCCESS') {
                                $scope.session = result.data;
                            } else {
                                console.log(result.fault.message);                             
                            }
                        });
            });
        }, 1000);
    };
    
    $scope.init();
});