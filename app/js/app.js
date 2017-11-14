
var app = angular.module('myApp', ['ngRoute'])
app.run(function($rootScope) 
{
    $rootScope.breweryId = '';
});
app.config(['$routeProvider', function ($routeProvider) {

    $routeProvider.when('/', {
        controller: 'DashboardCtrl',
        templateUrl: 'app/pages/userlist.html'
    });

    $routeProvider.otherwise({
        redirectTo: '/dashboard',
        templateUrl: 'app/pages/dashboard.html'
    });

    

}]);
