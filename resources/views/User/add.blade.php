<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	 @if ($errors->any())
	 <div class="alert alert-danger">
	 <ul>
	 @foreach ($errors->all() as $error)
	 <li>{{ $error }}</li>
	 @endforeach
	 </ul>
	 </div>
	 @endif
	<form action="adddo" method="post">
		{{@csrf_field()}}
		<input type="text" name="username">姓名
		<input type="text" name="age">年龄
		<button>提交</button>

	</form>
</body>
</html>