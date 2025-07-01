<template>
  <Head title="Ver Categoría" />
  
  <div class="min-h-screen bg-gray-100">
    <!-- Header simple -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          Detalles de Categoría
        </h1>
      </div>
    </header>

    <!-- Contenido principal -->
    <main class="py-12">
      <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            
            <!-- Breadcrumb simple -->
            <nav class="flex mb-6">
              <Link 
                :href="route('categorias.index')"
                class="text-green-600 hover:text-green-800"
              >
                ← Volver a Categorías
              </Link>
            </nav>

            <!-- Información de la categoría -->
            <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-6 mb-6">
              <div class="flex items-start justify-between">
                <div>
                  <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    {{ categoria.nombre }}
                  </h2>
                  <div class="space-y-1 text-sm text-gray-600">
                    <p><strong>ID:</strong> {{ categoria.id }}</p>
                    <p><strong>Creada:</strong> {{ formatDate(categoria.created_at) }}</p>
                    <p><strong>Última actualización:</strong> {{ formatDate(categoria.updated_at) }}</p>
                  </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex space-x-2">
                  <Link 
                    :href="route('categorias.edit', categoria.id)"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
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

            <!-- Información adicional -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Estadísticas -->
              <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Estadísticas</h3>
                <div class="space-y-2 text-sm">
                  <div class="flex justify-between">
                    <span class="text-gray-600">Licencias asociadas:</span>
                    <span class="font-medium">
                      {{ categoria.licencias_count || 0 }}
                    </span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600">Estado:</span>
                    <span class="inline-flex px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                      Activa
                    </span>
                  </div>
                </div>
              </div>

              <!-- Actividad reciente -->
              <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Información</h3>
                <div class="space-y-2 text-sm">
                  <p class="text-gray-600">
                    Esta categoría agrupa licencias de software relacionadas.
                  </p>
                  <p class="text-gray-600">
                    <strong>Última modificación:</strong><br>
                    {{ formatDatetime(categoria.updated_at) }}
                  </p>
                </div>
              </div>
            </div>

            <!-- Sección de licencias (cuando esté implementada) -->
            <div class="mt-8">
              <h3 class="text-lg font-medium text-gray-900 mb-4">Licencias en esta categoría</h3>
              <div class="bg-gray-50 rounded-lg p-6 text-center">
                <p class="text-gray-500">
                  Las licencias asociadas aparecerán aquí una vez que implementes el módulo de Licencias.
                </p>
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
          <h3 class="text-lg font-medium text-gray-900">Eliminar Categoría</h3>
          <div class="mt-2 px-7 py-3">
            <p class="text-sm text-gray-500">
              ¿Estás seguro de que deseas eliminar la categoría "{{ categoria.nombre }}"?
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
              @click="eliminarCategoria"
              class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition"
            >
              Eliminar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'

// Props
const props = defineProps({
  categoria: Object
})

// Estado reactivo
const showDeleteModal = ref(false)

// Métodos
const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

const formatDatetime = (dateString) => {
  return new Date(dateString).toLocaleString('es-ES', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}

const confirmarEliminacion = () => {
  showDeleteModal.value = true
}

const eliminarCategoria = () => {
  router.delete(`/categorias/${props.categoria.id}`)
  showDeleteModal.value = false
}
</script>