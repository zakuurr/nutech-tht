@extends('layouts.app')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('product.index') }}" class="text-black text-decoration-none"><h3>Daftar Produk</h3></a>
          </li>

        </ol>
      </nav>

    <div class="d-flex justify-content-between mb-4">
        <div class="d-flex gap-3">
          <form action="{{ route('product.index') }}" method="GET">
            <div class="wrapper">
              <input type="text" name="search" class="form-control input" placeholder="Cari Produk" value="{{ request('search') }}" style="width: 350px">
              <img src="{{ asset('') }}assets/img/magnifier.png" alt="icon" class="icon-lock" width="20">
            </div>
            <div class="wrapper">
                <select class="form-select input" name="category_id">
                    <option {{ request('category_id') == '' ? 'selected' : '' }} value="">Semua</option>
                    @foreach ($categories as $category)
                    <option {{ $category->id == request('category_id') ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->nama }}</option>
                    @endforeach
                  </select>
              <img src="{{ asset('') }}assets/img/Package.png" alt="icon" class="icon-lock icon-black">
            </div>
            <button type="submit" class="btn btn-sm btn-outline-dark">Cari</button>
          </form>
        </div>
        <div>
          <div class="d-flex gap-3">
            <a href="/product/export?{{ http_build_query(request()->except('page')) }}">
              <button type="button" class="btn btn-sm btn-success">
                <img src="{{ asset('') }}assets/img/MicrosoftExcelLogo.png" alt="ExportLogo" width="20px" height="20px">
                Export Excel
              </button>
            </a>
            <a href="{{ route('product.create') }}" class="text-decoration-none">
              <button type="button" class="btn btn-sm btn-danger d-inline">
                <img src="{{ asset('') }}assets/img/PlusCircle.png" alt="TambahLogo" width="20px" height="20px">
                Tambah Produk
              </button>
            </a>
          </div>
        </div>
      </div>

    <div class="rounded border py-2 px-3 mb-3">

            <table class="table table-borderless">
                <thead class="table-light" >
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col" class="text-center">Image</th>
                      <th scope="col">Nama Produk</th>
                      <th scope="col">Kategori Produk</th>
                      <th scope="col">Harga Barang (RP)</th>
                      <th scope="col">Harga Jual (RP)</th>
                      <th scope="col">Stok Produk</th>
                      <th scope="col" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($products as $key => $product)
                    <tr>
                      <td>{{ $products->firstItem() + $key }}</td>
                      <td class="text-center"><img src="{{ asset('') }}storage/product/{{ $product->gambar }}" alt="Image" height="20px"></td>

                      <td>{{ $product->nama_produk }}</td>
                      <td>{{ $product->category->nama }}</td>
                      <td>{{ format_uang($product->harga_beli) }}</td>
                      <td>{{ format_uang($product->harga_jual) }}</td>
                      <td>{{ $product->stok }}</td>

                      <td class="text-center">
                        <a href="{{ '/product/edit/'.$product->id }}" class="text-decoration-none">
                          <img src="{{ asset('') }}assets/img/edit.png" alt="icon" height="16px">
                        </a> &emsp;

                        <form method="POST" action="{{ route('product.destroy', $product->id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border: none;background-color: white"  class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><img src="{{ asset('') }}assets/img/delete.png" alt="icon" height="16px"></button>
                        </form>
                        </form>
                      </td>
                    </tr>
                  @empty
                  <div class="alert alert-danger" role="alert">
                  Data Kosong!
                  </div>
                  @endforelse
                  </tbody>
            </table>

    </div>
    {{ $products->links() }}

</div>

@endsection
