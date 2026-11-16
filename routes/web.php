<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Barang;
use App\Http\Controllers\BarangController;

// 1. Halaman Utama diarahkan ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Auth Login Siswa
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau kata sandi yang dimasukkan salah.',
    ])->onlyInput('email');
});

// 3. Auth Register
Route::get('/register', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('register');
})->name('register');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'min:6'],
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role' => 'siswa',
    ]);

    return redirect()->route('login')->with('status', 'Akun berhasil dibuat! Silakan masuk.');
});

// 4. Logout Universal
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// ================= LOGIN KHUSUS ADMIN SARPRAS ================= //
Route::get('/admin/login', function () {
    if (Auth::check() && (strtolower(trim(Auth::user()->role ?? '')) === 'admin' || Auth::user()->email === 'admin@sekolah.sch.id')) {
        return redirect()->route('admin.dashboard');
    }
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => ['required'],
        'password' => ['required'],
    ]);

    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $user = Auth::user();

        // Admin diakui jika role adalah admin ATAU email terdaftar sebagai admin@sekolah.sch.id
        if (strtolower(trim($user->role ?? '')) === 'admin' || $user->email === 'admin@sekolah.sch.id') {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors([
            'email' => 'Akun ini bukan akun Admin Sarpras. Silakan gunakan portal siswa.'
        ])->onlyInput('email');
    }

    return back()->withErrors([
        'email' => 'Email atau kata sandi admin salah.'
    ])->onlyInput('email');
})->name('admin.login.submit');

