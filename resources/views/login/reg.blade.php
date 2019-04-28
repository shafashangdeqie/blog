  @extends('layouts.shop')
  @section('title','微商城注册')
  @section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="shop/images/head.jpg" />
     </div><!--head-top/-->
     <form action="addreg" method="post" class="reg-login">
     {{csrf_field()}}
      <h3>已经有账号了？点此<a class="orange" href="login">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="email" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="reg" placeholder="输入短信验证码" />
        
        <button type="button" id="regs">获取验证码

        </div>
       <div class="lrList">

       <input type="text" id="pwd" name="password" placeholder="设置新密码（6-18位数字或字母）" />
       </div>
       <div class="lrList">

       <input type="text" id="pwd1" placeholder="再次输入密码" />

       </div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form>
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>

    <script>
          $('input[name=email]').blur(function(){
            var email=$('input[name=email]').val();
            if(email==''){
              alert('注册邮箱不能为空');
              return false;
            }

            $.ajax({
          method:"GET",
          url:"/regname",
          data:{email:email}
        }).done(function(msg){
          if(msg.code==00000){

            $('input[name=email]').next().remove();
            $('input[name=email]').after("<b style='color:red'>"
              +msg.msg+"</b><br>");
           
            location.href="/reg";

            return false;
          }
          
        });
            
          });

          $('input[name=password]').blur(function(){
            var password=$('input[name=password]').val();
            if(password==''){
              alert('密码不能为空');
              return false;
              
            }
            var seg= /^\w{3,6}$/;
            if(!seg.test(password)){
              alert('密码为3到6位字母数字下划线组成');
              return false;
            }
          });
          $('#pwd1').blur(function(){
            var pwd1= $('#pwd1').val();
            var password=$('input[name=password]').val();
            if(pwd1!=password){
              alert('密码和确认密码不一致');
              return false;
            }
          });
          $('#reg').blur(function(){
            var reg= $('#reg').val();
            if(reg==''){
              alert('验证码不能为空');
              return false;
            }
          });



        $('#regs').click(function(){
          var email=$('input[name=email]').val();
          var rand=$('input[name=reg]').val();
          $("#regs").attr("disabled",true);
         $.ajax({
          method:"GET",
          url:"/cmse",
          data:{email:email,rand:rand}
        }).done(function(msg){
          if(msg.code==00000){
            alert(msg.msg);
            return false;
          }else if(msg.code==1){
            alert(msg.msg);
          }
        });
        });

        $('input[type="submit"]').click(function(){
          var email=$('input[name=email]').val();
            if(email==''){
              alert('注册邮箱不能为空');
              return false;
            }
            var password=$('input[name=password]').val();
            if(password==''){
              alert('密码不能为空');
              return false;
            }
            var seg= /^\w{3,6}$/;
            if(!seg.test(password)){
              alert('密码为3到6位字母数字下划线组成');
              return false;
            }

            var pwd1= $('#pwd1').val();
            if(pwd1!=password){
              alert('密码和确认密码不一致');
              return false;
            }

          $.ajax({
          method:"GET",
          url:"/regname",
          data:{email:email}
        }).done(function(msg){
          if(msg.code==00000){
           alert('邮箱已存在');

           return false;
          }
          
        });
        
          
        });


    </script>

    @include('public.footer')
    @endsection

    