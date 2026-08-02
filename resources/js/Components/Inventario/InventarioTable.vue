<template>
  <div class="p-8 bg-gray-50 min-h-screen">

    <!-- Título Principal -->
    <h1 class="inventario-titulo">
      INVENTARIO
    </h1>

    <!-- Contenedor Principal -->
    <div class="inventario-contenedor">

      <!-- Encabezado -->
      <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-semibold text-blue-900">
          Lista de material en inventario
        </h2>

        <div class="relative w-1/3 flex items-center gap-2">
          <input
            v-model="buscar"
            @input="onBuscarInput"
            type="text"
            placeholder="Buscar por / Marca / Id / Nombre de pieza"
            class="w-full border border-blue-300 rounded-full py-2 px-4 text-blue-900 focus:ring-2 focus:ring-blue-400 outline-none"
          >
          <font-awesome-icon v-if="buscando" :icon="faSpinner" class="h-5 w-5 text-blue-600 shrink-0 animate-spin" />
        </div>

      </div>

      <!-- Tabla -->
      <table class="w-full border-collapse border border-blue-300 mb-8">

        <thead>
          <tr class="bg-blue-50 text-blue-900">
            <th class="border border-blue-300 p-3">ID</th>
            <th class="border border-blue-300 p-3">Nombre de Pieza</th>
            <th class="border border-blue-300 p-3">Cantidad</th>
            <th class="border border-blue-300 p-3">Marca</th>
            <th class="border border-blue-300 p-3">Estado</th>
            <th class="border border-blue-300 p-3">Acciones</th>
          </tr>
        </thead>

        <tbody>
          <!-- Animación de carga: ocupa todo el cuerpo de la tabla, menos el encabezado -->
          <tr v-if="cargando">
            <td colspan="6" class="border border-blue-300 p-3" style="height: 240px;">
              <div class="flex items-center justify-center h-full">
                <div class="puntos-cargando">
                  <span></span><span></span><span></span>
                </div>
              </div>
            </td>
          </tr>

          <tr v-else-if="items.length === 0" class="text-center text-blue-800">
            <td colspan="6" class="border border-blue-300 p-3">Sin material registrado</td>
          </tr>

          <tr v-for="item in items" v-else :key="item.id" class="text-center text-blue-800">

            <td class="border border-blue-300 p-3">
              {{ String(item.id).padStart(2, '0') }}
            </td>

            <td class="border border-blue-300 p-3">
              <div class="flex items-center justify-center gap-2">
                <font-awesome-icon :icon="obtenerIcono(item.nombre)" class="h-4 w-4 text-blue-700 shrink-0" />
                {{ item.nombre }}
              </div>
            </td>

            <td class="border border-blue-300 p-3">
              {{ item.cantidad }} pz
            </td>

            <td class="border border-blue-300 p-3">
              {{ item.marca }}
            </td>

            <td class="border border-blue-300 p-3" :class="estadoStock(item.cantidad).color">
              {{ estadoStock(item.cantidad).texto }}
            </td>

            <td class="border border-blue-300 p-3">
              <button class="inventario-btn-editar inline-flex items-center gap-1" @click="abrirModalEditar(item)" title="Editar">
                <font-awesome-icon :icon="faPen" class="h-4 w-4" />
                Editar
              </button>
              <button class="inventario-btn-eliminar inline-flex items-center gap-1" @click="pedirConfirmacionEliminar(item)" title="Eliminar">
                <font-awesome-icon :icon="faTrash" class="h-4 w-4" />
                Eliminar
              </button>
            </td>

          </tr>
        </tbody>

      </table>

      <!-- ===================== Botones para abrir los formularios (alineados uno junto al otro) ===================== -->
      <div class="border-t border-blue-200 pt-6 flex flex-wrap items-center gap-4">
        <button
          @click="abrirModalCantidad"
          class="inventario-btn-agregar inline-flex items-center gap-2"
        >
          <font-awesome-icon :icon="faPlus" class="h-4 w-4" />
          Agregar cantidad a material
        </button>

        <button
          @click="abrirModalNuevo"
          class="inventario-btn-agregar-material inline-flex items-center gap-2"
        >
          <font-awesome-icon :icon="faPlus" class="h-4 w-4" />
          Agregar nuevo material
        </button>
      </div>

    </div>

    <!-- ===================== HOJA INFERIOR: Agregar cantidad a material existente ===================== -->
    <transition name="hoja">
      <div v-if="modalCantidadAbierto" class="fixed inset-0 bg-black/50 flex items-end justify-center z-50" @click.self="cerrarModalCantidad">
        <div class="bg-white rounded-t-2xl shadow-2xl w-full max-w-lg p-6 relative border-t-4 border-blue-400">
          <div class="w-12 h-1.5 bg-blue-200 rounded-full mx-auto mb-4"></div>

          <button @click="cerrarModalCantidad" class="absolute top-4 right-4 text-blue-400 hover:text-blue-700">
            <font-awesome-icon :icon="faXmark" class="h-5 w-5" />
          </button>

          <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center gap-2">
            <font-awesome-icon :icon="faPlus" class="h-4 w-4" />
            Agregar cantidad a material
          </h3>

          <div class="space-y-3">
            <div class="flex items-center gap-4">
              <label class="w-20 text-blue-900">Id:</label>
              <input v-model="formCantidad.id" type="number" :class="inputClase" class="flex-1">
            </div>
            <div class="flex items-center gap-4">
              <label class="w-20 text-blue-900">Cantidad:</label>
              <input v-model.number="formCantidad.cantidad" type="number" :class="inputClase" class="flex-1">
            </div>
          </div>

          <div class="flex gap-2 justify-end mt-6">
            <button class="inventario-btn-cancelar-material" @click="cerrarModalCantidad">Cancelar</button>
            <button class="inventario-btn-agregar inline-flex items-center gap-2" @click="sumarCantidad" :disabled="agregandoCantidad">
              <font-awesome-icon v-if="agregandoCantidad" :icon="faSpinner" class="h-4 w-4 animate-spin" />
              {{ agregandoCantidad ? 'Agregando...' : 'Agregar' }}
            </button>
          </div>
        </div>
      </div>
    </transition>

    <!-- ===================== HOJA INFERIOR: Agregar nuevo material ===================== -->
    <transition name="hoja">
      <div v-if="modalNuevoAbierto" class="fixed inset-0 bg-black/50 flex items-end justify-center z-50" @click.self="cerrarModalNuevo">
        <div class="bg-white rounded-t-2xl shadow-2xl w-full max-w-lg p-6 relative border-t-4 border-blue-400">
          <div class="w-12 h-1.5 bg-blue-200 rounded-full mx-auto mb-4"></div>

          <button @click="cerrarModalNuevo" class="absolute top-4 right-4 text-blue-400 hover:text-blue-700">
            <font-awesome-icon :icon="faXmark" class="h-5 w-5" />
          </button>

          <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center gap-2">
            <font-awesome-icon :icon="faPlus" class="h-4 w-4" />
            Agregar nuevo material
          </h3>

          <div class="space-y-3">

            <div class="relative">
              <label class="block text-blue-900 mb-1">Nombre:</label>
              <input
                v-model="formNuevo.nombre"
                @input="onNombreInput"
                @keydown="onNombreKeydown"
                @focus="actualizarSugerencias"
                @blur="ocultarSugerenciasConRetraso"
                type="text"
                autocomplete="off"
                :class="inputClase"
                class="w-full"
              >
              <ul
                v-if="mostrarSugerencias && sugerencias.length"
                class="absolute z-10 bg-white border border-blue-300 rounded w-full mt-1 max-h-48 overflow-y-auto shadow-lg"
              >
                <li
                  v-for="(sug, idx) in sugerencias"
                  :key="sug.nombre"
                  @mousedown.prevent="seleccionarSugerencia(sug)"
                  class="px-3 py-1.5 flex items-center gap-2 cursor-pointer text-sm text-blue-900"
                  :class="idx === sugerenciaActiva ? 'bg-blue-100' : 'hover:bg-blue-50'"
                >
                  <font-awesome-icon :icon="sug.icono" class="h-4 w-4 text-blue-700 shrink-0" />
                  {{ sug.nombre }}
                </li>
              </ul>
            </div>

            <div>
              <label class="block text-blue-900 mb-1">Marca:</label>
              <input v-model="formNuevo.marca" type="text" :class="inputClase" class="w-full">
            </div>

            <div>
              <label class="block text-blue-900 mb-1">Cantidad:</label>
              <input v-model.number="formNuevo.cantidad" type="number" :class="inputClase" class="w-full">
            </div>
          </div>

          <div class="flex gap-2 justify-end mt-6">
            <button class="inventario-btn-cancelar-material" @click="cerrarModalNuevo">Cancelar</button>
            <button class="inventario-btn-agregar-material inline-flex items-center gap-2" @click="guardarNuevo" :disabled="agregandoNuevo">
              <font-awesome-icon v-if="agregandoNuevo" :icon="faSpinner" class="h-4 w-4 animate-spin" />
              {{ agregandoNuevo ? 'Agregando...' : 'Agregar' }}
            </button>
          </div>
        </div>
      </div>
    </transition>

    <!-- ===================== MODAL: Editar material existente ===================== -->
    <transition name="modal">
      <div v-if="modalEditarAbierto" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" @click.self="cerrarModalEditar">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 relative border border-blue-200">

          <button @click="cerrarModalEditar" class="absolute top-4 right-4 text-blue-400 hover:text-blue-700">
            <font-awesome-icon :icon="faXmark" class="h-5 w-5" />
          </button>

          <h3 class="text-xl font-bold text-blue-900 mb-4 flex items-center gap-2">
            <font-awesome-icon :icon="faPen" class="h-4 w-4" />
            Editar material existente
          </h3>

          <div class="space-y-3">
            <div>
              <label class="block text-blue-900 mb-1">Nombre:</label>
              <input v-model="formEditar.nombre" type="text" :class="inputClase" class="w-full">
            </div>
            <div>
              <label class="block text-blue-900 mb-1">Marca:</label>
              <input v-model="formEditar.marca" type="text" :class="inputClase" class="w-full">
            </div>
            <div>
              <label class="block text-blue-900 mb-1">Cantidad:</label>
              <input v-model.number="formEditar.cantidad" type="number" :class="inputClase" class="w-full">
            </div>
          </div>

          <div class="flex gap-2 justify-end mt-6">
            <button class="inventario-btn-cancelar-material" @click="cerrarModalEditar">Cancelar</button>
            <button class="inventario-btn-agregar-material inline-flex items-center gap-2" @click="guardarEdicion" :disabled="guardandoEdicion">
              <font-awesome-icon v-if="guardandoEdicion" :icon="faSpinner" class="h-4 w-4 animate-spin" />
              {{ guardandoEdicion ? 'Guardando...' : 'Guardar' }}
            </button>
          </div>

        </div>
      </div>
    </transition>

    <!-- ===================== MODAL: Confirmar eliminación ===================== -->
    <transition name="modal">
      <div v-if="modalEliminarAbierto" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50" @click.self="cancelarEliminar">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm p-6 relative border border-blue-200 text-center">

          <button @click="cancelarEliminar" class="absolute top-4 right-4 text-blue-400 hover:text-blue-700">
            <font-awesome-icon :icon="faXmark" class="h-5 w-5" />
          </button>

          <font-awesome-icon :icon="faTriangleExclamation" class="h-10 w-10 text-blue-500 mx-auto mb-3" />

          <h3 class="text-lg font-bold text-blue-900 mb-2">¿Eliminar material?</h3>
          <p class="text-blue-700 mb-6">
            Esta acción no se puede deshacer<span v-if="itemAEliminar">: "{{ itemAEliminar.nombre }}"</span>.
          </p>

          <div class="flex gap-2 justify-center">
            <button class="inventario-btn-cancelar-material" @click="cancelarEliminar">Cancelar</button>
            <button class="inventario-btn-eliminar inline-flex items-center gap-1" @click="confirmarEliminar" :disabled="eliminando">
              <font-awesome-icon v-if="eliminando" :icon="faSpinner" class="h-4 w-4 animate-spin" />
              <font-awesome-icon v-else :icon="faTrash" class="h-4 w-4" />
              {{ eliminando ? 'Eliminando...' : 'Eliminar' }}
            </button>
          </div>

        </div>
      </div>
    </transition>

    <!-- ===================== Notificación tipo pestañita ===================== -->
    <transition name="toast">
      <div
        v-if="mensaje"
        class="fixed bottom-6 right-6 z-[70] flex items-center gap-3 rounded-full px-5 py-3 shadow-xl border-2 bg-white"
        :class="esError ? 'border-red-400' : 'border-blue-400'"
      >
        <font-awesome-icon
          :icon="esError ? faCircleXmark : faCircleCheck"
          class="h-5 w-5"
          :class="esError ? 'text-red-500' : 'text-blue-500'"
        />
        <span class="font-semibold" :class="esError ? 'text-red-700' : 'text-blue-900'">{{ mensaje }}</span>
      </div>
    </transition>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import 'animate.css'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import {
  faSpinner, faPen, faTrash, faPlus, faXmark, faTriangleExclamation,
  faCircleCheck, faCircleXmark,
  faBolt, faFilter, faOilCan, faCarBattery, faCompactDisc,
  faCircleDot, faLink, faDroplet, faTemperatureHalf,
  faArrowsUpDown, faScrewdriverWrench,
} from '@fortawesome/free-solid-svg-icons'

const API_URL = 'api/inventario'

// Clase base compartida para que todos los inputs se vean azules y consistentes
const inputClase = 'border border-blue-300 rounded p-2 text-blue-900 bg-white focus:ring-2 focus:ring-blue-400 outline-none'

// Catálogo de refacciones comunes de taller: nombre + palabras clave + icono
const catalogoPartes = [
  { nombre: 'Bujías', claves: ['bujia', 'bujía', 'bugia'], icono: faBolt },
  { nombre: 'Filtro de aceite', claves: ['filtro de aceite'], icono: faFilter },
  { nombre: 'Filtro de aire', claves: ['filtro de aire'], icono: faFilter },
  { nombre: 'Filtro de gasolina', claves: ['filtro de gasolina', 'filtro de combustible'], icono: faFilter },
  { nombre: 'Aceite de motor', claves: ['aceite'], icono: faOilCan },
  { nombre: 'Batería', claves: ['bateria', 'batería', 'acumulador'], icono: faCarBattery },
  { nombre: 'Balatas delanteras', claves: ['balata', 'pastilla de freno'], icono: faCompactDisc },
  { nombre: 'Disco de freno', claves: ['disco de freno', 'disco'], icono: faCompactDisc },
  { nombre: 'Llanta', claves: ['llanta', 'neumatico', 'neumático'], icono: faCircleDot },
  { nombre: 'Rin', claves: ['rin'], icono: faCircleDot },
  { nombre: 'Banda de distribución', claves: ['banda', 'correa'], icono: faLink },
  { nombre: 'Bomba de agua', claves: ['bomba de agua'], icono: faDroplet },
  { nombre: 'Bomba de gasolina', claves: ['bomba de gasolina', 'bomba de combustible'], icono: faDroplet },
  { nombre: 'Radiador', claves: ['radiador'], icono: faTemperatureHalf },
  { nombre: 'Amortiguador delantero', claves: ['amortiguador'], icono: faArrowsUpDown },
  { nombre: 'Termostato', claves: ['termostato'], icono: faTemperatureHalf },
]

