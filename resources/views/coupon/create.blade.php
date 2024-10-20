@extends('app')
@section('title')
    クーポン登録画面
@endsection
@section('content')
    <form action="{{route("coupon_store")}}" method="POST">
        @csrf
        code: <input type="text" name="code" id="">
        discount: <input type="number" name="discount" id="">
        <button>登録</button>
    </form>

    <a href="{{route("coupon_index")}}"><button>戻る</button></a>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
    <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection