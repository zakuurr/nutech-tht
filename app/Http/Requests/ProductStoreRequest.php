<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama_produk' => 'required|unique:products,nama_produk',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'stok' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpg,png|max:100',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
        'nama_produk.required' => 'Nama Produk Tidak Boleh Kosong',
        'nama_produk.unique' => 'Nama Produk Sudah Ada',
        'harga_beli.required' => 'Harga Beli Tidak Boleh Kosong',
        'harga_beli.numeric' => 'Harga Beli Harus Number',
        'harga_beli.min' => 'Harga Beli Minimal :min.',
        'harga_jual.required' => 'Harga Jual Tidak Boleh Kosong',
        'harga_jual.numeric' => 'Harga Jual Harus Number',
        'harga_jual.min' => 'Harga Jual Minimal :min.',
        'stok.required' => 'Stok Tidak Boleh Kosong.',
        'stok.numeric' => 'Stok Harus Nambar.',
        'gambar.required' => 'Gambar Tidak Boleh Kosong',
        'gambar.image' => 'Harus Berupa Gambar',
        'gambar.mimes' => 'Format Gambar Salah (Harus JPG,PNG)',
        'gambar.max' => 'Gambar Harus :max kilobytes.',
        'category_id.required' => 'Kategori Tidak Boleh Kosong.'
        ];
    }
}
