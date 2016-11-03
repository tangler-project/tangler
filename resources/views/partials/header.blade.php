<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

    {{-- This is the token Laravel requires for non-GET requests --}}
    <meta id="token" value="{{ csrf_token() }}"> 

    <link rel="shortcut icon" href="/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/tanglerIcon.ico/apple-icon-180x180.png">
    <link rel="manifest" href="/favicon/manifest.json">
    <link href="https://fonts.googleapis.com/css?family=Exo:400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="/css/main.css" rel="stylesheet">

    {{-- pusher script --}}
    <script src="https://js.pusher.com/3.2/pusher.min.js"></script>

    <title>Tanglr</title>
    
</head>