function obtenerIcono(nombre) {
  const texto = (nombre || '').toLowerCase()
  const match = catalogoPartes.find((p) => p.claves.some((clave) => texto.includes(clave)))
  return match ? match.icono : faScrewdriverWrench
}

const items = ref([])
const cargando = ref(false)
const buscando = ref(false)
const buscar = ref('')
const mensaje = ref('')
const esError = ref(false)
let toastTimer = null

const modalCantidadAbierto = ref(false)
const modalNuevoAbierto = ref(false)
const agregandoCantidad = ref(false)
const agregandoNuevo = ref(false)

const formCantidad = ref({ id: '', cantidad: '' })
const formNuevo = ref({ nombre: '', marca: '', cantidad: '' })

// Modal de edición
const modalEditarAbierto = ref(false)
const guardandoEdicion = ref(false)
const editandoId = ref(null)
const formEditar = ref({ nombre: '', marca: '', cantidad: '' })

// Modal de confirmación de eliminación
const modalEliminarAbierto = ref(false)
const eliminando = ref(false)
const itemAEliminar = ref(null)

// Autocompletado (solo para el formulario de nuevo material)
const sugerencias = ref([])
const mostrarSugerencias = ref(false)
const sugerenciaActiva = ref(-1)

function actualizarSugerencias() {
  const texto = formNuevo.value.nombre.trim().toLowerCase()
  if (!texto) {
    sugerencias.value = catalogoPartes.slice(0, 6)
  } else {
    sugerencias.value = catalogoPartes
      .filter((p) => p.nombre.toLowerCase().includes(texto) || p.claves.some((c) => c.includes(texto)))
      .slice(0, 6)
  }
  mostrarSugerencias.value = sugerencias.value.length > 0
  sugerenciaActiva.value = -1
}

