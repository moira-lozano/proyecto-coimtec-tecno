<template>
  <AuthenticatedLayout page-title="Detalles del Cliente">
    <div class="p-6">
      <!-- Header -->
      <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-2xl font-bold text-gray-900">Detalles del Cliente</h1>
              <p class="text-sm text-gray-600 mt-1">Información completa del cliente</p>
            </div>
            <div class="flex space-x-3">
              <Link
                :href="route('clientes.edit', cliente.id)"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
              >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar
              </Link>
              <Link
                :href="route('clientes.index')"
                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
              >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver
              </Link>
            </div>
          </div>
        </div>
      </div>

      <!-- Información Principal -->
      <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">Información Principal</h2>
        </div>
        <div class="px-6 py-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Carnet</label>
              <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                <span class="text-lg font-semibold text-gray-900">{{ cliente.carnet }}</span>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
              <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                <span class="text-lg font-semibold text-gray-900">{{ cliente.nombre }}</span>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">NIT</label>
              <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                <span class="text-gray-900">{{ cliente.nit || 'No especificado' }}</span>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
              <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                <span class="text-gray-900">{{ cliente.correo || 'No especificado' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Información de Empresa -->
      <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">Información de Empresa</h2>
        </div>
        <div class="px-6 py-4">
          <div class="grid grid-cols-1 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
              <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                <span class="text-gray-900">{{ cliente.empresa || 'No especificado' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Información de Contacto -->
      <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">Información de Contacto</h2>
        </div>
        <div class="px-6 py-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Celular 1 -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
              <h3 class="text-sm font-medium text-blue-800 mb-3">Teléfono Principal</h3>
              <div class="space-y-2">
                <div>
                  <label class="block text-xs font-medium text-blue-700 mb-1">Código País</label>
                  <div class="bg-white border border-blue-300 rounded-md p-2">
                    <span class="text-sm text-gray-900">{{ cliente.cod_pais1 || 'No especificado' }}</span>
                  </div>
                </div>
                <div>
                  <label class="block text-xs font-medium text-blue-700 mb-1">Número</label>
                  <div class="bg-white border border-blue-300 rounded-md p-2">
                    <span class="text-sm text-gray-900">{{ cliente.celular1 || 'No especificado' }}</span>
                  </div>
                </div>
                <div v-if="cliente.cod_pais1 && cliente.celular1" class="mt-2">
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    {{ cliente.cod_pais1 }} {{ cliente.celular1 }}
                  </span>
                </div>
              </div>
            </div>

            <!-- Celular 2 -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
              <h3 class="text-sm font-medium text-green-800 mb-3">Teléfono Secundario</h3>
              <div class="space-y-2">
                <div>
                  <label class="block text-xs font-medium text-green-700 mb-1">Código País</label>
                  <div class="bg-white border border-green-300 rounded-md p-2">
                    <span class="text-sm text-gray-900">{{ cliente.cod_pais2 || 'No especificado' }}</span>
                  </div>
                </div>
                <div>
                  <label class="block text-xs font-medium text-green-700 mb-1">Número</label>
                  <div class="bg-white border border-green-300 rounded-md p-2">
                    <span class="text-sm text-gray-900">{{ cliente.celular2 || 'No especificado' }}</span>
                  </div>
                </div>
                <div v-if="cliente.cod_pais2 && cliente.celular2" class="mt-2">
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    {{ cliente.cod_pais2 }} {{ cliente.celular2 }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Información del Usuario Asignado -->
      <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">Usuario Asignado</h2>
        </div>
        <div class="px-6 py-4">
          <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
            </div>
            <div>
              <div class="text-sm font-medium text-gray-900">
                {{ cliente.usuario ? cliente.usuario.nombre : 'Usuario no encontrado' }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Información de Auditoría -->
      <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b border-gray-200">
          <h2 class="text-lg font-medium text-gray-900">Información de Auditoría</h2>
        </div>
        <div class="px-6 py-4">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Creación</label>
              <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                <span class="text-gray-900">
                  {{ cliente.created_at ? new Date(cliente.created_at).toLocaleString('es-ES') : 'No disponible' }}
                </span>
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Última Actualización</label>
              <div class="bg-gray-50 border border-gray-300 rounded-md p-3">
                <span class="text-gray-900">
                  {{ cliente.updated_at ? new Date(cliente.updated_at).toLocaleString('es-ES') : 'No disponible' }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { cliente } = defineProps({
  cliente: Object
});
</script>