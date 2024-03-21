@extends('adminlte::page')
@section('title', 'お問い合わせ')

@section('content')


<section class="pt-5 pb-24 text-center">
    <h2>お問い合わせフォーム</h2>
  <div class="w-192 mx-auto">
    <p class="mt-3">以下のフォームに必要事項をご入力の上、ご送信下さい。<br>
      通常お問い合わせから3営業日以内にご入力いただいたメールアドレスに返信させていただきます。<br>
      なお、info@nekocafe.xx.xxからの返信が受信できるように事前に設定のご確認をお願い致します。
    </p>

      <!-- ▼▼▼▼エラーメッセージ▼▼▼▼　-->

{{--      <div class="py-4 px-6 border border-warning bg-warning rounded" style="">--}}
{{--        <ul class="list-unstyled ">--}}
{{--          <li class="text-danger py-1">お名前は、必ず指定してください。</li>--}}
{{--          <li class="text-danger py-1">電話番号は、必ず指定してください。</li>--}}
{{--          <li class="text-danger py-1">お問い合わせ内容は、必ず指定してください。</li>--}}
{{--        </ul>--}}
{{--      </div>--}}
      <!-- ▲▲▲▲エラーメッセージ▲▲▲▲　-->
        <div class="mt-3">
            @if($errors->any())
                <div class="py-4 px-6 border border-warning bg-warning rounded" style="">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        </div>
        @endif

      <form action="{{ route('contact') }}" method="POST" class="mt-4 w-auto">
          @csrf
        <div class="mb-4 form-group">
{{--          <label for="name" class="form-label">お名前<span class="text-white text-xs bg-yellow-400 mx-2 py-1 px-2">必須</span></label>--}}
          <input id="name" class="form-control" type="text" placeholder="名前" aria-label="名前" name="name" value="{{ old('name') }}">
{{--            @if($errors->has('name'))--}}
{{--                <p class="text-red-400">{{ $errors->first('name') }}</p>--}}
{{--            @endif--}}
        </div>
        <div class="mb-4 form-group">
{{--          <label for=name_kana class="form-label">お名前（フリガナ）<span class="text-white text-xs bg-yellow-400 mx-2 py-1 px-2">必須</span></label>--}}
          <input id="name_kana" class="form-control" type="text" placeholder="フリガナ" aria-label="フリガナ" name="name_kana" value="{{ old('name_kana') }}">
{{--            @if($errors->has('name_kana'))--}}
{{--                <p class="text-red-400">{{ $errors->first('name_kana') }}</p>--}}
{{--            @endif--}}
        </div>
          <div class="mb-4 form-group">
{{--              <label for="phone" class="form-label">電話番号</label>--}}
              <input id="phone" class="form-control" type="text" placeholder="電話番号" aria-label="電話番号" value="{{ old('phone') }}">
{{--              @if($errors->has('phone'))--}}
{{--                  <p class="text-red-400">{{ $errors->first('phone') }}</p>--}}
{{--              @endif--}}
          </div>

          <div class="mb-4 form-group">
{{--          <label for="email" class="form-label">メールアドレス<span class="text-white text-xs bg-yellow-400 mx-2 py-1 px-2">必須</span></label>--}}
          <input id="email" class="form-control" type="email" placeholder="info@example.com" aria-label="info@example.com" value="{{ old('email') }}">
{{--            @if($errors->has('email'))--}}
{{--                <p class="text-red-400">{{ $errors->first('email') }}</p>--}}
{{--            @endif--}}
        </div>
        <div class="mb-4 form-group">
{{--          <label for="body" class="form-label">お問い合わせ内容<span class="text-white text-xs bg-yellow-400 mx-2 py-1 px-2">必須</span></label>--}}
          <textarea id="body" class="form-control" type="text" placeholder="お問い合わせ内容" aria-label="お問い合わせ内容" name="body">{{ old('body') }}</textarea>
{{--            @if($errors->has('body'))--}}
{{--                <p class="text-red-400">{{ $errors->first('body') }}</p>--}}
{{--            @endif--}}
        </div>
        <div class="text-center">
            <p>送信される際は、<a href="#" class="">個人情報保護方針</a>に同意したものとします。</p>
            <button class="mt-6 bg-black text-white hover:bg-blue-700 rounded px-4 py-3" type="submit">送信</button>
        </div>
      </form>

    </div>
    <a href="{{ url('/product') }}" class="d-block p-3">トップページ</a>
</section>
@endsection
