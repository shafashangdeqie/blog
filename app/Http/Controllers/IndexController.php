<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\StoreIndexPost;
use Illuminate\validation\Rule;
use App\Models\Index as Ind;
use Mail;
use App\Models\Area;
class IndexController extends Controller
{
  public function index ()
    {
    	$data=DB::table('reg')->get();
    	$post=DB::table('index')->where('show',1)->get();
    	$page=DB::table('index')->where('show',2)->paginate(3);
    	$email=request()->session()->get('email');
    	$price=DB::table('index')->max('pirce');
    	
    	return view('indexs/index',['page'=>$page,'post'=>$post,'email'=>$email]);
    } 

   public function addreg()
   {

	   	$post=request()->except('_token');
	   	$regrand=$post['reg'];
	   	$emailrand=request()->session()->get('rand');
	   	if($regrand!=$emailrand){
	    	echo"<script>alert('验证码错误');location.href='/reg'</script>";
	     }else{
        $email=$post['email'];
	    $data=DB::table('reg')->where('email',$email)->first();
	    $res=DB::table('reg')->insert($post);
	     if($data){
	    	echo"<script>alert('邮箱或手机号重复');location.href='/reg'</script>";
	     }else if($res){
	    	echo"<script>alert('注册成功');location.href='/login'</script>";
	     }else{
	    	echo"<script>alert('注册失败');location.href='/reg'</script>";
	     }

	     }
	   	
   	
   }

