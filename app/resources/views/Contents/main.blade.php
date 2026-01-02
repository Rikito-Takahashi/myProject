@extends('layouts.Contents_layout')

@section('main')

<h1>ようこそ、{{ Auth::user()->name }}さん！</h1>
<a href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    ログアウト
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection