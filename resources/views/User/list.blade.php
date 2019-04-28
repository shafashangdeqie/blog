@foreach($data as $k=>$v)
<p>名字:{{$v->username}} 年龄:{{$v->age}}</p>
@endforeach
{{$data->links()}}
