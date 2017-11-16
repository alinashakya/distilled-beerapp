###############################
Distilled SCH Beer Application
###############################

This is a simple PHP website that interacts with the BreweryDB API which is built using technologies like PHP, CodeIgniter, Angular JS, jQuery, Html and Css. It also uses PHP Redis for caching and followed PSR-2 coding standard. Some features are:

- It displays a random beer section (beer name, description and image) with two buttons "Another Beer" and "More From This Brewery".
	- "Another Beer" displays other radom beer.
	- "More From This Brewery" displays lists of beer from that brewery.
- It also consists of a small search form where users can search for beers or breweries by free text search. Search field must only contain letters, numbers, hyphens and spaces else alert box appers with message "Form is not valid".

*******************
Other Information
*******************

- It uses one page application to display random beers, beers in a brewery and search sections.
- You need to have Redis server installed in the system => https://redis.io/
- Composer is required to manage dependecies.
- Javascript library "AngularJs" is used which is maintained in "app" folder. "angular.min.js" is used for using angular properties whereas "angular-route.min.js" is used for routing purpose.
- BreweryDb library is used to connect to brewery DB Api to get beers and breweries informations.
- Used some classes from Bootstrap library.
- It has been successfully tested in chrome and firefox.

