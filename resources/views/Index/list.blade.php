<link href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">
<form action="">
	<input type="text" name="username" value="{{$username}}" placeholder="请输入搜素条件">
	<select name="age" id="">
		<option value="" >--请选择年龄--</option>
		<option value="17" @if($age==17) selected @endif>17</option>
		<option value="18" @if($age==18) selected @endif>18</option>
		<option value="19" @if($age==19) selected @endif>19</option>
		<option value="20" @if($age==20) selected @endif>20</option>
	</select>
	<button>搜索</button>
</form>
@foreach($data as $key=>$val)
<p>ID:{{$val->id}}  姓名:{{$val->username}} 年龄:{{$val->age}} 头像:<img src="http://www.uploads.com/{{$val->file}}" width="50px"><a href="del?id={{$val->id}}">删除</a><a href="edit{{$val->id}}">编辑</a></p>
@endforeach

{{$data->links()}}
