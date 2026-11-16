<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Barang - SMKN 1 Ciomas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body
    class="bg-[#F4F7FC] text-slate-700 font-sans antialiased min-h-screen flex"
    x-data="{ openModal: false, selectedBarang: '', searchUser: '', mobileMenu: false }">

    <!-- SIDEBAR -->
    <aside
    :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-100 flex flex-col justify-between p-6 min-h-screen overflow-y-auto transition-transform duration-300 lg:translate-x-0 lg:static lg:shrink-0">
        <div>
             <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 text-blue-600">
                    <i data-lucide="book-open" class="w-7 h-7"></i>
                </div>
                <div>
                    <h2 class="font-bold text-sm text-slate-800 leading-tight">Peminjaman Barang Sekolah</h2>
                    <p class="text-[11px] text-slate-400">SMKN 1 Ciomas</p>
                </div>
            </div>

            <nav class="space-y-1.5">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('barang') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-medium text-sm transition">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Barang</span>
                </a>
                <a href="{{ route('peminjaman.saya') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    <span>Peminjaman Saya</span>
                </a>
                <a href="/riwayat-peminjaman" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="history" class="w-4 h-4"></i>
                    <span>Riwayat Peminjaman</span>
                </a>
                <a href="{{ route('kontak.sarpras') }}"  class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                   <i data-lucide="headset" class="w-4 h-4"></i>
                   <span>Kontak Sarpras</span>
                </a>
                <a href="/profil" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-3 px-4 py-2.5 w-full text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl font-medium text-sm transition">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- OVERLAY SIDEBAR MOBILE -->
<div
    x-show="mobileMenu"
    @click="mobileMenu = false"
    class="fixed inset-0 bg-slate-900/40 z-30 lg:hidden"
    style="display: none;">
