<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

const sidebarOpen = ref(false);
const { props } = usePage();
const user = props.auth?.user;
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
          <li>
            <Link :href="route('dashboard')"
              class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
              :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': route().current('dashboard') }"
            >
              <!-- icono -->
              <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
              </svg>
              Dashboard
            </Link>
          </li>

          <li>
            <Link href="/clientes"
              class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
              :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/clientes') }"
            >
              <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 119.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
              Clientes
            </Link>
          </li>

          <li>
            <Link href="/proyectos"
              class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
              :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/proyectos') }"
            >
              <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012 2v2M7 7h10"/>
              </svg>
              Vendedores
            </Link>
          </li>

          <li>
            <Link href="/reportes"
              class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
              :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith('/reportes') }"
            >
              <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
              </svg>
              Reportes
            </Link>
          </li>
          <li>
            <Link
                href="/logout"
                method="post"
                as="button"
                class="flex items-center w-full p-2 text-red-600 rounded-lg hover:bg-red-50"
            >
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
