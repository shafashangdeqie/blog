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
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      <img src="http://www.uploads.com/{{$data->file}}" />
      <img src="http://www.uploads.com/{{$data->file}}" />
      
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$data->pirce}}</strong></th>
       <td>

       <input type="button" id="jia" class="add" style="color:red" value="＋"/> 
       <input type="text"   id="buy_num" value="1" style="width:40px; color:red" >
       <input type="button" id="jian" class="min" style="color:red" value="－"/>
       库存：<strong id="goods_num">{{$data->num}}</strong> 
        <input type="hidden" id="pid" p_id="{{$data->p_id}}">
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$data->username}}</strong>
        <p class="hui"></p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="shop/images/image4.jpg" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="car{{$data->p_id}}" id="car">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{asset('shop/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{asset('shop/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('shop/js/style.js')}}"></script>
    <!--焦点轮换-->
    <script src="{{asset('shop/js/jquery.excoloSlider.js')}}"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->
    <script src="{{asset('shop/js/jquery.spinner.js')}}"></script>


  <script>
        
            //+
            $(".add").click(function(){
                // console.log("1111");
                var _this=$(this);
                //库存
                var goods_num=$("#goods_num").text();
                var buy_num=parseInt($("#buy_num").val());//吧字符串转换成整数
                if(buy_num>=goods_num){
                    _this.prop("disabled",true);//最大值让+失效
                }else{
                    buy_num=buy_num+1;
                    $("#buy_num").val(buy_num);
                    _this.next("input").prop("disabled",false);//-生效
                }
            })
            //-
            $(".min").click(function(){
                // console.log("1111");
                var _this=$(this);
                var buy_num=parseInt($("#buy_num").val());//吧字符串转换成整数
                if(buy_num<=1){
                    _this.prop("disabled",true);//最小值让-失效
                }else{
                    buy_num=buy_num-1;
                    $("#buy_num").val(buy_num);
                    _this.prev("input").prop("disabled",false);//+生效
                }
            })
            //失焦事件
            $("#buy_num").blur(function(){
            var _this=$(this);
            //console.log(_this);
            var buy_num=_this.val();
            var goods_num=$('#goods_num').text();
            //验证
            var reg=/^\d{1,}$/;
            if(buy_num==''||buy_num<=1||!reg.test(buy_num)){
                _this.val(1);
            }else if(parseInt(buy_num)>=parseInt(goods_num)){
                // console.log(1111);
                _this.val(goods_num);
            }else{
                _this.val(parseInt(buy_num));
            }
            })
           // 加入购物车
            // $("#car").click(function(){
            //     // console.log(111);
            //    var goods_id=$("#goods_id").val();
            //    //console.log(goods_id);
            //    var buy_num=$("#buy_num").val();
            //    //console.log(buy_num);

            //    $.ajax({
            //       type:'get',
            //       url:'tcar',
            //       data:{buy_num:buy_num}
            //    });
            // });
        
  
</script>

  </body>
</html>