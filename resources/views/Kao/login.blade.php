<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
<form action="/kao/logindo" method="post">
{{csrf_field()}}
	<input type="text" name="u_name">用户名<br>
	<input type="submit" value="登录">
	</form>
</body>
</html>