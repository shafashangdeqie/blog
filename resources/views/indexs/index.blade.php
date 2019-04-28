  @extends('layouts.shop')
  @section('title','微商城首页')
  @section('content')
     <div class="head-top">
      <img src="/shop/images/head.jpg" />
      <dl>
       <dt><a href="user"><img src="/shop/images/touxiang.jpg" /></a></dt>
       <dd>
       
        <h1 class="username">欢迎<b style="color:red">{{$email}}</b>登录</h1>
        
        <ul>
         <li><a href="prolist"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
     <?php if($email==''){?>
      <li><a href="login">登录</a></li>
      <li><a href="reg" class="rlbg">注册</a></li>
      <?php }else{?>
      <li><a href="loginin" class="rlbg">退出</a></li>
      <?php }?>
     
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
      
     <div id="sliderA" class="slider">
      <img src="/shop/images/image1.jpg" />
      <img src="/shop/images/image2.jpg" />
      <img src="/shop/images/image3.jpg" />
      <img src="/shop/images/image4.jpg" />
      <img src="/shop/images/image5.jpg" />
     </div><!--sliderA/-->
    
     <ul class="pronav">
      <li><a href="prolist">晋恩干红</a></li>
      <li><a href="prolist">万能手链</a></li>
      <li><a href="prolist">高级手镯</a></li>
      <li><a href="prolist">特异戒指</a></li>
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     
     <div class="index-pro1">
     
      <div class="index-pro1-list">
      @foreach($post as $key=>$val)
       <dl>
        <dt>
        <a href="proinfo{{$val->p_id}}">
        <img src="http://www.uploads.com/{{$val->file}}" />
        </a></dt>
        <dd class="ip-text"><a href="proinfo{{$val->p_id}}">{{$val->username}}</a></dd>
        <dd class="ip-price"><strong>¥{{$val->pirce}}</strong> </dd>
       </dl>
        @endforeach
      </div>
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
      @foreach($page as $key=>$val)
      <dl>
       <dt><a href="proinfo{{$val->p_id}}"><img src="http://www.uploads.com/{{$val->file}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="proinfo">{{$val->username}}</a></h3>
        <div class="prolist-price"><strong>¥{{$val->pirce}}</strong></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao"><img src="/shop/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>
     
     @include('public.footer')
     @endsection