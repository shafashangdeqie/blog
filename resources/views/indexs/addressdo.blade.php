<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="{{asset('shop/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('shop/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('shop/css/response.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>收货地址</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="shop/images/head.jpg" />
     </div><!--head-top/-->
     <form action="addressuser" method="post" class="reg-login">
     {{csrf_field()}}
      <div class="lrBox">
       <div class="lrList">
       <input type="text" placeholder="收货人"  name="ress_name"/>
       </div>
       <div class="lrList">
       <input type="text" placeholder="详细地址" name="ress_text" /></div>
       <div class="lrList asd">
        <select class="changearea" name="ress_province" id="province">
         <option>省份/直辖市</option>
         @foreach($data as $key=>$val)
         <option name="id" value="{{$val->id}}">{{$val->name}}</option>
         @endforeach
        </select>
       </div>
       <div class="lrList asd">
        <select class="changearea" name="ress_city" id="city">
         <option>区县</option>
         <option value=""></option>
         
        </select>
       </div>
       <div class="lrList asd">
        <select class="changearea" name="ress_area" id="area">
         <option>详细地址</option>
        </select>
       </div>
       <div class="lrList">
       <input type="text" placeholder="手机"  name="ress_tel"/></div>
       <div >
       <input type="radio" name="ress_check" value="1" checked="checked" />设为默认
       <input type="radio" name="ress_check" value="2" />取消默认
       
       </div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="保存" />
      </div>
     </form><!--reg-login/-->
     
     @include('public/footer')
    </div><!--maincont-->
    
  </body>
</html>

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>


<script>
 
  $('.lrList').change(function(){
    var _this=$(this);
     id =$(this).find("select").val();  
      $.ajax({
      type:'get',
      url:'getdo',
      data:{id:id,'_token':"{{csrf_token()}}"},
      success:function(msg){
        var str="";
        $(msg).each(function(i,v){
          str+="<option value=\""+v.id+"\">"+v.name+"</option>";

          
        });
        _this.next().find("select").append(str);
      }
    });
    
     
     
  });
</script>