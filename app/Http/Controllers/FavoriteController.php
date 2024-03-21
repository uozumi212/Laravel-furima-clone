<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    //
    public function addToFavorites($id) {
//        $product = Product::findOrFail($id);

        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->with('error', '指定された商品が見つかりませんでした');
        }

        auth()->user()->favorites()->create([
            'favoritable_id' => $id,
//            'favoritable_type' => 'App\Models\Product',
            'favoritable_type' => Product::class,
        ]);

        return redirect()->back()->with('message', '商品をお気に入りに追加しました');
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
                return redirect()->back()->with('message', '商品をお気に入りから削除しました');
            } else {
                return redirect()->back()->with('error', '指定されたお気に入りが見つかりません');
            }

            // お気に入りを削除
//            $favorite->delete();

//            return redirect()->back()->with('message', '商品をお気に入りから削除しました');
        } catch (\Exception $e) {
            // お気に入りが見つからない場合の処理
            return redirect()->back()->with('error', '指定されたお気に入りが見つかりませんでした');
        }
    }
//    public function removeFromFavorites($id) {
////        logger($id);
//        try {
//            $favorite = auth()->user()->favorites()->findOrFail($id);
//            $favorite->delete();
//            return redirect()->back()->with('message', '商品をお気に入りから削除しました');
//        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
////            return redirect()->back()->with('error', '指定されたお気に入りが見つかりませんでした');
//            return redirect()->back()->with('error', $e->getMessage());
//        }
//    }
}
