<template>
  <AuthenticatedLayout>
      <Head title="Editar Categoría" />
  
  <div class="min-h-screen bg-gray-100">
    <!-- Header simple -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          Editar Categoría
        </h1>
      </div>
    </header>

    <!-- Contenido principal -->
    <main class="py-12">
      <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
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
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
              <h3 class="text-lg font-medium text-gray-900">{{ categoria.nombre }}</h3>
              <p class="text-sm text-gray-500">
                Creada el {{ formatDate(categoria.created_at) }}
              </p>
            </div>

            <!-- Formulario -->
            <form @submit.prevent="submit" class="space-y-6">
              <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                  Nombre de la Categoría
                </label>
                <input
                  id="nombre"
                  v-model="form.nombre"
                  type="text"
                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                  :class="{ 'border-red-500': form.errors.nombre }"
                  placeholder="Ingresa el nombre de la categoría"
                  autofocus
                />
                <p v-if="form.errors.nombre" class="mt-1 text-sm text-red-600">
                  {{ form.errors.nombre }}
                </p>
              </div>

              <!-- Indicador de cambios -->
              <div v-if="form.isDirty" class="text-sm text-amber-600 bg-amber-50 p-3 rounded-md">
                Tienes cambios sin guardar
              </div>

              <!-- Botones de acción -->
              <div class="flex items-center justify-end space-x-3 pt-4">
                <Link 
                  :href="route('categorias.index')"
                  class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition"
                >
                  Cancelar
                </Link>
                
                <button
                  type="submit"
                  :disabled="form.processing || !form.isDirty"
                  class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition disabled:opacity-50"
                >
                  <span v-if="form.processing">
                    Actualizando...
                  </span>
                  <span v-else>
                    Actualizar Categoría
                  </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// Props
const props = defineProps({
  categoria: Object
})

// Formulario reactivo con datos existentes
const form = useForm({
  nombre: props.categoria.nombre
})

// Método para formatear fecha
const formatDate = (dateString) => {
  return new Date(dateString).toLocaleDateString('es-ES', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

// Método para enviar formulario
const submit = () => {
  form.patch(`/categorias/${props.categoria.id}`)
}
</script>