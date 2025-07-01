<template>
  <Head title="Categorías" />
  
  <div class="min-h-screen bg-gray-100">
    <!-- Header simple -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          Gestión de Categorías
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
                Lista de Categorías
              </h3>
              <Link 
                :href="route('categorias.create')" 
                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150"
              >
                + Nueva Categoría
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

            <!-- Tabla de categorías -->
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Nombre
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Fecha de Creación
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  <template v-if="categorias && categorias.length > 0">
                    <tr v-for="categoria in categorias" :key="categoria.id" class="hover:bg-gray-50">
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ categoria.id }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                          {{ categoria.nombre }}
                        </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ formatDate(categoria.created_at) }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end space-x-2">
                          <!-- Botón Ver -->
                          <Link 
                            :href="route('categorias.show', categoria.id)"
                            class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition"
                          >
                            Ver
                          </Link>
                          
                          <!-- Botón Editar -->
                          <Link 
                            :href="route('categorias.edit', categoria.id)"
                            class="px-3 py-1 bg-yellow-500 text-white text-xs rounded hover:bg-yellow-600 transition"
                          >
                            Editar
                          </Link>
                          
                          <!-- Botón Eliminar -->
                          <button
                            @click="confirmarEliminacion(categoria)"
                            class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition"
                          >
                            Eliminar
                          </button>
                        </div>
                      </td>
                    </tr>
                  </template>
                  
                  <!-- Mensaje cuando no hay categorías -->
                  <template v-else>
                    <tr>
                      <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                        No hay categorías registradas
                      </td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal de confirmación simple -->
    <div v-if="showDeleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
          <h3 class="text-lg font-medium text-gray-900">Eliminar Categoría</h3>
          <div class="mt-2 px-7 py-3">
            <p class="text-sm text-gray-500">
              ¿Estás seguro de que deseas eliminar la categoría "{{ categoriaAEliminar?.nombre }}"?
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
defineProps({
  categorias: Array
})

// Estado reactivo
const showDeleteModal = ref(false)
const categoriaAEliminar = ref(null)

// Métodos
const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

const confirmarEliminacion = (categoria) => {
  categoriaAEliminar.value = categoria
  showDeleteModal.value = true
}

const eliminarCategoria = () => {
  if (categoriaAEliminar.value) {
    router.delete(`/categorias/${categoriaAEliminar.value.id}`)
    showDeleteModal.value = false
    categoriaAEliminar.value = null
  }
}
</script>