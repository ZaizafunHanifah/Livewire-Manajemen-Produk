<div class="container mt-4">
    <h4>Manajemen Produk Toko</h4>
    <button class="btn btn-primary mb-2" wire:click="create">Tambah Produk</button>
    <div class="row mb-3">
        <div class="col-md-3">
            <select wire:model="filter_kategori" class="form-control">
                <option value="">-- Filter Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select wire:model="filter_supplier" class="form-control">
                <option value="">-- Filter Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-secondary" wire:click="$set('filter_kategori', ''); $set('filter_supplier', '');">Reset Filter</button>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach(($produks ?? []) as $produk)
            <tr>
                <td>{{ $produk->nama_produk }}</td>
                <td>Rp {{ number_format($produk->harga,0,',','.') }}</td>
                <td>{{ $produk->stok }}</td>
                <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                <td>
                    <button wire:click="edit({{ $produk->id }})" class="btn btn-warning btn-sm">Edit</button>
                    <button wire:click="delete({{ $produk->id }})" class="btn btn-danger btn-sm">Hapus</button>
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
                        <h5 class="modal-title">Form Produk</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" wire:model="nama_produk" class="form-control mb-2" placeholder="Nama Produk">
                        <input type="number" wire:model="harga" class="form-control mb-2" placeholder="Harga">
                        <input type="number" wire:model="stok" class="form-control mb-2" placeholder="Stok">
                        <select wire:model="kategori_id" class="form-control mb-2">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <select wire:model="supplier_id" class="form-control mb-2">
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
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
