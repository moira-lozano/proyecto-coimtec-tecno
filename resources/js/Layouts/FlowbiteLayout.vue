<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({
  auth: Object
});

const isSidebarOpen = ref(true);
</script>

<template>
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside
      :class="[
        'w-64 bg-white border-r border-gray-200 p-4 space-y-4',
        isSidebarOpen ? 'block' : 'hidden sm:block'
      ]"
    >
      <div class="text-2xl font-bold text-gray-800">Mi Panel</div>

      <nav class="flex flex-col space-y-2">
        <Link
          :href="route('dashboard')"
          class="text-gray-700 hover:text-blue-500"
        >
          Dashboard
        </Link>
        <Link
          :href="route('profile.edit')"
          class="text-gray-700 hover:text-blue-500"
        >
          Perfil
        </Link>
        <Link
          :href="route('logout')"
          method="post"
          as="button"
          class="text-red-600 hover:text-red-800 text-left"
        >
          Cerrar sesión
        </Link>
      </nav>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">
      <!-- Navbar -->
      <header class="flex items-center justify-between bg-white border-b px-4 py-3 shadow">
        <button
          @click="isSidebarOpen = !isSidebarOpen"
          class="sm:hidden text-gray-500 hover:text-gray-800"
        >
          <!-- Heroicons menú -->
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
        </button>

        <h1 class="text-lg font-semibold text-gray-800">
          {{ auth?.user?.name ?? 'Mi Panel' }}
        </h1>
      </header>

      <!-- Content -->
      <main class="flex-1 p-6 overflow-y-auto">
        <slot />
      </main>
    </div>
  </div>
</template>
