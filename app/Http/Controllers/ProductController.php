<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $data_toko = [
            'nama_toko' => 'Tulis Nama Kamu',
            'alamat_toko' => 'Jl. Terus Jadian Kagak',
            'status_toko' => 'Belum Pasti'
        ];

        // Mengambil data produk menggunakan Eloquent ORM
        $data_product = Product::orderBy('id_product', 'desc')->paginate(10);

        return view('pages.product.show', [
            'data_toko' => $data_toko,
            'data_produk' => $data_product,
        ]);
    }

    // Menampilkan halaman tambah produk
    public function addProduct()
    {
        return view('pages.product.addProduct');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        // Validasi data yang diinputkan
        $request->validate([
            'name_product' => 'required|min:4|max:20',
            'stock_product' => 'required|numeric',
            'price_product' => 'required|numeric',
            'desc_product' => 'required',
        ]);

        // Menyimpan data produk ke database
        Product::create([
            'name_product' => $request->name_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'desc_product' => $request->desc_product,
            'id_category' => rand(1, 3),
        ]);

        return redirect('/product')->with(
            'message',
            'Data Berhasil Ditambahkan'
        );
    }

    // Menampilkan halaman edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('pages.product.editProduct', compact('product'));
    }

    // Memperbarui data produk
    public function update(Request $request, $id)
    {
        // Validasi data yang diinputkan
        $request->validate([
            'name_product' => 'required|min:4|max:20',
            'stock_product' => 'required|numeric',
            'price_product' => 'required|numeric',
            'desc_product' => 'required',
        ]);

        // Mencari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Memperbarui data produk
        $product->update([
            'name_product' => $request->name_product,
            'stock_product' => $request->stock_product,
            'price_product' => $request->price_product,
            'desc_product' => $request->desc_product,
        ]);

        return redirect('/product')->with(
            'message',
            'Data Berhasil Diperbarui'
        );
    }

        public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect('/product')->with('message', 'Data Berhasil Dihapus');
    }

     
// Menampilkan detail data produk
    public function show($id)
    {
        $produk_detail = Product::findOrFail($id);

        return view('pages.product.detail', [
            'detail_produk' => $produk_detail
        ]);
    }

}
