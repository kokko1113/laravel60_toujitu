@extends('app')
@section('title')
    クーポン一覧画面
@endsection
@section('content')
    <a href="{{route("coupon_create")}}"><button>クーポン新規登録</button></a>
    <a href="{{route("dash")}}"><button>戻る</button></a>
    
    <table border="1">
        <tr>
            <th>id</th>
            <th>shop_id</th>
            <th>code</th>
            <th>discount</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($coupons as $coupon)
            <tr>
                <td>{{ $coupon->id }}</td>
                <td>{{ $coupon->shop_id }}</td>
                <td>{{ $coupon->code }}</td>
                <td>{{ $coupon->discount }}</td>
                <td><a href="{{ route('coupon_edit', $coupon->id) }}"><button>編集</button></a></td>
                <td>
                    <form action="{{ route('coupon_destroy', $coupon->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button onclick="confirm('本当に削除しますか')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection