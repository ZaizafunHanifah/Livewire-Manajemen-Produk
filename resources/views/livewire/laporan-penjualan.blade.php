{{-- filepath: resources/views/livewire/laporan-penjualan.blade.php --}}
<div class="container mt-4">
    <h4>Laporan Penjualan Harian</h4>
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="date" wire:model="tanggal" class="form-control">
        </div>
    </div>
    <div class="alert alert-info">
        Total Nilai Penjualan Tanggal <b>{{ $tanggal }}</b>: <b>Rp {{ number_format($totalPenjualan,0,',','.') }}</b>
    </div>

    <h5>Stok Tersisa Produk</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach(($produks ?? []) as $produk)
            <tr>
                <td>{{ $produk->nama_produk }}</td>
                <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                <td>{{ $produk->stok }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>