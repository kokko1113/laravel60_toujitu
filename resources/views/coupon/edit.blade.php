@extends('app')
@section('title')
    クーポン編集画面
@endsection
@section('content')
    <form action="{{route("coupon_edit",$coupon->id)}}" method="post">
        @csrf
        @method("patch")
        code: <input type="text" name="code" value="{{$coupon->code}}">
        discount: <input type="number" name="discount" value="{{$coupon->discount}}">
        <button>更新</button>
    </form>
    <a href="{{route("coupon_index")}}"><button>戻る</button></a>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection