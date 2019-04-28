<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
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
	<form action="adddo" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		姓名·<input type="text" name="username"><br>
		年龄·<input type="text" name="age"><br>
		图片·<input type="file" name="file"><br>
		     <input type="submit" value="提交">
	</form>

	<script>
			$('input[name=username]').blur(function(){
				var username=$(this).val();
				if(username==''){
					// $(this).after("<span style='color:red fontsize:10px'>名称不能为空</span>");
					alert('名称不能为空');
					return false;
				}
				var reg=/^\w{3,30}$/;
				if(!reg.test(username)){
					alert('名称为字母数字下划线组成，不能大于三十位');
					return false;
				}
				$.ajaxSetup({
					headers:{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
					}

				});
				$.ajax({
					method:"POST",
					url:"/index/checkname",
					data:{username:username}
				}).done(function(msg){
					if(msg.code==00000){
						$('input[name=username]').next().remove();
						$('input[name=username]').after("<b style='color:red'>"+msg.msg+"</b><br>");
					}
				});
				$('input[name=age]').blur(function(){
					var age = $(this).val();
					if(age==''){
						$(this).next().remove();
						$(this).after("<b style='color:red'>年龄不为空</b><br>");
						return false;

					}
					var reg=/^\d{1,3}$/;
					if(!reg.test(age)){
						$(this).next().remove();
						$(this).after("<b style='color:red'>年龄是数字</b><br>");
						return false;

					}
				});

				



			});
              $('input[type=submit]').click(function(){
				var objname=$('input[name=username]').val();
				if(objname==''){
					// $(this).after("<span style='color:red fontsize:10px'>名称不能为空</span>");
					alert('名称不能为空');
					return false;
				}
				var reg=/^\w{3,30}$/;
				if(!reg.test(objname)){
					alert('名称为字母数字下划线组成，不能大于三十位');
					return false;
				}
				
				
				});
	</script>
</body>
</html>