// ================= FITUR APLIKASI (WAJIB LOGIN) ================= //
Route::middleware('auth')->group(function () {

    // Dashboard Siswa Dinamis
    Route::get('/dashboard', function () {
        $userId = Auth::id();

        $barangDipinjam = Peminjaman::where('user_id', $userId)
            ->where('status', 'Dipinjam')
            ->count();

        $totalPeminjaman = Peminjaman::where('user_id', $userId)->count();

        $notifikasis = Peminjaman::where('user_id', $userId)
            ->latest('updated_at')
            ->take(3)
            ->get();

        return view('dashboard', compact('barangDipinjam', 'totalPeminjaman', 'notifikasis'));
    })->name('dashboard');

    // Katalog Barang Siswa
    Route::get('/barang', function () {
        $barangs = Barang::latest()->get();
        return view('barang', compact('barangs'));
    })->name('barang');

    
    // Siswa Kirim Form Pengajuan Barang
    Route::post('/pinjam', function (Request $request) {
        $validated = $request->validate([
            'nama_peminjam'  => 'required|string',
            'nama_barang'    => 'required|string',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'jam_mulai'      => 'required|date_format:H:i',
            'jam_selesai'    => 'required|date_format:H:i|after:jam_mulai',
            'keperluan'      => 'required|string',
        ], [
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
        ]);

        Peminjaman::create([
            'user_id'        => Auth::id(),
            'nama_peminjam'  => $validated['nama_peminjam'],
            'nama_barang'    => $validated['nama_barang'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'jam_mulai'      => $validated['jam_mulai'],
            'jam_selesai'    => $validated['jam_selesai'],
            'keperluan'      => $validated['keperluan'],
            'status'         => 'Menunggu',
        ]);

        return redirect()->route('peminjaman.saya')
            ->with('success', 'Pengajuan berhasil dikirim! Menunggu persetujuan admin.');
    })->name('pinjam.store');


    // Peminjaman Saya Milik Siswa
    Route::get('/peminjaman-saya', function () {
        $peminjamans = Peminjaman::where('user_id', Auth::id())
            ->whereIn('status', ['Menunggu', 'Dipinjam'])
            ->latest()
            ->get();
        return view('peminjaman-saya', compact('peminjamans'));
    })->name('peminjaman.saya');

    // Siswa Kembalikan Barang
    Route::post('/peminjaman/{id}/kembalikan', function ($id) {
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $barang = Barang::where('nama_barang', $peminjaman->nama_barang)->first();
        if ($barang && $barang->dipinjam > 0) {
            $barang->decrement('dipinjam');
        }

        $peminjaman->update([
            'status' => 'Selesai',
        ]);

        return redirect()->route('riwayat.peminjaman')->with('success', 'Barang berhasil dikembalikan!');
    })->name('peminjaman.kembalikan');

    // Riwayat Peminjaman Siswa
    Route::get('/riwayat-peminjaman', function () {
        $riwayats = Peminjaman::where('user_id', Auth::id())
            ->where('status', 'Selesai')
            ->latest()
            ->get();
        return view('riwayat-peminjaman', compact('riwayats'));
    })->name('riwayat.peminjaman');

    // Profil Pengguna
    Route::get('/profil', function () {
        return view('profil');
    })->name('profil');

    
    // Kontak Sarpras untuk Siswa
    Route::get('/kontak-sarpras', function () {
        return view('sarpras');
    })->name('kontak.sarpras');


    // ================= BAGIAN ADMIN SARPRAS ================= //

    // Dashboard Admin Dinamis
    Route::get('/admin/dashboard', function () {
        $totalBarang    = Barang::sum('stok_total');
        $dipinjamSiswa  = Barang::sum('dipinjam');
        $pengajuanBaru  = Peminjaman::where('status', 'Menunggu')->count();
        $totalAkun      = User::count();

        $pengajuanTerbaru = Peminjaman::where('status', 'Menunggu')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBarang',
            'dipinjamSiswa',
            'pengajuanBaru',
            'totalAkun',
            'pengajuanTerbaru'
        ));
    })->name('admin.dashboard');

    // Kelola Barang Admin
    Route::get('/admin/barang', [BarangController::class, 'index'])->name('admin.barang');
    Route::post('/admin/barang', [BarangController::class, 'store'])->name('admin.barang.store');
    Route::put('/admin/barang/{id}', [BarangController::class, 'update'])->name('admin.barang.update');
    Route::delete('/admin/barang/{id}', [BarangController::class, 'destroy'])->name('admin.barang.destroy');

    // Persetujuan Admin
    Route::get('/admin/persetujuan', function () {
        $pengajuans = Peminjaman::where('status', 'Menunggu')
            ->latest()
            ->get();
        return view('admin.persetujuan', compact('pengajuans'));
    })->name('admin.persetujuan');

    // Aksi Admin: Setujui (ACC)
    Route::post('/admin/persetujuan/{id}/setujui', function ($id) {
        $peminjaman = Peminjaman::findOrFail($id);

        $barang = Barang::where('nama_barang', $peminjaman->nama_barang)->first();
        if ($barang && $barang->stok_tersedia > 0) {
            $barang->increment('dipinjam');
        }

        $peminjaman->update([
            'status' => 'Dipinjam'
        ]);

        return back()->with('success', 'Peminjaman berhasil disetujui!');
    })->name('admin.persetujuan.setujui');

    // Aksi Admin: Tolak
    Route::post('/admin/persetujuan/{id}/tolak', function ($id) {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'Ditolak'
        ]);

        return back()->with('success', 'Peminjaman ditolak!');
    })->name('admin.persetujuan.tolak');

    
    // Riwayat & Pengembalian Admin
    Route::get('/admin/riwayat', function (Illuminate\Http\Request $request) {
        $jenis = $request->input('jenis', 'semua');

        $query = \App\Models\Peminjaman::whereIn('status', [
            'Dipinjam',
            'Selesai'
        ]);

        $periodeLaporan = 'Semua Data';

        if ($jenis === 'tanggal') {
            $dariTanggal = $request->input('dari_tanggal') ?? $request->input('tanggal');
            $sampaiTanggal = $request->input('sampai_tanggal') ?? $dariTanggal;

            if ($dariTanggal) {
                $start = \Carbon\Carbon::parse($dariTanggal)->startOfDay();
                $end = \Carbon\Carbon::parse($sampaiTanggal ?? $dariTanggal)->endOfDay();

                if ($start->gt($end)) {
                    [$start, $end] = [$end, $start];
                }

                $query->whereBetween('tanggal_pinjam', [
                    $start->toDateString(),
                    $end->toDateString(),
                ]);

                $periodeLaporan = ($start->toDateString() === $end->toDateString())
                    ? $start->translatedFormat('d F Y')
                    : $start->translatedFormat('d M Y') . ' s/d ' . $end->translatedFormat('d M Y');
            }

        } elseif ($jenis === 'minggu') {
            $dariStart = $request->input('dari_minggu_start');
            $dariEnd = $request->input('dari_minggu_end');
            $sampaiStart = $request->input('sampai_minggu_start') ?? $dariStart;
            $sampaiEnd = $request->input('sampai_minggu_end') ?? $dariEnd;
            $dariLabel = $request->input('dari_minggu_label', 'Minggu 1');
            $sampaiLabel = $request->input('sampai_minggu_label', $dariLabel);

            // Dukungan format native week sebelumnya (misal 2026-W45) jika ada
            if (!$dariStart && $request->has('dari_minggu')) {
                $dm = $request->input('dari_minggu');
                $sm = $request->input('sampai_minggu', $dm);
                if ($dm) {
                    $dariStart = \Carbon\Carbon::parse($dm)->startOfWeek()->toDateString();
                    $sampaiEnd = \Carbon\Carbon::parse($sm)->endOfWeek()->toDateString();
                    $dariLabel = 'Minggu ' . \Carbon\Carbon::parse($dm)->format('W');
                    $sampaiLabel = 'Minggu ' . \Carbon\Carbon::parse($sm)->format('W');
                }
            }

            if ($dariStart && $sampaiEnd) {
                $start = \Carbon\Carbon::parse($dariStart)->startOfDay();
                $end = \Carbon\Carbon::parse($sampaiEnd)->endOfDay();

                if ($start->gt($end)) {
                    [$start, $end] = [$end, $start];
                    [$dariLabel, $sampaiLabel] = [$sampaiLabel, $dariLabel];
                }

                $query->whereBetween('tanggal_pinjam', [
                    $start->toDateString(),
                    $end->toDateString(),
                ]);

                $periodeLaporan = ($dariLabel === $sampaiLabel)
                    ? $dariLabel . ' (' . $start->translatedFormat('d M Y') . ' s/d ' . $end->translatedFormat('d M Y') . ')'
                    : $dariLabel . ' s/d ' . $sampaiLabel . ' (' . $start->translatedFormat('d M Y') . ' s/d ' . $end->translatedFormat('d M Y') . ')';
            }

        } elseif ($jenis === 'bulan') {
            $dariBulan = $request->input('dari_bulan') ?? $request->input('bulan');
            $sampaiBulan = $request->input('sampai_bulan') ?? $dariBulan;

            if ($dariBulan) {
                $start = \Carbon\Carbon::parse($dariBulan)->startOfMonth();
                $end = \Carbon\Carbon::parse($sampaiBulan ?? $dariBulan)->endOfMonth();

                if ($start->gt($end)) {
                    [$start, $end] = [$end, $start];
                }

                $query->whereBetween('tanggal_pinjam', [
                    $start->toDateString(),
                    $end->toDateString(),
                ]);

                $periodeLaporan = ($start->format('Y-m') === $end->format('Y-m'))
                    ? $start->translatedFormat('F Y')
                    : $start->translatedFormat('F Y') . ' s/d ' . $end->translatedFormat('F Y');
            }

        } elseif ($jenis === 'tahun') {
            $dariTahun = $request->input('dari_tahun');
            $sampaiTahun = $request->input('sampai_tahun') ?? $dariTahun;

            if ($dariTahun) {
                $y1 = min((int)$dariTahun, (int)$sampaiTahun);
                $y2 = max((int)$dariTahun, (int)$sampaiTahun);

                $start = \Carbon\Carbon::createFromDate($y1, 1, 1)->startOfYear();
                $end = \Carbon\Carbon::createFromDate($y2, 12, 31)->endOfYear();

                $query->whereBetween('tanggal_pinjam', [
                    $start->toDateString(),
                    $end->toDateString(),
                ]);

                $periodeLaporan = ($y1 === $y2) ? 'Tahun ' . $y1 : 'Tahun ' . $y1 . ' s/d ' . $y2;
            }
        }

        $riwayats = $query->latest()->get();

        return view('admin.riwayat', compact(
            'riwayats',
            'periodeLaporan'
        ));
    })->name('admin.riwayat');


    // Kelola Akun Siswa
    Route::get('/admin/siswa', function (Request $request) {
        $query = User::query();

        // Fitur pencarian sesuai nama, kelas, atau email siswa
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Batasi 10 data siswa per halaman
        $siswas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.siswa', compact('siswas'));
    })->name('admin.siswa');

    // Tambah Akun Siswa Baru
    Route::post('/admin/siswa', function (Request $request) {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'kelas'    => ['nullable', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:6'],
        ], [
            'name.required'     => 'Nama siswa wajib diisi.',
            'email.required'    => 'Email siswa wajib diisi.',
            'email.unique'      => 'Email ini sudah terdaftar di sistem.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'kelas'    => $validated['kelas'] ?: 'XI PPLG 1',
            'password' => bcrypt($validated['password']),
            'role'     => 'siswa',
        ]);

        return redirect()->route('admin.siswa')->with('success', 'Akun siswa ' . $validated['name'] . ' berhasil ditambahkan!');
    })->name('admin.siswa.store');

    // Update Data Siswa
    Route::put('/admin/siswa/{id}', function (Request $request, $id) {
        $siswa = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $siswa->id],
            'kelas' => ['nullable', 'string', 'max:50'],
        ], [
            'name.required'  => 'Nama siswa wajib diisi.',
            'email.required' => 'Email siswa wajib diisi.',
            'email.unique'   => 'Email ini sudah digunakan oleh akun lain.',
        ]);

        $siswa->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'kelas' => $validated['kelas'] ?: 'XI PPLG 1',
        ]);

        return redirect()->route('admin.siswa')->with('success', 'Data siswa ' . $siswa->name . ' berhasil diperbarui!');
    })->name('admin.siswa.update');

    // Aksi Reset Password Siswa
    Route::post('/admin/siswa/{id}/reset-password', function ($id) {
        $siswa = User::findOrFail($id);
        $siswa->update([
            'password' => bcrypt('123456')
        ]);

        return back()->with('success', 'Password untuk ' . $siswa->name . ' berhasil direset menjadi: 123456');
    })->name('admin.siswa.reset');

    // Hapus Akun Siswa
    Route::delete('/admin/siswa/{id}', function ($id) {
        $siswa = User::findOrFail($id);

        if ($siswa->id === Auth::id() || $siswa->email === 'admin@sekolah.sch.id' || strtolower($siswa->role ?? '') === 'admin') {
            return back()->withErrors(['Akun admin tidak dapat dihapus.']);
        }

        $nama = $siswa->name;
        $siswa->delete();

        return back()->with('success', 'Akun siswa ' . $nama . ' berhasil dihapus!');
    })->name('admin.siswa.destroy');

});