var app = angular.module('app');

app.controller('accessController', function (
    $scope, $interval,
    variableFactory,
    Access,
    Transaction,
    Session) {

    $scope.code = "";
    $scope.result = "";
    $scope.message = "";
    $scope.alerts = [];



    $scope.validate = function () {
        $scope.alerts = [];

        var promise = Access.getByCode({code : $scope.code}, function(result) {
            
            $scope.access = result.data;

            //checking if empty or null
            if ($scope.code == null || $scope.code == "") {
                $scope.alerts.push({ type: 'danger', message : "Access code is empty."});
                return false;
            }

            //checking expiration
            var dt = new Date(result.dtExpired * 1000);
            var now = new Date();

            if (dt.getTime() <= now.getTime()) {
                $scope.alerts.push({ type: 'danger', message : "Access code is expired."});
                return false;
            }

            //checking if blocked
            if ($scope.access.status.value == 1) {
                $scope.alerts.push({ type: 'danger', message : "Access code is blocked."});
                return false;
            }

            //checking if suspended
            if ($scope.access.status.value == 2) {
                $scope.alerts.push({ type: 'danger', message : "Access code is suspended."});
                return false;
            }

            //checking if pending
            if ($scope.access.status.value == 3) {
                $scope.alerts.push({ type: 'danger', message : "Access code is pending."});
                return false;
            }

            //checking if consumed
            if ($scope.access.status.value == 3) {
                $scope.alerts.push({ type: 'danger', message : "Access code is consumed."});
                return false;
            }

            //everything is ok
            return true;

        }, function(result) {
            //no existing code
            $scope.alerts.push({ type: 'danger', message : "Access code doesnt exist."});
            return false;
        });
    }

    $scope.check = function(){ 
        $scope.validate();
    };
    
    $scope.subscribe = function(){ 

        var value = $scope.validate();

        if (value == true){
            var session = Session();
            session.client = variableFactory.client.data.id;
            session.access = $scope.access.id;
            session.status = variableFactory.status.data[0].id;
            Session.save(session);
            console.log(session);

            var transaction = Transaction();
            transaction.client = variableFactory.client.data.id;
            transaction.access = $scope.access.id;
            transaction.status = variableFactory.status.data[0].id;
            Transaction.save(transaction);
            console.log(transaction);


            $scope.access.status = variableFactory.status.data[4].id;
            Access.update({id : $scope.access.id}, $scope.access);
            console.log($scope.access);

        }

        $scope.alerts.push({ type: 'success', message : "Subscribing successful."});
    };
    

    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };

    $scope.init = function() {
 
    };

    $scope.init();
});