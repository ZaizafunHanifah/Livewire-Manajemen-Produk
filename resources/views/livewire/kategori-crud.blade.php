{{-- filepath: resources/views/livewire/kategori-crud.blade.php --}}
<div class="container mt-4">
    <button class="btn btn-primary mb-2" wire:click="create">Tambah Kategori</button>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach(($kategoris ?? []) as $kategori)
            <tr>
                <td>{{ $kategori->nama_kategori }}</td>
                <td>
                    <button wire:click="edit({{ $kategori->id }})" class="btn btn-warning btn-sm">Edit</button>
                    <button wire:click="delete({{ $kategori->id }})" class="btn btn-danger btn-sm">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($isOpen)
    <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5)">
        <div class="modal-dialog">
            <form wire:submit.prevent="store">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Kategori</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" wire:model="nama_kategori" class="form-control mb-2" placeholder="Nama Kategori">
                        @error('nama_kategori') <span class="text-danger">{{ $message }}</span> @enderror
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
