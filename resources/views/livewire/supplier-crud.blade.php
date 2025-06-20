<div class="container mt-4">
    <button class="btn btn-primary mb-2" wire:click="create">Tambah Supplier</button>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach(($suppliers ?? []) as $supplier)
            <tr>
                <td>{{ $supplier->nama_supplier }}</td>
                <td>{{ $supplier->alamat }}</td>
                <td>{{ $supplier->telepon }}</td>
                <td>
                    <button wire:click="edit({{ $supplier->id }})" class="btn btn-warning btn-sm">Edit</button>
                    <button wire:click="delete({{ $supplier->id }})" class="btn btn-danger btn-sm">Hapus</button>
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
                        <h5 class="modal-title">Form Supplier</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" wire:model="nama_supplier" class="form-control mb-2" placeholder="Nama Supplier">
                        @error('nama_supplier') <span class="text-danger">{{ $message }}</span> @enderror
                        <input type="text" wire:model="alamat" class="form-control mb-2" placeholder="Alamat">
                        @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                        <input type="text" wire:model="telepon" class="form-control mb-2" placeholder="Telepon">
                        @error('telepon') <span class="text-danger">{{ $message }}</span> @enderror
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
