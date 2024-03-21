<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ダッシュボード</h1>
@stop

@section('content')
    <p>ここがコンテンツ部分です</p>
@stop

@section('css')
    {{-- ページごとCSSの設定
   <link rel="stylesheet" href="/css/xxx.css"> --}}

    @stop
@section('js')
    <script>console.log('ページごとJSの記述');</script>
@stop
