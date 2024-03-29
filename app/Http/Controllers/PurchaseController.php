<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    //
//    public function show(Product $product)
//    {
//        //
//        return view('purchase.show', ['product' => $product]);
//    }

    public function store(Request $request, Product $product) {

        $product = Product::find($product->id);

        if (!$product) {
            return redirect()->route('login')->with('error', '購入にはログインが必要です。');
        }

        $product_id = $request->input('product_id');
        $product = Product::findOrFail($product_id);

        $purchase = new Purchase();
        $purchase->user_id = auth()->id();
        $purchase->product_id = $product->id;
//        $purchase->name = $product->name;
//        $purchase->price = $product->price;

        $purchase->save();

        $product->delete();

        return redirect()->route('purchase')->with('success', '購入が完了しました。');
//        return view('purchase.show',compact('purchase'));
    }
}
