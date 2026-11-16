
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARPRAS ADMIN - Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    x-data="{ showLogoutModal: false, mobileMenu: false }"
    class="bg-[#F8FAFC] text-slate-700 font-sans antialiased min-h-screen flex">

    <!-- SIDEBAR DARK THEME -->
    <aside
        :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-[#0F172A] text-slate-300 flex flex-col justify-between p-5 min-h-screen shadow-xl overflow-y-auto transition-transform duration-300 lg:translate-x-0 lg:static lg:shrink-0">

        <div>

            <!-- HEADER BRAND LOGO -->
            <div class="flex items-center space-x-3 mb-8 px-2">
                <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                </div>

                <div>
                    <h2 class="font-extrabold text-sm text-white tracking-wider">
                        SARPRAS ADMIN
                    </h2>
                    <p class="text-[10px] text-slate-400 font-medium">
                        Sistem Kendali Sekolah
                    </p>
                </div>
            </div>

            <!-- MENU NAVIGASI ADMIN -->
            <nav class="space-y-1.5 text-xs font-semibold">

                <!-- DASHBOARD AKTIF -->
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#6366F1] text-white shadow-md shadow-indigo-500/20 transition">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.barang') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Kelola Barang</span>
                </a>

                <a href="{{ route('admin.persetujuan') }}"
                   class="flex items-center justify-between px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">

                    <div class="flex items-center gap-3">
                        <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                        <span>Persetujuan</span>
                    </div>

                    @if($pengajuanBaru > 0)
                        <span class="px-2 py-0.5 text-[10px] bg-amber-500/20 text-amber-400 rounded-full font-bold">
                            {{ $pengajuanBaru }}
                        </span>
                    @endif
                </a>

                <a href="{{ route('admin.riwayat') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                    <span>Riwayat & Kembali</span>
                </a>

                <a href="{{ route('admin.siswa') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Akun Siswa</span>
                </a>

            </nav>
        </div>

        <!-- PROFIL ADMIN DAN LOGOUT -->
        <div class="pt-4 border-t border-slate-800 space-y-3">

            <div class="flex items-center justify-between px-2 gap-2">

                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center font-bold text-indigo-400 text-xs shrink-0">
                        AD
                    </div>

                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-white leading-tight">
                            Pak Budi Sarpras
                        </h4>
                        <p class="text-[10px] text-slate-400 truncate">
                            admin@sekolah.sch.id
                        </p>
                    </div>
                </div>

                <button
                    @click="showLogoutModal = true"
                    type="button"
                    class="text-slate-400 hover:text-rose-400 p-1.5 rounded-lg hover:bg-slate-800 transition shrink-0"
                    title="Logout">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>

            </div>

            <a href="{{ route('dashboard') }}"
               class="block text-center text-[10px] text-slate-500 hover:text-indigo-400 transition py-1">
                ← Beralih ke Tampilan Siswa
            </a>

        </div>
    </aside>

    <!-- OVERLAY MENU MOBILE -->
    <div
        x-show="mobileMenu"
        @click="mobileMenu = false"
        class="fixed inset-0 bg-slate-900/50 z-30 lg:hidden"
        style="display: none;">
    </div>

    <!-- AREA UTAMA DASHBOARD ADMIN -->
    <main class="flex-1 flex flex-col min-w-0">

        <!-- TOP NAVBAR -->
        <header class="min-h-16 bg-white px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-3 border-b border-slate-100 sticky top-0 z-20">

            <div class="flex items-center gap-3 min-w-0">

                <!-- TOMBOL MENU MOBILE -->
                <button
                    @click="mobileMenu = !mobileMenu"
                    type="button"
                    class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 shrink-0">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <h1 class="text-sm sm:text-base font-bold text-slate-800 truncate">
                    Dashboard Ringkasan
                </h1>

            </div>

            <div class="flex items-center gap-2 sm:gap-4 shrink-0">

                <!-- PENCARIAN -->
                <div class="relative w-64 hidden sm:block">
                    <i data-lucide="search"
                       class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        placeholder="Cari data cepat..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-9 pr-4 py-2 text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-indigo-500 transition">
                </div>

                <!-- NOTIFIKASI -->
                <button
                    type="button"
                    class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 transition relative shrink-0">

                    <i data-lucide="bell" class="w-4 h-4"></i>

                    @if($pengajuanBaru > 0)
                        <span class="w-2 h-2 rounded-full bg-rose-500 absolute top-2 right-2 ring-2 ring-white"></span>
                    @endif
                </button>

                <!-- AVATAR -->
                <div class="w-8 h-8 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center overflow-hidden shrink-0">
                    <img
                        src="https://api.dicebear.com/7.x/bottts/svg?seed=AdminSarpras"
                        alt="avatar"
                        class="w-full h-full object-cover">
                </div>

            </div>
        </header>

        <!-- KONTEN -->
        <div class="w-full p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- 4 KARTU STATISTIK ADMIN -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                <!-- CARD 1: TOTAL BARANG -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold text-slate-400">
                            Total Barang
                        </p>

                        <h3 class="text-2xl font-black text-slate-800 mt-1">
                            {{ $totalBarang ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-emerald-500 font-semibold mt-1">
                            Stok tercatat
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                        <i data-lucide="package" class="w-6 h-6"></i>
                    </div>
                </div>

                <!-- CARD 2: DIPINJAM SISWA -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold text-slate-400">
                            Dipinjam Siswa
                        </p>

                        <h3 class="text-2xl font-black text-slate-800 mt-1">
                            {{ $dipinjamSiswa ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-indigo-500 font-semibold mt-1">
                            Aktif di lapangan
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                </div>

                <!-- CARD 3: PENGAJUAN BARU -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold text-slate-400">
                            Pengajuan Baru
                        </p>

                        <h3 class="text-2xl font-black text-amber-500 mt-1">
                            {{ $pengajuanBaru ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-amber-600 font-semibold mt-1">
                            Butuh tindakan segera
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-500 shrink-0">
                        <i data-lucide="alert-circle" class="w-6 h-6"></i>
                    </div>
                </div>

                <!-- CARD 4: TOTAL AKUN -->
                <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold text-slate-400">
                            Total Akun
                        </p>

                        <h3 class="text-2xl font-black text-slate-800 mt-1">
                            {{ $totalAkun ?? 0 }}
                        </h3>

                        <p class="text-[11px] text-slate-400 font-semibold mt-1">
                            Pengguna terdaftar
                        </p>
                    </div>

                    <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-600 shrink-0">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                </div>

            </div>

            <!-- BAGIAN GRAFIK DAN PENGAJUAN TERBARU -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

                <!-- GRAFIK MINGGUAN -->
                <div class="lg:col-span-2 bg-white rounded-3xl p-4 sm:p-6 border border-slate-100 shadow-sm min-w-0">

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">

                        <div>
                            <h3 class="font-bold text-sm text-slate-800">
                                Statistik Peminjaman Mingguan
                            </h3>

                            <p class="text-xs text-slate-400 mt-1">
                                Pantauan frekuensi peminjaman alat sekolah
                            </p>
                        </div>

                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-semibold rounded-lg w-fit">
                            Bulan Ini
                        </span>

                    </div>

                    <!-- DUMMY BAR CHART -->
                    <div class="h-56 flex items-end justify-between gap-2 sm:gap-3 px-1 sm:px-4 pt-4 border-b border-slate-100 pb-2">

                        <div class="flex-1 flex flex-col items-center gap-2 min-w-0">
                            <div class="w-full bg-slate-100 rounded-t-xl h-12"></div>
                            <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400">Sen</span>
                        </div>

                        <div class="flex-1 flex flex-col items-center gap-2 min-w-0">
                            <div class="w-full bg-indigo-600 rounded-t-xl h-44 relative flex items-center justify-center">
                                <span class="text-[10px] font-bold text-white mb-2">
                                    {{ $pengajuanBaru + $dipinjamSiswa }}
                                </span>
                            </div>
                            <span class="text-[10px] sm:text-[11px] font-semibold text-indigo-600">Sel</span>
                        </div>

                        <div class="flex-1 flex flex-col items-center gap-2 min-w-0">
                            <div class="w-full bg-slate-100 rounded-t-xl h-24"></div>
                            <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400">Rab</span>
                        </div>

                        <div class="flex-1 flex flex-col items-center gap-2 min-w-0">
                            <div class="w-full bg-slate-100 rounded-t-xl h-36"></div>
                            <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400">Kam</span>
                        </div>

                        <div class="flex-1 flex flex-col items-center gap-2 min-w-0">
                            <div class="w-full bg-slate-100 rounded-t-xl h-20"></div>
                            <span class="text-[10px] sm:text-[11px] font-semibold text-slate-400">Jum</span>
                        </div>

                    </div>
                </div>

                <!-- KARTU PENGAJUAN TERBARU -->
                <div class="bg-white p-4 sm:p-6 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-between min-w-0">

                    <div>

                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-bold text-sm text-slate-800">
                                Pengajuan Terbaru
                            </h3>

                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 animate-pulse"></span>
                        </div>

                        <div class="space-y-3">

                            @forelse($pengajuanTerbaru as $item)

                                @php
                                    $words = explode(' ', trim($item->nama_peminjam));
                                    $initial = count($words) >= 2
                                        ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                                        : strtoupper(substr($item->nama_peminjam, 0, 2));
                                @endphp

                                <div class="flex items-center justify-between gap-2 p-2.5 rounded-2xl hover:bg-slate-50 transition border border-slate-50">

                                    <div class="flex items-center gap-3 min-w-0">

                                        <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ $initial }}
                                        </div>

                                        <div class="min-w-0">
                                            <h4 class="text-xs font-bold text-slate-800 break-words">
                                                {{ $item->nama_peminjam }}
                                            </h4>

                                            <p class="text-[11px] text-slate-400 break-words">
                                                {{ $item->nama_barang }} (1 Unit)
                                            </p>
                                        </div>

                                    </div>

                                    <span class="px-2.5 py-1 bg-amber-50 text-amber-600 text-[10px] font-bold rounded-lg shrink-0">
                                        Pending
                                    </span>

                                </div>

                            @empty

                                <div class="text-center py-8 text-xs text-slate-400">
                                    Belum ada pengajuan baru yang tertunda.
                                </div>

                            @endforelse

                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 mt-4 text-center">
                        <a href="{{ route('admin.persetujuan') }}"
                           class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 transition">

                            Lihat Semua Pengajuan ({{ $pengajuanBaru }}) →
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <!-- MODAL LOGOUT -->
    <div
        x-show="showLogoutModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4"
        style="display: none;">

        <div
            @click.away="showLogoutModal = false"
            class="bg-white rounded-3xl p-5 sm:p-8 max-w-sm w-full text-center shadow-xl border border-slate-100 flex flex-col items-center">

            <h3 class="text-lg font-bold text-slate-800 mb-1">
                Keluar dari Admin?
            </h3>

            <p class="text-xs text-slate-400 mb-6">
                Sesi kerja sarpras Anda akan diakhiri.
            </p>

            <div class="grid grid-cols-2 gap-3 w-full">

                <button
                    @click="showLogoutModal = false"
                    type="button"
                    class="py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf

                    <button
                        type="submit"
                        class="w-full py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-semibold text-xs transition">
                        Logout
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- SCRIPT ICON -->
    <script>
        lucide.createIcons();
    </script>

</body>
</html>