function onNombreInput() {
  actualizarSugerencias()
}

function seleccionarSugerencia(sug) {
  formNuevo.value.nombre = sug.nombre
  mostrarSugerencias.value = false
}

function onNombreKeydown(e) {
  if (!mostrarSugerencias.value || sugerencias.value.length === 0) return

  if (e.key === 'ArrowDown') {
    e.preventDefault()
    sugerenciaActiva.value = (sugerenciaActiva.value + 1) % sugerencias.value.length
  } else if (e.key === 'ArrowUp') {
    e.preventDefault()
    sugerenciaActiva.value = (sugerenciaActiva.value - 1 + sugerencias.value.length) % sugerencias.value.length
  } else if (e.key === 'Enter') {
    e.preventDefault()
    const elegido = sugerenciaActiva.value >= 0 ? sugerencias.value[sugerenciaActiva.value] : sugerencias.value[0]
    seleccionarSugerencia(elegido)
  } else if (e.key === 'Escape') {
    mostrarSugerencias.value = false
  }
}

function ocultarSugerenciasConRetraso() {
  setTimeout(() => (mostrarSugerencias.value = false), 150)
}

function mostrarMensaje(texto, error = false) {
  clearTimeout(toastTimer)
  mensaje.value = texto
  esError.value = error
  toastTimer = setTimeout(() => (mensaje.value = ''), 3000)
}

