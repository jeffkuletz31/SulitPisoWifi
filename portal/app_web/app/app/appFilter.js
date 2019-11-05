var app = angular.module('app');

app.filter('datetimeFilter', function ($filter) {
    return function (input, option) {
        
        if (input == null) return "";

        var date = new Date(input * 1000);
        var formatted;

        switch (option) {
            case 'date':
                formatted = $filter('date')(date, 'yyyy-MM-dd');
                break;
            case 'time':
                formatted = $filter('date')(date, 'HH:mm:ss');
                break;
            case 'full':
                formatted = $filter('date')(date, 'yyyy-MM-dd HH:mm:ss');
                break;
            default:
                formatted = $filter('date')(date, 'yyyy-MM-dd HH:mm:ss');
        }
        //console.log("input : " + input);
        //console.log("formatted : "+ formatted);
        return formatted;
        
    };
});

app.filter('currencyFilter', function ($filter) {
    return function (input, option) {
        if (input == null) return "";
        var formatted = input.toFixed(2);;
        return formatted;
    };
});

app.filter('timeFilter', function ($filter, helperService) {
    return function (input, option) {

        if (input == null) return "";

        var days =  Math.floor(input / (24 * 60 * 60)); 
        input = input % (24 * 60 * 60);
        var hours =  Math.floor(input / (60 * 60)); 
        input = input % (60 * 60);
        var minutes =  Math.floor(input / 60);
        input = input % 60;
        var seconds =  Math.floor(input);

        var d = helperService.zeroPad(days, 1);
        var h = helperService.zeroPad(hours, 2);
        var m = helperService.zeroPad(minutes, 2);
        var s = helperService.zeroPad(seconds, 2);

        var formatted = d + " days " +h + ":" + m + ":" + s;
        return formatted;
    };
});