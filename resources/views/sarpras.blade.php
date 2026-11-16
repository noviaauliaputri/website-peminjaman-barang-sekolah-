
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Sarpras - SIPBARANG</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- CSS MODE GELAP DAN TERANG -->
    <style>
        body,
        aside,
        #pageHeader,
        main,
        main section,
        main section > div,
        main .bg-slate-50 {
            transition: background-color 0.25s ease, color 0.25s ease,
                        border-color 0.25s ease;
        }

        body.dark-mode {
            background-color: #0f172a !important;
            color: #e2e8f0 !important;
        }

        body.dark-mode aside,
        body.dark-mode #pageHeader,
        body.dark-mode main section.bg-white,
        body.dark-mode main section > div.bg-white,
        body.dark-mode main section > div > div.bg-white {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }

        body.dark-mode main h1,
        body.dark-mode main h2,
        body.dark-mode main h3,
        body.dark-mode main p,
        body.dark-mode aside h2,
        body.dark-mode aside p,
        body.dark-mode #pageHeader span {
            color: #e2e8f0 !important;
        }

        body.dark-mode main .bg-slate-50 {
            background-color: #334155 !important;
            border-color: #475569 !important;
        }

        body.dark-mode main .bg-blue-50 {
            background-color: #1e3a5f !important;
            border-color: #334155 !important;
        }

        body.dark-mode #themeToggle {
            background-color: #334155;
            color: #f8fafc;
            border-color: #475569;
        }

        body.dark-mode aside a:not(.bg-blue-50) {
            color: #cbd5e1;
        }

        body.dark-mode aside a:hover {
            background-color: #334155;
        }
    </style>
</head>