function estadoStock(cantidad) {
  if (cantidad > 20) return { texto: 'Alto ⌃', color: 'text-green-600' }
  if (cantidad > 5) return { texto: 'Medio', color: 'text-yellow-600' }
  return { texto: 'Bajo ⌄', color: 'text-red-600' }
}

let debounceTimer = null

function onBuscarInput() {
  buscando.value = true
  cargando.value = true
  clearTimeout(debounceTimer)
  debounceTimer = setTimeout(() => {
    fetchInventario()
  }, 350)
}

// GET
async function fetchInventario() {
  cargando.value = true
  try {
    const { data } = await axios.get(API_URL, { params: { buscar: buscar.value } })
    items.value = data.data
  } catch (e) {
    mostrarMensaje('Error al cargar el inventario', true)
  } finally {
    cargando.value = false
    buscando.value = false
  }
}

// Abrir / cerrar hoja inferior: cantidad
function abrirModalCantidad() {
  modalCantidadAbierto.value = true
}
function cerrarModalCantidad() {
  modalCantidadAbierto.value = false
  resetFormCantidad()
}

// Abrir / cerrar hoja inferior: nuevo material
function abrirModalNuevo() {
  modalNuevoAbierto.value = true
}
function cerrarModalNuevo() {
  modalNuevoAbierto.value = false
  mostrarSugerencias.value = false
  resetFormNuevo()
}

// POST (crear nuevo material)
async function guardarNuevo() {
  if (!formNuevo.value.nombre || formNuevo.value.cantidad === '') {
    mostrarMensaje('Nombre y cantidad son obligatorios', true)
    return
  }

  agregandoNuevo.value = true
  try {
    await axios.post(API_URL, formNuevo.value)
    mostrarMensaje('Material agregado con éxito')
    cerrarModalNuevo()
    fetchInventario()
  } catch (e) {
    mostrarMensaje('Error al guardar el material', true)
  } finally {
    agregandoNuevo.value = false
  }
}

function resetFormNuevo() {
  formNuevo.value = { nombre: '', marca: '', cantidad: '' }
}

