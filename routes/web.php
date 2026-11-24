
<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.beranda');
});

Route::get('/about', function () {
    return view('pages.about', [
        'nama'=> 'Helen',
        'kelas'=> 'TSM-02',
        'nim' => '707082400030',
    ]);
});

Route::view('/contact', 'pages.contact');

// Menampilkan data dari database
Route::get('/product', [ProductController::class, 'index']);

// Menampilkan halaman form insert data
Route::get('/product/addProduct', [ProductController::class, 'addProduct']);

// Memasukkan data dari form ke dalam database
Route::post('/product', [ProductController::class, 'store']);

// Menampilkan detail data produk
Route::get('/product/{id}', [ProductController::class, 'show']);

// Menampilkan form edit produk
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);

// Memperbarui data produk
Route::put('/product/{id}', [ProductController::class, 'update']);

// Menghapus data produk
Route::delete('/product/{id}', [ProductController::class, 'destroy']);

// Resource Controller Category
Route::resource('/category', CategoryController::class);
