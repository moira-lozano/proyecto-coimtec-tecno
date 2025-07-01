<template>
  <Head title="Editar Licencia" />
  
  <div class="min-h-screen bg-gray-100">
    <!-- Header simple -->
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900">
          Editar Licencia
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
                :href="route('licencias.index')"
                class="text-purple-600 hover:text-purple-800"
              >
                ← Volver a Licencias
              </Link>
            </nav>

            <!-- Información de la licencia -->
            <div class="mb-6 p-4 bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg">
              <h3 class="text-lg font-medium text-gray-900">{{ licencia.nombre }}</h3>
              <p class="text-sm text-gray-500">
                Código: {{ licencia.codigo }} • Creada el {{ formatDate(licencia.created_at) }}
              </p>
            </div>

            <!-- Formulario -->
            <form @submit.prevent="submit" class="space-y-8">
              
              <!-- Información básica -->
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información Básica</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  
                  <!-- Nombre -->
                  <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                      Nombre de la Licencia *
                    </label>
                    <input
                      id="nombre"
                      v-model="form.nombre"
                      type="text"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                      :class="{ 'border-red-500': form.errors.nombre }"
                      placeholder="Ej: Windows 11 Pro"
                      autofocus
                    />
                    <p v-if="form.errors.nombre" class="mt-1 text-sm text-red-600">
                      {{ form.errors.nombre }}
                    </p>
                  </div>

                  <!-- Código -->
                  <div>
                    <label for="codigo" class="block text-sm font-medium text-gray-700 mb-2">
                      Código *
                    </label>
                    <input
                      id="codigo"
                      v-model="form.codigo"
                      type="text"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500 font-mono"
                      :class="{ 'border-red-500': form.errors.codigo }"
                      placeholder="Ej: WIN11-PRO-001"
                    />
                    <p v-if="form.errors.codigo" class="mt-1 text-sm text-red-600">
                      {{ form.errors.codigo }}
                    </p>
                  </div>

                  <!-- Marca -->
                  <div>
                    <label for="marca_id" class="block text-sm font-medium text-gray-700 mb-2">
                      Marca *
                    </label>
                    <select
                      id="marca_id"
                      v-model="form.marca_id"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                      :class="{ 'border-red-500': form.errors.marca_id }"
                    >
                      <option value="">Selecciona una marca</option>
                      <option v-for="marca in marcas" :key="marca.id" :value="marca.id">
                        {{ marca.nombre }}
                      </option>
                    </select>
                    <p v-if="form.errors.marca_id" class="mt-1 text-sm text-red-600">
                      {{ form.errors.marca_id }}
                    </p>
                  </div>

                  <!-- Categoría -->
                  <div>
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">
                      Categoría *
                    </label>
                    <select
                      id="categoria_id"
                      v-model="form.categoria_id"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                      :class="{ 'border-red-500': form.errors.categoria_id }"
                    >
                      <option value="">Selecciona una categoría</option>
                      <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                        {{ categoria.nombre }}
                      </option>
                    </select>
                    <p v-if="form.errors.categoria_id" class="mt-1 text-sm text-red-600">
                      {{ form.errors.categoria_id }}
                    </p>
                  </div>
                </div>
              </div>

              <!-- Precios -->
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Precios</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                  
                  <!-- Precio base -->
                  <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">
                      Precio Base *
                    </label>
                    <div class="relative">
                      <span class="absolute left-3 top-2 text-gray-500">$</span>
                      <input
                        id="precio"
                        v-model="form.precio"
                        type="number"
                        step="0.01"
                        min="0"
                        class="block w-full pl-8 rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                        :class="{ 'border-red-500': form.errors.precio }"
                        placeholder="0.00"
                      />
                    </div>
                    <p v-if="form.errors.precio" class="mt-1 text-sm text-red-600">
                      {{ form.errors.precio }}
                    </p>
                  </div>

                  <!-- Precio mayorista -->
                  <div>
                    <label for="precio_mayorista" class="block text-sm font-medium text-gray-700 mb-2">
                      Precio Mayorista
                    </label>
                    <div class="relative">
                      <span class="absolute left-3 top-2 text-gray-500">$</span>
                      <input
                        id="precio_mayorista"
                        v-model="form.precio_mayorista"
                        type="number"
                        step="0.01"
                        min="0"
                        class="block w-full pl-8 rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                        :class="{ 'border-red-500': form.errors.precio_mayorista }"
                        placeholder="0.00"
                      />
                    </div>
                    <p v-if="form.errors.precio_mayorista" class="mt-1 text-sm text-red-600">
                      {{ form.errors.precio_mayorista }}
                    </p>
                  </div>

                  <!-- Precio renovación -->
                  <div>
                    <label for="precio_renovacion" class="block text-sm font-medium text-gray-700 mb-2">
                      Precio Renovación
                    </label>
                    <div class="relative">
                      <span class="absolute left-3 top-2 text-gray-500">$</span>
                      <input
                        id="precio_renovacion"
                        v-model="form.precio_renovacion"
                        type="number"
                        step="0.01"
                        min="0"
                        class="block w-full pl-8 rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"
                        :class="{ 'border-red-500': form.errors.precio_renovacion }"
                        placeholder="0.00"
                      />
                    </div>
                    <p v-if="form.errors.precio_renovacion" class="mt-1 text-sm text-red-600">
                      {{ form.errors.precio_renovacion }}
                    </p>
                  </div>
                </div>
              </div>

              <!-- Características -->
              <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Características</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                  
                  <!-- Trasladable -->
                  <div class="flex items-center">
                    <input
                      id="trasladable"
                      v-model="form.trasladable"
                      type="checkbox"
                      class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                    />
                    <label for="trasladable" class="ml-2 block text-sm text-gray-900">
                      Trasladable
                    </label>
                  </div>

                  <!-- Deducible -->
                  <div class="flex items-center">
                    <input
                      id="deducible"
                      v-model="form.deducible"
                      type="checkbox"
                      class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                    />
                    <label for="deducible" class="ml-2 block text-sm text-gray-900">
                      Deducible
                    </label>
                  </div>

                  <!-- Formateable -->
                  <div class="flex items-center">
                    <input
                      id="formateable"
                      v-model="form.formateable"
                      type="checkbox"
                      class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                    />
                    <label for="formateable" class="ml-2 block text-sm text-gray-900">
                      Formateable
                    </label>
                  </div>

                  <!-- Compra asistida -->
                  <div class="flex items-center">
                    <input
                      id="compra_asistida"
                      v-model="form.compra_asistida"
                      type="checkbox"
                      class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                    />
                    <label for="compra_asistida" class="ml-2 block text-sm text-gray-900">
                      Compra Asistida
                    </label>
                  </div>

                  <!-- Compartida -->
                  <div class="flex items-center">
                    <input
                      id="compartida"
                      v-model="form.compartida"
                      type="checkbox"
                      class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded"
                    />
                    <label for="compartida" class="ml-2 block text-sm text-gray-900">
                      Compartida
                    </label>
                  </div>
                </div>
              </div>

              <!-- Indicador de cambios -->
              <div v-if="form.isDirty" class="text-sm text-amber-600 bg-amber-50 p-3 rounded-md">
                Tienes cambios sin guardar
              </div>

              <!-- Botones de acción -->
              <div class="flex items-center justify-end space-x-3 pt-4">
                <Link 
                  :href="route('licencias.index')"
                  class="px-6 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition"
                >
                  Cancelar
                </Link>
                
                <button
                  type="submit"
                  :disabled="form.processing || !form.isDirty"
                  class="px-6 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition disabled:opacity-50"
                >
                  <span v-if="form.processing">
                    Actualizando...
                  </span>
                  <span v-else>
                    Actualizar Licencia
                  </span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'

// Props
const props = defineProps({
  licencia: Object,
  marcas: Array,
  categorias: Array
})

// Formulario reactivo con datos existentes
const form = useForm({
  nombre: props.licencia.nombre,
  codigo: props.licencia.codigo,
  precio: props.licencia.precio,
  precio_mayorista: props.licencia.precio_mayorista,
  precio_renovacion: props.licencia.precio_renovacion,
  trasladable: Boolean(props.licencia.trasladable),
  deducible: Boolean(props.licencia.deducible),
  formateable: Boolean(props.licencia.formateable),
  compra_asistida: Boolean(props.licencia.compra_asistida),
  compartida: Boolean(props.licencia.compartida),
  marca_id: props.licencia.marca_id,
  categoria_id: props.licencia.categoria_id
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
  form.patch(`/licencias/${props.licencia.id}`)
}
</script>