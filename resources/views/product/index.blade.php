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
                    <th>お気に入り登録</th>
                    <th>動作</th>
                </tr>
                </thead>
                <tbody>


                @foreach ($products as $product)
                    <tr>
                        <td class="text-center"><img src="{{ asset('storage/images/' . $product->image) }}" alt="商品画像" style="width: 150px; height: auto;"></td>
                        <td style="width: 10%;">{{ $product->name }}</td>
                        {{-- 数字フォーマット --}}
                        <td style="width: 7%;">¥{{ number_format($product->price) }}</td>
                        <td style="width: 20%;">{{ $product->description }}</td>

                        <td style="width: 5%;" class="text-center">
                            @if ($product->user)
                                {{ $product->user->name }}
                            @endif
                        </td>

                        <td style="width: 5%;">
                            @if (auth()->check() && auth()->user()->id !== $product->user_id)
                             @if ($product->favorites(auth()->user()))
                                    @if ($product->favorites()->where('user_id', auth()->id())->exists())
                                 <form action="{{ route('product.remove_from_favorites', $product->id ) }}" method="POST" class="text-center">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        @csrf
                                        @method('DELETE')

                                     <div class="box">
                                         <button class="bubbly-button" type="submit" onclick="toggleFavorite({{$product->id}})">
{{--                                             <img src="{{ asset('image/icon-star.png') }}" alt="星の画像" style="height: 50px; width: 50px;">--}}
                                             <i class="fa fa-star" style="font-size: 30px; color: #ffd635;"></i>
                                         </button>
                                     </div>

                                 </form>
                                @else
                                    <form action="{{ route('product.add_to_favorites', $product->id ) }}" method="POST" class="text-center">
                                        @csrf

                                        <div class="box">
                                            <button class="bubbly-button" type="submit" onclick="toggleFavorite({{$product->id}})">
{{--                                                <img src="{{ asset('image/星アイコン8.png') }}" alt="星の画像" style="height: 50px; width: 50px; color: yellow;">--}}
                                                <i class="fa fa-star" style="font-size: 30px; "></i>
                                            </button>
                                        </div>

                                    </form>
                                @endif
                            @endif
                            @endif

                        </td>

                        <td style="width: 15%;" class="text-center">
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

    <link rel="stylesheet" href="{{ asset('/css/favorite.css') }}">
    <script src="{{ asset('/js/favorite-anim.js') }}"></script>

@stop
