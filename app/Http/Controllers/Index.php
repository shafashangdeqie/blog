<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\StoreIndexPost;
use Illuminate\validation\Rule;
use App\Models\Index as Ind;
class Index extends BaseController
{
   public function index ()
   {
   	return view();
   }

   public function add ()
   {
   	 return view('Index/add');
  
   }

   public function adddo (StoreIndexPost $request)
   //public function adddo (Request $request)
   {

//表单验证
     $request->validate([
            'username'=>'required|unique:index|max:30|min:3',
         ],
         [
            'username.required'=>'用户名不能为空',
            'username.unique'=>'用户名已存在',
            'username.max'=>'用户名长度超过30位',
            'username.min'=>'用户名长度小于3位',
         ]
         );
   //控制器验证


     $post=$request->only(['username','age']);
      

   //第三种
      // $validator=\Validator::make($post,[
      //       'username'=>'required|unique:index|max:30|min:3',
      //       'age'=>'required|inteage',

      //    ]);
      // if($validator->fails()){
      //    return redirect('index/add')
      //    ->withErrors($validator)
      //    ->withInput();
      // }




      if($request->hasFile('file')){
         $post['file']=$this->upload($request,'file');
      }
    

     $res=DB::table('index')->insert($post);
     if($res){
        $request->session()->put('login',$post['username']);
   			echo"<script>alert('添加成功');location.href='/index/list'</script>";
   		}else{
   			echo"<script>alert('添加失败');location.href='/index/add'</script>";
   		}
       
   }

   public function list()
   {
    
   	$query=request()->all();
   	$where=[];
   	$username=$query['username']??'';
   	if($username){
   		$where[]=['username','like',"%$username%"];
   	}
   	$age=$query['age']??'';
   	if($age){
   		$where['age']=$age;
   	}
   	$pagesize=config('app.pageSize',3);
   	$data=DB::table('index')->where($where)->paginate($pagesize);
   	
   	return view('Index/list',['data'=>$data,'username'=>$username,'age'=>$age]);
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
   	public function del (Request $request)
   	{
   		$id=$request->input('id');

   		$res=DB::table('index')->delete($id);
   		if($res){
   			echo"<script>alert('删除成功');location.href='/index/list'</script>";
   		}else{
   			echo"<script>alert('删除失败');location.href='/index/list'</script>";
   		}
   					
   	}
      public function checkName (Request $request)
      {
        $username=request()->username;
        if(!$username){
         return ['code'=>00000,'msg'=>'请填写用户名'];
        }
        $data=DB::table('index')->where('username',$username)->first();
        if($data){
            return ['code'=>00000,'msg'=>'用户名已存在'];
        }else{
            return ['code'=>1,'msg'=>'用户名可用'];
        }
             
      }

      public function edit ($id)
      {
        if($id){
         //$data=DB::table('index')->where('id',$id)->first();
         // $data=DB::select('select * from index where id=:id',['id=>$id']);
         $data=Ind::find($id);
         return view('index/edit',['data'=>$data]);
        }       
      }
      public function update (StoreIndexPost $request,$id)
          {
           $post=$request->except('_token');
           if ($request->hasFile('edit_file')){
                $post['file']=$this->upload($request,'edit_file');
                unset($post['edit_file']);
           }
           $res=DB::table('index')
           ->where('id',$id)
           ->update($post);
           if($res){
        echo"<script>alert('修改成功');location.href='/index/list'</script>";
      }else{
        echo"<script>alert('修改失败');location.href='/index/list'</script>";
      }

          }	

      public function Login ()
        {
          return view('Index/login');
        }	
   
}

