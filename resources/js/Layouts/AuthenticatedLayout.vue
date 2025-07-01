<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Sidebar from './Sidebar.vue';

const page = usePage();
const user = page.props.auth?.user;
const sidebarOpen = ref(false); // Controla visibilidad en móviles

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value;
};
</script>

<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <Sidebar :open="sidebarOpen" @close="sidebarOpen = false" />

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col w-0">
      <!-- Topbar -->
      <header class="bg-white shadow z-10 sticky top-0 w-full">
        <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
          <div class="flex items-center space-x-3">
            <!-- Botón de abrir sidebar en móviles -->
            <button class="lg:hidden text-gray-500 hover:text-gray-900" @click="toggleSidebar">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                   viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
            <h1 class="text-lg font-semibold text-gray-900">
              Bienvenido, {{ user?.nombre ?? 'Invitado' }}
            </h1>
          </div>
        </div>
      </header>

      <main class="flex-1 overflow-y-auto p-6">
        <slot />
      </main>
    </div>
  </div>
</template>
