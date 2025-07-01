<template>
  <AuthenticatedLayout>
    <Head title="Ver Licencia" />
  
  <div class="min-h-screen bg-gray-100">
    <!-- Header simple -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          Detalles de Licencia
        </h1>
      </div>
    </header>

    <!-- Contenido principal -->
    <main class="py-12">
      <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-6">
          <Link 
            :href="route('licencias.index')"
            class="text-purple-600 hover:text-purple-800"
          >
            ← Volver a Licencias
          </Link>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          
          <!-- Información principal -->
          <div class="lg:col-span-2 space-y-6">
            
            <!-- Header de la licencia -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-6">
                <div class="flex items-start justify-between">
                  <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">
                      {{ licencia.nombre }}
                    </h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                      <span class="font-mono bg-gray-200 px-2 py-1 rounded">
                        {{ licencia.codigo }}
                      </span>
                      <span class="inline-flex px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                        {{ licencia.marca?.nombre || 'Sin marca' }}
                      </span>
                      <span class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                        {{ licencia.categoria?.nombre || 'Sin categoría' }}
                      </span>
                    </div>
                  </div>
                  
                  <!-- Botones de acción -->
                  <div class="flex space-x-2">
                    <Link 
                      :href="route('licencias.edit', licencia.id)"
                      class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition"
                    >
                      Editar
                    </Link>
                    <button
                      @click="confirmarEliminacion"
                      class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition"
                    >
                      Eliminar
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Precios -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información de Precios</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                  
                  <!-- Precio base -->
                  <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm text-gray-600 mb-1">Precio Base</div>
                    <div class="text-2xl font-bold text-purple-600">
                      ${{ formatPrice(licencia.precio) }}
                    </div>
                  </div>

                  <!-- Precio mayorista -->
                  <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm text-gray-600 mb-1">Precio Mayorista</div>
                    <div class="text-2xl font-bold text-blue-600">
                      <span v-if="licencia.precio_mayorista">
                        ${{ formatPrice(licencia.precio_mayorista) }}
                      </span>
                      <span v-else class="text-gray-400">N/A</span>
                    </div>
                  </div>

                  <!-- Precio renovación -->
                  <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-sm text-gray-600 mb-1">Precio Renovación</div>
                    <div class="text-2xl font-bold text-green-600">
                      <span v-if="licencia.precio_renovacion">
                        ${{ formatPrice(licencia.precio_renovacion) }}
                      </span>
                      <span v-else class="text-gray-400">N/A</span>
                    </div>
                  </div>
                </div>

                <!-- Análisis de precios -->
                <div v-if="licencia.precio_mayorista" class="mt-4 p-3 bg-blue-50 rounded-lg">
                  <div class="text-sm text-blue-800">
                    <strong>Descuento mayorista:</strong> 
                    {{ Math.round(((licencia.precio - licencia.precio_mayorista) / licencia.precio) * 100) }}%
                    (Ahorro: ${{ formatPrice(licencia.precio - licencia.precio_mayorista) }})
                  </div>
                </div>
              </div>
            </div>

            <!-- Características detalladas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Características de la Licencia</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  
                  <!-- Características funcionales -->
                  <div>
                    <h4 class="font-medium text-gray-900 mb-3">Funcionalidades</h4>
                    <div class="space-y-2">
                      <div class="flex items-center">
                        <div class="w-4 h-4 mr-3">
                          <svg v-if="licencia.trasladable" class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                          <svg v-else class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                        <span :class="licencia.trasladable ? 'text-green-700' : 'text-red-700'">
                          {{ licencia.trasladable ? 'Licencia trasladable' : 'Licencia no trasladable' }}
                        </span>
                      </div>
                      
                      <div class="flex items-center">
                        <div class="w-4 h-4 mr-3">
                          <svg v-if="licencia.formateable" class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                          <svg v-else class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                        <span :class="licencia.formateable ? 'text-green-700' : 'text-red-700'">
                          {{ licencia.formateable ? 'Permite formateo' : 'No permite formateo' }}
                        </span>
                      </div>

                      <div class="flex items-center">
                        <div class="w-4 h-4 mr-3">
                          <svg v-if="licencia.compartida" class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                          <svg v-else class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                        <span :class="licencia.compartida ? 'text-green-700' : 'text-red-700'">
                          {{ licencia.compartida ? 'Licencia compartida' : 'Licencia individual' }}
                        </span>
                      </div>
                    </div>
                  </div>

                  <!-- Características comerciales -->
                  <div>
                    <h4 class="font-medium text-gray-900 mb-3">Aspectos Comerciales</h4>
                    <div class="space-y-2">
                      <div class="flex items-center">
                        <div class="w-4 h-4 mr-3">
                          <svg v-if="licencia.deducible" class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                          <svg v-else class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                        <span :class="licencia.deducible ? 'text-green-700' : 'text-red-700'">
                          {{ licencia.deducible ? 'Deducible de impuestos' : 'No deducible' }}
                        </span>
                      </div>

                      <div class="flex items-center">
                        <div class="w-4 h-4 mr-3">
                          <svg v-if="licencia.compra_asistida" class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                          </svg>
                          <svg v-else class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                          </svg>
                        </div>
                        <span :class="licencia.compra_asistida ? 'text-green-700' : 'text-red-700'">
                          {{ licencia.compra_asistida ? 'Compra con asistencia' : 'Compra independiente' }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sidebar con información adicional -->
          <div class="space-y-6">
            
            <!-- Información técnica -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información del Sistema</h3>
                <div class="space-y-3 text-sm">
                  <div class="flex justify-between">
                    <span class="text-gray-600">ID:</span>
                    <span class="font-medium">{{ licencia.id }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">Creada:</span>
                    <span class="font-medium">{{ formatDate(licencia.created_at) }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">Actualizada:</span>
                    <span class="font-medium">{{ formatDate(licencia.updated_at) }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">Estado:</span>
                    <span class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                      Activa
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Resumen de características -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Resumen de Características</h3>
                <div class="flex flex-wrap gap-2">
                  <span v-if="licencia.trasladable" class="inline-flex px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                    Trasladable
                  </span>
                  <span v-if="licencia.deducible" class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                    Deducible
                  </span>
                  <span v-if="licencia.formateable" class="inline-flex px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">
                    Formateable
                  </span>
                  <span v-if="licencia.compra_asistida" class="inline-flex px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800">
                    Compra Asistida
                  </span>
                  <span v-if="licencia.compartida" class="inline-flex px-2 py-1 text-xs rounded-full bg-orange-100 text-orange-800">
                    Compartida
                  </span>
                  
                  <!-- Mensaje si no tiene características -->
                  <span v-if="!hasAnyFeature" class="text-gray-500 text-sm">
                    Sin características especiales
                  </span>
                </div>
              </div>
            </div>

            <!-- Acciones rápidas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                  <Link 
                    :href="route('licencias.edit', licencia.id)"
                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 transition"
                  >
                    Editar Licencia
                  </Link>
                  
                  <button
                    @click="confirmarEliminacion"
                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 transition"
                  >
                    Eliminar Licencia
                  </button>
                  
                  <Link 
                    :href="route('licencias.create')"
                    class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition"
                  >
                    Crear Similar
                  </Link>
                </div>
              </div>
            </div>

            <!-- Información de relaciones -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Relaciones</h3>
                <div class="space-y-3">
                  <div>
                    <span class="text-sm text-gray-600">Marca:</span>
                    <div class="mt-1">
                      <span class="inline-flex px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                        {{ licencia.marca?.nombre || 'Sin marca asignada' }}
                      </span>
                    </div>
                  </div>
                  
                  <div>
                    <span class="text-sm text-gray-600">Categoría:</span>
                    <div class="mt-1">
                      <span class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                        {{ licencia.categoria?.nombre || 'Sin categoría asignada' }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal de confirmación de eliminación -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
          <h3 class="text-lg font-medium text-gray-900">Eliminar Licencia</h3>
          <div class="mt-2 px-7 py-3">
            <p class="text-sm text-gray-500">
              ¿Estás seguro de que deseas eliminar la licencia "{{ licencia.nombre }}"?
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
import { ref, computed } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// Props
const props = defineProps({
  licencia: Object
})

// Estado reactivo
const showDeleteModal = ref(false)

// Computed properties
const hasAnyFeature = computed(() => {
  return props.licencia.trasladable || 
         props.licencia.deducible || 
         props.licencia.formateable || 
         props.licencia.compra_asistida || 
         props.licencia.compartida
})

// Métodos
const formatPrice = (price) => {
  return new Intl.NumberFormat('es-AR', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
  }).format(price)
}

const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

const confirmarEliminacion = () => {
  showDeleteModal.value = true
}

const eliminarLicencia = () => {
  router.delete(`/licencias/${props.licencia.id}`)
  showDeleteModal.value = false
}
</script>