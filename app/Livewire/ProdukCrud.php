<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;

class ProdukCrud extends Component
{
    public $nama_produk, $harga, $stok, $kategori_id, $supplier_id, $produk_id;
    public $isOpen = false;

    // Filter properti
    public $filter_kategori = '';
    public $filter_supplier = '';

    public function render()
    {
        logger('Render dipanggil. Filter:', [
            'kategori' => $this->filter_kategori,
            'supplier' => $this->filter_supplier,
        ]);

        $produks = Produk::with(['kategori', 'supplier'])
            ->when($this->filter_kategori != '', fn($query) =>
                $query->where('kategori_id', $this->filter_kategori)
            )
            ->when($this->filter_supplier != '', fn($query) =>
                $query->where('supplier_id', $this->filter_supplier)
            )
            ->get();

        return view('livewire.produk-crud', [
            'produks' => $produks,
            'kategoris' => Kategori::all(),
            'suppliers' => Supplier::all(),
        ])->layout('layouts.sidebar');
    }


    public function updated($property)
    {
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'nama_produk' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        Produk::updateOrCreate(['id' => $this->produk_id], [
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'kategori_id' => $this->kategori_id,
            'supplier_id' => $this->supplier_id,
        ]);

        session()->flash('message', $this->produk_id ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.');

        $this->resetInputFields();
        $this->closeModal();
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $this->produk_id = $id;
        $this->nama_produk = $produk->nama_produk;
        $this->harga = $produk->harga;
        $this->stok = $produk->stok;
        $this->kategori_id = $produk->kategori_id;
        $this->supplier_id = $produk->supplier_id;
        $this->openModal();
    }

    public function delete($id)
    {
        Produk::findOrFail($id)->delete();
        session()->flash('message', 'Produk berhasil dihapus.');
    }

    public function resetFilter()
    {
        $this->filter_kategori = '';
        $this->filter_supplier = '';
    }

    private function resetInputFields()
    {
        $this->nama_produk = '';
        $this->harga = '';
        $this->stok = '';
        $this->kategori_id = '';
        $this->supplier_id = '';
        $this->produk_id = '';
    }

    private function openModal()
    {
        $this->isOpen = true;
    }

    private function closeModal()
    {
        $this->isOpen = false;
    }
}
