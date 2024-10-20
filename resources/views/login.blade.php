@extends('app')
@section('title')
    ログイン画面
@endsection
@section('content')
    <form action="{{ route('check') }}" method="POST">
        @csrf
        ID: <input type="text" name="name">
        pass: <input type="text" name="password">
        <button>送信</button>
    </form>

    @if (session('message'))
        <p style="color: red">{{ session('message') }}</p>
    @endif
@endsection
