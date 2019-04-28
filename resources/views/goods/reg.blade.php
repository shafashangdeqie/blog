<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/goods/addreg" method="post">
	{{csrf_field()}}
		用户名<input type="text" name="username"><span></span><br>
		验证码<input type="text" name="reg">
		<input type="button" value="发送验证码">
		<span></span><br>
		密码——<input type="text" name="password" id="pwd"><span></span><br>
		确认密码<input type="text" id="pwd1"><span></span><br>
		<input type="submit" value="注册">
	</form>
</body>
</html>
<script src="{{asset('shop/js/jquery.min.js')}}"></script>
<script>
	$('input[name=username]').blur(function(){
		var _this=$(this).val();
		if(_this==''){
			alert('用户名不能为空');
			return false;
		}
		});
	$('input[name=reg]').blur(function(){
		var _this=$(this).val();
		if(_this==''){
			alert('验证码不能为空');
			return false;
		}
		});
	$('input[name=password]').blur(function(){
		var _this=$(this).val();
		if(_this==''){
			alert('密码不能为空');
			return false;
		}
		});

	$('#pwd1').blur(function(){
		var pwd1=$(this).val();
		var pwd=$('#pwd').val();
		if(pwd1!=pwd){
			alert('确认码和密码不一致');
			return false;
		}
		});

	$('input[type=submit]').click(function(){
		var _this=$('input[name=username]').val();
		if(_this==''){
			alert('用户名不能为空');
			return false;
		}
		var reg=$('input[name=reg]').val();
		if(reg==''){
			alert('验证码不能为空');
			return false;
		}
		var pwd=$('input[name=password]').val();	
		if(pwd==''){
			alert('密码不能为空');
			return false;
		}

		var pwd1=$('#pwd1').val();
		var pwd=$('#pwd').val();
		if(pwd1!=pwd){
			alert('确认码和密码不一致');
			return false;
		}
		// var username=$('input[name=username]').val();
		// var reg = "/^1[0-9]\d{9}$/";
		// var chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
		// if(!reg.test(username)){
		// 	alert('手机号错误');
		// 	return false;
		// }
		// if(!chars.test(username)){
		// 	alert('邮箱错误');
		// 	return false;
		// }

		
	});

	$('input[type=button]').click(function(){
		var username=$('input[name=username]').val();
		$.ajax({
			type:'get',
			url:'/goods/doreg',
			data:{username:username}
		}).done(function(msg){
			if(msg.code==1){
				alert(msg.msg);
			}else{
				alert(msg.msg);
			}
		});
	});
</script>