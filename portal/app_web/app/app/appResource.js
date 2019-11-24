var app = angular.module('app');

var ip = 'http://192.168.1.16:81';
//var ip = 'http://192.168.100.1:81';


app.factory('Server', function ($resource) {
    return $resource(ip + '/server/:id', { id: '@id' }, {
        'getAll' : {
            method: 'GET',
            isArray : false
        }
    });
});

app.factory('Remote', function ($resource) {
    return $resource(ip + '/remote/:id', { id: '@id' } ,{
        'getAll' : {
            method: 'GET',
            isArray : false
        }
    });
});

app.factory('Status', function ($resource) {
    return $resource(ip + '/status/:id', { id: '@id' }, {
        'getAll' : {
            method: 'GET',
            isArray : false
        }
    });
});

app.factory('Access', function ($resource) {
    return $resource(ip + '/access/:id', { id: '@id' }, {
        'getAll' : {
            method: 'GET',
            isArray : false
        },
        'update': {
            method: 'PUT'
        },
        getByCode: {
            method: 'GET',
            params: {
                code: '@code',
            }
        }
    });
});

app.factory('Transaction', function ($resource) {
    return $resource(ip + '/transaction/:id', { id: '@id' }, {
        'getAll' : {
            method: 'GET',
            isArray : false
        },
        'update': {
            method: 'PUT'
        },
        getByClient: {
            method: 'GET',
            params: {
                client: '@client',
            }
        }
    });
});

app.factory('Client', function ($resource) {
    return $resource(ip + '/client/:id', { id: '@id' },{
        'getAll' : {
            method: 'GET',
            isArray : false
        },

        'update': {
            method: 'PUT'
        },
        getByIpMac: {
            method: 'GET',
            params: {
                ip: '@ip',
                mac: '@mac'
            }
        },
        getByIp: {
            method: 'GET',
            params: {
                ip: '@ip'
            }
        },
        getByMac: {
            method: 'GET',
            params: {
                mac: '@mac'
            }
        }
    });
});

app.factory('Session', function ($resource) {
    return $resource(ip + '/session/:id', { id: '@id' },{
        'getAll' : {
            method: 'GET',
            isArray : false
        },
        'update': {
            method: 'PUT'
        },
        getByClient: {
            method: 'GET',
            params: {
                client: '@client',
            }
        }
    });
});
