app.controller('BeerCtrl', function(dataFactory, $scope, $rootScope, $http) {
    $rootScope.breweryId = '';
    $scope.regex = '^[a-zA-Z0-9. -]+$';

    /*
     * Gets random beer
     */
    dataFactory.httpRequest('/beerapp/index.php/beer/getRandomBeer', 'GET').then(function(response) {
        $('.loader').addClass("hide");
        $scope.beerName = response.name;
        $scope.beerDescription = response.description;
        $rootScope.breweryId = response.breweryId;
        $scope.beerImage = response.image;
    });


    /*
     * Gets all beers from a brewery
     */
    $scope.breweryBeers = function() {
        $(".brewery-beers").removeClass("hide");
        $('.search-types').addClass('hide');
        $('.search-type-text').addClass('hide');
        dataFactory.httpRequest('/beerapp/index.php/beer/getBreweryBeers/' + $rootScope.breweryId, 'GET').then(function(response) {
            $('.loader').addClass("hide");
            if (!$scope.$$phase) $scope.$apply();
            $scope.beerNames = '';
            $scope.beerDescriptions = '';
            $scope.beerImages = '';
            $scope.brewBeers = response.results;
            return false;
        });
    }

    /*
     * Gets random beer
     */
    $scope.anotherBeer = function() {
        $(".brewery-beers").addClass("hide");
        $('.search-types').addClass('hide');
        $('.search-type-text').addClass('hide');
        dataFactory.httpRequest('/beerapp/index.php/beer/getRandomBeer/', 'GET').then(function(response) {
            $('.loader').addClass("hide");
            $scope.beerName = response.name;
            $scope.beerDescription = response.description;
            $rootScope.breweryId = response.breweryId;
            $scope.beerImage = response.image;
        });
    }

    /*
     * Submits search form and gives search results
     */
    $scope.formsubmit = function(isValid) {
        if (isValid) {
            dataFactory.httpRequest('/beerapp/index.php/beer/searchBeerBrewery/', 'POST', {
                name: $scope.name,
                type: $scope.type
            }).then(function(response) {
                $('.loader').addClass("hide");
                if (response.results[0].status == 'fail') {
                    $('.search-type-text').removeClass('hide');
                    $('.search-types').addClass('hide');
                    $(".brewery-beers").addClass("hide");
                    $('.search-type-text p').html(response.results[0].message);
                } else {
                    $('.search-types').removeClass('hide');
                    $('.search-type-text').addClass('hide');
                    $(".brewery-beers").addClass("hide");
                    $scope.searchTypes = response.results;
                }
            });
        } else {
            alert('Form is not valid');
        }
    }
});