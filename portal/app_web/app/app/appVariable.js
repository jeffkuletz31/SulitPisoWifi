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
                variableFactory.server = Server.get({id : 1});
                break;
            case 'remote':
                variableFactory.remote = Remote.get({id : 1});
                break;
            case 'status':
                variableFactory.status = Status.query();
                break;
        }
    };

    variableFactory.init = function () {

        var promises = $q.all(
            [
                Server.get({id : 1}),
                Remote.get({id : 1}),
                Status.query()
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
