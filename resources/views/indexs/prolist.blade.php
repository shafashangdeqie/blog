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
       <form action="/prolist" method="get">
       <input type="text" name="username" width="50px">
       <button>搜索</button>
       </form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="prolistprice">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
     <link href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">
     @foreach($data as $key=>$val)
      <dl>
       <dt><a href="proinfo{{$val->p_id}}"><img src="http://www.uploads.com/{{$val->file}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo.html">{{$val->username}}</a></h3>
        <div class="prolist-price"><strong>¥{{$val->pirce}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
      {{$data->links()}}
     </div><!--prolist/-->
     @include('public.footer')
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  </body>
</html>