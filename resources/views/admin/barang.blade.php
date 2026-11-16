
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARPRAS ADMIN - Kelola Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="{
    showLogoutModal: false,
    showAddModal: false,
    showEditModal: false,
    mobileMenu: false,
    search: '',
    category: 'all',
    editData: { id: '', name: '', code: '', category: 'Elektronik', totalStock: 0 },
    openEdit(id, name, code, category, stock) {
        this.editData = { id: id, name: name, code: code, category: category, totalStock: stock };
        this.showEditModal = true;
    }
}" class="bg-[#F8FAFC] text-slate-700 font-sans antialiased min-h-screen flex">

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
                    <h2 class="font-extrabold text-sm text-white tracking-wider">SARPRAS ADMIN</h2>
                    <p class="text-[10px] text-slate-400 font-medium">Sistem Kendali Sekolah</p>
                </div>
            </div>

            <!-- MENU NAVIGASI ADMIN -->
            <nav class="space-y-1.5 text-xs font-semibold">

                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.barang') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#6366F1] text-white shadow-md shadow-indigo-500/20 transition">
                    <i data-lucide="package" class="w-4 h-4"></i>
                    <span>Kelola Barang</span>
                </a>

                <a href="{{ route('admin.persetujuan') }}"
                   class="flex items-center justify-between px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                    <div class="flex items-center gap-3">
                        <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                        <span>Persetujuan</span>
                    </div>
                    <span class="px-2 py-0.5 text-[10px] bg-amber-500/20 text-amber-400 rounded-full font-bold">8</span>
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

        <!-- PROFIL ADMIN & LOGOUT -->
        <div class="pt-4 border-t border-slate-800 space-y-3">
            <div class="flex items-center justify-between px-2 gap-2">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center font-bold text-indigo-400 text-xs shrink-0">
                        AD
                    </div>
                    <div class="min-w-0">
                        <h4 class="text-xs font-bold text-white leading-tight">Pak Budi Sarpras</h4>
                        <p class="text-[10px] text-slate-400 truncate">admin@sekolah.sch.id</p>
                    </div>
                </div>

                <button @click="showLogoutModal = true" type="button"
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

    <!-- AREA UTAMA KELOLA BARANG -->
    <main class="flex-1 flex flex-col min-w-0">

        <!-- TOP NAVBAR -->
        <header class="min-h-16 bg-white px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-3 border-b border-slate-100 sticky top-0 z-20">

            <div class="flex items-center gap-3 min-w-0">
                <!-- TOMBOL MENU MOBILE -->
                <button @click="mobileMenu = !mobileMenu" type="button"
                    class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 shrink-0">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>

                <h1 class="text-sm sm:text-base font-bold text-slate-800 truncate">
                    Kelola Barang (CRUD)
                </h1>
            </div>

            <div class="flex items-center gap-2 sm:gap-4 shrink-0">
                <button type="button"
                    class="w-9 h-9 rounded-xl bg-slate-50 hover:bg-slate-100 flex items-center justify-center text-slate-500 transition relative">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="w-2 h-2 rounded-full bg-rose-500 absolute top-2 right-2 ring-2 ring-white"></span>
                </button>

                <div class="w-8 h-8 rounded-xl bg-indigo-100 border border-indigo-200 flex items-center justify-center overflow-hidden shrink-0">
                    <img src="https://api.dicebear.com/7.x/bottts/svg?seed=AdminSarpras"
                         alt="avatar" class="w-full h-full object-cover">
                </div>
            </div>
        </header>

        <!-- KONTEN INVENTARIS -->
        <div class="w-full p-4 sm:p-6 lg:p-8 space-y-6">

            <!-- ALERT NOTIFIKASI BERHASIL -->
            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs rounded-xl flex items-center justify-between gap-3">
                    <span>{{ session('success') }}</span>
                    <span class="font-bold shrink-0">✓</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-xl">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- HEADER ACTIONS & TITLE -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Inventaris Barang Sekolah</h2>
                    <p class="text-xs text-slate-400 mt-1">Atur tambah, edit, dan hapus data barang sarpras.</p>
                </div>

                <button @click="showAddModal = true" type="button"
                    class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-5 py-2.5 bg-[#4F46E5] hover:bg-indigo-700 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-600/20 transition">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Tambah Barang Baru</span>
                </button>
            </div>

            <!-- FILTER BAR & SEARCH -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="relative w-full sm:w-80">
                    <i data-lucide="search"
                       class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input x-model="search" type="text"
                        placeholder="Cari nama atau kode barang..."
                        class="w-full bg-white border border-slate-200 rounded-xl pl-9 pr-4 py-2.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-indigo-500 transition shadow-sm">
                </div>

                <div class="w-full sm:w-auto">
                    <select x-model="category"
                        class="w-full sm:w-48 bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 transition shadow-sm cursor-pointer">
                        <option value="all">Semua Kategori</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Musik">Musik</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <!-- TABEL DATA BARANG -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[850px] text-left border-collapse">

                        <thead>
                            <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
                                <th class="py-4 px-6">BARANG</th>
                                <th class="py-4 px-6">KATEGORI</th>
                                <th class="py-4 px-6">STOK TOTAL</th>
                                <th class="py-4 px-6">DIPINJAM</th>
                                <th class="py-4 px-6">STATUS</th>
                                <th class="py-4 px-6 text-center">AKSI</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 text-xs font-medium">
                            @forelse($barangs as $item)

                                <tr x-show="(category === 'all' || category === '{{ $item->kategori }}') && ('{{ strtolower($item->nama_barang . ' ' . $item->kode_barang) }}'.includes(search.toLowerCase()))"
                                    class="hover:bg-slate-50/70 transition">

                                    <!-- KOLOM BARANG -->
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-3.5">
                                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 font-bold text-[11px] flex items-center justify-center shrink-0">
                                                {{ strtoupper(substr($item->nama_barang, 0, 3)) }}
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-slate-800 text-xs">{{ $item->nama_barang }}</h4>
                                                <p class="text-[11px] text-slate-400 mt-0.5">Kode: {{ $item->kode_barang }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- KOLOM KATEGORI -->
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-lg text-[11px] font-semibold">
                                            {{ $item->kategori }}
                                        </span>
                                    </td>

                                    <!-- KOLOM STOK TOTAL -->
                                    <td class="py-4 px-6 text-slate-700 font-semibold">
                                        {{ $item->stok_total }} Unit
                                    </td>

                                    <!-- KOLOM DIPINJAM -->
                                    <td class="py-4 px-6 text-slate-500">
                                        {{ $item->dipinjam }} Unit
                                    </td>

                                    <!-- KOLOM STATUS -->
                                    <td class="py-4 px-6">
                                        @if($item->stok_tersedia > 0)
                                            <span class="text-emerald-500 font-semibold text-xs">
                                                Tersedia ({{ $item->stok_tersedia }})
                                            </span>
                                        @else
                                            <span class="text-rose-500 font-semibold text-xs">Habis</span>
                                        @endif
                                    </td>

                                    <!-- KOLOM AKSI -->
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex items-center justify-center gap-2">

                                            <!-- TOMBOL EDIT -->
                                            <button
                                                @click="openEdit({{ $item->id }}, {{ Illuminate\Support\Js::from($item->nama_barang) }}, {{ Illuminate\Support\Js::from($item->kode_barang) }}, {{ Illuminate\Support\Js::from($item->kategori) }}, {{ $item->stok_total }})"
                                                type="button"
                                                class="p-2 text-indigo-500 hover:text-indigo-700 hover:bg-indigo-50 rounded-lg transition"
                                                title="Edit Barang">
                                                <i data-lucide="pencil" class="w-4 h-4"></i>
                                            </button>

                                            <!-- TOMBOL HAPUS -->
                                            <form method="POST"
                                                action="{{ route('admin.barang.destroy', $item->id) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="p-2 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition"
                                                    title="Hapus Barang">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-10 text-slate-400 text-xs">
                                        Belum ada barang di database. Klik tombol
                                        <b>Tambah Barang Baru</b> di atas untuk menambahkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- MODAL TAMBAH BARANG -->
    <div x-show="showAddModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4 overflow-y-auto"
        style="display: none;">

        <div @click.away="showAddModal = false"
            class="bg-white rounded-3xl p-5 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 my-auto">

            <div class="flex items-center justify-between gap-3 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Tambah Barang Baru</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Data akan langsung tersimpan di Database MySQL</p>
                </div>
                <button @click="showAddModal = false" type="button"
                    class="text-slate-400 hover:text-slate-600 p-1 rounded-lg shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.barang.store') }}" class="space-y-4 mt-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Barang</label>
                    <input name="nama_barang" type="text"
                        placeholder="Contoh: Proyektor Epson EB-X400" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kode Barang</label>
                        <input name="kode_barang" type="text" placeholder="ELK-012" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori</label>
                        <select name="kategori"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                            <option value="Elektronik">Elektronik</option>
                            <option value="Musik">Musik</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jumlah Stok Awal</label>
                    <input name="stok_total" type="number" min="1" value="1" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <button @click="showAddModal = false" type="button"
                        class="py-2.5 px-4 rounded-xl border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="py-2.5 px-5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs shadow-md shadow-indigo-600/20 transition">
                        Simpan ke Database
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT BARANG -->
    <div x-show="showEditModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4 overflow-y-auto"
        style="display: none;">

        <div @click.away="showEditModal = false"
            class="bg-white rounded-3xl p-5 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 my-auto">

            <div class="flex items-center justify-between gap-3 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Edit Data Barang</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Perbarui stok dan info inventaris</p>
                </div>
                <button @click="showEditModal = false" type="button"
                    class="text-slate-400 hover:text-slate-600 p-1 rounded-lg shrink-0">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <form :action="'/admin/barang/' + editData.id" method="POST" class="space-y-4 mt-5">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Barang</label>
                    <input name="nama_barang" x-model="editData.name" type="text" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kode Barang</label>
                        <input name="kode_barang" x-model="editData.code" type="text" required
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori</label>
                        <select name="kategori" x-model="editData.category"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                            <option value="Elektronik">Elektronik</option>
                            <option value="Musik">Musik</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jumlah Stok Total</label>
                    <input name="stok_total" x-model="editData.totalStock" type="number" min="1" required
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-700 focus:outline-none focus:border-indigo-500 focus:bg-white transition">
                </div>

                <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <button @click="showEditModal = false" type="button"
                        class="py-2.5 px-4 rounded-xl border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="py-2.5 px-5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs shadow-md shadow-indigo-600/20 transition">
                        Update Database
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL LOGOUT -->
    <div x-show="showLogoutModal"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-xs p-4"
        style="display: none;">

        <div @click.away="showLogoutModal = false"
            class="bg-white rounded-3xl p-5 sm:p-8 max-w-sm w-full text-center shadow-xl border border-slate-100 flex flex-col items-center">

            <h3 class="text-lg font-bold text-slate-800 mb-1">Keluar dari Admin?</h3>
            <p class="text-xs text-slate-400 mb-6">Sesi kerja sarpras Anda akan diakhiri.</p>

            <div class="grid grid-cols-2 gap-3 w-full">
                <button @click="showLogoutModal = false" type="button"
                    class="py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
                    Batal
                </button>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                        class="w-full py-2.5 rounded-xl bg-rose-500 hover:bg-rose-600 text-white font-semibold text-xs transition">
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
