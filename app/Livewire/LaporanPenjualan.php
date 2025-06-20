<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class LaporanPenjualan extends Component
{
    public $tanggal;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
    }

    public function render()
    {
        // Hitung total nilai penjualan harian
        $totalPenjualan = Penjualan::whereDate('tanggal', $this->tanggal)
            ->join('produks', 'penjualans.produk_id', '=', 'produks.id')
            ->select(DB::raw('SUM(penjualans.jumlah * produks.harga) as total'))
            ->value('total') ?? 0;

        // Ambil semua produk beserta stoknya
        $produks = Produk::with('kategori', 'supplier')->get();

        return view('livewire.laporan-penjualan', [
            'totalPenjualan' => $totalPenjualan,
            'produks' => $produks,
        ]);
    }
}