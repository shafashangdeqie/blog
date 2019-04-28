<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::prefix('index')->group(function(){

// 	Route::post('add','Index@add');
// 	Route::post('index','Index@index');
// 	Route::post('del','Index@del');
// 	Route::post('edit','Index@edit');
// 	Route::post('addHandle','Index@addHandle');
// });

Route::prefix('index')->group(function(){
Route::get('/index/add',function(){
	return view('Index/add');
});
Route::post('adddo','Index@adddo');
Route::get('list','Index@list');
Route::get('del','Index@del');
Route::post('checkname','Index@checkName');
Route::get('edit{id}','Index@edit');
Route::post('update/{id}','Index@update');
Route::get('login','Index@Login');
});


Route::get('/test',function(){
		return response('Hello World',200)->header('X-CSRF-TOKEN',csrf_token())->cookie('name','123',3);

});
 
Route::get('/kao/login','KaoController@login');
Route::prefix('kao')->middleware('login')->group(function(){
Route::get('add',function(){
	return view('Kao/add');
});
Route::post('addHandle','KaoController@addHandle');
Route::get('list','KaoController@list');
Route::get('checkname','KaoController@checkname');
Route::get('del','KaoController@del');
Route::get('edit/{id}','KaoController@edit');
Route::post('update/{id}','KaoController@update');
Route::post('logindo','KaoController@logindo');



});


//微商城
Route::get('/','IndexController@index');
Route::get('/login',function(){
	return view('login.login');
});
Route::get('/reg',function(){
	return view('login.reg');
});
Route::get('/regs','IndexController@regs');
Route::get('/cmse','IndexController@cmse');
Route::post('/addreg','IndexController@addreg');
Route::get('/users','IndexController@users');
Route::get('/regname','IndexController@regname');
Route::get('/index','IndexController@index');
Route::get('/prolist','IndexController@prolist');
Route::get('/proinfo{id}','IndexController@proinfo');
Route::get('/loginin','IndexController@loginin');
Route::get('/car{id}','IndexController@car');
Route::get('/docar','IndexController@docar');
Route::get('/delcar{id}','IndexController@delcar');
Route::get('/prolistprice','IndexController@prolistprice');
Route::get('/user','IndexController@user');
Route::get('/address','IndexController@address');
Route::get('/addressdo','IndexController@addressdo');
Route::post('/addressuser','IndexController@addressuser');
Route::get('/getarea','IndexController@getarea');
Route::any('/getdo','IndexController@getdo');
Route::get('/pay','IndexController@pay');
Route::get('/successdo{id}','IndexController@successdo');
Route::get('/success','IndexController@success');
Route::get('/order','IndexController@order');
Route::get('/addressdel{id}','IndexController@addressdel');
Route::get('/zhisuccess{id}','IndexController@zhisuccess');
Route::get('/memcached','IndexController@memcached');
Route::get('/pay{s_sand}','AlipayController@pay');
Route::get('/returnaAlipay','AlipayController@returnaAlipay');

// Route::get('/emailcon',function(){
// 	return view('indexs/emailcon');
// });

Route::get('/session','IndexController@session');


Route::get('/goods/index','GoodsController@index');
Route::get('/goods/del{id}','GoodsController@del');
Route::get('/goods/edit{id}','GoodsController@edit');
Route::post('/goods/update/{id}','GoodsController@update');
Route::get('/goods/list/{id}','GoodsController@list');

Route::get('/goods/reg','GoodsController@reg');
Route::any('/goods/doreg','GoodsController@doreg');
Route::any('/goods/addreg','GoodsController@addreg');
Route::any('/goods/login','GoodsController@login');
Route::any('/goods/dologin','GoodsController@dologin');
Route::any('/goods/redis','GoodsController@redis');













// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
