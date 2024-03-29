<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{


    public function checkFavoriteStatus($id)
    {
        // ログインしているユーザーのIDを取得
        $userId = auth()->id();

        // ユーザーが指定された商品をお気に入りに登録しているかどうかを確認
        $isFavorite = Favorite::where('user_id', $userId)
            ->where('favoritable_id', $id)
            ->exists();

        // レスポンスとしてお気に入りの状態を返す
        return response()->json(['isFavorite' => $isFavorite]);
    }


    public function addToFavorites($id) {
//        auth()->user()->favorites()->attach($product->id);
        auth()->user()->favorites()->create([
            'favoritable_id' => $id,
            'favoritable_type' => Product::class,
        ]);

        return response()->json($id);

    }

    public function removeFromFavorites($id)
    {
        try {
            // ユーザーがログインしているかどうかを確認
            if (!auth()->check()) {
                return redirect()->back()->with('error', 'お気に入りを解除するにはログインしてください');
            }

            // ユーザーのお気に入りを取得
            $favorite = auth()->user()->favorites()->where('favoritable_id', $id)->first();

            if ($favorite) {
                $favorite->delete();

                return response()->json($favorite);

            } else {
                return redirect()->back()->with('error', '指定されたお気に入りが見つかりません');
            }


//            return redirect()->back()->with('message', '商品をお気に入りから削除しました');
        } catch (\Exception $e) {
            // お気に入りが見つからない場合の処理
            return redirect()->back()->with('error', '指定されたお気に入りが見つかりませんでした');
        }
    }

}
