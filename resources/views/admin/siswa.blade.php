
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARPRAS ADMIN - Kelola Akun Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{
    mobileMenu: false,
    showLogoutModal: false,
    showAddModal: false,
    showEditModal: false,
    editData: { id: '', name: '', kelas: '', email: '' },
    openEdit(id, name, kelas, email) {
        this.editData = { id: id, name: name, kelas: kelas, email: email };
        this.showEditModal = true;
    },
    searchSiswa: '{{ addslashes(request('search', '')) }}'
}" class="bg-[#F8FAFC] text-slate-700 font-sans antialiased min-h-screen flex">

    <!-- SIDEBAR -->
    <aside
        :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-[#0F172A] text-slate-300 flex flex-col justify-between p-5 min-h-screen shadow-xl overflow-y-auto transition-transform duration-300 lg:translate-x-0 lg:static lg:shrink-0">

        <div>
            <div class="flex items-center space-x-3 mb-8 px-2">
                <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="font-extrabold text-sm text-white tracking-wider">SARPRAS ADMIN</h2>
                    <p class="text-[10px] text-slate-400 font-medium">Sistem Kendali Sekolah</p>
                </div>
            </div>

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

                <a href="{{ route('admin.riwayat') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="arrow-left-right" class="w-4 h-4"></i>
                    <span>Riwayat & Kembali</span>
                </a>

                <a href="{{ route('admin.siswa') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-[#6366F1] text-white shadow-md shadow-indigo-500/20 transition">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Akun Siswa</span>
                </a>
            </nav>
        </div>

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
                <button @click="showLogoutModal = true; mobileMenu = false" type="button" class="text-slate-400 hover:text-rose-400 p-1.5 rounded-lg hover:bg-slate-800 transition" title="Logout">
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

    <!-- AREA UTAMA -->
    <main class="flex-1 flex flex-col min-w-0">

        <!-- HEADER -->
        <header class="min-h-16 bg-white px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-3 border-b border-slate-100 sticky top-0 z-20">

            <div class="flex items-center gap-3 min-w-0">
                <button @click="mobileMenu = !mobileMenu" type="button" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <h1 class="text-sm sm:text-base font-bold text-slate-800 truncate">Kelola Akun Siswa</h1>
            </div>

            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Pencarian Desktop -->
                <form method="GET" action="{{ route('admin.siswa') }}" class="relative w-64 hidden sm:block">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input name="search" value="{{ request('search') }}" x-model="searchSiswa" type="text" placeholder="Cari nama, kelas, email..." class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-9 pr-8 py-2 text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-indigo-500 transition">

                    @if(request('search'))
                        <a href="{{ route('admin.siswa') }}" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 p-0.5" title="Hapus pencarian">
                            <i data-lucide="x" class="w-3.5 h-3.5"></i>
                        </a>
                    @endif
                </form>

                <button type="button" class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 transition relative">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                </button>

                <div class="w-8 h-8 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center overflow-hidden shrink-0">
                    <img src="https://api.dicebear.com/7.x/bottts/svg?seed=AdminSarpras" alt="avatar" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- KONTEN -->
        <div class="w-full p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- PENCARIAN MOBILE -->
            <form method="GET" action="{{ route('admin.siswa') }}" class="relative sm:hidden">
                <i data-lucide="search" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input name="search" value="{{ request('search') }}" type="text" placeholder="Cari nama, kelas, email..." class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-3 text-xs text-slate-700 focus:outline-none focus:border-indigo-500">
            </form>

            @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <span class="font-bold">✓</span>
            </div>
            @endif

            @if(isset($errors) && $errors->any())
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl space-y-1">
                <div class="font-bold flex items-center space-x-1.5">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    <span>Gagal memproses data:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- JUDUL HALAMAN -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Kelola Akun Siswa</h2>
                    <p class="text-xs text-slate-400 mt-1">Daftar akun siswa yang terdaftar di sistem peminjaman.</p>
                </div>

                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                    <span class="px-3.5 py-2.5 bg-indigo-50 border border-indigo-100 text-indigo-600 rounded-xl text-xs font-semibold">
                        Total: {{ $siswas->total() }} Siswa
                    </span>

                    <button @click="showAddModal = true" type="button" class="inline-flex items-center space-x-2 px-4 py-2.5 bg-[#6366F1] hover:bg-indigo-600 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 transition cursor-pointer">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        <span>+ Tambah Akun Siswa</span>
                    </button>
                </div>
            </div>

            @if(request('search'))
            <div class="p-3.5 bg-indigo-50/70 border border-indigo-200/70 rounded-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-xs text-indigo-800">
                <div class="flex items-center space-x-2">
                    <i data-lucide="filter" class="w-4 h-4 text-indigo-500 shrink-0"></i>
                    <span>Hasil pencarian: "<b>{{ request('search') }}</b>" (<b>{{ $siswas->total() }}</b> akun ditemukan)</span>
                </div>
                <a href="{{ route('admin.siswa') }}" class="font-semibold text-indigo-600 hover:text-indigo-900 underline">
                    Reset Filter
                </a>
            </div>
            @endif

            <!-- TABEL AKUN SISWA -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[850px] text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                                <th class="py-4 px-6">NAMA SISWA</th>
                                <th class="py-4 px-6">KELAS</th>
                                <th class="py-4 px-6">EMAIL / USERNAME</th>
                                <th class="py-4 px-6 text-center">AKSI / RESET PASSWORD</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 text-xs font-medium">
                            @forelse($siswas as $siswa)
                                <tr class="hover:bg-slate-50/70 transition">

                                    <td class="py-4 px-6 font-bold text-slate-800">
                                        {{ $siswa->name }}
                                    </td>

                                    <td class="py-4 px-6 text-slate-500">
                                        <span class="px-2.5 py-1 bg-slate-100 text-slate-700 rounded-lg text-xs font-medium">
                                            {{ $siswa->kelas ?? 'XI PPLG 1' }}
                                        </span>
                                    </td>

                                    <td class="py-4 px-6 text-slate-500 font-mono text-[11px]">
                                        {{ $siswa->email }}
                                    </td>

                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center space-x-2">

                                            <!-- EDIT AKUN -->
                                            <button
                                                @click="openEdit(
                                                    {{ $siswa->id }},
                                                    {{ Illuminate\Support\Js::from($siswa->name) }},
                                                    {{ Illuminate\Support\Js::from($siswa->kelas ?? 'XI PPLG 1') }},
                                                    {{ Illuminate\Support\Js::from($siswa->email) }}
                                                )"
                                                type="button"
                                                class="inline-flex items-center space-x-1.5 px-2.5 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 rounded-lg text-xs font-semibold transition cursor-pointer"
                                                title="Edit Data Siswa">
                                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                                <span>Edit</span>
                                            </button>

                                            <!-- RESET PASSWORD -->
                                            <form method="POST" action="{{ route('admin.siswa.reset', $siswa->id) }}" onsubmit="return confirm('Yakin ingin mereset password akun ini?')">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-lg text-xs font-semibold transition" title="Reset Password">
                                                    <i data-lucide="key" class="w-3.5 h-3.5"></i>
                                                    <span>Reset</span>
                                                </button>
                                            </form>

                                            <!-- HAPUS AKUN -->
                                            <form method="POST" action="{{ route('admin.siswa.destroy', $siswa->id) }}" onsubmit="return confirm('Yakin ingin menghapus akun siswa ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center space-x-1.5 px-2.5 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs font-semibold transition" title="Hapus Akun Siswa">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                    <span>Hapus</span>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-12 text-slate-400 text-xs">
                                        @if(request('search'))
                                            Tidak ditemukan akun siswa yang cocok dengan nama, kelas, atau email "<b>{{ request('search') }}</b>".
                                        @else
                                            Belum ada siswa yang mendaftar.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                @if($siswas->total() > 0)
                <div class="px-4 sm:px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-50/40">

                    <div class="text-xs text-slate-500 text-center sm:text-left">
                        Menampilkan <span class="font-bold text-slate-700">{{ $siswas->firstItem() }}</span> -
                        <span class="font-bold text-slate-700">{{ $siswas->lastItem() }}</span> dari
                        <span class="font-bold text-slate-700">{{ $siswas->total() }}</span> akun siswa
                    </div>

                    @if($siswas->hasPages())
                    <div class="flex items-center flex-wrap justify-center gap-1.5">

                        @if ($siswas->onFirstPage())
                            <span class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-300 text-xs font-semibold cursor-not-allowed bg-white select-none">
                                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                                <span class="hidden sm:inline">Sebelumnya</span>
                            </span>
                        @else
                            <a href="{{ $siswas->previousPageUrl() }}" class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-300 hover:bg-indigo-50/50 text-xs font-semibold transition bg-white">
                                <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                                <span class="hidden sm:inline">Sebelumnya</span>
                            </a>
                        @endif

                        <div class="flex items-center space-x-1">
                            @foreach ($siswas->linkCollection()->slice(1, -1) as $link)
                                @if ($link['active'])
                                    <span class="w-8 h-8 rounded-lg bg-[#6366F1] text-white font-bold text-xs flex items-center justify-center shadow-md shadow-indigo-500/20">
                                        {{ $link['label'] }}
                                    </span>
                                @elseif ($link['url'] === null)
                                    <span class="w-8 h-8 text-slate-400 font-bold text-xs flex items-center justify-center">
                                        ...
                                    </span>
                                @else
                                    <a href="{{ $link['url'] }}" class="w-8 h-8 rounded-lg border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-300 hover:bg-indigo-50/50 font-medium text-xs flex items-center justify-center transition bg-white">
                                        {{ $link['label'] }}
                                    </a>
                                @endif
                            @endforeach
                        </div>

                        @if ($siswas->hasMorePages())
                            <a href="{{ $siswas->nextPageUrl() }}" class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-300 hover:bg-indigo-50/50 text-xs font-semibold transition bg-white">
                                <span class="hidden sm:inline">Selanjutnya</span>
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </a>
                        @else
                            <span class="inline-flex items-center space-x-1 px-3 py-1.5 rounded-lg border border-slate-200 text-slate-300 text-xs font-semibold cursor-not-allowed bg-white select-none">
                                <span class="hidden sm:inline">Selanjutnya</span>
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </span>
                        @endif

                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </main>

    <!-- MODAL TAMBAH AKUN -->
    <div x-show="showAddModal"
         x-transition
         class="fixed inset-0 z-50 flex items-start sm:items-center justify-center overflow-y-auto bg-slate-900/40 backdrop-blur-sm p-3 sm:p-4"
         style="display: none;">

        <div @click.away="showAddModal = false" class="bg-white rounded-3xl p-5 sm:p-8 max-w-md w-full my-auto shadow-2xl border border-slate-100 max-h-[95vh] overflow-y-auto">

            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600">
                        <i data-lucide="user-plus" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Tambah Akun Siswa</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Buat akun siswa baru untuk peminjaman</p>
                    </div>
                </div>
                <button @click="showAddModal = false" type="button" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.siswa.store') }}" class="space-y-4 mt-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Lengkap Siswa</label>
                    <input name="name" type="text" placeholder="Contoh: Muhammad Rizky Pratama" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kelas</label>
                    <input name="kelas" type="text" placeholder="Contoh: XI PPLG 1" value="XI PPLG 1" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email / Username Siswa</label>
                    <input name="email" type="email" placeholder="Contoh: rizky@sekolah.sch.id" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Password</label>
                    <input name="password" type="text" value="123456" placeholder="Minimal 6 karakter" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                    <p class="text-[10px] text-slate-400 mt-1">Default password: <span class="font-mono text-indigo-600 font-semibold">123456</span></p>
                </div>

                <div class="pt-3 flex items-center justify-end gap-2">
                    <button @click="showAddModal = false" type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#6366F1] hover:bg-indigo-600 text-white font-semibold text-xs shadow-md shadow-indigo-500/20 transition flex items-center space-x-1.5">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Simpan Akun</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT AKUN -->
    <div x-show="showEditModal"
         x-transition
         class="fixed inset-0 z-50 flex items-start sm:items-center justify-center overflow-y-auto bg-slate-900/40 backdrop-blur-sm p-3 sm:p-4"
         style="display: none;">

        <div @click.away="showEditModal = false" class="bg-white rounded-3xl p-5 sm:p-8 max-w-md w-full my-auto shadow-2xl border border-slate-100 max-h-[95vh] overflow-y-auto">

            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600">
                        <i data-lucide="user-cog" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Edit Akun Siswa</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Perbarui data informasi akun siswa</p>
                    </div>
                </div>
                <button @click="showEditModal = false" type="button" class="text-slate-400 hover:text-slate-600 p-1 rounded-lg">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form method="POST" :action="'{{ url('/admin/siswa') }}/' + editData.id" class="space-y-4 mt-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Lengkap Siswa</label>
                    <input name="name" x-model="editData.name" type="text" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kelas</label>
                    <input name="kelas" x-model="editData.kelas" type="text" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email / Username Siswa</label>
                    <input name="email" x-model="editData.email" type="email" required class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div class="pt-3 flex items-center justify-end gap-2">
                    <button @click="showEditModal = false" type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 font-semibold text-xs transition">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-600 text-white font-semibold text-xs shadow-md shadow-amber-500/20 transition flex items-center space-x-1.5 cursor-pointer">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL LOGOUT -->
    <div x-show="showLogoutModal"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-3 sm:p-4"
         style="display: none;">

        <div @click.away="showLogoutModal = false" class="bg-white rounded-3xl p-6 sm:p-8 max-w-sm w-full text-center shadow-xl border border-slate-100 flex flex-col items-center">

            <h3 class="text-lg font-bold text-slate-800 mb-1">Keluar dari Admin?</h3>
            <p class="text-xs text-slate-400 mb-6">Sesi kerja sarpras Anda akan diakhiri.</p>

            <div class="grid grid-cols-2 gap-3 w-full">
                <button @click="showLogoutModal = false" type="button" class="py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
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
