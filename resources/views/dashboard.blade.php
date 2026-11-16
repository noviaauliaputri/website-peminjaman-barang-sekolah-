<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Peminjaman Barang Sekolah SMKN 1 Ciomas</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons & Alpine.js -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body x-data="{ showLogoutModal: false, mobileMenu: false }" class="bg-[#F4F7FC] text-slate-700 font-sans antialiased min-h-screen flex">

    <!-- SIDEBAR KIRI -->
    <aside
    :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-100 flex flex-col justify-between p-6 min-h-screen transition-transform duration-300 lg:translate-x-0 lg:static lg:shrink-0">
        <div>
            <!-- Header Brand -->
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 text-blue-600">
                    <i data-lucide="book-open" class="w-7 h-7"></i>
                </div>
                <div>
                    <h2 class="font-bold text-sm text-slate-800 leading-tight">Peminjaman Barang Sekolah</h2>
                    <p class="text-[11px] text-slate-400">SMKN 1 Ciomas</p>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <nav class="space-y-1.5">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-medium text-sm transition">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('barang') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-700 font-medium text-sm transition">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Barang</span>
                </a>

                <a href="{{ route('peminjaman.saya') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 hover:text-slate-700 font-medium text-sm transition">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    <span>Peminjaman Saya</span>
                </a>

                <a href="{{ route('riwayat.peminjaman') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
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

        <!-- Tombol Trigger Logout Modal -->
        <div>
            <button @click="showLogoutModal = true" type="button" class="flex items-center space-x-3 px-4 py-2.5 w-full text-slate-500 hover:text-red-500 hover:bg-red-50 rounded-xl font-medium text-sm transition">
                <i data-lucide="log-out" class="w-4 h-4"></i>
                <span>Logout</span>
            </button>
        </div>
    </aside>
    <div
    x-show="mobileMenu"
    @click="mobileMenu = false"
    class="fixed inset-0 bg-slate-900/40 z-30 lg:hidden"
    style="display: none;">
</div>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col min-w-0">
        <!-- Top Navbar -->
        <header class="min-h-16 bg-white/60 backdrop-blur-md px-4 sm:px-6 lg:px-8 flex items-center justify-between border-b border-slate-100">

    <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
        <i data-lucide="menu" class="w-6 h-6"></i>
    </button>

           
<!-- Profil User Kanan Atas -->
<div class="flex items-center gap-2 sm:gap-4 min-w-0">
    <div class="flex items-center space-x-2 text-sm text-slate-600 cursor-pointer">
        <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold overflow-hidden border border-blue-200">
            <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ Auth::user()->name ?? 'user' }}"
                 alt="avatar"
                 class="w-full h-full object-cover">
        </div>

        <span class="font-medium text-xs text-slate-600 hidden sm:inline">
            {{ Auth::user()->email ?? 'user@gmail.com' }}
        </span>

        <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400"></i>
    </div>

    @include('tema')
