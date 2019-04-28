<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function add ()
    {
    	return view('User/add');
    }
    public function adddo (Request $request)
    {

    	$post=$request->only(['username','age']);
    	$res=DB::table('index')->insert($post);
    	if($res){
    		echo"<script>alert('添加成功');location.href='/user/list';</script>";
    	}else{
    		echo"<script>alert('添加失败');location.href='/user/add';</script>";
    	}
    }
    public function list ()
    {
    	$data=DB::table('index')->paginate(3);
    	return view('user/list',['data'=>$data]);
    }
}
