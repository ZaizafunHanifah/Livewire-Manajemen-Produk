{{-- layouts/sidebar.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-100 border-r px-4 py-8 flex flex-col justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-8 text-gray-800">Menu</h2>
            <nav>
                <ul class="space-y-4">
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('produk') }}">Produk</a></li>
                    <li><a href="{{ route('kategori') }}">Kategori</a></li>
                    <li><a href="{{ route('supplier') }}">Supplier</a></li>
                    <li><a href="{{ route('penjualan-laporan') }}">Laporan Penjualan</a></li>
                </ul>
            </nav>
        </div>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mt-8 text-left text-red-600 hover:text-red-800 font-medium">
                Logout
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 bg-gray-50">
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>
</div>

@livewireScripts
</body>
</html>

