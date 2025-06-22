<script setup>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineProps({
  form: Object,
  processing: Boolean,
  usuarios: Array,
  isEdit: Boolean
});

</script>

<template>
<AuthenticatedLayout>
  <!-- Contenedor principal con fondo blanco y sombra -->
  <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-6">
    <!-- Header del formulario -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">
        {{ isEdit ? 'Editar Cliente' : 'Nuevo Cliente' }}
      </h1>
      <p class="text-gray-600">Complete la información del cliente</p>
    </div>

    <form @submit.prevent="$emit('submit')">
      <!-- Grid para organizar los campos -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        
        <!-- Campo Carnet -->
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700">
            Carnet <span class="text-red-500">*</span>
          </label>
          <input
            v-model="form.carnet"
            type="text"
            :readonly="isEdit"
            :class="[
              'w-full px-4 py-3 rounded-lg border-2 transition-colors duration-200',
              isEdit 
                ? 'bg-gray-50 border-gray-200 text-gray-500 cursor-not-allowed'
                : 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none'
            ]"
            placeholder="Ingrese el carnet"
          />
        </div>

        <!-- Campo Nombre -->
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700">
            Nombre Completo <span class="text-red-500">*</span>
          </label>
          <input 
            v-model="form.nombre" 
            type="text" 
            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200"
            placeholder="Ingrese el nombre completo"
          />
        </div>

        <!-- Campo NIT -->
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700">
            NIT
          </label>
          <input 
            v-model="form.nit" 
            type="text" 
            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200"
            placeholder="Ingrese el NIT"
          />
        </div>

        <!-- Campo Email -->
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700">
            Correo Electrónico <span class="text-red-500">*</span>
          </label>
          <input 
            v-model="form.correo" 
            type="email" 
            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200"
            placeholder="ejemplo@correo.com"
          />
        </div>

        <!-- Campo Empresa -->
        <div class="space-y-2 md:col-span-2">
          <label class="block text-sm font-semibold text-gray-700">
            Empresa
          </label>
          <input 
            v-model="form.empresa" 
            type="text" 
            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200"
            placeholder="Nombre de la empresa"
          />
        </div>
      </div>

      <!-- Sección de Teléfonos -->
      <div class="bg-gray-50 rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
          <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21L6.16 11.37a11.045 11.045 0 005.516 5.516l1.983-4.064a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
          </svg>
          Información de Contacto
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Teléfono Principal -->
          <div class="space-y-4">
            <h4 class="font-medium text-gray-700">Teléfono Principal</h4>
            <div class="flex space-x-2">
              <div class="w-24">
                <label class="block text-xs font-medium text-gray-600 mb-1">Código País</label>
                <input 
                  v-model="form.cod_pais1" 
                  type="text" 
                  class="w-full px-3 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200 text-center"
                  placeholder="+591"
                />
              </div>
              <div class="flex-1">
                <label class="block text-xs font-medium text-gray-600 mb-1">Número</label>
                <input 
                  v-model="form.celular1" 
                  type="text" 
                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200"
                  placeholder="12345678"
                />
              </div>
            </div>
          </div>

          <!-- Teléfono Secundario -->
          <div class="space-y-4">
            <h4 class="font-medium text-gray-700">Teléfono Secundario (Opcional)</h4>
            <div class="flex space-x-2">
              <div class="w-24">
                <label class="block text-xs font-medium text-gray-600 mb-1">Código País</label>
                <input 
                  v-model="form.cod_pais2" 
                  type="text" 
                  class="w-full px-3 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200 text-center"
                  placeholder="+591"
                />
              </div>
              <div class="flex-1">
                <label class="block text-xs font-medium text-gray-600 mb-1">Número</label>
                <input 
                  v-model="form.celular2" 
                  type="text" 
                  class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200"
                  placeholder="87654321"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Campo Asignar Usuario -->
      <div class="bg-blue-50 rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
          <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
          Asignación de Usuario
        </h3>
        <div class="space-y-2">
          <label class="block text-sm font-semibold text-gray-700">
            Usuario Responsable
          </label>
          <select 
            v-model="form.id_usuario" 
            class="w-full px-4 py-3 rounded-lg border-2 border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors duration-200 bg-white"
          >
            <option value="" class="text-gray-500">Seleccione un usuario responsable</option>
            <option
              v-for="usuario in usuarios"
              :key="usuario.id"
              :value="usuario.id"
              class="text-gray-800"
            >
              {{ usuario.nombre }}
            </option>
          </select>
        </div>
      </div>

      <!-- Botones de acción -->
      <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
        <Link
          :href="route('clientes.index')"
          class="inline-block px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors duration-200"
        >
          Cancelar
        </Link>

        <button
          type="submit"
          :disabled="processing"
          :class="[
            'px-8 py-3 font-semibold rounded-lg transition-all duration-200 flex items-center space-x-2',
            processing 
              ? 'bg-gray-400 text-gray-700 cursor-not-allowed' 
              : 'bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white shadow-lg hover:shadow-xl transform hover:-translate-y-0.5'
          ]"
        >
          <svg v-if="processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-700" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>{{ processing ? 'Guardando...' : (isEdit ? 'Actualizar Cliente' : 'Crear Cliente') }}</span>
        </button>
      </div>
    </form>
  </div>
</AuthenticatedLayout>
</template>