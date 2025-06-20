<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class PenjualanDanLaporan extends Component
{
    public $produk_id, $jumlah, $tanggal;
    public $isOpen = false;
    public $tanggal_laporan;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->tanggal_laporan = date('Y-m-d');
    }

    public function render()
    {
        // Laporan total penjualan harian
        $totalPenjualan = Penjualan::whereDate('tanggal', $this->tanggal_laporan)
            ->join('produks', 'penjualans.produk_id', '=', 'produks.id')
            ->select(DB::raw('SUM(penjualans.jumlah * produks.harga) as total'))
            ->value('total') ?? 0;

        $produks = Produk::with('kategori', 'supplier')->get();

        return view('livewire.penjualan-dan-laporan', [
            'produks' => $produks,
            'totalPenjualan' => $totalPenjualan,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->tanggal = date('Y-m-d');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->produk_id = '';
        $this->jumlah = '';
        $this->tanggal = date('Y-m-d');
    }

    public function store()
    {
        $this->validate([
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal' => 'required|date',
        ]);

        $produk = Produk::find($this->produk_id);

        if (!$produk || $produk->stok < $this->jumlah) {
            session()->flash('error', 'Stok produk tidak mencukupi!');
            return;
        }

        Penjualan::create([
            'produk_id' => $this->produk_id,
            'jumlah' => $this->jumlah,
            'tanggal' => $this->tanggal,
        ]);

        $produk->decrement('stok', $this->jumlah);

        session()->flash('message', 'Penjualan berhasil disimpan.');
        $this->resetInputFields();
        $this->closeModal();
    }
}