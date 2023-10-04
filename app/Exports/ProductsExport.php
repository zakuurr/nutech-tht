<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class ProductsExport implements FromCollection, WithHeadings, withColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $products;

    public function __construct($products){
        $this->products = $products;
    }
    public function collection(){
        $counter = 1;
        return $this->products->map(function ($product) use (&$counter){
            return [
                'No' => $counter++,
                'Nama Produk' => $product->nama_produk,
                'Kategori Produk' => $product->category->nama,
                'Harga Beli (RP)' => number_format($product->harga_beli),
                'Harga Jual (RP)' => number_format($product->harga_jual),
                'Stok Produk' => number_format($product->stok)
            ];
        });
    }

    public function headings(): array{
        return ["No", "Nama Produk", "Kategori Produk", "Harga Beli", "Harga Jual", "Stok"];
    }

    public function styles(Worksheet $sheet){
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FF0000']]],
        ];
    }

    public function columnWidths(): array{
        return [
            'A' => 4,
            'B' => 15,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 10,
        ];
    }
}
