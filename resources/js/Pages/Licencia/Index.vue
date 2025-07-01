<template>
  <AuthenticatedLayout>
      <Head title="Licencias" />
  
  <div class="min-h-screen bg-gray-100">
    <!-- Header simple -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          Gestión de Licencias
        </h1>
      </div>
    </header>

    <!-- Contenido principal -->
    <main class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            
            <!-- Header con botón crear -->
            <div class="flex justify-between items-center mb-6">
              <h3 class="text-lg font-medium text-gray-900">
                Lista de Licencias
              </h3>
              <Link 
                :href="route('licencias.create')" 
                class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 transition ease-in-out duration-150"
              >
                + Nueva Licencia
              </Link>
            </div>

            <!-- Mensaje de éxito -->
            <div 
              v-if="$page.props.flash?.success" 
              class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
            >
              {{ $page.props.flash.success }}
            </div>

            <!-- Mensaje de error -->
            <div 
              v-if="$page.props.flash?.error" 
              class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded"
            >
              {{ $page.props.flash.error }}
            </div>

            <!-- Tabla de licencias - Responsive -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Código
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Nombre
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Marca
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Categoría
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Precio
                    </th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Características
                    </th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <template v-if="licencias && licencias.length > 0">
                    <tr v-for="licencia in licencias" :key="licencia.id" class="hover:bg-gray-50">
                      <!-- Código -->
                      <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm font-mono text-gray-900">
                          {{ licencia.codigo }}
                        </div>
                      </td>
                      
                      <!-- Nombre -->
                      <td class="px-4 py-4">
                        <div class="text-sm font-medium text-gray-900">
                          {{ licencia.nombre }}
                        </div>
                      </td>
                      
                      <!-- Marca -->
                      <td class="px-4 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                          {{ licencia.marca?.nombre || 'Sin marca' }}
                        </span>
                      </td>
                      
                      <!-- Categoría -->
                      <td class="px-4 py-4 whitespace-nowrap">
                        <span class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                          {{ licencia.categoria?.nombre || 'Sin categoría' }}
                        </span>
                      </td>
                      
                      <!-- Precio -->
                      <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                        <div class="space-y-1">
                          <div class="font-medium">${{ formatPrice(licencia.precio) }}</div>
                          <div v-if="licencia.precio_mayorista" class="text-xs text-gray-500">
                            Mayorista: ${{ formatPrice(licencia.precio_mayorista) }}
                          </div>
                        </div>
                      </td>
                      
                      <!-- Características -->
                      <td class="px-4 py-4 text-center">
                        <div class="flex flex-wrap justify-center gap-1">
                          <span v-if="licencia.trasladable" class="inline-flex px-1 py-0.5 text-xs rounded bg-blue-100 text-blue-800" title="Trasladable">
                            T
                          </span>
                          <span v-if="licencia.deducible" class="inline-flex px-1 py-0.5 text-xs rounded bg-green-100 text-green-800" title="Deducible">
                            D
                          </span>
                          <span v-if="licencia.formateable" class="inline-flex px-1 py-0.5 text-xs rounded bg-yellow-100 text-yellow-800" title="Formateable">
                            F
                          </span>
                          <span v-if="licencia.compra_asistida" class="inline-flex px-1 py-0.5 text-xs rounded bg-purple-100 text-purple-800" title="Compra Asistida">
                            CA
                          </span>
                          <span v-if="licencia.compartida" class="inline-flex px-1 py-0.5 text-xs rounded bg-orange-100 text-orange-800" title="Compartida">
                            C
                          </span>
                        </div>
                      </td>
                      
                      <!-- Acciones -->
                      <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                          <!-- Botón Ver -->
                          <Link 
                            :href="route('licencias.show', licencia.id)"
                            class="px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition"
                          >
                            Ver
                          </Link>
                          
                          <!-- Botón Editar -->
                          <Link 
                            :href="route('licencias.edit', licencia.id)"
                            class="px-2 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600 transition"
                          >
                            Editar
                          </Link>
                          
                          <!-- Botón Eliminar -->
                          <button
                            @click="confirmarEliminacion(licencia)"
                            class="px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition"
                          >
                            Eliminar
                          </button>
                        </div>
                      </td>
                    </tr>
                  </template>
                  
                  <!-- Mensaje cuando no hay licencias -->
                  <template v-else>
                    <tr>
                      <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        <div class="space-y-2">
                          <p>No hay licencias registradas</p>
                          <Link 
                            :href="route('licencias.create')"
                            class="text-purple-600 hover:text-purple-800 underline"
                          >
                            Crear la primera licencia
                          </Link>
                        </div>
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>

            <!-- Leyenda de características -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
              <h4 class="text-sm font-medium text-gray-900 mb-2">Leyenda de características:</h4>
              <div class="flex flex-wrap gap-4 text-xs text-gray-600">
                <span><span class="inline-flex px-1 py-0.5 rounded bg-blue-100 text-blue-800">T</span> = Trasladable</span>
                <span><span class="inline-flex px-1 py-0.5 rounded bg-green-100 text-green-800">D</span> = Deducible</span>
                <span><span class="inline-flex px-1 py-0.5 rounded bg-yellow-100 text-yellow-800">F</span> = Formateable</span>
                <span><span class="inline-flex px-1 py-0.5 rounded bg-purple-100 text-purple-800">CA</span> = Compra Asistida</span>
                <span><span class="inline-flex px-1 py-0.5 rounded bg-orange-100 text-orange-800">C</span> = Compartida</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal de confirmación simple -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
          <h3 class="text-lg font-medium text-gray-900">Eliminar Licencia</h3>
          <div class="mt-2 px-7 py-3">
            <p class="text-sm text-gray-500">
              ¿Estás seguro de que deseas eliminar la licencia "{{ licenciaAEliminar?.nombre }}"?
            </p>
            <p class="text-xs text-red-600 mt-1">
              Esta acción no se puede deshacer.
            </p>
          </div>
          <div class="flex justify-center space-x-3 mt-4">
            <button
              @click="showDeleteModal = false"
              class="px-4 py-2 bg-gray-300 text-gray-800 text-sm rounded hover:bg-gray-400 transition"
            >
              Cancelar
            </button>
            <button
              @click="eliminarLicencia"
              class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition"
            >
              Eliminar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// Props
defineProps({
  licencias: Array
})

// Estado reactivo
const showDeleteModal = ref(false)
const licenciaAEliminar = ref(null)

// Métodos
const formatPrice = (price) => {
  return new Intl.NumberFormat('es-AR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(price)
}

const confirmarEliminacion = (licencia) => {
  licenciaAEliminar.value = licencia
  showDeleteModal.value = true
}

const eliminarLicencia = () => {
  if (licenciaAEliminar.value) {
    router.delete(`/licencias/${licenciaAEliminar.value.id}`)
    showDeleteModal.value = false
    licenciaAEliminar.value = null
  }
}
</script>