
@extends('layouts.master')

@section('content')

<h1>Daftar produk kami</h1>
<hr>

<a href="/product/addProduct" class="btn btn-primary mb-3">
    Tambah Data
</a>

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

<div class="card">
    <div class="card-header">
        Produk Kami
    </div>

    <div class="alert alert-primary">
        <b>Nama Toko :</b> {{ $data_toko['nama_toko'] }}
        <br>
        <b>Alamat Toko :</b> {{ $data_toko['alamat_toko'] }}
        <br>
        <b>Status Toko :</b> {{ $data_toko['status_toko'] }}
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data_produk as $item)
                    <tr>
                        <th scope="row">
                            {{ ($data_produk->perPage() * ($data_produk->currentPage() - 1)) + $loop->iteration }}
                        </th>

                        <td>{{ $item->name_product }}</td>
                        <td>{{ $item->stock_product }}</td>

                        <td>
                            Rp. {{ number_format($item->price_product, 0, ',', '.') }}
                        </td>

                        <td>{{ $item->desc_product }}</td>

                        <td>
                            <form action="/product/{{ $item->id_product }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    Delete
                                </button>
                            </form>

                            <a href="/product/{{ $item->id_product }}/edit"
                                class="btn btn-warning">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $data_produk->links('pagination::bootstrap-5') }}

        {{-- Jawaban Soal 1: Menampilkan detail status data --}}
        <div class="mt-2">
            Halaman : {{ $data_produk->currentPage() }}
            <br>

            Jumlah Data : {{ $data_produk->total() }}
            <br>

            Data Per Halaman : {{ $data_produk->perPage() }}
        </div>
    </div>
</div>

@endsection