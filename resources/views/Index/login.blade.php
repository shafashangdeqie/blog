<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
</head>
<body>
   <form action="/index/list" method="get">
    {{csrf_field()}}
	用户名<input type="text" name="username"><br>
	密码--<input type="text" pwd="password"><br>
	<input type="submit" value="登录">	
	</form>
</body>
</html>