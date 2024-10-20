@extends('app')
@section('title')
    商品編集画面
@endsection
@section('content')
    <form action="{{route("item_edit",$item->id)}}" method="post">
        @csrf
        @method("patch")
        name: <input type="text" name="name" value="{{$item->name}}">
        price: <input type="text" name="price" value="{{$item->price}}">
        <button>更新</button>
    </form>
    <a href="{{route("dash")}}"><button>戻る</button></a>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection