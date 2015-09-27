<!DOCTYPE html>
<html>
    <head>
        <title>{{trans('app.title')}} - @yield('title')</title>

        <link href="{{asset('/css/style.css')}}" rel="stylesheet" type="text/css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.2.js"></script>
        <script src="{{asset('/js/app.js')}}"></script>
        <script src="{{asset('/js/directives.js')}}"></script>
        <script src="{{asset('/js/controllers.js')}}"></script>
        <script src="{{asset('/js/services.js')}}"></script>
        
        <!-- Optional theme -->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->

        <!-- Latest compiled and minified JavaScript -->
<!--        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
        
    </head>
    <body ng-app="library">
        @yield('content')
    </body>
</html>
