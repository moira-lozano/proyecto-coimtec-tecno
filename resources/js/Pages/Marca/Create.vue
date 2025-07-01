<template>
  <AuthenticatedLayout>
     <Head title="Nueva Marca" />
  
  <div class="min-h-screen bg-gray-100">
    <!-- Header simple -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          Crear Nueva Marca
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
                :href="route('marcas.index')"
                class="text-blue-600 hover:text-blue-800"
              >
                ← Volver a Marcas
              </Link>
            </nav>

            <!-- Formulario -->
            <form @submit.prevent="submit" class="space-y-6">
              <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                  Nombre de la Marca
                </label>
                <input
                  id="nombre"
                  v-model="form.nombre"
                  type="text"
                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                  :class="{ 'border-red-500': form.errors.nombre }"
                  placeholder="Ingresa el nombre de la marca"
                  autofocus
                />
                <p v-if="form.errors.nombre" class="mt-1 text-sm text-red-600">
                  {{ form.errors.nombre }}
                </p>
              </div>

              <!-- Botones de acción -->
              <div class="flex items-center justify-end space-x-3 pt-4">
                <Link 
                  :href="route('marcas.index')"
                  class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition"
                >
                  Cancelar
                </Link>
                
                <button
                  type="submit"
                  :disabled="form.processing"
                  class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition disabled:opacity-50"
                >
                  <span v-if="form.processing">
                    Guardando...
                  </span>
                  <span v-else>
                    Guardar Marca
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

// Formulario reactivo
const form = useForm({
  nombre: ''
})

// Método para enviar formulario
const submit = () => {
  form.post(route('marcas.store'))
}
</script>