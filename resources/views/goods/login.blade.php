<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/goods/dologin" method="post">
	  {{csrf_field()}}
		用户名<input type="text" name="username"><br>
		密码~~<input type="text" name="password"><br>
		<input type="submit" value="提交">
	</form>
</body>
</html>