</div>
</header>


        <!-- Body Content -->
        <div class="w-full max-w-6xl p-4 sm:p-6 lg:p-8 space-y-6">
            <!-- Banner Ucapan Selamat Datang -->
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-pink-50 via-rose-50/50 to-pink-50 p-4 sm:p-6 border border-pink-100/60 flex items-center justify-between gap-3">
                <div class="z-10">
                    <h1 class="text-lg font-bold text-slate-800 leading-tight">Selamat datang,</h1>
                    <p class="text-xl font-bold text-slate-900 mt-0.5">
                        {{ Auth::user()->name ?? 'Pengguna' }}!
                    </p>
                    <p class="text-xs text-slate-500 mt-2 font-medium">
                        Semoga harimu menyenangkan di SMKN 1 Ciomas <span class="text-rose-400">💕</span>
                    </p>
                </div>

                <!-- Ilustrasi Karakter Avatar Kanan -->
                <div class="shrink-0 w-24 h-24 flex items-center justify-center">
                    <img src="https://api.dicebear.com/7.x/adventurer/svg?seed={{ Auth::user()->name ?? 'user' }}&backgroundColor=ffdfbf" alt="Ilustrasi" class="w-20 h-20 drop-shadow">
                </div>
            </div>

            <!-- 4 Kartu Statistik Dinamis -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Card 1: Barang Dipinjam -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center text-pink-500 mb-3">
                        <i data-lucide="package" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold text-slate-500">Barang Dipinjam</span>
                    <div class="mt-2 flex items-baseline space-x-1">
                        <span class="text-2xl font-bold text-slate-800">{{ $barangDipinjam ?? 0 }}</span>
                        <span class="text-[11px] text-slate-400 font-medium">barang</span>
                    </div>
                </div>

                <!-- Card 2: Tenggat Terdekat -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500 mb-3">
                        <i data-lucide="alarm-clock" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold text-slate-500">Tenggat Terdekat</span>
                    <div class="mt-2 flex items-baseline space-x-1">
                        <span class="text-2xl font-bold text-slate-800">{{ ($barangDipinjam ?? 0) > 0 ? '1' : '0' }}</span>
                        <span class="text-[11px] text-slate-400 font-medium">hari lagi</span>
                    </div>
                </div>

                <!-- Card 3: Total Peminjaman -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 mb-3">
                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold text-slate-500">Total Peminjaman</span>
                    <div class="mt-2 flex items-baseline space-x-1">
                        <span class="text-2xl font-bold text-slate-800">{{ $totalPeminjaman ?? 0 }}</span>
                        <span class="text-[11px] text-slate-400 font-medium">kali</span>
                    </div>
                </div>

                <!-- Card 4: Pemberitahuan -->
                <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col justify-between">
                    <div class="w-9 h-9 rounded-xl bg-violet-50 flex items-center justify-center text-violet-500 mb-3">
                        <i data-lucide="bell" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-semibold text-slate-500">Pemberitahuan Terbaru</span>
                    <div class="mt-2 flex items-baseline space-x-1">
                        <span class="text-2xl font-bold text-slate-800">{{ count($notifikasis ?? []) }}</span>
                        <span class="text-[11px] text-slate-400 font-medium">notifikasi</span>
                    </div>
                </div>
            </div>

            <!-- Bagian Bawah (Pemberitahuan & Ilustrasi Kuotasi) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
                <!-- Tabel / List Pemberitahuan Dinamis -->
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <h3 class="font-bold text-sm text-slate-800">Pemberitahuan Terbaru</h3>
                        <a href="{{ route('peminjaman.saya') }}" class="text-xs text-blue-500 hover:text-blue-600 font-medium">Lihat Semua</a>
                    </div>

                    <div class="divide-y divide-slate-50 mt-2">
                        @forelse($notifikasis ?? [] as $notif)
                            <div class="py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs">
                                <div class="flex items-center space-x-3">
                                    @if($notif->status === 'Dipinjam')
                                        <span class="w-6 h-6 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0">
                                            <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                        </span>
                                        <p class="text-slate-700 font-medium leading-relaxed">
                                            Peminjaman <span class="font-bold text-slate-800">{{ $notif->nama_barang }}</span> disetujui & aktif.
                                        </p>
                                    @elseif($notif->status === 'Selesai')
                                        <span class="w-6 h-6 rounded-full bg-blue-500 text-white flex items-center justify-center shrink-0">
                                            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                                        </span>
                                        <p class="text-slate-700 font-medium leading-relaxed">
                                            Barang <span class="font-bold text-slate-800">{{ $notif->nama_barang }}</span> telah selesai dikembalikan.
                                        </p>
                                    @elseif($notif->status === 'Ditolak')
                                        <span class="w-6 h-6 rounded-full bg-rose-500 text-white flex items-center justify-center shrink-0">
                                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                                        </span>
                                        <p class="text-slate-700 font-medium leading-relaxed">
                                            Pengajuan <span class="font-bold text-slate-800">{{ $notif->nama_barang }}</span> ditolak oleh admin.
                                        </p>
                                    @else
                                        <span class="w-6 h-6 rounded-full bg-amber-500 text-white flex items-center justify-center shrink-0">
                                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                        </span>
                                        <p class="text-slate-700 font-medium leading-relaxed">
                                            Pengajuan <span class="font-bold text-slate-800">{{ $notif->nama_barang }}</span> sedang menunggu persetujuan admin.
                                        </p>
                                    @endif
                                </div>
                                <span class="text-slate-400 shrink-0 sm:ml-4 font-normal text-[11px]">{{ $notif->updated_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="text-center py-8 text-xs text-slate-400">
                                Belum ada pemberitahuan aktivitas peminjaman.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kutipan Slogan & Ilustrasi Buku -->
                <div class="flex flex-col items-center justify-center p-6 text-center pt-8">
                    <p class="font-serif italic text-slate-700 text-lg leading-tight mb-4">
                        Pinjam barang,<br>
                        <span class="font-semibold text-slate-800">Raih prestasi</span> 
                        <span class="not-italic text-rose-400 text-sm">♡</span>
                    </p>
                    <div class="w-28 opacity-90 hover:scale-105 transition">
                        <img src="https://cdn-icons-png.flaticon.com/512/3389/3389081.png" alt="Books" class="w-full">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- MODAL LOGOUT POP-UP -->
    <div x-show="showLogoutModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/30 backdrop-blur-xs p-4"
         style="display: none;">

        <div @click.away="showLogoutModal = false" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-3xl p-8 max-w-sm w-full text-center shadow-xl border border-blue-50/50 flex flex-col items-center">
            
            <div class="relative w-32 h-32 flex items-center justify-center mb-4">
                <div class="absolute w-24 h-24 bg-blue-50/80 rounded-full"></div>
                <span class="absolute top-2 right-4 text-pink-300 text-xs">❤️</span>
                <span class="absolute top-8 left-3 text-amber-200 text-sm">✨</span>
                <span class="absolute bottom-5 left-2 text-pink-300 text-xs">🌸</span>
                <span class="absolute top-10 right-1 text-amber-300 text-xs">✨</span>
                <span class="absolute bottom-6 right-5 text-blue-300 text-[10px]">✦</span>

                <div class="relative z-10 w-16 h-20 bg-[#DCE7FD] border-2 border-[#3B82F6] rounded-xl flex items-center justify-end pr-1 shadow-xs">
                    <div class="absolute right-3 top-0 bottom-0 w-[2px] bg-[#3B82F6]"></div>
                    <div class="bg-white border-2 border-[#3B82F6] rounded-md p-1 -mr-3 flex items-center justify-center shadow-xs">
                        <i data-lucide="arrow-right" class="w-4 h-4 text-[#3B82F6] stroke-[2.5]"></i>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-bold text-[#1E293B] mb-1">
                Anda yakin ingin logout?
            </h3>
            <p class="text-xs text-slate-400 mb-6">
                Kamu akan keluar dari akun ini.
            </p>

            <div class="grid grid-cols-2 gap-3 w-full">
                <button @click="showLogoutModal = false" type="button" class="py-2.5 px-4 rounded-xl border border-blue-200 text-[#1E293B] font-semibold text-xs hover:bg-slate-50 transition">
                    Batal
                </button>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-gradient-to-r from-[#F43F5E] to-[#FB7185] hover:opacity-90 text-white font-semibold text-xs flex items-center justify-center space-x-1.5 shadow-sm transition">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>