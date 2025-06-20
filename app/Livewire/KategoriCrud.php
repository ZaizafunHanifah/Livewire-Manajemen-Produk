<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Kategori;

class KategoriCrud extends Component
{
    public $kategoris, $nama_kategori, $kategori_id;
    public $isOpen = false;

    public function render()
    {
        $this->kategoris = Kategori::all();
        return view('livewire.kategori-crud')->layout('layouts.sidebar');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function resetInputFields()
    {
        $this->nama_kategori = '';
        $this->kategori_id = '';
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate([
            'nama_kategori' => 'required',
        ]);

        // Jangan masukkan 'id' ke dalam array data create/update
        Kategori::updateOrCreate(
            ['id' => $this->kategori_id], // hanya untuk update
            ['nama_kategori' => $this->nama_kategori]
        );

        session()->flash('message', $this->kategori_id ? 'Kategori Diperbarui.' : 'Kategori Ditambahkan.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->kategori_id = $id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->isOpen = true;
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();
        session()->flash('message', 'Kategori Dihapus.');
    }
}
