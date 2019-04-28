<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<link href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">
<form action="">
	<input type="text" name="username">
	<input type="submit" value="搜索">
</form>
	<table border="1">
		<tr>
			<td>商品名称</td>
			<td>商品图片</td>
			<td>商品数量</td>
			<td>商品价格</td>
			<td>操作</td>
		</tr>
		@foreach($data as $k=>$v)
		<tr>
			<td>{{$v->username}}</td>
			<td>
			<a href="/goods/list/{{$v->p_id}}">
			<img src="http://www.uploads.com/{{$v->file}}" width="50px" ></a>
			</td>
			<td>{{$v->num}}</td>
			<td>{{$v->pirce}}</td>
			<td>
			<a href="del{{$v->p_id}}">删除</a>
			<a href="edit{{$v->p_id}}">修改</a>
			</td>
		</tr>
		@endforeach
	</table>
	{{$data->appends($query)->links()}}
</body>
</html>