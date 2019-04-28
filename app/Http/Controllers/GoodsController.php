<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Mail;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $query=request()->all();
        $username=request()->username;
        $where=[]; 

        if($username){
            $where[]=['username','like',"%$username%"];
        }
       
      $data=DB::table('index')->where($where)->paginate(2);  
      return view('goods/index',['data'=>$data,'query'=>$query]);
    }

    public function del ($p_id)
    {
       $res=DB::table('index')->where('p_id',$p_id)->delete();
       if($res){
           cache::pull('data_'.$p_id);
            echo"<script>alert('删除成功');location.href='/goods/index'</script>";
       }else{
           echo"<script>alert('删除失败');location.href='/goods/index'</script>";
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=DB::table('index')->where('p_id',$id)->first();

        return view('goods/edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $p_id)
    {
        $post=request()->except('_token');
        if ($request->hasFile('edit_file')){
                $post['file']=$this->upload($request,'edit_file');
                unset($post['edit_file']);
           }
        $res=DB::table('index')->where('p_id',$p_id)->update($post);
        if($res){
             cache(['data_'.$p_id=>$res],60*1);
             echo"<script>alert('修改成功');location.href='/goods/index'</script>";
        }else{
             echo"<script>alert('修改失败');location.href='/goods/index'</script>";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload (Request $request,$name)
    {
        if ($request->file($name)->isValid()) {
        $photo = $request->file($name);
        $extension = $photo->extension();
        $store_result = $photo->storeAs(date('Ymd'),date('YmdHis').rand(100,999).'.'.$extension);
        return $store_result;
        }
        exit('文件上传过程出错');
    }

    public function list ($p_id)
    {
        $data=cache('data_'.$p_id);
        if(!$data){
            echo 123;
         $data=DB::table('index')->where('p_id',$p_id)->first();
         cache(['data_'.$p_id=>$data],60*1); 
        }
        
        return view('goods/list',['data'=>$data]);
    }

    public function reg ()
    {
       return view('goods/reg');
    }
     public function doreg ()
    {
       $username=request()->username;
       $rand=request()->rand;
       $reg = "/^1[0-9]\d{9}$/";
       $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
       $rand=rand(10000,99999);
       if(preg_match($reg,$username)){
        $host = "http://dingxin.market.alicloudapi.com";
            $path = "/dx/sendSms";
            $method = "POST";
            $appcode = "b890770291654564af82e7d5d4f587b0";
            $headers = array();
            array_push($headers, "Authorization:APPCODE " . $appcode);
            $rand=rand(10000,99999);
            $querys = "mobile=".$username."&param=code%3A".$rand."&tpl_id=TP1711063";
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
             return ['code'=>0,'msg'=>'手机号注册成功'];
            }else if(preg_match($chars,$username)){
                Mail::send('goods/emailcon',['rand'=>$rand],function($message)use($username){
                    $message->subject('欢迎'.$username.'注册');
                    $message->to($username);
                }); 
            request()->session()->put('rand',$rand);
            return ['code'=>0,'msg'=>'邮箱注册成功'];
       }else{
        return ['code'=>1,'msg'=>'手机号或邮箱有误'];    
       }
    }

    public function addreg ()
    {
        $post=request()->except('_token');
        $rand=$post['reg'];
        $post['password']=md5($post['password']);
        $emailrand = request()->session()->get('rand');
        if($rand!=$emailrand){
        echo"<script>alert('验证码有误');location.href='/goods/reg'</script>";
        }else{
            $res=DB::table('regs')->insert($post);
            if($res){
            echo"<script>alert('注册成功');location.href='/goods/login'</script>";
            }else{
            echo"<script>alert('注册失败');location.href='/goods/reg'</script>";
            }
        }

    }
    public function login ()
    {
        return view('goods/login');
    }
    public function dologin ()
    {
       $post=request()->except('_token');
       $passwords=$post['password'];
       $where=[
            'username'=>$post['username']
       ];
       $res=DB::table('regs')->where($where)->first();
       $password=$res->password;
       $num=[
            'f_time'=>time(),
            'num'=>$res->num+1
       ]; 
      if($password!=$passwords){
       if($res->num >= 5){
         $f_time=60-ceil((time()-$res->f_time)/60);
        echo"<script>alert('密码已锁定请".$f_time."分钟后重试');location.href='/goods/login'</script>";
              }else{
            DB::table('regs')->where($where)->update($num);
        echo"<script>alert('密码错误你还有".(4-$res->num)."次机会');location.href='/goods/login'</script>";
                   }
      }else{
        $f_time=60-ceil((time()-$res->f_time)/60);
        if(($f_time)>0&&$res->num >= 5){
               echo"<script>alert('密码已锁定请".$f_time."分钟后登录');location.href='/goods/login'</script>"; 
            }else{
            $cnum=[
            'f_time'=>0,
            'num'=>0
            ];
        DB::table('regs')->where($where)->update($cnum);
        echo"<script>alert('登录成功');location.href='/goods/index'</script>"; 
            }
        
        
       
        
      }
    }

    public function redis ()
    {
       $id=11;
       //dd(cache::pull('data_'.$id));
       $data=Redis::get('data_'.$id);  
       if(!$data){
         echo 123;
         
         $data=Redis::set('data_'.$id,'zhangshan');
       }
       var_dump($data);
    }

       

}
