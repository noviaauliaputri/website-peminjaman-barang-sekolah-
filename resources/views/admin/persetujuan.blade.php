
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARPRAS ADMIN - Persetujuan Peminjaman</title>
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
            <!-- Header Brand Logo -->
            <div class="flex items-center space-x-3 mb-8 px-2">
                <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-sm text-white tracking-wider">SARPRAS ADMIN</h2>
                    <p class="text-[10px] text-slate-400 font-medium">Sistem Kendali Sekolah</p>
                </div>
            </div>

            <!-- Menu Navigasi Admin -->
            <nav class="space-y-1.5 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.barang') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Kelola Barang</span>
                </a>

                <!-- Persetujuan Aktif -->
                <a href="{{ route('admin.persetujuan') }}" class="flex items-center justify-between px-4 py-3 rounded-xl bg-[#6366F1] text-white shadow-md shadow-indigo-500/20 transition">
                    <div class="flex items-center space-x-3">
                        <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                        <span>Persetujuan</span>
                    </div>
                    <span class="px-2 py-0.5 text-[10px] bg-amber-500/20 text-amber-300 rounded-full font-bold">
                        {{ $pengajuans->count() }}
                    </span>
                </a>

                <a href="{{ route('admin.riwayat') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                    <span>Riwayat & Kembali</span>
                </a>

                <a href="{{ route('admin.siswa') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Akun Siswa</span>
                </a>
            </nav>
        </div>

        <!-- Profil Admin & Logout -->
        <div class="pt-4 border-t border-slate-800 space-y-3">
            <div class="flex items-center justify-between px-2">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center font-bold text-indigo-400 text-xs">
                        AD
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white leading-tight">Pak Budi Sarpras</h4>
                        <p class="text-[10px] text-slate-400">admin@sekolah.sch.id</p>
                    </div>
                </div>

                <button @click="showLogoutModal = true" type="button" class="text-slate-400 hover:text-rose-400 p-1.5 rounded-lg hover:bg-slate-800 transition" title="Logout">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </div>

            <a href="{{ route('dashboard') }}" class="block text-center text-[10px] text-slate-500 hover:text-indigo-400 transition py-1">
                ← Beralih ke Tampilan Siswa
            </a>
        </div>
    </aside>

    <!-- OVERLAY SIDEBAR MOBILE -->
    <div
        x-show="mobileMenu"
        @click="mobileMenu = false"
        class="fixed inset-0 bg-slate-900/50 z-30 lg:hidden"
        style="display: none;">
    </div>

    <!-- AREA UTAMA PERSETUJUAN -->
    <main class="flex-1 flex flex-col min-w-0">

        <!-- Top Navbar -->
        <header class="min-h-16 bg-white px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between border-b border-slate-100 sticky top-0 z-20">

            <div class="flex items-center gap-3">
                <!-- Tombol Menu Mobile -->
                <button
                    @click="mobileMenu = !mobileMenu"
                    type="button"
                    class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <h1 class="text-sm sm:text-base font-bold text-slate-800">
                    Persetujuan Peminjaman
                </h1>
            </div>

            <div class="flex items-center space-x-3 sm:space-x-4">
                <button type="button" class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 transition relative">
                    <i data-lucide="bell" class="w-4 h-4"></i>

                    @if($pengajuans->count() > 0)
                        <span class="w-2 h-2 rounded-full bg-rose-500 absolute top-2 right-2 ring-2 ring-white"></span>
                    @endif
                </button>

                <div class="w-8 h-8 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center overflow-hidden">
                    <img src="https://api.dicebear.com/7.x/bottts/svg?seed=AdminSarpras" alt="avatar" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- KONTEN DAFTAR PENGAJUAN -->
        <div class="w-full p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- Alert Notifikasi Berhasil -->
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl flex items-center justify-between">
                    <span>{{ session('success') }}</span>
                    <span class="font-bold">✓</span>
                </div>
            @endif

            <!-- HEADER TITLE -->
            <div>
                <h2 class="text-xl font-bold text-slate-800">Persetujuan Peminjaman</h2>
                <p class="text-xs text-slate-400 mt-1">
                    Tinjau daftar siswa yang mengajukan peminjaman alat sarpras.
                </p>
            </div>

            <!-- LIST KARTU PENGAJUAN -->
            <div class="space-y-4">
                @forelse($pengajuans as $item)
                    @php
                        // Ambil inisial nama siswa
                        $words = explode(' ', trim($item->nama_peminjam));
                        $initial = count($words) >= 2
                            ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                            : strtoupper(substr($item->nama_peminjam, 0, 2));
                    @endphp

                    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4 transition hover:shadow-md">

                        <!-- Kolom Kiri: Inisial & Info Siswa -->
                        <div class="flex items-start space-x-3 sm:space-x-4 min-w-0">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-sm shrink-0">
                                {{ $initial }}
                            </div>

                            <div class="space-y-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-sm font-bold text-slate-800">
                                        {{ $item->nama_peminjam }}
                                    </h3>
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded-md text-[10px] font-semibold">
                                        Siswa
                                    </span>
                                </div>

                                <p class="text-xs text-slate-500">
                                    Meminta pinjam:
                                    <strong class="text-slate-700 font-semibold">
                                        {{ $item->nama_barang }} (1 Unit)
                                    </strong>
                                </p>

                                <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-1.5 text-[11px] text-slate-400 pt-0.5">
                                    <span class="flex items-center">
                                        <i data-lucide="calendar" class="w-3.5 h-3.5 mr-1 text-slate-400 shrink-0"></i>
                                        Tanggal Pinjam:
                                        <span class="font-medium text-slate-500 ml-1">
                                            {{ date('d M Y', strtotime($item->tanggal_pinjam)) }}
                                        </span>
                                    </span>

                                    <span class="hidden sm:inline mx-1.5 text-slate-300">—</span>

                                    <span>
                                        Alasan:
                                        <span class="text-slate-600 italic">
                                            {{ $item->keperluan }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Tombol Tolak & Setujui -->
                        <div class="flex items-center justify-end gap-2 shrink-0 self-end md:self-center w-full md:w-auto">

                            <!-- Form Tolak -->
                            <form method="POST" action="{{ route('admin.persetujuan.tolak', $item->id) }}" onsubmit="return confirm('Yakin ingin menolak permohonan peminjaman ini?')">
                                @csrf
                                <button type="submit" class="px-3 sm:px-4 py-2.5 text-rose-500 hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-100 font-semibold text-xs rounded-xl transition flex items-center space-x-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <span>Tolak</span>
                                </button>
                            </form>

                            <!-- Form Setujui -->
                            <form method="POST" action="{{ route('admin.persetujuan.setujui', $item->id) }}" onsubmit="return confirm('Yakin ingin menyetujui peminjaman ini?')">
                                @csrf
                                <button type="submit" class="px-3 sm:px-5 py-2.5 bg-[#4F46E5] hover:bg-indigo-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-600/20 transition flex items-center space-x-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Setujui (ACC)</span>
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <!-- Tampilan Jika Belum Ada Pengajuan -->
                    <div class="text-center py-16 px-4 bg-white rounded-2xl border border-slate-100">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl mx-auto flex items-center justify-center mb-3">
                            <i data-lucide="check-circle" class="w-6 h-6"></i>
                        </div>

                        <h4 class="text-sm font-bold text-slate-700">
                            Semua Pengajuan Sudah Ditinjau
                        </h4>

                        <p class="text-xs text-slate-400 mt-1">
                            Tidak ada permohonan peminjaman yang tertunda saat ini.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    <!-- MODAL POPUP LOGOUT -->
    <div
        x-show="showLogoutModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4 overflow-y-auto"
        style="display: none;">

        <div
            @click.away="showLogoutModal = false"
            class="bg-white rounded-3xl p-6 sm:p-8 max-w-sm w-full text-center shadow-xl border border-slate-100 flex flex-col items-center my-auto">

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
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-semibold text-xs transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