// Modal de edición
function abrirModalEditar(item) {
  editandoId.value = item.id
  formEditar.value = { nombre: item.nombre, marca: item.marca, cantidad: item.cantidad }
  modalEditarAbierto.value = true
}

function cerrarModalEditar() {
  modalEditarAbierto.value = false
  editandoId.value = null
}

// PUT (guardar edición desde el modal)
async function guardarEdicion() {
  if (!formEditar.value.nombre || formEditar.value.cantidad === '') {
    mostrarMensaje('Nombre y cantidad son obligatorios', true)
    return
  }

  guardandoEdicion.value = true
  try {
    await axios.put(`${API_URL}/${editandoId.value}`, formEditar.value)
    mostrarMensaje('Material actualizado con éxito')
    cerrarModalEditar()
    fetchInventario()
  } catch (e) {
    mostrarMensaje('Error al actualizar el material', true)
  } finally {
    guardandoEdicion.value = false
  }
}

// PUT (sumar cantidad a un item existente por id)
async function sumarCantidad() {
  const id = formCantidad.value.id
  const extra = Number(formCantidad.value.cantidad)

  if (!id || !extra) {
    mostrarMensaje('Ingresa un ID y una cantidad válida', true)
    return
  }

  const actual = items.value.find((i) => i.id == id)
  if (!actual) {
    mostrarMensaje('No existe un material con ese ID', true)
    return
  }

  agregandoCantidad.value = true
  try {
    await axios.put(`${API_URL}/${id}`, { cantidad: actual.cantidad + extra })
    mostrarMensaje('Cantidad actualizada con éxito')
    cerrarModalCantidad()
    fetchInventario()
  } catch (e) {
    mostrarMensaje('Error al actualizar cantidad', true)
  } finally {
    agregandoCantidad.value = false
  }
}

function resetFormCantidad() {
  formCantidad.value = { id: '', cantidad: '' }
}

// Confirmación de eliminación (con el mismo diseño en vez del confirm() del navegador)
function pedirConfirmacionEliminar(item) {
  itemAEliminar.value = item
  modalEliminarAbierto.value = true
}

function cancelarEliminar() {
  modalEliminarAbierto.value = false
  itemAEliminar.value = null
}

// DELETE
async function confirmarEliminar() {
  if (!itemAEliminar.value) return

  eliminando.value = true
  try {
    await axios.delete(`${API_URL}/${itemAEliminar.value.id}`)
    mostrarMensaje('Material eliminado con éxito')
    modalEliminarAbierto.value = false
    itemAEliminar.value = null
    fetchInventario()
  } catch (e) {
    mostrarMensaje('Error al eliminar el material', true)
  } finally {
    eliminando.value = false
  }
}

onMounted(fetchInventario)
</script>

<style scoped>
.animate-spin {
  animation: girar 1s linear infinite;
}
@keyframes girar {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

/* Animación de carga: 3 puntos rebotando, centrados en la tabla */
.puntos-cargando {
  display: flex;
  gap: 10px;
}
.puntos-cargando span {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background-color: #2563eb; /* blue-600 */
  animation: rebote 1.4s ease-in-out infinite;
}
.puntos-cargando span:nth-child(2) { animation-delay: 0.2s; }
.puntos-cargando span:nth-child(3) { animation-delay: 0.4s; }
@keyframes rebote {
  0%, 80%, 100% { transform: scale(0.6); opacity: 0.5; }
  40% { transform: scale(1); opacity: 1; }
}

/* Hoja inferior (bottom sheet) para los formularios */
.hoja-enter-active,
.hoja-leave-active {
  transition: opacity 0.25s ease;
}
.hoja-enter-from,
.hoja-leave-to {
  opacity: 0;
}
.hoja-enter-active > div,
.hoja-leave-active > div {
  transition: transform 0.3s ease;
}
.hoja-enter-from > div,
.hoja-leave-to > div {
  transform: translateY(100%);
}

/* Modal centrado (editar / confirmar eliminación) */
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.2s ease;
}
.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

/* Notificación tipo pestañita */
.toast-enter-active,
.toast-leave-active {
  transition: all 0.3s ease;
}
.toast-enter-from,
.toast-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>
