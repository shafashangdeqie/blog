<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="1">
		<h3>商品图片</h3>
		<img src="http://www.uploads.com/{{$data->file}}" width="200px" ><br>
		<h3>价格</h3>
		<h4>{{$data->pirce}}</h4>
		<h3>库存</h3>
		<h5>{{$data->num}}</h5>
	</table>
</body>
</html>