<!DOCTYPE html>
<html ng-app="myApp">
   <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Distilled SCH</title>
   </head>
   <body ng-cloak>
      <div id="wrapper" ng-cloak="">
         <div class="view page page-fade-in" ng-view ng-cloak=""></div>
      </div>
      <script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/angular-route.min.js"></script>
      <script src="<?php echo base_url(); ?>app/js/app.js"></script>
      <script src="<?php echo base_url(); ?>app/js/controllers/BeerController.js"></script>
      <script src="<?php echo base_url(); ?>app/js/services/myServices.js"></script>
      <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery-2.0.0.js"></script>
      <link rel="stylesheet" type='text/css' href="<?php echo base_url(); ?>assets/css/beer.css">
   </body>
</html>