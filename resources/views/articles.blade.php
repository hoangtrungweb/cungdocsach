<html>
<head>
	<title>View articles</title>
</head>
<body>
@extends('templates.master')
 
	@section('content')
	<ul>
	@foreach($articles as $article)
		<li>Name : {{$article->name}} | Author : {{$article->author}}</li>
	@endforeach
	</ul>
	@stop
</body>
</html>