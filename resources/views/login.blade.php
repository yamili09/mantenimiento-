<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMA - Login</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white rounded-lg shadow-lg flex max-w-4xl w-full overflow-hidden min-h-[500px]">
        <div class="w-1/2 p-10 flex flex-col justify-center">
            <h1 class="text-3xl font-bold text-blue-800">Bienvenido a SIMA</h1>
            <p class="text-xs text-blue-600 font-semibold tracking-wider mb-8">SISTEMA INTEGRAL DE MANTENIMIENTO AUTOMOTRIZ</p>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-600 text-sm mb-1 font-medium">👤 Usuario (Email)</label>
                    <input type="email" name="email" value="" class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-600 text-sm mb-1 font-medium">🔒 Contraseña</label>
                    <input type="password" name="password" value="" class="w-full border border-gray-300 rounded px-3 py-2 outline-none focus:border-blue-500" required>
                </div>

                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded transition flex justify-between items-center px-4 shadow">
                    <span>Entrar</span>
                    <span>➔</span>
                </button>
            </form>
        </div>

        <div class="w-1/2 bg-cover bg-center hidden md:block" style="background-image: url('https://images.unsplash.com/photo-1486006920555-c77dce18193b?q=80&w=1000&auto=format&fit=crop');">
        </div>
    </div>

</body>
</html>