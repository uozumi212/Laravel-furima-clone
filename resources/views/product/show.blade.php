@extends('adminlte::page')

@section('content_header')
    <h1>購入ページ</h1>

@stop


@section('content')
    {{-- 完了メッセージ --}}
{{--    @if (session('message'))--}}
{{--        <div class="alert alert-info alert-dismissible">--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">--}}
{{--                ×--}}
{{--            </button>--}}
{{--            {{ session('message') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if (session('error'))--}}
{{--        <div class="alert alert-warning alert-dismissible">--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">--}}
{{--                x--}}
{{--            </button>--}}
{{--            {{ session('error') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    @if (session('warning'))--}}
{{--        <div class="alert alert-danger alert-dismissible">--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">--}}
{{--                x--}}
{{--            </button>--}}
{{--            {{ session('warning') }}--}}
{{--        </div>--}}
{{--    @endif--}}

    {{-- 新規登録画面へ --}}


    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>概要</th>
                    <th style="width: 60px"></th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        {{--                        <td><img src="{{ asset('images/' . $product->image) }}" alt="商品画像" style="width: 100px; height: auto;"></td>--}}
                        <td class="text-center"><img src="{{ asset('storage/images/' . $product->image) }}" alt="商品画像" style="width: 150px; height: auto;"></td>
                        <td style="width: 20%;">{{ $product->name }}</td>
                        {{-- 数字フォーマット --}}
                        <td style="width: 10%;">¥{{ number_format($product->price) }}</td>
                        <td style="width: 40%;">{{ $product->description }}</td>
                        <td style="width: 7%;">
                                <div>
                                    <form action="{{ route('purchase.store', $product->id) }}" method="post">
                                        @csrf
                                        {{-- 簡易的に確認メッセージを表示 --}}
                                        <button type="submit" class="btn btn-success"
                                                onclick="return confirm('本当に購入しますか?');">
                                            購入
                                        </button>
                                    </form>
                                </div>

                        </td>
                    </tr>


                </tbody>
            </table>
            <div class="card-footer">
                <div class="row">
                    <a class="btn btn-default" href="{{ route('product.index') }}" role="button">戻る</a>
                </div>
            </div>
        </div>


    </div>
@stop
