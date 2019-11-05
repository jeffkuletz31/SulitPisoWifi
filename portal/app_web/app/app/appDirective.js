var app = angular.module('app');

app.directive('serverDirective', function () {
    return {
        templateUrl: '/app/components/server/index.html',
        controller: 'serverController'
    }
});

app.directive('remoteDirective', function () {
    return {
        templateUrl: '/app/components/remote/index.html',
        controller: 'remoteController'
    }
});

app.directive('clientDirective', function () {
    return {
        templateUrl: '/app/components/client/index.html',
        controller: 'clientController'
    }
});


app.directive('accessDirective', function () {
    return {
        templateUrl: '/app/components/access/index.html',
        controller: 'accessController'
    }
});

app.directive('transactionDirective', function () {
    return {
        templateUrl: '/app/components/transaction/index.html',
        controller: 'transactionController'
    }
});

app.directive('sessionDirective', function () {
    return {
        templateUrl: '/app/components/session/index.html',
        controller: 'sessionController'
    }
});

app.directive('footerDirective', function () {
    return {
        templateUrl: '/app/components/footer/index.html',
        controller: 'footerDirective'
    }
});

app.directive('headerDirective', function () {
    return {
        templateUrl: '/app/components/header/index.html',
        controller: 'headerController'
    }
});

// app.directive('panelMap', function () {
//     return {
//         templateUrl: '/app/view/directive/panelMap.html',
//         controller: 'panelMapController'
//     }
// });

// app.directive('panelLoading', function () {
//     return {
//         templateUrl: '/app/view/directive/panelLoading.html',
//         controller: 'panelLoadingController'
//     }
// });

// app.directive('panelBottom', function () {
//     return {
//         templateUrl: '/app/view/directive/panelBottom.html',
//         controller: 'panelBottomController'
//     }
// });