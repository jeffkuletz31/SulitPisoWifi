var app = angular.module('app');

app.controller('clientController', function (
    $scope, $interval,
    variableFactory,
    Client) {

    $scope.init = function() {
        $interval(function() {
            variableFactory.remote.$promise.then(function() {
                Client.getByIpMac({ip : variableFactory.remote.data[0].ip, mac : variableFactory.remote.data[0].mac}, 
                    function(result) {

                        $scope.client = result.data;
                        variableFactory.client = result;
                        console.log("client exist!");

                        $scope.client.data.dtLogged = Date.now() / 1000;
                        Client.update({id : $scope.client.data.id}, $client.data);
                    },
                    function(result) {
                        var newClient = Client();
                        newClient.ip = result.data.ip;
                        newClient.mac = result.data.mac;
                        newClient.browser = result.data.browser;
                        newClient.status = {id : 1};

                        Client.save(newClient, function(result) {
                            console.log("client save!");
                        });
                    });
            });
        }, 3000);
    };
    
    $scope.init();
});