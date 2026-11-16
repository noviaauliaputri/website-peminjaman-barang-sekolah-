<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Peminjaman Barang SMKN 1 Ciomas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Buat Akun</h1>
            <p class="text-xs text-slate-500 mt-1">Peminjaman Barang Sekolah SMKN 1 Ciomas</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Contoh: Rahma Oktaviani" value="{{ old('name') }}"
                       class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Email</label>
                <input type="email" name="email" required placeholder="nama@gmail.com" value="{{ old('email') }}"
                       class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Password</label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter"
                       class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                @error('password')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Register -->
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl transition mt-2">
                Daftar Akun
            </button>

            <p class="text-center text-xs text-slate-500 pt-2">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Masuk di sini</a>
            </p>
        </form>
    </div>

</body>
</html>