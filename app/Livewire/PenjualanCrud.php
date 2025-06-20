<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class PenjualanCrud extends Component
{
    public $produk_id, $jumlah, $tanggal;
    public $isOpen = false;

    public function render()
    {
        return view('livewire.penjualan-crud', [
            'produks' => Produk::all(),
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