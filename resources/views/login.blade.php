<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Peminjaman Barang Sekolah SMKN 1 Ciomas</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons & AlpineJS -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row min-h-[600px]">
        
        <!-- Sisi Kiri (Ilustrasi & Branding) -->
        <div class="w-full md:w-1/2 relative bg-cover bg-center flex flex-col justify-between p-8 text-slate-800"
             style="background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1000');"
            
            <!-- Overlay tipis jika diperlukan -->
            <div class="absolute inset-0 bg-blue-50/20 backdrop-blur-[1px]"></div>

            <div class="relative z-10">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white/80 backdrop-blur-md rounded-lg shadow-sm">
                        <i data-lucide="book-open" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-slate-900 leading-tight">Peminjaman Barang Sekolah</h2>
                        <p class="text-xs text-slate-600 font-medium">SMKN 1 Ciomas</p>
                    </div>
                </div>
            </div>

            <div class="relative z-10 mt-auto pt-20">
                <p class="font-handwriting text-2xl text-slate-700 font-semibold italic">
                    "Bersama<br>Membangun Siswa<br>yang Lebih Baik <span class="not-italic text-red-400">♥</span>"
                </p>
            </div>
        </div>

        <!-- Sisi Kanan (Form Login) -->
        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-between bg-white" x-data="{ showPassword: false }">
            
            <div class="flex justify-end">
                <!-- Icon Sederhana di Pojok Kanan Atas -->
                <div class="flex space-x-1 text-slate-400">
                    <i data-lucide="line-chart" class="w-4 h-4"></i>
                    <i data-lucide="heart" class="w-4 h-4"></i>
                </div>
            </div>

            <div class="my-auto py-6">
                <h1 class="text-3xl font-bold text-slate-900 mb-2">Selamat Datang!</h1>
                <p class="text-sm text-slate-500 mb-8">Silakan masuk untuk melanjutkan ke akun Anda.</p>

                <!-- Pesan Error / Status Session -->
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Field Email -->
                    <div>
                        <div class="relative flex items-center border border-gray-300 rounded-xl px-3 py-2.5 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition">
                            <div class="text-slate-400 pr-3">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </div>
                            <div class="w-full">
                                <label for="email" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                       placeholder="contoh@email.com" 
                                       class="w-full text-sm font-medium text-slate-800 placeholder-slate-400 border-none p-0 focus:ring-0 focus:outline-none">
                            </div>
                        </div>
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Field Password -->
                    <div>
                        <div class="relative flex items-center border border-gray-300 rounded-xl px-3 py-2.5 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition">
                            <div class="text-slate-400 pr-3">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <div class="w-full">
                                <label for="password" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Password</label>
                                <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                                       placeholder="Masukkan password" 
                                       class="w-full text-sm font-medium text-slate-800 placeholder-slate-400 border-none p-0 focus:ring-0 focus:outline-none">
                            </div>
                            <button type="button" @click="showPassword = !showPassword" class="text-slate-400 hover:text-slate-600 focus:outline-none">
                                <i data-lucide="eye" x-show="!showPassword" class="w-5 h-5"></i>
                                <i data-lucide="eye-off" x-show="showPassword" class="w-5 h-5" style="display: none;"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" 
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-xl shadow-md transition duration-200 flex items-center justify-center space-x-2">
                        <span>Login</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>

            <div class="text-center pt-4">
                <p class="text-xs text-slate-400">Hanya untuk pengguna terdaftar</p>
            </div>

        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>