<body
    x-data="{ mobileMenu: false }"
    class="bg-[#F4F7FC] text-slate-700 font-sans antialiased min-h-screen flex">

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

            <!-- MENU -->
            <nav class="space-y-1.5">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 text-sm">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('barang') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 text-sm">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Barang</span>
                </a>

                <a href="{{ route('peminjaman.saya') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 text-sm">
                    <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                    <span>Peminjaman Saya</span>
                </a>

                <a href="{{ route('riwayat.peminjaman') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 text-sm">
                    <i data-lucide="history" class="w-4 h-4"></i>
                    <span>Riwayat Peminjaman</span>
                </a>

                <!-- KONTAK SARPRAS AKTIF -->
                <a href="{{ route('kontak.sarpras') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-blue-50 text-blue-600 font-semibold text-sm">
                    <i data-lucide="headset" class="w-4 h-4"></i>
                    <span>Kontak Sarpras</span>
                </a>

                <a href="{{ route('profil') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-slate-50 text-sm">
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
                    class="flex items-center gap-3 px-4 py-2.5 w-full text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl text-sm">
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
    <main class="flex-1 min-w-0">

        <!-- HEADER -->
        <header id="pageHeader"
            class="min-h-16 bg-white/80 px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between gap-3 border-b border-slate-100">

            <div class="flex items-center gap-3 min-w-0">

                <!-- TOMBOL MENU MOBILE -->
                <button
                    @click="mobileMenu = !mobileMenu"
                    type="button"
                    class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 shrink-0">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <h1 class="text-sm font-bold text-slate-800">
                    Kontak Sarpras
                </h1>
            </div>

            <div class="flex items-center gap-2 sm:gap-4 shrink-0">

                <!-- TOMBOL MODE GELAP -->
                <button id="themeToggle" type="button"
                    class="flex items-center gap-2 px-2 sm:px-3 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 transition text-xs font-semibold">
                    <i id="themeIcon" data-lucide="moon" class="w-4 h-4"></i>
                    <span id="themeText" class="hidden sm:inline">Mode Gelap</span>
                </button>

                <!-- PROFIL -->
                <div class="flex items-center gap-2 text-xs text-slate-600 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                        <i data-lucide="user-round" class="w-4 h-4 text-blue-600"></i>
                    </div>

                    <span class="hidden sm:inline truncate max-w-[150px]">
                        {{ Auth::user()->email }}
                    </span>
                </div>

            </div>
        </header>

        <!-- ISI HALAMAN -->
        <div class="w-full max-w-5xl p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- JUDUL -->
            <section>
                <h2 class="text-2xl font-bold text-slate-800">
                    Hubungi Petugas Sarpras
                </h2>

                <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                    Butuh bantuan peminjaman barang? Hubungi petugas sarana dan prasarana sekolah.
                </p>
            </section>

            <!-- KARTU PETUGAS -->
            <section class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-6 lg:p-8">

                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5">

                    <div class="w-20 h-20 rounded-2xl bg-blue-50 flex items-center justify-center shrink-0">
                        <i data-lucide="headset" class="w-10 h-10 text-blue-600"></i>
                    </div>

                    <div class="text-center sm:text-left">
                        <p class="text-xs text-blue-600 font-semibold uppercase tracking-wider">
                            Petugas Sarana dan Prasarana
                        </p>

                        <h3 class="text-xl font-bold text-slate-800 mt-2">
                            Bapak Didin
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Silakan hubungi petugas untuk menanyakan ketersediaan barang,
                            status pengajuan, atau prosedur peminjaman.
                        </p>
                    </div>

                </div>
            </section>

            <!-- INFORMASI KONTAK -->
            <section class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- WHATSAPP -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-6">

                    <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center">
                        <i data-lucide="message-circle" class="w-5 h-5 text-emerald-600"></i>
                    </div>

                    <h3 class="font-bold text-slate-800 mt-4">
                        WhatsApp
                    </h3>

                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Hubungi petugas melalui WhatsApp untuk bertanya tentang peminjaman.
                    </p>

                    <p class="text-sm font-semibold text-slate-700 mt-4">
                        0812-3456-7890
                    </p>

                    <a href="https://wa.me/6281234567890?text=Halo%20Petugas%20Sarpras%2C%20saya%20ingin%20bertanya%20tentang%20peminjaman%20barang."
                       target="_blank" rel="noopener noreferrer"
                       class="mt-4 inline-flex items-center justify-center gap-2 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl py-3 transition">

                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        Hubungi WhatsApp
                    </a>
                </div>

                <!-- TELEPON -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-6">

                    <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                        <i data-lucide="phone" class="w-5 h-5 text-blue-600"></i>
                    </div>

                    <h3 class="font-bold text-slate-800 mt-4">
                        Telepon
                    </h3>

                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Kamu juga bisa mencoba menelepon petugas untuk mendapatkan bantuan.
                    </p>

                    <p class="text-sm font-semibold text-slate-700 mt-4">
                        0812-3456-7890
                    </p>

                    <a href="tel:+6281234567890"
                       class="mt-4 inline-flex items-center justify-center gap-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl py-3 transition">

                        <i data-lucide="phone" class="w-4 h-4"></i>
                        Telepon Petugas
                    </a>
                </div>

                <!-- LOKASI -->
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-6 md:col-span-2">

                    <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                        <i data-lucide="map-pin" class="w-5 h-5 text-amber-600"></i>
                    </div>

                    <h3 class="font-bold text-slate-800 mt-4">
                        Lokasi Ruang Sarpras
                    </h3>

                    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                        Datang langsung ke ruang Sarpras apabila membutuhkan bantuan secara langsung.
                    </p>

                    <div class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <p class="text-sm font-semibold text-slate-800">
                            Ruang Sarana dan Prasarana
                        </p>

                        <p class="text-sm text-slate-500 mt-1">
                            SMKN 1 Ciomas — silakan sesuaikan dengan lokasi ruangan yang sebenarnya.
                        </p>
                    </div>
                </div>

            </section>

            <!-- CATATAN -->
            <div class="flex gap-3 p-4 rounded-xl bg-blue-50 border border-blue-100">

                <i data-lucide="info" class="w-5 h-5 text-blue-600 shrink-0"></i>

                <p class="text-xs leading-5 text-blue-800">
                    Informasi kontak di halaman ini masih berupa contoh.
                    Pastikan nama, nomor telepon, dan lokasi sudah benar sebelum digunakan.
                </p>
            </div>

            <!-- KEMBALI -->
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800">

                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Dashboard
            </a>

        </div>
    </main>

    <!-- SCRIPT MODE GELAP DAN TERANG -->
    <script>
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');
        const themeText = document.getElementById('themeText');

        function applyTheme(isDark) {
            document.body.classList.toggle('dark-mode', isDark);

            themeIcon.setAttribute('data-lucide', isDark ? 'sun' : 'moon');
            themeText.textContent = isDark ? 'Mode Terang' : 'Mode Gelap';

            localStorage.setItem('sarpras-theme', isDark ? 'dark' : 'light');

            lucide.createIcons();
        }

        themeToggle.addEventListener('click', function () {
            const isDark = !document.body.classList.contains('dark-mode');
            applyTheme(isDark);
        });

        applyTheme(localStorage.getItem('sarpras-theme') === 'dark');

        lucide.createIcons();
    </script>

</body>
</html>
