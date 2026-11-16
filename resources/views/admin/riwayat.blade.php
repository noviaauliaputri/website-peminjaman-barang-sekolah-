
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARPRAS ADMIN - Riwayat & Pengembalian</title>
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

                <a href="{{ route('admin.persetujuan') }}" class="flex items-center justify-between px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <div class="flex items-center space-x-3">
                        <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                        <span>Persetujuan</span>
                    </div>
                </a>

                <!-- Riwayat & Kembali Aktif -->
                <a href="{{ route('admin.riwayat') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-[#6366F1] text-white shadow-md shadow-indigo-500/20 transition">
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
        class="fixed inset-0 bg-slate-900/50 z-30 lg:hidden no-print"
        style="display: none;">
    </div>

    <!-- AREA UTAMA -->
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
                    Riwayat & Pengembalian
                </h1>
            </div>

            <div class="flex items-center space-x-3 sm:space-x-4">
                <button type="button" class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 transition relative">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                </button>

                <div class="w-8 h-8 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center overflow-hidden">
                    <img src="https://api.dicebear.com/7.x/bottts/svg?seed=AdminSarpras" alt="avatar" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- KONTEN -->
        <div class="w-full p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- HEADER ACTIONS & TITLE -->
            <div class="flex flex-col gap-4">

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">
                            Riwayat & Pengembalian Barang
                        </h2>
                        <p class="text-xs text-slate-400 mt-1">
                            Filter dan cetak laporan peminjaman berdasarkan tanggal atau bulan.
                        </p>
                    </div>

                    <button onclick="window.print()" type="button"
                        class="no-print inline-flex items-center justify-center space-x-2 px-4 py-2.5 bg-[#0F172A] hover:bg-slate-800 text-white font-semibold text-xs rounded-xl shadow-md transition w-full sm:w-auto">
                        <i data-lucide="printer" class="w-4 h-4"></i>
                        <span>Cetak / Export Laporan</span>
                    </button>
                </div>

                @php
                    $today = \Carbon\Carbon::now();
                    $calcYear = $today->year;
                    $calcMonth = $today->month;
                    $firstDay = \Carbon\Carbon::create($calcYear, $calcMonth, 1)->startOfDay();
                    $curr = $firstDay->copy()->subDays($firstDay->dayOfWeek);
                    $defaultWeekNum = 1;
                    $defaultWeekStart = $today->toDateString();
                    $defaultWeekEnd = $today->toDateString();
                    $defaultWeekLabel = 'Minggu 1 (' . $today->translatedFormat('M Y') . ')';

                    for ($w = 1; $w <= 6; $w++) {
                        $weekDays = [];
                        for ($d = 0; $d < 7; $d++) {
                            $weekDays[] = $curr->copy();
                            $curr->addDay();
                        }

                        $mDays = array_values(array_filter($weekDays, fn($d) => $d->month === $calcMonth));

                        if (count($mDays) > 0) {
                            $wStart = $mDays[0];
                            $wEnd = $mDays[count($mDays) - 1];

                            if ($today->betweenIncluded($wStart, $wEnd)) {
                                $defaultWeekNum = $w;
                                $defaultWeekStart = $wStart->toDateString();
                                $defaultWeekEnd = $wEnd->toDateString();
                                $defaultWeekLabel = 'Minggu ' . $w . ' (' . $today->translatedFormat('M Y') . ')';
                                break;
                            }
                        }
                    }

                    $dariMingguLabelVal = request('dari_minggu_label', $defaultWeekLabel);
                    $dariMingguStartVal = request('dari_minggu_start', $defaultWeekStart);
                    $dariMingguEndVal = request('dari_minggu_end', $defaultWeekEnd);

                    $sampaiMingguLabelVal = request('sampai_minggu_label', $dariMingguLabelVal);
                    $sampaiMingguStartVal = request('sampai_minggu_start', $dariMingguStartVal);
                    $sampaiMingguEndVal = request('sampai_minggu_end', $dariMingguEndVal);
                @endphp

                <!-- FILTER LAPORAN -->
                <div class="no-print bg-white rounded-2xl border border-slate-100 shadow-sm p-4 sm:p-5 space-y-4">

                    <form method="GET" action="{{ route('admin.riwayat') }}"
                        class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-end gap-3.5">

                        <!-- Pilihan Jenis Filter -->
                        <div class="w-full sm:w-44">
                            <label for="jenis" class="block text-xs font-bold text-slate-600 mb-1.5">
                                Jenis Filter
                            </label>

                            <select name="jenis" id="jenis"
                                class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-xs font-semibold text-slate-700 bg-slate-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                <option value="semua" {{ request('jenis', 'semua') === 'semua' ? 'selected' : '' }}>
                                    Semua Data
                                </option>
                                <option value="tanggal" {{ request('jenis') === 'tanggal' ? 'selected' : '' }}>
                                    Per Tanggal
                                </option>
                                <option value="minggu" {{ request('jenis') === 'minggu' ? 'selected' : '' }}>
                                    Per Minggu
                                </option>
                                <option value="bulan" {{ request('jenis') === 'bulan' ? 'selected' : '' }}>
                                    Per Bulan
                                </option>
                                <option value="tahun" {{ request('jenis') === 'tahun' ? 'selected' : '' }}>
                                    Per Tahun
                                </option>
                            </select>
                        </div>

                        <!-- Filter Per Tanggal -->
                        <div id="filterTanggal" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-2.5 w-full sm:w-auto">
                            <div class="w-full sm:w-40">
                                <label for="dari_tanggal" class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Dari Tanggal
                                </label>
                                <input type="date" name="dari_tanggal" id="dari_tanggal"
                                    value="{{ request('dari_tanggal', request('tanggal', date('Y-m-d'))) }}"
                                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>

                            <div class="w-full sm:w-40">
                                <label for="sampai_tanggal" class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Sampai Tanggal
                                </label>
                                <input type="date" name="sampai_tanggal" id="sampai_tanggal"
                                    value="{{ request('sampai_tanggal', date('Y-m-d')) }}"
                                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>
                        </div>

                        <!-- Filter Per Minggu -->
                        <div id="filterMinggu" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-2.5 w-full sm:w-auto">

                            <!-- Dari Minggu -->
                            <div class="w-full sm:w-44 relative"
                                x-data="weekCalendarPicker('dari_minggu', '{{ $dariMingguLabelVal }}', '{{ $dariMingguStartVal }}', '{{ $dariMingguEndVal }}')">

                                <label class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Dari Minggu
                                </label>

                                <input type="hidden" name="dari_minggu_label" :value="selectedLabel">
                                <input type="hidden" name="dari_minggu_start" :value="startDate">
                                <input type="hidden" name="dari_minggu_end" :value="endDate">

                                <button type="button" @click="open = !open"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 flex items-center justify-between hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-xs text-left cursor-pointer">
                                    <span class="truncate" x-text="selectedLabel || 'Pilih Minggu'"></span>
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 shrink-0 ml-1"></i>
                                </button>

                                <!-- Pop-up Kalender -->
                                <div x-show="open" @click.away="open = false" x-cloak
                                    class="absolute top-full left-0 mt-2 z-50 bg-white rounded-2xl shadow-2xl border border-slate-200 p-3.5 w-80 max-w-[calc(100vw-2rem)] text-xs transition"
                                    style="display: none;">

                                    <div class="flex items-center justify-between mb-2.5 pb-2 border-b border-slate-100">
                                        <button type="button" @click="prevMonth()" class="w-7 h-7 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-600 transition cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>

                                        <div class="flex items-center space-x-1 font-bold text-slate-800 text-xs">
                                            <span x-text="monthNames[currentMonth]"></span>
                                            <span x-text="currentYear"></span>
                                        </div>

                                        <button type="button" @click="nextMonth()" class="w-7 h-7 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-600 transition cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-8 gap-1 text-[10px] font-bold text-center mb-1 pb-1 border-b border-slate-100">
                                        <div class="text-indigo-600 font-extrabold uppercase">Minggu</div>
                                        <div class="text-rose-500 font-bold">Min</div>
                                        <div class="text-slate-500">Sen</div>
                                        <div class="text-slate-500">Sel</div>
                                        <div class="text-slate-500">Rab</div>
                                        <div class="text-slate-500">Kam</div>
                                        <div class="text-slate-500">Jum</div>
                                        <div class="text-slate-500">Sab</div>
                                    </div>

                                    <div class="space-y-1">
                                        <template x-for="week in weeks" :key="week.weekNumber + '-' + currentMonth + '-' + currentYear">
                                            <div @click="selectWeek(week)"
                                                :class="isSelected(week) ? 'bg-indigo-600 text-white shadow-xs' : 'hover:bg-indigo-50/80 text-slate-700'"
                                                class="grid grid-cols-8 gap-1 items-center py-1.5 px-1 rounded-xl cursor-pointer transition text-center text-[11px] group">

                                                <div :class="isSelected(week) ? 'bg-white/20 text-white font-black' : 'bg-indigo-100/70 text-indigo-700 font-bold group-hover:bg-indigo-200/80'"
                                                    class="py-1 rounded-lg text-[10px] tracking-tight">
                                                    <span x-text="'M ' + week.weekNumber"></span>
                                                </div>

                                                <template x-for="day in week.days" :key="day.fullDate">
                                                    <div :class="{
                                                        'text-white font-bold': isSelected(week),
                                                        'text-slate-700 font-medium': !isSelected(week) && day.isCurrentMonth && !day.isSunday,
                                                        'text-rose-500 font-bold': !isSelected(week) && day.isCurrentMonth && day.isSunday,
                                                        'text-slate-300': !isSelected(week) && !day.isCurrentMonth
                                                    }" class="py-0.5">
                                                        <span x-text="day.date"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>

                                    <div class="mt-2 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-400">
                                        <span>Klik baris untuk memilih minggu</span>
                                        <button type="button" @click="goToCurrentMonth()" class="text-indigo-600 hover:underline font-semibold cursor-pointer">
                                            Bulan Ini
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Sampai Minggu -->
                            <div class="w-full sm:w-44 relative"
                                x-data="weekCalendarPicker('sampai_minggu', '{{ $sampaiMingguLabelVal }}', '{{ $sampaiMingguStartVal }}', '{{ $sampaiMingguEndVal }}')">

                                <label class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Sampai Minggu
                                </label>

                                <input type="hidden" name="sampai_minggu_label" :value="selectedLabel">
                                <input type="hidden" name="sampai_minggu_start" :value="startDate">
                                <input type="hidden" name="sampai_minggu_end" :value="endDate">

                                <button type="button" @click="open = !open"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 flex items-center justify-between hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-xs text-left cursor-pointer">
                                    <span class="truncate" x-text="selectedLabel || 'Pilih Minggu'"></span>
                                    <i data-lucide="calendar" class="w-4 h-4 text-slate-400 shrink-0 ml-1"></i>
                                </button>

                                <!-- Pop-up Kalender -->
                                <div x-show="open" @click.away="open = false" x-cloak
                                    class="absolute top-full left-0 sm:left-auto sm:right-0 mt-2 z-50 bg-white rounded-2xl shadow-2xl border border-slate-200 p-3.5 w-80 max-w-[calc(100vw-2rem)] text-xs transition"
                                    style="display: none;">

                                    <div class="flex items-center justify-between mb-2.5 pb-2 border-b border-slate-100">
                                        <button type="button" @click="prevMonth()" class="w-7 h-7 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-600 transition cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                            </svg>
                                        </button>

                                        <div class="flex items-center space-x-1 font-bold text-slate-800 text-xs">
                                            <span x-text="monthNames[currentMonth]"></span>
                                            <span x-text="currentYear"></span>
                                        </div>

                                        <button type="button" @click="nextMonth()" class="w-7 h-7 rounded-lg hover:bg-slate-100 flex items-center justify-center text-slate-600 transition cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="grid grid-cols-8 gap-1 text-[10px] font-bold text-center mb-1 pb-1 border-b border-slate-100">
                                        <div class="text-indigo-600 font-extrabold uppercase">Minggu</div>
                                        <div class="text-rose-500 font-bold">Min</div>
                                        <div class="text-slate-500">Sen</div>
                                        <div class="text-slate-500">Sel</div>
                                        <div class="text-slate-500">Rab</div>
                                        <div class="text-slate-500">Kam</div>
                                        <div class="text-slate-500">Jum</div>
                                        <div class="text-slate-500">Sab</div>
                                    </div>

                                    <div class="space-y-1">
                                        <template x-for="week in weeks" :key="week.weekNumber + '-' + currentMonth + '-' + currentYear">
                                            <div @click="selectWeek(week)"
                                                :class="isSelected(week) ? 'bg-indigo-600 text-white shadow-xs' : 'hover:bg-indigo-50/80 text-slate-700'"
                                                class="grid grid-cols-8 gap-1 items-center py-1.5 px-1 rounded-xl cursor-pointer transition text-center text-[11px] group">

                                                <div :class="isSelected(week) ? 'bg-white/20 text-white font-black' : 'bg-indigo-100/70 text-indigo-700 font-bold group-hover:bg-indigo-200/80'"
                                                    class="py-1 rounded-lg text-[10px] tracking-tight">
                                                    <span x-text="'M ' + week.weekNumber"></span>
                                                </div>

                                                <template x-for="day in week.days" :key="day.fullDate">
                                                    <div :class="{
                                                        'text-white font-bold': isSelected(week),
                                                        'text-slate-700 font-medium': !isSelected(week) && day.isCurrentMonth && !day.isSunday,
                                                        'text-rose-500 font-bold': !isSelected(week) && day.isCurrentMonth && day.isSunday,
                                                        'text-slate-300': !isSelected(week) && !day.isCurrentMonth
                                                    }" class="py-0.5">
                                                        <span x-text="day.date"></span>
                                                    </div>
                                                </template>
                                            </div>
                                        </template>
                                    </div>

                                    <div class="mt-2 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px] text-slate-400">
                                        <span>Klik baris untuk memilih minggu</span>
                                        <button type="button" @click="goToCurrentMonth()" class="text-indigo-600 hover:underline font-semibold cursor-pointer">
                                            Bulan Ini
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Filter Per Bulan -->
                        <div id="filterBulan" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-2.5 w-full sm:w-auto">
                            <div class="w-full sm:w-40">
                                <label for="dari_bulan" class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Dari Bulan
                                </label>
                                <input type="month" name="dari_bulan" id="dari_bulan"
                                    value="{{ request('dari_bulan', request('bulan', date('Y-m'))) }}"
                                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>

                            <div class="w-full sm:w-40">
                                <label for="sampai_bulan" class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Sampai Bulan
                                </label>
                                <input type="month" name="sampai_bulan" id="sampai_bulan"
                                    value="{{ request('sampai_bulan', date('Y-m')) }}"
                                    class="w-full rounded-xl border border-slate-200 px-3 py-2 text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            </div>
                        </div>

                        <!-- Filter Per Tahun -->
                        <div id="filterTahun" class="flex flex-col sm:flex-row items-stretch sm:items-end gap-2.5 w-full sm:w-auto">
                            @php
                                $currentYear = (int)date('Y');
                                $dariTahunSelected = (int)request('dari_tahun', $currentYear);
                                $sampaiTahunSelected = (int)request('sampai_tahun', $currentYear);
                            @endphp

                            <div class="w-full sm:w-36">
                                <label for="dari_tahun" class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Dari Tahun
                                </label>
                                <select name="dari_tahun" id="dari_tahun"
                                    class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @for($y = $currentYear - 5; $y <= $currentYear + 2; $y++)
                                        <option value="{{ $y }}" {{ $dariTahunSelected === $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="w-full sm:w-36">
                                <label for="sampai_tahun" class="block text-xs font-bold text-slate-600 mb-1.5">
                                    Sampai Tahun
                                </label>
                                <select name="sampai_tahun" id="sampai_tahun"
                                    class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-xs font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                    @for($y = $currentYear - 5; $y <= $currentYear + 2; $y++)
                                        <option value="{{ $y }}" {{ $sampaiTahunSelected === $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto">
                            <button type="submit"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold shadow-md shadow-indigo-500/20 transition cursor-pointer">
                                <i data-lucide="filter" class="w-4 h-4"></i>
                                <span>Tampilkan Laporan</span>
                            </button>

                            <a href="{{ route('admin.riwayat') }}"
                                class="inline-flex items-center justify-center px-4 py-2.5 border border-slate-200 hover:bg-slate-50 text-slate-600 rounded-xl text-xs font-bold transition">
                                Reset
                            </a>
                        </div>
                    </form>

                    <!-- Informasi Periode Aktif -->
                    <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs text-slate-500">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-medium">Periode aktif:</span>
                            <span class="px-2.5 py-1 bg-indigo-50 text-indigo-700 font-bold rounded-lg border border-indigo-100">
                                {{ $periodeLaporan ?? 'Semua Data' }}
                            </span>
                        </div>

                        <span class="font-semibold text-slate-600">
                            {{ $riwayats->count() }} data ditemukan
                        </span>
                    </div>
                </div>

                <!-- JUDUL CETAK -->
                <div class="print-only">
                    <h2 class="text-lg font-bold">Laporan Riwayat Peminjaman Barang</h2>
                    <p class="text-sm">
                        Periode: {{ $periodeLaporan ?? 'Semua Data' }}
                    </p>
                    <p class="text-sm">
                        Dicetak pada: {{ now()->format('d-m-Y H:i') }}
                    </p>
                </div>
            </div>

            <!-- TABEL DATA RIWAYAT & PENGEMBALIAN -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                                <th class="py-4 px-6">PEMINJAM</th>
                                <th class="py-4 px-6">BARANG</th>
                                <th class="py-4 px-6">TGL PINJAM</th>
                                <th class="py-4 px-6">TGL KEMBALI</th>
                                <th class="py-4 px-6">STATUS PENGEMBALIAN</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 text-xs font-medium">
                            @forelse($riwayats as $row)
                                <tr class="hover:bg-slate-50/70 transition">

                                    <!-- Peminjam -->
                                    <td class="py-4 px-6">
                                        <h4 class="font-bold text-slate-800">
                                            {{ $row->nama_peminjam }}
                                        </h4>
                                        <p class="text-[11px] text-slate-400">Siswa</p>
                                    </td>

                                    <!-- Barang -->
                                    <td class="py-4 px-6 font-semibold text-slate-700">
                                        {{ $row->nama_barang }} (1 unit)
                                    </td>

                                    <!-- Tanggal Pinjam -->
                                    <td class="py-4 px-6 text-slate-500">
                                        {{ date('d M Y', strtotime($row->tanggal_pinjam)) }}
                                    </td>

                                    <!-- Tanggal Kembali -->
                                    <td class="py-4 px-6 text-slate-500">
                                        @if($row->status === 'Selesai')
                                            {{ isset($row->updated_at) ? (is_string($row->updated_at) ? date('d M Y', strtotime($row->updated_at)) : $row->updated_at->format('d M Y')) : ($row->tanggal_kembali ? date('d M Y', strtotime($row->tanggal_kembali)) : '-') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <!-- Status Pengembalian -->
                                    <td class="py-4 px-6">
                                        @if($row->status === 'Selesai')
                                            <span class="text-emerald-600 font-bold text-xs bg-emerald-50 px-2.5 py-1 rounded-lg">
                                                Sudah Kembali
                                            </span>
                                        @else
                                            <span class="text-amber-600 font-bold text-xs bg-amber-50 px-2.5 py-1 rounded-lg">
                                                Belum Kembali (Dipinjam)
                                            </span>
                                        @endif
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12 px-4 text-slate-400 text-xs">
                                        @if(request('jenis') && request('jenis') !== 'semua')
                                            Belum ada riwayat peminjaman barang pada periode <b>{{ $periodeLaporan }}</b>.
                                        @else
                                            Belum ada riwayat peminjaman barang saat ini.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- MODAL LOGOUT -->
    <div
        x-show="showLogoutModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4 overflow-y-auto no-print"
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

    <!-- STYLE CETAK -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        .print-only {
            display: none;
        }

        @media print {
            body {
                background: white !important;
                color: black !important;
                display: block !important;
            }

            body > aside,
            main > header,
            .no-print {
                display: none !important;
            }

            main {
                width: 100% !important;
                display: block !important;
            }

            main > div {
                padding: 0 !important;
            }

            .print-only {
                display: block !important;
                margin-bottom: 20px;
            }

            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }

            th, td {
                border: 1px solid #d1d5db !important;
                padding: 8px !important;
                color: black !important;
            }

            thead tr {
                background: #f1f5f9 !important;
            }

            tr {
                break-inside: avoid;
            }

            @page {
                size: landscape;
                margin: 12mm;
            }
        }
    </style>

    <!-- SCRIPT FILTER DAN KALENDER -->
    <script>
        const jenisFilter = document.getElementById('jenis');
        const filterTanggal = document.getElementById('filterTanggal');
        const filterMinggu = document.getElementById('filterMinggu');
        const filterBulan = document.getElementById('filterBulan');
        const filterTahun = document.getElementById('filterTahun');

        function aturFilter() {
            const val = jenisFilter.value;

            filterTanggal.style.display = val === 'tanggal' ? 'flex' : 'none';
            filterMinggu.style.display = val === 'minggu' ? 'flex' : 'none';
            filterBulan.style.display = val === 'bulan' ? 'flex' : 'none';
            filterTahun.style.display = val === 'tahun' ? 'flex' : 'none';
        }

        jenisFilter.addEventListener('change', aturFilter);
        aturFilter();

        function weekCalendarPicker(fieldName, initLabel, initStart, initEnd) {
            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            const monthShorts = [
                'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
            ];

            let startD = initStart ? new Date(initStart) : new Date();

            if (isNaN(startD.getTime())) {
                startD = new Date();
            }

            return {
                open: false,
                monthNames: monthNames,
                selectedLabel: initLabel || '',
                startDate: initStart || '',
                endDate: initEnd || '',
                currentYear: startD.getFullYear(),
                currentMonth: startD.getMonth(),

                get weeks() {
                    const year = this.currentYear;
                    const month = this.currentMonth;
                    const firstDayOfMonth = new Date(year, month, 1);
                    const lastDayOfMonth = new Date(year, month + 1, 0);
                    const startDayOfWeek = firstDayOfMonth.getDay();

                    let currentDate = new Date(year, month, 1 - startDayOfWeek);
                    const weeksList = [];
                    let weekIdx = 1;

                    while (true) {
                        const days = [];
                        let hasCurrentMonthDays = false;

                        for (let d = 0; d < 7; d++) {
                            const dayObj = new Date(currentDate);
                            const isCur = dayObj.getMonth() === month;

                            if (isCur) {
                                hasCurrentMonthDays = true;
                            }

                            const yr = dayObj.getFullYear();
                            const mo = String(dayObj.getMonth() + 1).padStart(2, '0');
                            const da = String(dayObj.getDate()).padStart(2, '0');

                            days.push({
                                date: dayObj.getDate(),
                                fullDate: `${yr}-${mo}-${da}`,
                                isCurrentMonth: isCur,
                                isSunday: d === 0
                            });

                            currentDate.setDate(currentDate.getDate() + 1);
                        }

                        if (hasCurrentMonthDays) {
                            const curDays = days.filter(d => d.isCurrentMonth);

                            weeksList.push({
                                weekNumber: weekIdx,
                                weekLabel: `Minggu ${weekIdx}`,
                                startDate: curDays[0].fullDate,
                                endDate: curDays[curDays.length - 1].fullDate,
                                days: days
                            });

                            weekIdx++;
                        }

                        if (currentDate.getMonth() !== month && currentDate > lastDayOfMonth) {
                            break;
                        }
                    }

                    return weeksList;
                },

                prevMonth() {
                    if (this.currentMonth === 0) {
                        this.currentMonth = 11;
                        this.currentYear--;
                    } else {
                        this.currentMonth--;
                    }
                },

                nextMonth() {
                    if (this.currentMonth === 11) {
                        this.currentMonth = 0;
                        this.currentYear++;
                    } else {
                        this.currentMonth++;
                    }
                },

                goToCurrentMonth() {
                    const now = new Date();
                    this.currentYear = now.getFullYear();
                    this.currentMonth = now.getMonth();
                },

                selectWeek(week) {
                    const mShort = monthShorts[this.currentMonth];

                    this.selectedLabel = `${week.weekLabel} (${mShort} ${this.currentYear})`;
                    this.startDate = week.startDate;
                    this.endDate = week.endDate;
                    this.open = false;
                },

                isSelected(week) {
                    return this.startDate === week.startDate && this.endDate === week.endDate;
                }
            };
        }

        lucide.createIcons();
    </script>

</body>
</html>
