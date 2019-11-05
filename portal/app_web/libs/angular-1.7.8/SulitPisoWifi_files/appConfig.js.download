var app = angular.module('app');

app.config(function (
    $routeProvider,
    $locationProvider,
    $httpProvider,
    $logProvider) {

    $routeProvider
        .when('/', {
            redirectTo: '/main'
        })
        .when('/main', {
            templateUrl: "app/components/main/index.html",
            controller: 'mainController',
            resolve: {
                init : function (variableFactory) {
                    variableFactory.init();
                    //console.log(variableFactory);
                }
            }
        })
        .when('/admin', {
            // templateUrl: 'app/view/directive/panelContainer.html',
            // controller: 'panelContainerController',
            // authenticated: true,
            // resolve: {
            //     flags: function ($timeout, flagFactory, uiFactory) {
            //         flagFactory.init();
            //     }
            // }

        })
        // when('/login', {
        //     templateUrl: 'app/view/form/login.html',
        //     controller: 'loginController',
        // })
        .otherwise({
            redirectTo: '/'
        });


    $logProvider.debugEnabled(false);
});