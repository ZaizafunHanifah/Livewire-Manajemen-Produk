<div class="container mx-auto px-4 mt-6">
    <h2 class="text-xl font-semibold mb-4">Penjualan & Laporan Harian</h2>

    <button class="px-4 py-2 mb-4 text-white bg-green-600 rounded hover:bg-green-700" wire:click="create">
        + Input Penjualan
    </button>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md mx-auto">
            <form wire:submit.prevent="store">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold">Form Penjualan</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block mb-1 font-medium">Pilih Produk</label>
                        <select wire:model="produk_id" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Pilih Produk</option>
                            @foreach(($produks ?? []) as $produk)
                                <option value="{{ $produk->id }}">{{ $produk->nama_produk }} (Stok: {{ $produk->stok }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Jumlah</label>
                        <input type="number" wire:model="jumlah" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" placeholder="Jumlah">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Tanggal</label>
                        <input type="date" wire:model="tanggal" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                    </div>
                </div>
                <div class="px-6 py-4 border-t flex justify-end gap-2">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <hr class="my-6">

    <h3 class="text-lg font-semibold mb-2">Laporan Penjualan Harian</h3>
    <div class="mb-4">
        <input type="date" wire:model="tanggal_laporan" class="px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
    </div>

    <div class="mb-6 p-3 bg-blue-100 text-blue-700 rounded">
        Total Nilai Penjualan Tanggal <strong>{{ $tanggal_laporan }}</strong>:
        <strong>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</strong>
    </div>

    <h3 class="text-lg font-semibold mb-2">Stok Tersisa Produk</h3>
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold text-gray-700">Nama Produk</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Kategori</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Supplier</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Stok</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach(($produks ?? []) as $produk)
                <tr>
                    <td class="px-4 py-2">{{ $produk->nama_produk }}</td>
                    <td class="px-4 py-2">{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $produk->stok }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
