

<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Starter Codeigniter & Angularjs</title>
    
</head>
<body ng-cloak>
<div id="wrapper" ng-cloak="">
    <div class="view page page-fade-in" ng-view ng-cloak=""></div>
</div>

<!-- Angular Init Here -->
<script src="<?php echo base_url(); ?>assets/js/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
<script src="<?php echo base_url(); ?>app/js/app.js"></script>
<script src="<?php echo base_url(); ?>app/js/controllers/BeerController.js"></script>
<script src="<?php echo base_url(); ?>app/js/services/myServices.js"></script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/jquery-2.0.0.js"></script>
<link rel="stylesheet" type='text/css' href="<?php echo base_url(); ?>assets/css/beer.css">
<?php echo base_url(); ?>
<!-- App JS Files
<script src="<?php echo base_url(); ?>angular/js/application.js"></script>
<script src="<?php echo base_url(); ?>angular/js/controller.js"></script>
<script src="<?php echo base_url(); ?>angular/js/directive.js"></script>
<script src="<?php echo base_url(); ?>angular/js/services.js"></script>
<script src="<?php echo base_url(); ?>angular/js/filters.js"></script>-->
</body>
</html>
