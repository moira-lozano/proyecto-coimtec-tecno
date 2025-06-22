<template>
  <div class="flex h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Sidebar -->
    <aside
      :class="['fixed top-0 left-0 z-40 w-64 h-screen transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700', { '-translate-x-full': !sidebarOpen }]"
      aria-label="Sidebar"
    >
      <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-gray-800">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Mi Panel</h2>
        <ul class="space-y-2">
          <li>
            <Link href="/dashboard" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="ml-3">Dashboard</span>
            </Link>
          </li>
          <li>
            <Link href="/perfil" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="ml-3">Perfil</span>
            </Link>
          </li>
          <li>
            <Link href="/clientes" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
              <span class="ml-3">Clientes</span>
            </Link>
          </li>
          <li>
            <Link href="/logout" method="post" as="button" class="flex items-center p-2 text-red-600 hover:bg-red-50 dark:hover:bg-gray-700">
              <span class="ml-3">Cerrar sesión</span>
            </Link>
          </li>
        </ul>
      </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 flex flex-col sm:ml-64">
      <!-- Top bar -->
      <header class="bg-white shadow dark:bg-gray-800">
        <div class="flex items-center justify-between p-4">
          <button
            @click="sidebarOpen = !sidebarOpen"
            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none dark:text-gray-400 dark:hover:bg-gray-700"
          >
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
              <path
                fill-rule="evenodd"
                d="M3 5h14a1 1 0 100-2H3a1 1 0 000 2zm14 4H3a1 1 0 000 2h14a1 1 0 100-2zm0 6H3a1 1 0 000 2h14a1 1 0 100-2z"
                clip-rule="evenodd"
              />
            </svg>
          </button>
          <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Mi Panel</h1>
        </div>
      </header>

      <!-- Page content -->
      <main class="p-4 overflow-y-auto">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const sidebarOpen = ref(false);
</script>

<style scoped>
/* Para mejorar el efecto en modo responsive */
</style>
