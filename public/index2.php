<?php 

$templates = ["Dashboard"=>"./assets/js/dashboard/dashPartial.php","Lodge"=>"./assets/js/rooms/roomsPartial.php","Settings"=>"./assets/js/users/usersPartial.php","Records"=>"./assets/js/records/recordsPartial.php"]
?>

<!doctype html>
<html ng-app="app">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FrontDesk</title>

    <!-- Angular core -->
    <script src="./vendor/angular/angular.min.js"></script>
    <script src="./vendor/angular/angular-route.min.js"></script>
    <script src="./vendor/angular/angular-animate.min.js"></script>
    <script src="./vendor/angular/angular-sanitize.min.js"></script>
    <script src="./vendor/angular/ui-bootstrap-tpls-2.5.0.min.js"></script>

    <!-- jQueryui core -->
    <script src="./vendor/jquery/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="./vendor/jquery-ui-1.12.1/jquery-ui.css">
    <script src="./vendor/jquery-ui-1.12.1/jquery-ui.js"></script>

    <!-- Bootstrap core-->
    <link rel="stylesheet" href="./vendor/bootstrap4-alpha/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="./vendor/bootstrap4-alpha/js/bootstrap.min.js"></script>

    <!-- Hamburger css -->
    <link href="./vendor/hamburgers/dist/hamburgers.css" rel="stylesheet">
    <link href="./vendor/Hover/css/hover.css" rel="stylesheet">

    <!-- list core js -->
    <script src="./vendor/List/List.js"></script>

    <!-- Custom styles for this template -->
    <link href="./assets/css/index.css" rel="stylesheet">
    <link href="./assets/css/ng-animation.css" rel="stylesheet">
    <link href="./assets/css/utilities.css" rel="stylesheet">
    <link rel="stylesheet" href="./vendor/node_modules/croppie/croppie.css" />
    <link rel="stylesheet" href="./vendor/node_modules/ng-croppie/unminified/ng-croppie.css" />
    <link rel="stylesheet" href="./vendor/node_modules/angularjs-datepicker/src/css/angular-datepicker.css" />

    <!-- Custom scripts for this template -->
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/filters.js"></script>
    <script src="./assets/js/services.js"></script>
    <script src="./assets/js/directives.js"></script>
    <script src="./assets/js/dashboard/directives.js"></script>
    <script src="./assets/js/dashboard/controllers.js"></script>
    <script src="./assets/js/rooms/directives.js"></script>
    <script src="./assets/js/rooms/controllers.js"></script>
    <script src="./assets/js/users/directives.js"></script>
    <script src="./assets/js/users/controllers.js"></script>
    <script src="./assets/js/records/directives.js"></script>
    <script src="./assets/js/records/controllers.js"></script>
    <script src="./vendor/node_modules/ng-croppie/unminified/ng-croppie.js"></script>
    <script src="./vendor/node_modules/angularjs-datepicker/src/js/angular-datepicker.js"></script>
</head>

<body>

    <div class="wrapper anim" ng-style = "{'padding-left': settings.role == 'admin' ? '80px' : '0'}"  ng-controller="appctrl" ng-class = "{'toggled' : settings.role == 'admin' ? sidebarnav.menuicon.active : false}">
        <div class="sidebarleft anim" ng-style = "{'width': settings.role == 'admin' ? '80px' : '0'}">
            <div class="h-15 menuicon w-100 ml-3 pl-1 py-4">
                <div class="hamburger hamburger--minus p-0" ng-click="sidebarnav.menuicon.toggleactive()" ng-class="{'is-active':sidebarnav.menuicon.active}">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </div>
            
            <div class="navig">
                <ul class="wht">
                    <li ng-repeat = "nav in sidebarnav.navig.navs" class = "{{nav.listClass}}" ng-style = "{opacity:  nav.name == sidebarnav.navig.activeNav ? '1': null, background:  nav.name == sidebarnav.navig.activeNav ? '#222': null, boxShadow : nav.name == sidebarnav.navig.activeNav ? 'inset 0px -5px 10px rgba(0,0,0,.3), inset 0px 5px 10px  rgba(0,0,0,.3)': null}" ng-click = "sidebarnav.navig.mkactiveNav(nav.name)"><i class="{{nav.iconClass}}" ng-bind-html = "nav.innerHtml"></i>{{sidebarnav.menuicon.active ? nav.name : null}}</li>
                </ul>
            </div>
        </div>
        
        <div class="main"   ng-switch on="sidebarnav.navig.activeNav">
            
            <?php foreach($templates as $key => $value): ?>
            <div class  = "<?php echo $key ?>" ng-switch-when = "<?php echo $key; ?>">
                <div ng-include ng-init = "settings.userDefinition('<?php echo $_SESSION['user_name']; ?>', '<?php echo $_SESSION['role']; ?>');" src = "'<?php echo $value; ?>'"></div>
            </div>
            <?php endforeach;?>
        </div>
    </div>

</body>

</html>
