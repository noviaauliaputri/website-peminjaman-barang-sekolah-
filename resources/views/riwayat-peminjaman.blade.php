
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - SMKN 1 Ciomas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="bg-[#F4F7FC] text-slate-700 font-sans antialiased min-h-screen flex"
    x-data="{ mobileMenu: false }">

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
                    <h2 class="font-bold text-sm text-slate-800 leading-tight">
                        Peminjaman Barang Sekolah
                    </h2>
                    <p class="text-[11px] text-slate-400">SMKN 1 Ciomas</p>
                </div>
            </div>

            <!-- Menu Navigasi -->
            <nav class="space-y-1.5">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('barang') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Barang</span>
                </a>

                <a href="{{ route('peminjaman.saya') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    <span>Peminjaman Saya</span>
                </a>

                <a href="{{ route('riwayat.peminjaman') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-medium text-sm transition">
                    <i data-lucide="history" class="w-4 h-4"></i>
                    <span>Riwayat Peminjaman</span>
                </a>

                <a href="{{ route('kontak.sarpras') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="headset" class="w-4 h-4"></i>
                    <span>Kontak Sarpras</span>
                </a>

                <a href="{{ route('profil') }}"
                   class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>Profil</span>
                </a>
            </nav>
        </div>

        <!-- Logout -->
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center space-x-3 px-4 py-2.5 w-full text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl font-medium text-sm transition">
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

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col min-w-0">

        <!-- Navbar -->
        <header class="min-h-16 bg-white/60 backdrop-blur-md px-4 sm:px-6 lg:px-8 flex items-center justify-between border-b border-slate-100">

            <button
                @click="mobileMenu = !mobileMenu"
                class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            <h1 class="text-sm font-bold text-slate-800 hidden sm:block">
                Riwayat Peminjaman
            </h1>

            <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                <div class="flex items-center space-x-2 text-sm text-slate-600">
                    <div class="w-7 h-7 rounded-full bg-blue-100 flex items-center justify-center overflow-hidden border border-blue-200">
                        <img src="https://api.dicebear.com/7.x/bottts/svg?seed={{ urlencode(Auth::user()->name) }}"
                             alt="Avatar"
                             class="w-full h-full object-cover">
                    </div>
                    <span class="font-medium text-xs hidden sm:inline">
                        {{ Auth::user()->email }}
                    </span>
                </div>

                @include('tema')
            </div>
        </header>

        <!-- Area Riwayat -->
        <div class="w-full max-w-7xl p-4 sm:p-6 lg:p-8 space-y-6">

            <div>
                <h2 class="text-xl font-bold text-slate-800">
                    Riwayat Peminjaman
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Semua riwayat peminjaman barang Anda.
                </p>
            </div>

            <!-- Notifikasi -->
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Riwayat -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden p-4 sm:p-6">

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px] text-left text-xs">

                        <thead>
                            <tr class="text-slate-400 font-semibold border-b border-slate-100">
                                <th class="pb-3 pr-4">ID</th>
                                <th class="pb-3 pr-4">Barang</th>
                                <th class="pb-3 pr-4">Tanggal Pinjam</th>
                                <th class="pb-3 pr-4">Jam Mulai</th>
                                <th class="pb-3 pr-4">Jam Selesai</th>
                                <th class="pb-3 pr-4">Tanggal Kembali</th>
                                <th class="pb-3 text-right pr-2">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-50 text-slate-600 font-medium">
                            @forelse($riwayats as $item)
                                <tr class="hover:bg-slate-50/70 transition">

                                    <td class="py-4 pr-4 text-slate-500">
                                        {{ $item->id }}
                                    </td>

                                    <td class="py-4 pr-4 font-semibold text-slate-800">
                                        {{ $item->nama_barang }}
                                    </td>

                                    <td class="py-4 pr-4 text-slate-500 whitespace-nowrap">
                                        {{ $item->tanggal_pinjam }}
                                    </td>

                                    <td class="py-4 pr-4 text-slate-500 whitespace-nowrap">
                                        {{ $item->jam_mulai ? substr($item->jam_mulai, 0, 5) : '-' }}
                                    </td>

                                    <td class="py-4 pr-4 text-slate-500 whitespace-nowrap">
                                        {{ $item->jam_selesai ? substr($item->jam_selesai, 0, 5) : '-' }}
                                    </td>

                                    <td class="py-4 pr-4 text-slate-500 whitespace-nowrap">
                                        {{ $item->tanggal_kembali ?? '-' }}
                                    </td>

                                    <td class="py-4 text-right pr-2">
                                        <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full font-semibold text-[11px]">
                                            {{ $item->status }}
                                        </span>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400">
                                        <i data-lucide="clipboard-list" class="w-8 h-8 mx-auto mb-3"></i>
                                        <p>Belum ada riwayat peminjaman.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div>
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center space-x-2 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold rounded-xl text-xs transition border border-blue-100">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>

        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
