
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form trong Laravel 5</title>
</head>
<body>
	<h1>Them Bai Viet Moi</h1>
	{!! Form::open(['url' => 'articles']) !!}
 {!! Form::label('name','Name:') !!}
  {!! Form::text('name') !!}
  	</br>
 
  {!! Form::label('author','Author:') !!}
		{!! Form::text('author') !!} 
		</br>
 
		{!! Form::submit('Them moi')!!}
	{!! Form::close() !!}
</body>
</html>