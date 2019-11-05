var app = angular.module('app');

app.controller('sessionController', function (
    $scope, $interval,
    variableFactory,
    Session) {


    $scope.init = function() {
        $interval(function() {
            variableFactory.client.$promise.then(function(){
                $scope.session = Session.getByClient(
                    {client : variableFactory.client.id },
                    function(result){
                        //console.log(result);        
                    }, 
                    function(result) {
                        
                        //console.log(result);
                    });
            });
        }, 1000);
    };
    
    $scope.init();
});