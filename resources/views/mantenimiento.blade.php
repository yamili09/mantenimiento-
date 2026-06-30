<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Mantenimiento - SIMA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#f8fafc] font-sans min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200" 
         x-data="{ 
            step: 1, 
            filtroMecanico: 'todos',
            mecanicoSeleccionado: null, 
            mecanicoConfirmado: null 
         }">
        
        <header class="bg-[#2b59c3] text-white px-6 py-3.5 flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-1.5 rounded-full">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-white">Fernando Chonco...</h2>
                    <p class="text-[10px] text-blue-200 uppercase">Administrador</p>
                </div>
            </div>
            <nav class="flex gap-6 text-xs uppercase font-bold tracking-wider">
                <a href="#" class="hover:text-blue-200 transition">Inicio</a>
                <a href="#" class="border-b-2 border-white pb-1">Registros</a>
                <a href="#" class="hover:text-blue-200 transition">Inventario</a>
                <a href="#" class="hover:text-blue-200 transition">Administración</a>
                <a href="#" class="hover:text-blue-200 transition">Configuración</a>
            </nav>
        </header>

        <form action="{{ route('mantenimiento.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
            @csrf
            
            <input type="hidden" name="mecanico_id" :value="mecanicoConfirmado ? mecanicoConfirmado.id : ''">

            <div class="text-xs font-bold text-[#2b59c3] flex items-center gap-2">
                <span>SMS</span> <span class="text-gray-300">————————————————————————————————————————————————————————————————————</span>
            </div>

            <div x-show="step === 1" class="space-y-6">
                <h3 class="text-center text-[#2b59c3] text-xl font-extrabold uppercase tracking-widest">Datos del Vehículo</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Fabricante:</label>
                        <select name="fabricante" class="w-full p-2 border-2 border-blue-100 rounded-md text-sm text-gray-500 bg-white focus:border-blue-500 focus:outline-none">
                            <option value="">Seleccione el fabricante</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Nissan">Nissan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Modelo:</label>
                        <select name="modelo" class="w-full p-2 border-2 border-blue-100 rounded-md text-sm text-gray-500 bg-white focus:border-blue-500 focus:outline-none">
                            <option value="">Seleccione el modelo</option>
                            <option value="Hilux">Hilux</option>
                            <option value="Versa">Versa</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Año de lanzamiento:</label>
                        <input type="text" name="anio" placeholder="Seleccione el año" class="w-full p-2 border-2 border-blue-100 rounded-md text-sm focus:border-blue-500 focus:outline-none placeholder-gray-300">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                    <div>
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Placas del vehículo:</label>
                        <input type="text" name="placas" placeholder="000-000" class="w-full p-2 border-2 border-blue-100 rounded-md text-sm focus:border-blue-500 focus:outline-none placeholder-gray-300">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Seleccione el tipo de mantenimiento:</label>
                        <div class="flex gap-8 py-2">
                            <label class="flex items-center gap-2 text-xs font-bold text-gray-600 cursor-pointer">
                                <input type="checkbox" name="tipo_mantenimiento[]" value="Preventivo" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"> Preventivo
                            </label>
                            <label class="flex items-center gap-2 text-xs font-bold text-gray-600 cursor-pointer">
                                <input type="checkbox" name="tipo_mantenimiento[]" value="Correctivo" class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500"> Correctivo
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Descripción del problema:</label>
                    <textarea name="descripcion" rows="4" class="w-full p-3 border-2 border-blue-100 rounded-md font-mono text-sm text-gray-600 bg-gray-50/50 lines-bg focus:outline-none focus:border-blue-500 shadow-inner" placeholder="1&#10;2&#10;3"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" class="px-8 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded text-xs uppercase tracking-wider transition shadow-sm">Cancelar</button>
                    <button type="button" @click="step = 2" class="px-8 py-2 bg-[#2b59c3] hover:bg-blue-700 text-white font-bold rounded text-xs uppercase tracking-wider transition shadow-sm">Siguiente</button>
                </div>
            </div>

            <div x-show="step === 2" class="space-y-6" x-cloak>
                <h3 class="text-center text-[#2b59c3] text-xl font-extrabold uppercase tracking-widest">Datos del Cliente</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Nombre:</label>
                        <input type="text" name="nombre_cliente" placeholder="Nombre completo" class="w-full p-2 border-2 border-blue-100 rounded-md text-sm focus:border-blue-500 focus:outline-none placeholder-gray-300">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Teléfono:</label>
                        <input type="text" name="telefono_cliente" placeholder="+52 000-000-0000" class="w-full p-2 border-2 border-blue-100 rounded-md text-sm focus:border-blue-500 focus:outline-none placeholder-gray-300">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#2b59c3] uppercase mb-1.5">Dirección:</label>
                        <input type="text" name="direccion_cliente" placeholder="C. 20 x 20 y 50" class="w-full p-2 border-2 border-blue-100 rounded-md text-sm focus:border-blue-500 focus:outline-none placeholder-gray-300">
                    </div>
                </div>

                <div class="pt-4 space-y-4">
                    
                    <div x-show="!mecanicoConfirmado" class="max-w-md mx-auto text-center space-y-3">
                        <h4 class="text-[#2b59c3] font-extrabold text-sm uppercase tracking-wider">A asignar mecánico</h4>
                        <div class="flex items-center justify-center gap-3">
                            <button type="button" @click="step = 3" class="w-full py-2.5 bg-[#2b59c3] hover:bg-blue-700 text-white font-bold rounded text-sm uppercase tracking-wide transition flex items-center justify-center gap-2 shadow-sm">
                                <span>Asignar</span>
                                <span class="bg-white/20 px-1 py-0.2 rounded text-xs">+</span>
                            </button>
                            <div class="text-red-500 animate-pulse">
                                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div x-show="mecanicoConfirmado" class="max-w-xl mx-auto space-y-3" x-cloak>
                        <h4 class="text-center text-[#2b59c3] font-extrabold text-xs uppercase tracking-wider">Mecánico Asignado</h4>
                        
                        <div class="border-2 border-blue-600 rounded-3xl p-4 flex items-center justify-between bg-white shadow-sm">
                            <div class="flex items-center gap-4 w-2/3">
                                <div class="w-14 h-14 rounded-full bg-orange-100 border border-orange-300 flex items-center justify-center text-xl">👤</div>
                                <div class="text-xs text-gray-700 space-y-0.5">
                                    <p><strong>Mecánico:</strong> <span x-text="mecanicoConfirmado ? mecanicoConfirmado.nombre : ''"></span></p>
                                    <p><strong>Estado:</strong> <span class="text-green-600 font-bold" x-text="mecanicoConfirmado ? mecanicoConfirmado.estado : ''"></span></p>
                                    <p class="text-gray-400">Trabajos este mes: <span x-text="mecanicoConfirmado ? mecanicoConfirmado.trabajos : ''"></span></p>
                                </div>
                            </div>
                            <div class="w-1/3 border-l border-gray-200 pl-4 flex flex-col justify-between items-center h-full">
                                <div class="text-center text-xs text-gray-600 space-y-1 mb-2">
                                    <p><strong>Especialidad:</strong> <span x-text="mecanicoConfirmado ? mecanicoConfirmado.especialidad : ''"></span></p>
                                    <p class="text-gray-400">Carros Asignados: <span x-text="mecanicoConfirmado ? mecanicoConfirmado.carros : ''"></span></p>
                                </div>
                                <button type="button" @click="step = 3" class="px-5 py-1 border border-blue-500 text-blue-600 font-bold rounded-full text-[10px] uppercase tracking-wider hover:bg-blue-50 transition">Cambiar</button>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" @click="step = 1" class="px-8 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded text-xs uppercase tracking-wider transition shadow-sm">Cancelar</button>
                    <button type="submit" class="px-8 py-2 border-2 border-blue-600 text-blue-600 font-bold rounded text-xs uppercase tracking-wider transition bg-white hover:bg-blue-50 shadow-sm">Agregar</button>
                </div>
            </div>

            <div x-show="step === 3" class="space-y-6" x-cloak>
                
                <div class="flex justify-between items-center border-b pb-2">
                    <h3 class="text-[#2b59c3] text-lg font-extrabold uppercase tracking-wider">A Asignar Mecánico</h3>
                    
                    <div class="flex gap-4 text-xs font-bold uppercase tracking-wider">
                        <button type="button" @click="filtroMecanico = 'todos'" :class="filtroMecanico === 'todos' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-400'">Todos</button>
                        <button type="button" @click="filtroMecanico = 'ocupado'" :class="filtroMecanico === 'ocupado' ? 'text-red-500 border-b-2 border-red-500' : 'text-gray-400'">Ocupado</button>
                        <button type="button" @click="filtroMecanico = 'disponible'" :class="filtroMecanico === 'disponible' ? 'text-green-500 border-b-2 border-green-500' : 'text-gray-400'">Disponible</button>
                    </div>
                </div>

                <div class="space-y-4 max-h-[380px] overflow-y-auto pr-2">
                    
                    <div x-show="filtroMecanico === 'todos' || filtroMecanico === 'ocupado'"
                         class="border-2 rounded-3xl p-4 flex items-center justify-between transition relative bg-gray-50/50 border-gray-200 opacity-75">
                        
                        <span class="absolute top-0 right-28 transform -translate-y-1/2 px-4 py-0.5 bg-red-700 text-white text-[10px] font-bold rounded-full uppercase tracking-wider shadow">Ocupado</span>

                        <div class="flex items-center gap-4 w-5/12">
                            <div class="w-14 h-14 rounded-full bg-gray-200 border border-gray-300 flex items-center justify-center text-xl grayscale">👤</div>
                            <div class="text-xs text-gray-700 space-y-0.5">
                                <p><strong>Mecánico:</strong> Carlos Mendoza</p>
                                <p><strong>Estado:</strong> <span class="text-red-600 font-bold">[OCUPADO]</span></p>
                                <p class="text-gray-400">Trabajos este mes: 14</p>
                            </div>
                        </div>

                        <div class="w-4/12 border-l border-gray-200 pl-4 space-y-1">
                            <p class="text-xs text-gray-700"><strong>Especialidad:</strong> Frenos</p>
                            <p class="text-xs text-gray-400">Carros Asignados: 05</p>
                            <button type="button" class="px-4 py-0.5 border border-gray-300 text-gray-400 rounded-full text-[9px] font-bold uppercase tracking-wider bg-white cursor-not-allowed">Detalles</button>
                        </div>

                        <div class="w-3/12 flex items-center justify-end gap-6">
                            <span class="text-gray-400 text-3xl grayscale">🚗</span>
                            <div class="text-red-500 pr-1">
                                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0114 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div x-show="filtroMecanico === 'todos' || filtroMecanico === 'disponible'"
                         class="border-2 rounded-3xl p-4 flex items-center justify-between transition relative bg-white"
                         :class="mecanicoSeleccionado?.id === 2 ? 'border-blue-600 bg-blue-50/20' : 'border-blue-200 shadow-sm'">
                        
                        <span class="absolute top-0 right-28 transform -translate-y-1/2 px-4 py-0.5 bg-green-500 text-white text-[10px] font-bold rounded-full uppercase tracking-wider shadow">Disponible</span>

                        <div class="flex items-center gap-4 w-5/12">
                            <div class="w-14 h-14 rounded-full bg-blue-50 border border-blue-200 flex items-center justify-center text-xl">👤</div>
                            <div class="text-xs text-gray-700 space-y-0.5">
                                <p><strong>Mecánico:</strong> Alejandro Ruiz</p>
                                <p><strong>Estado:</strong> <span class="text-green-600 font-bold">[DISPONIBLE]</span></p>
                                <p class="text-gray-400">Trabajos este mes: 10</p>
                            </div>
                        </div>

                        <div class="w-4/12 border-l border-gray-200 pl-4 space-y-1">
                            <p class="text-xs text-gray-700"><strong>Especialidad:</strong> Motores</p>
                            <p class="text-xs text-gray-400">Carros Asignados: 01</p>
                            <button type="button" class="px-4 py-0.5 border border-blue-400 text-blue-500 rounded-full text-[9px] font-bold uppercase tracking-wider hover:bg-blue-50">Detalles</button>
                        </div>

                        <div class="w-3/12 flex items-center justify-end gap-6">
                            <span class="text-blue-700 text-3xl">🚗</span>
                            <label class="cursor-pointer">
                                <input type="radio" name="mecanico_radio" @click="mecanicoSeleccionado = {id: 2, nombre: 'Alejandro Ruiz', estado: '[DISPONIBLE]', trabajos: 10, especialidad: 'Motores', carros: '01'}" class="w-5 h-5 text-blue-600 border-2 border-gray-300 focus:ring-blue-500">
                            </label>
                        </div>
                    </div>

                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="step = 2" class="px-8 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded text-xs uppercase tracking-wider transition shadow-sm">Cancelar</button>
                    <button type="button" @click="if(mecanicoSeleccionado) { mecanicoConfirmado = mecanicoSeleccionado; step = 2; }" class="px-8 py-2 bg-[#2b59c3] hover:bg-blue-700 text-white font-bold rounded text-xs uppercase tracking-wider transition shadow-sm">Asignar</button>
                </div>
            </div>

            <div class="flex justify-center items-center gap-2 pt-2" x-show="step !== 3">
                <button type="button" @click="step = 1" :class="step === 1 ? 'bg-[#2b59c3] text-white' : 'border border-gray-300 text-gray-600'" class="w-6 h-6 rounded text-xs font-bold flex items-center justify-center transition shadow-sm">1</button>
                <button type="button" @click="step = 2" :class="step === 2 ? 'bg-[#2b59c3] text-white' : 'border border-gray-300 text-gray-600'" class="w-6 h-6 rounded text-xs font-bold flex items-center justify-center transition shadow-sm">2</button>
            </div>
        </form>
    </div>

    <style>
        [x-cloak] { display: none !important; }
        .lines-bg {
            line-height: 1.75rem;
            background-image: linear-gradient(transparent, transparent 27px, #e2e8f0 27px, #e2e8f0 28px, transparent 28px);
            background-size: 100% 28px;
        }
    </style>
</body>
</html>