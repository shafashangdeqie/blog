<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="shop/images/favicon.ico" />
    
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
       <h1>我的订单</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="shop/images/head.jpg" />
     </div><!--head-top/-->
     
     <div class="zhaieq oredereq">
      <a href="javascript:;" class="zhaiCur">待付款</a>
      <a href="javascript:;">待发货</a>
      <a href="javascript:;">已取消</a>
      <a href="javascript:;" style="background:none;">已完成</a>
      <div class="clearfix"></div>
     </div><!--oredereq/-->
     
     <div class="dingdanlist" onClick="window.location.href='proinfo.html'">
      
     </div><!--dingdanlist/-->
     
     <div class="dingdanlist" onClick="window.location.href='proinfo'">
      <table>
      @foreach($data as $k=>$v)
       <tr>
        <td colspan="2" width="65%">订单号：<strong>{{$v->s_sand}}</strong></td>
        <td width="35%" align="right"><div class="qingqu"><a href="addressdel{{$v->s_id}}" class="orange">订单取消</a></div></td>
       </tr>
      
       <tr>
        <td class="dingimg" width="15%"><img src="http://www.uploads.com/{{$file}}" /></td>
        <td width="50%">
         <h3></h3>
         <time>下单时间：{{date('Y-m-d',$v->s_time)}}</time>
        </td>
        <td align="right"><img src="shop/images/jian-new.png" /></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange">￥{{$price}}</strong></th>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/--> 
     
     @include('public/footer')
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <!--jq加减-->
    <script src="js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
   </script>
  </body>
</html>