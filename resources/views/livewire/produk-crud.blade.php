<div class="container mx-auto px-4 mt-6">
    <h2 class="text-xl font-semibold mb-4">Manajemen Produk Toko</h2>

    <button class="mb-4 px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700" wire:click="create">
        + Tambah Produk
    </button>

    <!-- Filter -->
    <div class="flex flex-col md:flex-row md:space-x-4 mb-4 space-y-2 md:space-y-0">
        <div class="w-full md:w-1/3">
            <select wire:model.lazy="filter_kategori" wire:change="$refresh" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                <option value="">-- Filter Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ (string) $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select wire:model.lazy="filter_supplier" wire:change="$refresh" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                <option value="">-- Filter Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ (string) $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <button wire:click="resetFilter" class="w-full px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Reset Filter
            </button>
        </div>
    </div>


    <!-- Notifikasi -->
    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Tabel Produk -->
    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold text-gray-700">Nama Produk</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Harga</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Stok</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Kategori</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Supplier</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach(($produks ?? []) as $produk)
                <tr>
                    <td class="px-4 py-2">{{ $produk->nama_produk }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($produk->harga,0,',','.') }}</td>
                    <td class="px-4 py-2">{{ $produk->stok }}</td>
                    <td class="px-4 py-2">{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <button wire:click="edit({{ $produk->id }})" class="px-3 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600 text-sm">Edit</button>
                        <button wire:click="delete({{ $produk->id }})" class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-700 text-sm">Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-xl mx-auto">
            <form wire:submit.prevent="store">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold">Form Produk</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block mb-1 font-medium">Nama Produk</label>
                        <input type="text" wire:model="nama_produk" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" placeholder="Nama Produk">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Harga</label>
                        <input type="number" wire:model="harga" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" placeholder="Harga">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Stok</label>
                        <input type="number" wire:model="stok" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" placeholder="Stok">
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Kategori</label>
                        <select wire:model="kategori_id" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium">Supplier</label>
                        <select wire:model="supplier_id" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->nama_supplier }}</option>
                            @endforeach
                        </select>
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
</div>
