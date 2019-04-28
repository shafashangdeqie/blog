<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class KaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $query=request()->all();
        $where=[];
        $u_name=$query['u_name']??'';
     if($u_name){
        $where[]=['u_name','like',"%$u_name%"];
    }
        $data=DB::table('kao')->where($where)->paginate(2);
        $u_lei=$data['u_lei'];
        return view('Kao/list',['data'=>$data,'u_lei'=>$u_lei,'u_name'=>$u_name]);

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
    public function addHandle(Request $request)
    {
        $post=$request->except('_token');
        
        if($request->hasFile('u_file')){
         $post['u_file']=$this->upload($request,'u_file');
      }
      $res=DB::table('kao')->insertGetId($post);
      if($res){
            session(['id'=>$res]);
            echo"<script>alert('添加成功');location.href='/kao/list'</script>";
        }else{
            echo"<script>alert('添加失败');location.href='/kao/add'</script>";
        }

    }

    public function del (Request $request)
    {
        $id=$request->input('id');
        $res=DB::table('kao')->delete($id);
        if($res){
            echo"<script>alert('删除成功');location.href='/kao/list'</script>";
        }else{
            echo"<script>alert('删除失败');location.href='/kao/list'</script>";
        }

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
        $data=DB::table('kao')->where('id',$id)->first();
       return view('Kao/edit',['data'=>$data]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $post=$request->except('_token');
           if ($request->hasFile('edit_file')){
                $post['u_file']=$this->upload($request,'edit_file');
                unset($post['edit_file']);
           }
           $res=DB::table('kao')
           ->where('id',$id)
           ->update($post);
           if($res){
        echo"<script>alert('修改成功');location.href='/kao/list'</script>";
      }else{
        echo"<script>alert('修改失败');location.href='/kao/list'</script>";
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

    public function upload (Request $request,$name )
    {
      if ($request->file($name)->isValid()) {
        $photo = $request->file($name);
        $extension = $photo->extension();
        $store_result = $photo->storeAs(date('Ymd'),date('YmdHis').rand(100,999).'.'.$extension);
    return $store_result;
    }
    exit('文件上传过程出错');  
    }

    public function checkname (Request $request)
    {

       $u_name=request()->u_name;

        $data=DB::table('kao')->where('u_name',$u_name)->first();
        if($data){
            return ['code'=>2,'msg'=>'网站名以存在'];
        
     } 

    }
    public function login ()
    {
        return view('Kao/login');
    }

    public function logindo (Request $request)
    {

        $u_name=$request->u_name;
        if(!$u_name==''){
            $res=DB::table('kao')->where('u_name',$u_name)->first();
        if($res){
        echo"<script>alert('登录成功');location.href='/kao/list'</script>";
      }else{
        echo"<script>alert('登录失败');location.href='/kao/login'</script>";
      }  
        }
        
    }


}