  public function cmse ()
  {

		   	$email=request()->email;
		   	$regrand=request()->rand;
		   	$reg = "/^1[0-9]\d{9}$/";
		   	$chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
		   	$rands=rand(10000,99999);
		   	  if(preg_match($reg, $email)){
		   		
		   	$host = "http://dingxin.market.alicloudapi.com";
		    $path = "/dx/sendSms";
		    $method = "POST";
		    $appcode = "b890770291654564af82e7d5d4f587b0";
		    $headers = array();
		    array_push($headers, "Authorization:APPCODE " . $appcode);
		    $rand=rand(10000,99999);
		    $querys = "mobile=".$email."&param=code%3A".$rand."&tpl_id=TP1711063";
		    $bodys = "";
		    $url = $host . $path . "?" . $querys;

		    $curl = curl_init();
		    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		    curl_setopt($curl, CURLOPT_URL, $url);
		    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		    curl_setopt($curl, CURLOPT_FAILONERROR, false);
		    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curl, CURLOPT_HEADER, false);
		     if (1 == strpos("$".$host, "https://"))
		     {
		        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		     }
		     var_dump(curl_exec($curl));
		     $emailrand = request()->session()->put('rand',$rand);
		     return ['code'=>1,'msg'=>'手机号注册成功'];
		       }else if(preg_match($chars, $email)){
		   		Mail::send('indexs/emailcon',['rands'=>$rands],function($message)use($email){
		   			$message->subject('你的验证码为');
		   			$message->to($email);
		   		});	
		   	 request()->session()->put('rand',$rands);
		   	    return ['code'=>1,'msg'=>'邮箱或注册成功'];	 
		   	    }else{
		   		return ['code'=>00000,'msg'=>'邮箱或手机号错误'];
		   	    }

		   	    

  }


   public function users (Request $request)
   {
    	$post=$request->all();
    	$where=[
    		'email'=>$post['email'],
    		'password'=>$post['password']
    	];
    	$email=$post['email'];

    	$res=DB::table('reg')->where($where)->first();
    	if($res){
    		$request->session()->put('email',$email);
    	echo"<script>alert('登录成功');location.href='/index?id='</script>";
      }else{
        echo"<script>alert('账号密码有误');location.href='/login'</script>";
      }
   }
   public function session (Request $request)
   {
     $session=$request->session()->get('rand');
     dd($session);
     	
   }


    public function regname (Request $request)
    {
        $email=request()->email;
        if(!$email){
         return ['code'=>00000,'msg'=>'请填写邮箱'];
        }
        $data=DB::table('reg')->where('email',$email)->first();
        if($data){
            return ['code'=>00000,'msg'=>'用户名已存在'];
        }else{
            return ['code'=>1,'msg'=>'用户名可用'];
        }
             
      }

      public function prolist ()
       {
       	$query=request()->all();
       	$where=[];
       	$username=$query['username']??'';
   	 if($username){
   		$where[]=['username','like',"%$username%"];
   	         }

       	$data=DB::table('index')->where($where)->paginate(8);
       	return view('indexs/prolist',['data'=>$data]);
    }

   public function prolistprice ()
   {
       	$query=request()->all();
       	$where=[];
       	$username=$query['username']??'';
   	 if($username){
   		$where[]=['username','like',"%$username%"];
   	   }

       	//$data=DB::table('index')->orderBy('pirce','desc')->get();	
       	
       	$data=DB::table('index')->where($where)->paginate(8);
       	return view('indexs/prolist',['data'=>$data]);
   }

   public function proinfo ($id)
   {
          $data=cache('proinfo'.$id);
          if(!$data){
            
            $data=DB::table('index')->where('p_id',$id)->first();
            cache(['proinfo'.$id=>$data],60*24);
          }
          
          return view('indexs/proinfo',['data'=>$data]);	
   } 
  //退出登录
   public function loginin ()
   {
        	request()->session()->forget('email');
        	echo"<script>location.href='/login'</script>";	
   }
   //加入购物车
   public function car ($p_id)
   {
   			
        	if(!request()->session()->get('email')){
        		echo"<script>alert('请登录后再进行操作');location.href='/login'</script>";	
        	}
        	$email=request()->session()->get('email');
        	//$where=['email'=>$email];
        	$l_id=DB::table('reg')->where('email',$email)->first();
        	$login_id=$l_id->login_id;
        	$post=['login_id'=>$login_id,'p_id'=>$p_id];
        	$ress=DB::table('car')->where($post)->first();
        	
        	if($ress){
        		echo"<script>alert('购物车已有');location.href='/prolist'</script>";
        	     die;
        	}
            $res=DB::table('car')->insert($post);
        	 if($res){
        		echo"<script>alert('加入购物车成功');location.href='/docar'</script>";
        	}else{
        		echo"<script>alert('加入购物车失败');location.href='/prolist'</script>";
        	}      	      	
   }

   public function tcar ()
   {
   	dd(request()->all());
   }

   public function docar ()
   {
       
        if(!request()->session()->get('email')){
        		echo"<script>alert('请登录后再进行操作');location.href='/login'</script>";	
        	}
        $shoping=DB::table('car')->count();
        if($shoping==0){
        		echo"<script>alert('请加一条数据到购物车');location.href='/prolist'</script>";	
        	}

        $email=request()->session()->get('email');
        $l_id=DB::table('reg')->where('email',$email)->first();
        $login_id=$l_id->login_id;	
        $where=[
        	'login_id'=>$login_id,
        ];
        $data=DB::table('car')->where($where)->first();
         $login_id= $data->login_id; 
         $car=DB::table('car')
         ->where('login_id',$login_id)
         ->join('index','index.p_id','=','car.p_id')->get();
         $num=DB::table('car')
         ->where('login_id',$login_id)
         ->join('index','index.p_id','=','car.p_id')->count(); 
            
         return view('indexs/docar',['car'=>$car,'num'=>$num]);
   }
   //删除商品
   public function delcar ($cid)
   {
        	$res=DB::table('car')->where('cid',$cid)->delete();
        	if($res){
        		echo"<script>alert('删除商品成功');location.href='/docar'</script>";
        	}else{
        		echo"<script>alert('删除商品失败');location.href='/docar'</script>";
        	}		
   }
   //个人中心
   public function user ()
   {
   	    $data=DB::table('reg')->get();
    	$email=request()->session()->get('email');
    	if($email==''){
    		echo"<script>alert('请登录');location.href='/login'</script>";
    	}
    	return view('indexs/user',['email'=>$email]);
   } 
   //收货地址
   public function address()
   {
   	$data=DB::table('ress')->get();

   	return view('indexs/address',['data'=>$data]);
   }
   //添加收货地址
   public function addressdo()
   {
	   	$data=$this->area(0);
	   	
	   	return view('indexs/addressdo',['data'=>$data]);
   }

   //省市区
   public function area ($pid)
   {
	   	$where=[
	   		'pid','=',$pid
	   	];
	   	$post= DB::table('tp_area')->get()->where('pid',$pid)->toArray();
	   	return $post;
   }

   public function addressuser()
   {
	   	$post=request()->except('_token');

	   	$res=DB::table('ress')->insert($post);
	   	if($res){
	   	  echo"<script>alert('收货地址添加成功');location.href='/address'</script>";
	   	}else{
	       echo"<script>alert('收货地址添加失败');location.href='/addressdo'</script>";
	   	}
	   }

   public function getdo ()
   {
   	
	    $id=request()->id;
	    $res=DB::table('tp_area')->where('pid',$id)->get()->toArray();
	    return $res;
    	
   }

   public function getarea ()
   {
	    $id=request()->all();
	    //dd($id);
   }
   //去结算
   public function pay ()
   {
	   	$p_id=request()->p_id;
	   	$data=DB::table('index')->where('p_id',$p_id)->get();
	   	//dd($data);
	   	return view('indexs/pay',['data'=>$data]);
   }

   //订单页面
   public function successdo ($p_id)
   {
	   	$rand=rand(1000,9999).time();
	   	$session=request()->session()->get('email');
	   	$goods_id=DB::table('reg')->where('email',$session)->first();
	   	$login_id=$goods_id->login_id;
	   	$pirce=DB::table('index')->where('p_id',$p_id)->first();
	   	$dd=DB::table('success')->get();
	   	foreach ($dd as $key => $value) {
	 		$ps_id=$value->p_id;
	 	}

	   $price=$pirce->pirce;
	   	$data=[
	   		'p_id'=>$p_id,
	   		's_sand'=>$rand,
	   		'login_id'=>$login_id,
	   		's_price'=>$price,
	   		'c_time'=>time(),
	   		's_time'=>time()+86400
	   	];
	   	$res=DB::table('success')->insert($data);
	   	if($res){
	   		echo"<script>alert('订单提交成功');location.href='/success'</script>";
	   		DB::table('car')->where('p_id',$p_id)->delete();
	   	}else if(!empty($ps_i)){
	   		echo"<script>alert('已存在订单');location.href='/pay'</script>";
	   	}else{
	   		echo"<script>alert('订单提交失败');location.href='/pay'</script>";
	   	}
   }
   public function success ()
   {
	 	$data=DB::table('success')->get();
	 	$res=DB::table('success')->get()->toArray();
	 	foreach ($res as $key => $value) {
	 		$s_time=$value->s_time;
	 		$s_id=$value->s_id;
	 	}
	 	if(time()>=$s_time){
	 		$ress=DB::table('success')->where('s_id',$s_id)->delete();
	 	}
	   	return view('indexs/success',['data'=>$data]);
   }

   //我的订单
   public function order ()
    {
    	$data=DB::table('success')->get();
    	foreach ($data as $key => $value) {
 		  $s_time=$value->s_time;
 		  $p_id=$value->p_id;
		 	}
		 	$res=DB::table('index')->where('p_id',$p_id)->get();
		 	foreach ($res as $key => $value){
		 		  $file=$value->file;
		 		  $price=$value->pirce;
		 	}
      
    	return view('indexs/order',['data'=>$data,'file'=>$file,'price'=>$price]);
    } 
    //删除订单
    public function addressdel($s_id)
    {
    	$res=DB::table('success')->where('s_id',$s_id)->delete();
    	if($res){
   	  echo"<script>alert('订单取消成功');location.href='/order'</script>";
	   	}else{
	       echo"<script>alert('订单取消失败');location.href='/order'</script>";
	   	}
    }

    public function zhisuccess ($s_id)
    {
    	
    	//支付宝支付
      $data = DB::table('success')->where('s_id',$s_id)->first();
        $path = base_path();
        $config = Config('alipay');
        require_once app_path('/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = $data->s_sand;

        //订单名称，必填
        $subject = trim('1810商品支付');

        //付款金额，必填
        $total_amount = $data->s_price;

        //商品描述，可空
        $body = '';

        //构造参数
        //php中new 一个类如果不写命名空间，就默认为与当前同命名空间
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);
    }

    //同步回调
    public function re()
    {
        echo 1;
    }

    //异步回调
    public function notify()
    {
        echo 2;
    }
    

    public function memcached()
    {
      $id=11;
      $data=cache('data_'.$id);
      if(!$data){
        echo "data file";
        $data=DB::table('index')->where(['p_id'=>$id])->first();
        cache(['data_'.$id=>$data],60*24);
        
      }
      //dd($data);
      return view('indexs/memcached',['data'=>$data]);
    }


   
}
   


