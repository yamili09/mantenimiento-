<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMA - Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 font-sans">

    <header class="bg-blue-800 text-white px-8 py-4 flex justify-between items-center shadow-md">
        <div class="flex items-center gap-3">
            <div class="bg-white/20 p-2 rounded-full text-xl">👤</div>
            <div>
                <h2 class="font-bold text-sm uppercase">{{ $user->name }}</h2>
                <p class="text-xs text-gray-300">Administrador</p>
            </div>
        </div>
        
        <nav class="flex items-center gap-6 font-medium text-sm">
            <a href="#" class="border-b-2 border-white pb-1">Inicio</a>
            <a href="#" class="text-gray-300 hover:text-white">Registros</a>
            <a href="#" class="text-gray-300 hover:text-white">Inventario</a>
            <a href="#" class="text-gray-300 hover:text-white">Administración</a>
            <a href="#" class="text-gray-300 hover:text-white">Configuración</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-300 hover:text-red-100 text-xs bg-red-900/40 px-2 py-1 rounded">Salir</button>
            </form>
        </nav>
    </header>

    <section class="bg-gradient-to-r from-blue-700 to-blue-900 text-white mx-8 mt-6 rounded-lg p-6 relative overflow-hidden shadow-lg">
        <div class="max-w-2xl z-10 relative">
            <h1 class="text-4xl font-black tracking-tight">SIMA <span class="text-xl font-normal tracking-wide block sm:inline">| SISTEMA INTEGRAL DE MANTENIMIENTO AUTOMOTRIZ</span></h1>
            <p class="text-blue-200 text-sm mt-2 font-light">Unifica la gestión, el control y la planeación inteligente para llevar el mantenimiento automotriz al siguiente nivel.</p>
        </div>
        <div class="absolute right-6 top-6 bg-white/10 backdrop-blur-md rounded px-4 py-2 text-right">
            <p class="text-xs text-blue-200">Bienvenido</p>
            <p id="reloj" class="text-2xl font-bold">08:24 <span class="text-sm">am</span></p>
        </div>
    </section>

    <main class="mx-8 mt-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-blue-900 font-bold tracking-wider text-lg uppercase border-b-2 border-blue-950 pb-1">Resumen</h3>
            <span class="text-xs text-gray-500 font-medium">{{ date('d/m/Y') }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-xl border border-blue-200 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-blue-800 font-bold">Total vehículos</p>
                    <p class="text-4xl font-extrabold text-blue-950 mt-1">{{ $totalVehiculos }}</p>
                </div>
                <span class="text-3xl bg-blue-50 p-2 rounded-lg">🚙</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-blue-200 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-blue-800 font-bold">En servicio</p>
                    <p class="text-4xl font-extrabold text-blue-950 mt-1">{{ $enServicio }}</p>
                </div>
                <span class="text-3xl bg-blue-50 p-2 rounded-lg">🔧</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-blue-200 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-blue-800 font-bold">En espera de refacción</p>
                    <p class="text-4xl font-extrabold text-blue-950 mt-1">{{ $esperaRefaccion }}</p>
                </div>
                <span class="text-3xl bg-red-50 p-2 rounded-lg">⚠️</span>
            </div>
            <div class="bg-white p-4 rounded-xl border border-blue-200 shadow-sm flex justify-between items-center">
                <div>
                    <p class="text-xs text-blue-800 font-bold">Servicios terminados</p>
                    <p class="text-4xl font-extrabold text-blue-950 mt-1">{{ $terminados }}</p>
                </div>
                <span class="text-3xl bg-green-50 p-2 rounded-lg">💚</span>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 items-center">
            <button class="bg-white border border-blue-300 p-4 rounded-xl shadow-sm hover:bg-blue-50 transition text-center flex flex-col items-center">
                <span class="text-2xl mb-1">➕🚙</span>
                <span class="text-xs font-semibold text-blue-900">Nuevo registro</span>
            </button>
            <button class="bg-white border border-blue-300 p-4 rounded-xl shadow-sm hover:bg-blue-50 transition text-center flex flex-col items-center">
                <span class="text-2xl mb-1">📇🚙</span>
                <span class="text-xs font-semibold text-blue-900">Registros de vehículos</span>
            </button>
            <button class="bg-white border border-blue-300 p-4 rounded-xl shadow-sm hover:bg-blue-50 transition text-center flex flex-col items-center">
                <span class="text-2xl mb-1">👥🛠️</span>
                <span class="text-xs font-semibold text-blue-900">Mecánicos</span>
            </button>
            <button class="bg-white border border-blue-300 p-4 rounded-xl shadow-sm hover:bg-blue-50 transition text-center flex flex-col items-center">
                <span class="text-2xl mb-1">⚙️📦</span>
                <span class="text-xs font-semibold text-blue-900">Catálogo de refacciones</span>
            </button>
            <div class="flex justify-center items-center">
                <button class="bg-white border border-red-200 p-3 rounded-full shadow hover:bg-red-50 relative">
                    <span class="text-xl">🔔</span>
                    <span class="absolute top-0 right-0 bg-red-500 w-3 h-3 rounded-full border-2 border-white"></span>
                </button>
            </div>
        </div>
    </main>

    <script>
        function actualizarReloj() {
            const ahora = new Date();
            let horas = ahora.getHours();
            let minutos = ahora.getMinutes();
            const ampm = horas >= 12 ? 'pm' : 'am';

            // Convertir de 24 horas a 12 horas
            horas = horas % 12;
            horas = horas ? horas : 12; 

            // Formatear minutos con cero a la izquierda si es menor a 10
            minutos = minutos < 10 ? '0' + minutos : minutos;
            
            // Formatear horas con cero a la izquierda
            let horasFormateadas = horas < 10 ? '0' + horas : horas;

            // Inyectar el formato en el HTML
            document.getElementById('reloj').innerHTML = `${horasFormateadas}:${minutos} <span class="text-sm font-normal">${ampm}</span>`;
        }

        // Ejecutar de inmediato al cargar la página
        actualizarReloj();
        
        // Actualizar cada segundo
        setInterval(actualizarReloj, 1000);
    </script>
</body>
</html>