<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductsExport;
class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::searchAndFilter($request);
        return view('products.index', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            if ($request->hasFile('gambar')) {
                $image_type = $request->gambar->getClientOriginalExtension();
                $image_name = $request->nama_produk . '.' . $image_type;
                $request->gambar->move(public_path('assets/product'), $image_name);
            }


            Product::create([
                'nama_produk' => $request->nama_produk,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'stok' => $request->stok,
                'category_id' => $request->category_id,
                'gambar' => $image_name
            ]);

            Alert::success('Berhasil!', 'Produk Berhasil Ditambahkan');
            return redirect()->route('product.index');
        } catch (Exception $e) {
            Alert::error('Gagal!', 'Produk Gagal Ditambahkan'. $e->getMessage());
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, $id)
    {
        $product = Product::find($id);

        if($request->hasFile('gambar')){
            $current_image_path = public_path('assets/product/');
            $current_image_name = $product->gambar;
            if(File::exists($current_image_path.$current_image_name)){
                File::delete($current_image_path.$current_image_name);
            }
            $image_type = $request->gambar->getClientOriginalExtension();
            $image_name = $request->nama_produk.'.'.$image_type;
            $request->gambar->move(public_path('assets/product'), $image_name);
        }

        Product::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'category_id' => $request->category_id,
            'gambar' => $image_name
        ]);

        Alert::success('Berhasil!', 'Produk Berhasil Di Ubah');
        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $image_path = public_path('assets/product/');
        $image_name = $product->gambar;
        if (File::exists($image_path . $image_name)) {
            File::delete($image_path . $image_name);
        }
        $product->delete();
        alert()->success('Berhasil!', 'Product Berhasil di Hapus!');
        return redirect()->route('product.index');
    }

    public function export(Request $request){
        $products = Product::Excel($request);
        return Excel::download(new ProductsExport($products), 'products.xlsx');
    }
}
