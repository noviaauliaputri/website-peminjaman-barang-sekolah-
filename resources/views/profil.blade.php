
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - SMKN 1 Ciomas</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    x-data="{ mobileMenu: false }"
    class="bg-[#F4F7FC] text-slate-700 font-sans antialiased min-h-screen flex">

    <!-- SIDEBAR -->
    <aside
        :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-100 flex flex-col justify-between p-6 min-h-screen overflow-y-auto transition-transform duration-300 lg:translate-x-0 lg:static lg:shrink-0">

        <div>

            <!-- HEADER LOGO -->
            <div class="flex items-center space-x-3 mb-8">
                <div class="p-2 text-blue-600">
                    <i data-lucide="book-open" class="w-7 h-7"></i>
                </div>

                <div>
                    <h2 class="font-bold text-sm text-slate-800 leading-tight">
                        Peminjaman Barang Sekolah
                    </h2>
                    <p class="text-[11px] text-slate-400">
                        SMKN 1 Ciomas
                    </p>
                </div>
            </div>

            <!-- MENU NAVIGASI -->
            <nav class="space-y-1.5">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('barang') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Barang</span>
                </a>

                <a href="{{ route('peminjaman.saya') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    <span>Peminjaman Saya</span>
                </a>

                <a href="{{ route('riwayat.peminjaman') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="history" class="w-4 h-4"></i>
                    <span>Riwayat Peminjaman</span>
                </a>

                <a href="{{ route('kontak.sarpras') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 font-medium text-sm transition">
                    <i data-lucide="headset" class="w-4 h-4"></i>
                    <span>Kontak Sarpras</span>
                </a>

                <!-- MENU AKTIF: PROFIL -->
                <a href="{{ route('profil') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-medium text-sm transition">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span>Profil</span>
                </a>

            </nav>
        </div>

        <!-- LOGOUT -->
        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="flex items-center gap-3 px-4 py-2.5 w-full text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl font-medium text-sm transition">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- OVERLAY MENU MOBILE -->
    <div
        x-show="mobileMenu"
        @click="mobileMenu = false"
        class="fixed inset-0 bg-slate-900/40 z-30 lg:hidden"
        style="display: none;">
    </div>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col min-w-0">

        <!-- TOP NAVBAR -->
        <header
            class="min-h-16 bg-white/60 backdrop-blur-md px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-3 border-b border-slate-100">

            <!-- TOMBOL MENU MOBILE -->
            <div class="flex items-center gap-3">

                <button
                    @click="mobileMenu = !mobileMenu"
                    type="button"
                    class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <span class="text-sm font-bold text-slate-800">
                    Profil Saya
                </span>

            </div>

            <!-- PROFIL USER DAN TOMBOL TEMA -->
            <div class="flex items-center gap-2 sm:gap-4 min-w-0">

                <div class="flex items-center gap-2 text-sm text-slate-600 min-w-0">

                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold overflow-hidden border border-blue-200 shrink-0">
                        <img
                            src="https://api.dicebear.com/7.x/bottts/svg?seed={{ Auth::user()->name }}"
                            alt="avatar"
                            class="w-full h-full object-cover">
                    </div>

                    <span class="font-medium text-xs hidden sm:inline truncate max-w-[150px]">
                        {{ Auth::user()->email }}
                    </span>

                    <i data-lucide="chevron-down"
                       class="w-3.5 h-3.5 text-slate-400 hidden sm:block"></i>

                </div>

                @include('tema')

            </div>
        </header>

        <!-- KONTEN PROFIL -->
        <div class="w-full max-w-4xl p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- JUDUL -->
            <div>
                <h1 class="text-xl font-bold text-slate-800">
                    Profil Saya
                </h1>

                <p class="text-xs text-slate-500 mt-1">
                    Informasi akun dan data diri pengguna.
                </p>
            </div>

            <!-- KARTU INFO AKUN -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-6 space-y-6">

                <!-- FOTO DAN IDENTITAS -->
                <div class="flex flex-col sm:flex-row items-center sm:items-center gap-4 pb-6 border-b border-slate-100">

                    <div class="w-16 h-16 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center overflow-hidden shrink-0">
                        <img
                            src="https://api.dicebear.com/7.x/bottts/svg?seed={{ Auth::user()->name }}"
                            alt="avatar"
                            class="w-12 h-12 object-cover">
                    </div>

                    <div class="text-center sm:text-left min-w-0">

                        <h2 class="text-base font-bold text-slate-800 break-words">
                            {{ Auth::user()->name }}
                        </h2>

                        <p class="text-xs text-slate-400 mt-1 break-all">
                            {{ Auth::user()->email }}
                        </p>

                        <span class="inline-block mt-2 px-2.5 py-1 bg-blue-50 text-blue-600 text-[10px] font-semibold rounded-md border border-blue-100">
                            Siswa / Peminjam
                        </span>

                    </div>
                </div>

                <!-- DETAIL GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">

                    <!-- NAMA LENGKAP -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 min-w-0">
                        <span class="text-slate-400 block mb-1">
                            Nama Lengkap
                        </span>

                        <span class="font-semibold text-slate-700 text-sm break-words">
                            {{ Auth::user()->name }}
                        </span>
                    </div>

                    <!-- EMAIL AKUN -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 min-w-0">
                        <span class="text-slate-400 block mb-1">
                            Email Akun
                        </span>

                        <span class="font-semibold text-slate-700 text-sm break-all">
                            {{ Auth::user()->email }}
                        </span>
                    </div>

                    <!-- INSTANSI SEKOLAH -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block mb-1">
                            Instansi Sekolah
                        </span>

                        <span class="font-semibold text-slate-700 text-sm">
                            SMKN 1 Ciomas
                        </span>
                    </div>

                    <!-- BERGABUNG SEJAK -->
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block mb-1">
                            Bergabung Sejak
                        </span>

                        <span class="font-semibold text-slate-700 text-sm">
                            {{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}
                        </span>
                    </div>

                </div>
            </div>

            <!-- TOMBOL KEMBALI -->
            <div>
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold rounded-xl text-xs transition border border-blue-100">

                    <i data-lucide="arrow-left" class="w-4 h-4"></i>

                    <span>Kembali ke Dashboard</span>
                </a>
            </div>

        </div>
    </main>

    <!-- SCRIPT ICON -->
    <script>
        lucide.createIcons();
    </script>

</body>
</html>
