@extends('app')
@section('title')
    商品登録画面
@endsection
@section('content')
    <form action="{{route("item_store")}}" method="POST">
        @csrf
        name: <input type="text" name="name" id="">
        price: <input type="number" name="price" id="">
        <button>登録</button>
    </form>

    <a href="{{route("dash")}}"><button>戻る</button></a>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
    <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection