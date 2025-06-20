{{-- filepath: resources/views/livewire/penjualan-crud.blade.php --}}
<div class="container mt-4">
    <h4>Input Penjualan Produk</h4>
    <button class="btn btn-primary mb-2" wire:click="create">Tambah Penjualan</button>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5)">
        <div class="modal-dialog">
            <form wire:submit.prevent="store">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Penjualan</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <select wire:model="produk_id" class="form-control mb-2">
                            <option value="">Pilih Produk</option>
                            @foreach(($produks ?? []) as $produk)
                                <option value="{{ $produk->id }}">
                                    {{ $produk->nama_produk }} (Stok: {{ $produk->stok }})
                                </option>
                            @endforeach
                        </select>
                        <input type="number" wire:model="jumlah" class="form-control mb-2" placeholder="Jumlah">
                        <input type="date" wire:model="tanggal" class="form-control mb-2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>