@extends('layouts.app')

@section('content')
<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('product.index') }}" class="text-breadcumb"><h3>Daftar Produk</h3></a>
          </li>
          <li class="breadcrumb-item text-black h3 active" aria-current="page">Edit produk</li>
        </ol>
      </nav>

      <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
          <div class="col-4">
            <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label fw-semibold">Kategori</label>
              <select class="form-select" name="category_id">
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id', $category->id == isset($product->category_id)) ? 'selected' : '' }}>
                    {{ $category->nama }}
                  </option>
                  @endforeach
              </select>

              @if ($errors->has('category_id'))
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
              @endif
            </div>
          </div>
          <div class="col-8">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-semibold">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk', isset($product->nama_produk) ? $product->nama_produk : '') }}" placeholder="Masukkan nama produk">
                @if ($errors->has('nama_produk'))
                  <span class="text-danger">{{ $errors->first('nama_produk') }}</span>
                @endif
              </div>
          </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-semibold">Harga Beli</label>
                <input type="number" name="harga_beli" id="harga_beli" class="form-control" value="{{ old('harga_beli', isset($product->harga_beli) ? $product->harga_beli : '') }}">
                @if ($errors->has('harga_beli'))
                  <span class="text-danger">{{ $errors->first('harga_beli') }}</span>
                @endif
              </div>
            </div>
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-semibold">Harga Jual</label>
                <input type="number" name="harga_jual" id="harga_jual" class="form-control" value="{{ old('harga_jual', isset($product->harga_jual) ? $product->harga_jual : '') }}">
                @if ($errors->has('harga_jual'))
                  <span class="text-danger">&diams;&ensp;{{ $errors->first('harga_jual') }}</span>
                @endif
              </div>
            </div>
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label fw-semibold">Stok</label>
                <input type="number" name="stok" id="stok" class="form-control" value="{{ old('stok', isset($product->stok) ? $product->stok : '') }}">
                @if ($errors->has('stok'))
                  <span class="text-danger">{{ $errors->first('stok') }}</span>
                @endif
              </div>
            </div>
          </div>
          <div class="col-12 mb-3">
            <label for="exampleFormControlInput1" class="form-label fw-semibold">Upload Image</label>
            <div id="container" class="form-upload-image d-flex justify-content-center flex-column rounded">
              <div class="mx-auto">
                <img src="{{ isset($product->gambar) ? '/assets/product/'.$product->gambar : '/assets/img/Image.png' }}" id="preview" class="uploadImagePreview">
              </div>
              <label for="file-ip-1" id="labelPreview" class="mx-auto">
                <p class="fw-semibold">upload gambar disini</p>
              </label>
              <input type="file" name="gambar" id="file-ip-1" accept=".jpg, .png" onchange="previewImg(event);">
            </div>

          </div>
          <div class="d-flex justify-content-end gap-3">
            <button type="reset" class="btn btn-outline-primary px-5">Batalkan</button>
            <button class="btn btn-primary px-5" type="submit">Simpan</button>
          </div>
        </form>

</div>
@endsection
