var app = angular.module('app');

app.factory('variableFactory', function (
    $q,

    Server,
    Remote,
    Status
 
    ) {

    var variableFactory = {};
    
    variableFactory.client = {};


    variableFactory.load = function (type) {
        switch (type) {
            case 'server':
                Server.getAll(function(result) {
                    variableFactory.server = result;
                });
                break;
            case 'remote':
                Remote.getAll(function(result) {
                    variableFactory.remote = result;
                });
                break;
            case 'status':
                Status.getAll(function(result) {
                    variableFactory.status = result;
                })
                break;
        }
    };

    variableFactory.init = function () {

        var promises = $q.all(
            [
                Server.getAll(),
                Remote.getAll(),
                Status.getAll()
            ]
        );

        promises.then(function (result) {
            variableFactory.server = result[0];
            variableFactory.remote = result[1];
            variableFactory.status = result[2];
        });
    };

    return variableFactory;  
});
