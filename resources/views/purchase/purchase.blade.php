@extends('adminlte::page')

@section('content_header')
    <h1>購入完了</h1>

@stop


@section('content')
    <h3>{{ $purchase->name }}の購入が完了しました</h3>


    <div class="card">
        <div class="card-body">


            <div class="card-footer">
                <div class="row">
                    <a class="btn btn-default" href="{{ route('product.index') }}" role="button">商品一覧へ戻る</a>
                </div>
            </div>
        </div>

    </div>
@stop
