<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;

class SupplierCrud extends Component
{
    public $suppliers, $nama_supplier, $alamat, $telepon, $supplier_id;
    public $isOpen = false;

    public function render()
    {
        $this->suppliers = Supplier::all();
        return view('livewire.supplier-crud')->layout('layouts.sidebar');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function resetInputFields()
    {
        $this->nama_supplier = '';
        $this->alamat = '';
        $this->telepon = '';
        $this->supplier_id = '';
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate([
            'nama_supplier' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        Supplier::updateOrCreate(['id' => $this->supplier_id], [
            'nama_supplier' => $this->nama_supplier,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
        ]);

        session()->flash('message', $this->supplier_id ? 'Supplier Diperbarui.' : 'Supplier Ditambahkan.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        $this->supplier_id = $id;
        $this->nama_supplier = $supplier->nama_supplier;
        $this->alamat = $supplier->alamat;
        $this->telepon = $supplier->telepon;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        Supplier::find($id)->delete();
        session()->flash('message', 'Supplier Dihapus.');
    }
}
