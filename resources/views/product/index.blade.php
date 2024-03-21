@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
   <div class="d-flex">
       <h1>商品一覧</h1>
       <form action="{{ route('product.index') }}" method="GET" class="mb-3 ml-4 ">
           <div class="input-group">
               <input type="text" name="search" class="form-control col-16 w-55" placeholder="商品名を入力してください" value="{{ request('search') }}">
                   <button type="submit" class="btn btn-primary ml-3">検索</button>

           </div>
       </form>

   </div>

@stop


@section('content')
    {{-- 完了メッセージ --}}
    @if (session('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                ×
            </button>
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                x
            </button>
            {{ session('error') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                x
            </button>
            {{ session('warning') }}
        </div>
    @endif

    {{-- 新規登録画面へ --}}
    <a class="btn btn-primary mb-2" href="{{ route('product.create') }}" role="button">新規登録</a>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>概要</th>
                    <th>出品者</th>
                    <th>いいね</th>
                    <th>アクション</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="text-center"><img src="{{ asset('storage/images/' . $product->image) }}" alt="商品画像" style="width: 150px; height: auto;"></td>
                        <td style="width: 20%;">{{ $product->name }}</td>
                        {{-- 数字フォーマット --}}
                        <td style="width: 10%;">¥{{ number_format($product->price) }}</td>
                        <td style="width: 40%;">{{ $product->description }}</td>

                        <td style="width: 5%;" class="text-center">
                            @if ($product->user)
                                {{ $product->user->name }}
                            @endif
                        </td>
                        <td>
{{--                            @if (auth()->check())--}}
                            @if (auth()->check() && auth()->user()->id !== $product->user_id)
                             @if ($product->favorites(auth()->user()))
                                    @if ($product->favorites()->where('user_id', auth()->id())->exists())
                                 <form action="{{ route('product.remove_from_favorites', $product->id ) }}" method="POST">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" style="border: none; background: none; padding: 0;">
                                            <i class="fa fa-star text-center" style="width: 20px; height: 20px;"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('product.add_to_favorites', $product->id ) }}" method="POST" class="text-center">
                                        @csrf
                                        <button type="submit" style="border: none; background: none; padding: 0;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width: 20px; height: 20px;"><!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.><path d="M287.9 0c9.2 0 17.6 5.2 21.6 13.5l68.6 141.3 153.2 22.6c9 1.3 16.5 7.6 19.3 16.3s.5 18.1-5.9 24.5L433.6 328.4l26.2 155.6c1.5 9-2.2 18.1-9.7 23.5s-17.3 6-25.3 1.7l-137-73.2L151 509.1c-8.1 4.3-17.9 3.7-25.3-1.7s-11.2-14.5-9.7-23.5l26.2-155.6L31.1 218.2c-6.5-6.4-8.7-15.9-5.9-24.5s10.3-14.9 19.3-16.3l153.2-22.6L266.3 13.5C270.4 5.2 278.7 0 287.9 0zm0 79L235.4 187.2c-3.5 7.1-10.2 12.1-18.1 13.3L99 217.9 184.9 303c5.5 5.5 8.1 13.3 6.8 21L171.4 443.7l105.2-56.2c7.1-3.8 15.6-3.8 22.6 0l105.2 56.2L384.2 324.1c-1.3-7.7 1.2-15.5 6.8-21l85.9-85.1L358.6 200.5c-7.8-1.2-14.6-6.1-18.1-13.3L287.9 79z"/></svg>
                                        </button>
                                    </form>
                                @endif
                            @endif
                            @endif

                        </td>
                        <td style="width: 8%;" class="text-center">
                            @if (auth()->check() && auth()->user()->id  === $product->user_id)

                                <div class="text-center">
                                    <a class="btn btn-primary mb-2" href="{{ route('product.edit', $product->id) }}"
                                       role="button">編集</a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        {{-- 簡易的に確認メッセージを表示 --}}
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('削除してもよろしいですか?');">
                                            削除
                                        </button>
                                    </form>
                                </div>
                            @else

                                      <a class="btn btn-success mb-2" href="{{ route('product.show', $product->id) }}"
                                       role="button">購入</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{-- ページネーション --}}
        @if ($products->hasPages())
            <div class="card-footer clearfix">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@stop
