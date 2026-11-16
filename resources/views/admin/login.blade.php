<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Sarpras - SMKN 1 Ciomas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#0B0F19] min-h-screen flex items-center justify-center p-4 font-sans text-slate-300">

    <div class="w-full max-w-md bg-[#131B2E] border border-slate-800/80 rounded-3xl p-8 sm:p-10 shadow-2xl relative overflow-hidden">
        
        <!-- Header Logo & Title -->
        <div class="flex flex-col items-center text-center mb-8">
            <div class="w-14 h-14 rounded-2xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30 mb-4">
                <i data-lucide="layers" class="w-7 h-7"></i>
            </div>
            <h1 class="text-xl font-bold text-white tracking-wide">Login Admin Sarpras</h1>
            <p class="text-xs text-slate-400 mt-1">Sistem Informasi Peminjaman Barang Sekolah</p>
        </div>

        <!-- Alert Error -->
        @if ($errors->any())
        <div class="mb-5 p-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs flex items-center space-x-2">
            <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        @if (session('status'))
        <div class="mb-5 p-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs flex items-center space-x-2">
            <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
            <span>{{ session('status') }}</span>
        </div>
        @endif

        <!-- Form Login Admin -->
        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf

            <!-- Email / Username Admin -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1.5">Email / Username Admin</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                    </span>
                    <input type="text" name="email" value="{{ old('email', 'admin@sekolah.sch.id') }}" required placeholder="admin@sekolah.sch.id"
                        class="w-full bg-[#0B0F19]/80 border border-slate-700/80 rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                </div>
            </div>

            <!-- Password Admin -->
            <div>
                <label class="block text-xs font-medium text-slate-400 mb-1.5">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-500">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </span>
                    <input type="password" name="password" required placeholder="••••••••••••"
                        class="w-full bg-[#0B0F19]/80 border border-slate-700/80 rounded-xl pl-10 pr-4 py-2.5 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition">
                </div>
            </div>

            <!-- Ingat Saya & Lupa Password -->
            <div class="flex items-center justify-between text-[11px] pt-1 text-slate-400">
                <label class="flex items-center space-x-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded bg-[#0B0F19] border-slate-700 text-indigo-600 focus:ring-0">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="hover:text-indigo-400 transition">Lupa password?</a>
            </div>

            <!-- Tombol Masuk Admin -->
            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-3 px-4 rounded-xl bg-[#525CEB] hover:bg-[#434dc9] text-white font-semibold text-xs shadow-lg shadow-indigo-600/30 transition duration-200">
                    Masuk ke Panel Admin
                </button>
            </div>
        </form>

        <!-- Demo Akun Info Footer -->
        <div class="mt-8 text-center">
            <p class="text-[11px] text-slate-500">

            </p>
            <a href="{{ route('login') }}" class="inline-block mt-3 text-[11px] text-indigo-400 hover:text-indigo-300 transition">
                ← Beralih ke Login Siswa
            </a>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>