<?php
// app/Http/Livewire/ProdukCrud.php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Supplier;

class ProdukCrud extends Component
{
    public $nama_produk, $harga, $stok, $kategori_id, $supplier_id, $produk_id;
    public $isOpen = false;

    // Tambahkan properti filter
    public $filter_kategori = '';
    public $filter_supplier = '';

    public function render()
    {
        $query = Produk::with('kategori', 'supplier');

        // Filter jika dipilih
        if ($this->filter_kategori) {
            $query->where('kategori_id', $this->filter_kategori);
        }
        if ($this->filter_supplier) {
            $query->where('supplier_id', $this->filter_supplier);
        }

        // filter jika ada
        return view('livewire.produk-crud', [
            'produks' => $query->get(),
            'kategoris' => Kategori::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal() { $this->isOpen = true; }
    public function closeModal() { $this->isOpen = false; }

    private function resetInputFields()
    {
        $this->nama_produk = '';
        $this->harga = '';
        $this->stok = '';
        $this->kategori_id = '';
        $this->supplier_id = '';
        $this->produk_id = '';
    }

    public function store()
    {
        $this->validate([
            'nama_produk' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'kategori_id' => 'required',
            'supplier_id' => 'required',
        ]);

        Produk::updateOrCreate(['id' => $this->produk_id], [
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'kategori_id' => $this->kategori_id,
            'supplier_id' => $this->supplier_id,
        ]);

        session()->flash('message', $this->produk_id ? 'Produk Updated.' : 'Produk Created.');
        $this->resetInputFields();
        $this->filter_kategori = '';
        $this->filter_supplier = '';
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
        Produk::find($id)->delete();
        session()->flash('message', 'Produk Deleted.');
    }
}