var app = angular.module('app');

app.controller('transactionController', function (
    $scope, $interval,
    variableFactory,
    Transaction) {


    $scope.init = function() {
        // Transaction.getByClient({client : variableFactory.client.id }, function(result){
        //     $scope.transaction = result;
        //     $scope.result = "alert alert-success";
        //     $scope.message = "Transaction exist.";
        // },
        // function(result) {
        //     $scope.result = "alert alert-danger";
        //     $scope.message = "Transaction doesnt exist.";
        // });

        $scope.transactions = Transaction.query();
    };
    
    $scope.init();
});