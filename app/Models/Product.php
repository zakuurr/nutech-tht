<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $incrementing = true;
    protected $keyType = 'int';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    // Mass Assigment
    protected $fillable = [
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'gambar',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearchAndFilter($query, $request)
    {
        return $query
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama_produk', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('id', $request->category_id);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function scopeExcel($query, $request)
    {
        return $query
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama_produk', 'LIKE', '%' . $request->search . '%');
            })
            ->when($request->category_id, function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('id', $request->category_id);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