</div>

    <!-- KONTEN -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- Top Navbar -->
        <header class="min-h-16 bg-white/60 backdrop-blur-md px-4 sm:px-6 lg:px-8 flex items-center justify-between border-b border-slate-100">

    <button
        @click="mobileMenu = !mobileMenu"
        class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
        <i data-lucide="menu" class="w-6 h-6"></i>
    </button>

            <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                <div class="flex items-center space-x-2 text-sm text-slate-600">
                    <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold overflow-hidden border border-blue-200">
                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ Auth::user()->name }}" alt="avatar" class="w-full h-full object-cover">
                    </div>
                    <span class="font-medium text-xs hidden sm:inline">{{ Auth::user()->email }}</span>
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
                </div>

                @include('tema')
            </div>

        </header>

        <div class="w-full max-w-7xl p-4 sm:p-6 lg:p-8 space-y-6">
            <!-- Header Katalog -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Katalog Barang Sekolah</h1>
                    <p class="text-xs text-slate-500">Daftar barang yang tersedia untuk dipinjam.</p>
                </div>
                <!-- Input Pencarian Aktif Real-time -->
                <div class="relative w-full sm:w-64">
                    <input x-model="searchUser" type="text" placeholder="Cari barang..." class="w-full text-xs pl-8 pr-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-1 focus:ring-blue-500 bg-white shadow-sm">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-2.5 top-2.5"></i>
                </div>
            </div>

            <!-- Grid Kartu Barang dari Database MySQL -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @forelse ($barangs as $item)
                    @php
                        // Deteksi gambar otomatis sesuai kata kunci nama barang
                        $nama_lower = strtolower($item->nama_barang);
                        $img = 'https://images.unsplash.com/photo-1584824486509-112e4181ff6b?q=80&w=400'; // Default

                        if (str_contains($nama_lower, 'laptop')) {
                            $img = 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'kamera')) {
                            $img = 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'proyektor')) {
                            $img = 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'printer')) {
                            $img = 'https://images.unsplash.com/photo-1612815154858-60aa4c59eaa6?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'tas')) {
                            $img = 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'mouse')) {
                            $img = 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'buku')) {
                            $img = 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'tripod')) {
                            $img = 'https://images.unsplash.com/photo-1584824486509-112e4181ff6b?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'gitar')) {
                            $img = 'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?q=80&w=400';
                        } elseif (str_contains($nama_lower, 'bola')) {
                            $img = 'https://images.unsplash.com/photo-1519766304817-4f37bda74a29?q=80&w=400';
                        }
                    @endphp

                    <div x-show="'{{ strtolower($item->nama_barang . ' ' . $item->kategori) }}'.includes(searchUser.toLowerCase())"
                         class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                        
                        <div class="w-full h-36 bg-slate-50 rounded-xl mb-3 overflow-hidden flex items-center justify-center p-2">
                            <img src="{{ $img }}" alt="{{ $item->nama_barang }}" class="max-h-full max-w-full object-contain">
                        </div>

                        <div>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-md bg-blue-50 text-blue-600 mb-1 inline-block">
                                {{ $item->kategori }}
                            </span>
                            <h3 class="font-bold text-sm text-slate-800">{{ $item->nama_barang }}</h3>
                            
                            <!-- Stok Otomatis dari Database -->
                            @if($item->stok_tersedia > 0)
                                <p class="text-xs text-emerald-600 font-semibold mt-1">Stok: {{ $item->stok_tersedia }}</p>
                            @else
                                <p class="text-xs text-rose-500 font-semibold mt-1">Stok Habis</p>
                            @endif
                        </div>

                        @if($item->stok_tersedia > 0)
                            <button type="button" 
                                    @click="openModal = true; selectedBarang = '{{ addslashes($item->nama_barang) }}'"
                                    class="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white text-xs font-semibold py-2.5 rounded-xl transition duration-150 shadow-sm">
                                Ajukan Peminjaman
                            </button>
                        @else
                            <button disabled type="button" 
                                    class="mt-4 w-full bg-slate-100 text-slate-400 text-xs font-semibold py-2.5 rounded-xl cursor-not-allowed">
                                Stok Habis
                            </button>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-100 text-slate-400 text-xs">
                        Belum ada barang di inventaris sekolah. Silakan minta Admin untuk menambahkan barang.
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- MODAL POPUP FORM PENGAJUAN -->
   <div x-show="openModal" 
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4 overflow-y-auto" 
     style="display: none;">

        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto p-4 sm:p-6 relative"
             @click.away="openModal = false">
            
            <div class="flex items-center justify-between border-b pb-3 mb-4">
                <h3 class="font-bold text-base text-slate-800">Form Pengajuan Peminjaman</h3>
                <button @click="openModal = false" class="text-slate-400 hover:text-slate-600">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('pinjam.store') }}" class="space-y-4">
                @csrf

                <!-- Nama Peminjam -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" value="{{ Auth::user()->name }}" required
                           class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs font-medium text-slate-800 bg-slate-50 focus:outline-none">
                </div>

                <!-- Barang yang Dipinjam -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Barang yang Dipinjam</label>
                    <input type="text" name="nama_barang" :value="selectedBarang" readonly required
                           class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs font-bold text-blue-600 bg-blue-50/50 focus:outline-none">
                </div>

                <!-- Tanggal Pinjam -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" required
                           class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-blue-500">
                </div>

                
<!-- Tanggal Kembali -->
<div>
    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">
        Tanggal Kembali
    </label>
    <input type="date" name="tanggal_kembali" required
           class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-blue-500">
</div>


                
<!-- Jam Mulai dan Jam Selesai -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
    <div>
        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">
            Jam Mulai
        </label>
        <input type="time" name="jam_mulai" required
            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-blue-500">
    </div>

    <div>
        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">
            Jam Selesai
        </label>
        <input type="time" name="jam_selesai" required
            class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-blue-500">
    </div>
</div>


                <!-- Keperluan -->
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Keperluan</label>
                    <textarea name="keperluan" rows="3" required placeholder="Contoh: Praktik Lab TKJ"
                              class="w-full border border-gray-300 rounded-xl px-3 py-2 text-xs text-slate-700 focus:outline-none focus:border-blue-500"></textarea>
                </div>

                <div class="flex justify-end space-x-2 pt-2">
                    <button type="button" @click="openModal = false" class="px-4 py-2 text-xs text-slate-500 hover:bg-slate-100 rounded-xl font-medium">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 text-xs bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl shadow-md transition">
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>

       <script>
        lucide.createIcons();
    </script>
</body>
</html>