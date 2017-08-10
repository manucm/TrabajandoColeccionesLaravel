<!DOCTYPE html>
<html>
<head>
	<title>Este es el layout principal</title>

	 {!! MaterializeCSS::include_css() !!}
	 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	 <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@yield('content')

<script src="{{asset('js/app.js')}}"></script>
{!! MaterializeCSS::include_js() !!}
</body>
</html>