<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //商品一覧
//        $products = Product::all();

        $query = Product::query();

        $search = $request->input('search');
        $products = $query->orderBy('id', 'desc')->paginate(10);

        if ($search) {
            $products = Product::where('name', 'LIKE', "%$search%")->paginate(10);
        } else {
            $products = Product::paginate(10);
        }

//        $products = $query->orderBy('id', 'desc')->paginate(10);

        $products->load('user');
        return view (
            'product.index',
            ['products' => $products]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $product = new Product();

        return view('product.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $product = new Product;

        $request->validate([
            'name' => 'required|string|max:30',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        $price = str_replace(',', '', $request->price);

        $imageName = time(). '.' . $request->image->extension();
        $request->image->move(public_path('storage/images'), $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $imageName;
        $product->user_id = auth()->id();

        // fillを使用する場合は、必ずモデルのfillableを指定する
//        $product->fill($request->all())->save();
        $product->save();


        // 一覧へ戻り完了メッセージを表示
        return redirect()->route('product.index')->with('message', '商品を出品しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = Product::find($id);

        return view('product.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        //
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', '商品が見つかりませんでした');
        }
        // 2. 画像がアップロードされた場合は新しい画像を保存
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $imageName = time(). '.' . $request->image->extension();
            $request->image->move(public_path('storage/images'), $imageName);

            // 既存の画像を削除
            if (file_exists(public_path('storage/images/' . $product->image))) {
                unlink(public_path('storage/images/' . $product->image));
            }

            $product->image = $imageName;
        }

        // 3. フォームから送信されたデータで商品情報を更新
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        // 4. 更新を保存
        $product->save();

        return redirect()->route('product.index')->with('message', '編集しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

//        Product::where('id', $id)->delete();
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('products.index')->with('error', '商品が見つかりませんでした');
        }

        try {
            $product->delete();
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('warning', '削除に失敗しました');
        }

        // 完了メッセージを表示
        return redirect()->route('product.index')->with('message', '削除しました');

    }

    public function purchase($id) {
        $product = Product::findOrFail($id);

//        return redirect()->route('product.index')->with('message', '商品を購入しました');
        return view('purchase',compact('product'));
    }

}
