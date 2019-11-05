var app = angular.module('app');

app.controller('clientController', function (
    $scope, $interval,
    variableFactory,
    Client) {

    $scope.init = function() {
        $interval(function() {
            Client.getByIpMac({ip : variableFactory.remote.ip, mac : variableFactory.remote.mac}, 
                function(result) {
                    $scope.client = result;
                    variableFactory.client = result;
                    console.log("client exist!");
                    $scope.client.dtLogged = Date.now() / 1000;
                    $scope.client.update({id : $scope.client.id});
                },
                function(result) {
                    variableFactory.remote.status = {};
                    variableFactory.remote.status.id = 1;
                    Client.save(variableFactory.remote, function(result) {
                        console.log("client save!");
                    });
                })
        }, 1000);
    };
    
    $scope.init();
});