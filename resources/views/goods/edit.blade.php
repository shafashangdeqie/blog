<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<form action="{{url('/goods/update/'.$data->p_id)}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
<table border="1">
	<tr>
		<td>商品名称</td>
		<td><input type="text" name="username" value="{{$data->username}}"></td>
	</tr>
	<tr>
		<td>商品图片</td>
		<td>
		<input type="file" name="edit_file" ><br>
		<input type="hidden" name="file" value="{{$data->file}}">
		<img src="http://www.uploads.com/{{$data->file}}" width="50px">
		</td>
	</tr>
	<tr>
		<td>商品数量</td>
		<td><input type="text" name="num" value="{{$data->num}}"></td>
	</tr>
	<tr>
		<td>商品价格</td>
		<td><input type="text" name="pirce" value="{{$data->pirce}}"></td>
	</tr>
	<tr>
		<td>修改</td>
		<td><input type="submit"></td>
	</tr>
	</table>
	</form>
</body>
</html>