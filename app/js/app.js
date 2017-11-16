var app = angular.module('myApp', ['ngRoute'])
app.run(function($rootScope) {
    $rootScope.breweryId = '';
});
app.config(['$routeProvider', function($routeProvider) {

    $routeProvider.when('/', {
        controller: 'BeerCtrl',
        templateUrl: 'app/pages/beer.html'
    });

    $routeProvider.otherwise({
        redirectTo: '/home',
        templateUrl: 'app/pages/home.html'
    });
}]);
