<div class="container mx-auto px-4 mt-6">
    <h2 class="text-xl font-semibold mb-4">Manajemen Supplier</h2>

    <button wire:click="create" class="mb-4 px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">
        + Tambah Supplier
    </button>

    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded shadow-sm">
            {{ session('message') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 font-semibold text-gray-700">Nama Supplier</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Alamat</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Telepon</th>
                    <th class="px-4 py-2 font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach(($suppliers ?? []) as $supplier)
                <tr>
                    <td class="px-4 py-2">{{ $supplier->nama_supplier }}</td>
                    <td class="px-4 py-2">{{ $supplier->alamat }}</td>
                    <td class="px-4 py-2">{{ $supplier->telepon }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <button wire:click="edit({{ $supplier->id }})" class="px-3 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600 text-sm">
                            Edit
                        </button>
                        <button wire:click="delete({{ $supplier->id }})" class="px-3 py-1 text-white bg-red-600 rounded hover:bg-red-700 text-sm">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-auto">
            <form wire:submit.prevent="store">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold">Form Supplier</h2>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Nama Supplier</label>
                        <input type="text" wire:model="nama_supplier" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                        @error('nama_supplier') 
                            <span class="text-sm text-red-600">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Alamat</label>
                        <input type="text" wire:model="alamat" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                        @error('alamat') 
                            <span class="text-sm text-red-600">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Telepon</label>
                        <input type="text" wire:model="telepon" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                        @error('telepon') 
                            <span class="text-sm text-red-600">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                <div class="px-6 py-4 border-t flex justify-end gap-2">
                    <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
