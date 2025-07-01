<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const sidebarOpen = ref(false);
const { props } = usePage();
const user = props.auth?.user;

// Extraemos permisos en forma de lista
const permissions = user?.permissions || [];

const puedeVerVentas = computed(() => permissions.includes('ver ventas'));
const puedeVerReportes = computed(() => permissions.includes('ver reportes'));
const puedeVerFinanzas = computed(() => permissions.includes('ver finanzas'));
const puedeGestionarUsuarios = computed(() => permissions.includes('gestionar usuarios'));

/*const puedeAccederAlmacen = computed(() =>
  permissions.includes('ver productos') ||
  permissions.includes('crear productos') ||
  permissions.includes('editar productos')
);*/

</script>


<template>
  <div class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside
      :class="[
        'fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-white border-r border-gray-200 lg:translate-x-0',
        { '-translate-x-full': !sidebarOpen }
      ]"
    >
      <div class="h-full px-3 py-4 overflow-y-auto">
        <div class="flex items-center justify-center mb-6">
          <Link :href="route('dashboard')" class="flex items-center">
            <ApplicationLogo class="h-8 w-auto text-gray-800" />
            <span class="ml-2 text-xl font-semibold text-gray-800">Mi App</span>
          </Link>
        </div>

        <ul class="space-y-2">
          <!-- Siempre visible -->
          <li>
            <Link :href="route('dashboard')" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
                  :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': route().current('dashboard') }">
              <!-- Icono -->
              <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Dashboard
            </Link>
          </li>

          <!-- Gestión de Usuarios (Administración) -->
          <template v-if="puedeGestionarUsuarios">
            <li>
              <Link href="/usuarios" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
                    :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/usuarios') }">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Usuarios
              </Link>
            </li>
          </template>

          <!-- Finanzas -->
          <template v-if="puedeVerFinanzas">
            <li>
              <Link href="/finanzas" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
                    :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/finanzas') }">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.5 0-2.5 1-2.5 2.5S10.5 13 12 13s2.5-1 2.5-2.5S13.5 8 12 8zm0 10a8 8 0 100-16 8 8 0 000 16z"/>
                </svg>
                Finanzas
              </Link>
            </li>
          </template>

          <!-- Ventas -->
          <template v-if="puedeVerVentas">
            <li>
              <Link href="/ventas" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
                    :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/ventas') }">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L6 5H3m4 8v4a2 2 0 002 2h10a2 2 0 002-2v-4"/>
                </svg>
                Ventas
              </Link>
            </li>
          </template>

          <!-- Reportes -->
          <template v-if="puedeVerReportes">
            <li>
              <Link href="/reportes" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
                    :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/reportes') }">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 2v-6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Reportes
              </Link>
            </li>
          </template>

          <!--Permiso compartido con administración y comercial-->
          <template v-if="permissions.includes('gestionar clientes')">
            <li>
              <Link href="/clientes" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
                    :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/clientes') }">
                <!-- Icono -->
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7"/>
                </svg>
                Clientes
              </Link>
            </li>
          </template>


          <!-- Logout -->
          <li>
            <Link href="/logout" method="post" as="button"
                  class="flex items-center w-full p-2 text-red-600 rounded-lg hover:bg-red-50">
              <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
              </svg>
              Cerrar sesión
            </Link>
          </li>
        </ul>

      </div>
    </aside>

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col lg:ml-64">
      <!-- Navbar superior -->
      <header class="bg-white shadow px-4 py-3 flex justify-between items-center">
        <!-- Botón de menú móvil -->
        <button
          @click="sidebarOpen = !sidebarOpen"
          class="inline-flex items-center p-2 text-gray-500 rounded-lg lg:hidden hover:bg-gray-100"
        >
          <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M3 5h14a1 1 0 100-2H3a1 1 0 000 2zm14 4H3a1 1 0 000 2h14a1 1 0 100-2zm0 6H3a1 1 0 000 2h14a1 1 0 100-2z"
                  clip-rule="evenodd" />
          </svg>
        </button>

        <!-- Dropdown Usuario -->
        <div v-if="user" class="relative">
          <Dropdown align="right" width="48">
            <template #trigger>
              <span class="inline-flex rounded-md">
                <button
                  type="button"
                  class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white rounded-md hover:text-gray-900"
                >
                  {{ user.name }}
                  <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
                  </svg>
                </button>
              </span>
            </template>

            <template #content>
              <DropdownLink :href="route('profile.edit')">Perfil</DropdownLink>
              <DropdownLink :href="route('logout')" method="post" as="button">
                Cerrar sesión
              </DropdownLink>
            </template>
          </Dropdown>
        </div>
      </header>

      <!-- Header personalizado (si existe slot "header") -->
      <div v-if="$slots.header" class="bg-white border-b px-4 py-3 shadow-sm">
        <slot name="header" />
      </div>

      <!-- Main -->
      <main class="flex-1 overflow-y-auto p-4">
        <slot />
      </main>
    </div>
  </div>
</template>