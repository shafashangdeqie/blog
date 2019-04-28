<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
</head>
<body>
	<form action="{{url('/kao/update/'.$data->id)}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
		<tr>
			<td>网站名称</td>
			<td><input type="text" name="u_name" value="{{$data->u_name}}"></td><br>
		</tr>
		<tr>
			<td>网站地址</td>
			<td><input type="text" name="u_url" value="{{$data->u_url}}"></td><br>
		</tr>
		<tr>
			<td>链接类型</td>
			<td>
			<input type="radio" name="u_lei" value="1" checked="checked">LOGO链接
			<input type="radio" name="u_lei" value="2">文字链接
			</td><br>
		</tr>
		<tr>
			<td>图片LOGO</td>
			<td>
			<img width="50px" src="http://www.uploads.com/{{$data->u_file}}" >
			<input type="file" name="edit_file" >修改图片</td><br>
		</tr>
		<tr>
			<td>站内联系人</td>
			<td><input type="text" name="u_ren" value="{{$data->u_ren}}"></td><br>
		</tr>
		<tr>
			<td>网站介绍</td>
			<td>
			<textarea name="u_text" cols="21" rows="7" >{{$data->u_text}}</textarea>
			</td><br>
		</tr>
		<tr>
			<td>是否显示</td>
			<td>
			 <input type="radio" value="1" checked="checked">是
			 <input type="radio" value="2">否
			</td><br>
		</tr>
		<tr>
			<td>修改</td>
			<td><input type="submit" value="确定"></td><br>
		</tr>
	</form>
</body>
</html>
<script>
	$('input[name=u_name]').blur(function(){
		var u_name=$(this).val();
		if(u_name==''){
			alert('网站名称不能为空');
			return false;
		}

		var reg=/^[\u4e00-\u9fa5\w]$/;
		if(reg.test(u_name)){
			alert('网站名称为中文，字母，数字，下划线做成');
			return false;
		}

		$.ajax({
				method:"POST",
				url:"/kao/checkname",
				data:{u_name:u_name}
				}).done(function(msg){
					if(msg.code==2){
						alert('网站名称已存在');
					}
				});
	});
	$('input[name=u_url]').blur(function(){
		var u_url=$(this).val();
		if(u_url==''){
			alert('网站地址不能为空');
			return false;
		}
		var reg1=/^[http:]{7,30}$/;
		if(reg1.test(u_url)){
			alert('网站地址由http://开头');
			return false;
		}



	});
</script>
