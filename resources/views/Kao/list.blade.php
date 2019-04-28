<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<link href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">
	<form action="">
		<input type="text" name="u_name" value="{{$u_name}}"><input type="submit" value="查找">
	</form>
		<table border="1">
			<tr>
				<td>ID</td>
				<td>网站名称</td>
				<td>图片LOGO</td>
				<td>所属分类</td>
				<td>链接类型</td>
				<td>状态</td>
				<td>管理操作</td>
				
			</tr>
			@foreach($data as $key=>$val)
			<tr>
				<td>{{$val->id}}</td>
				<td>{{$val->u_name}}</td>
				<td><img width="50px" src="http://www.uploads.com/{{$val->u_file}}" alt=""></td>
				<td>{{$val->u_url}}</td>
				<td>{{$val->u_lei}}</td>
				<td>{{$val->u_show}}</td>
				<td>
				<a href="del?id={{$val->id}}">删除</a>
				<a href="edit{{$val->id}}">修改</a>
				</td>
				
			</tr>
			@endforeach
		</table>
	{{$data->links()}}
</body>
</html>