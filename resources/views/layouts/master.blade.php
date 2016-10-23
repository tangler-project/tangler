<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tangler Prototype</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet">

    </head>
    <body>

    	<div class='logoLine'>
    		<div class='landingVLineTop'></div>
    		<div class='logo'>&#9776</div>
    		<div class='landingVLineBot'></div>
    	</div>

        @yield('content')

    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <script src='/js/main.js'></script>
        <script src='/js/vue.js'></script>

        @yield('scripts')

    </body>
</html>