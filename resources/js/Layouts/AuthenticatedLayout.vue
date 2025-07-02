<script setup>
import { ref, computed } from 'vue';
import { usePage, router } from '@inertiajs/vue3'; // ← Agregar router
import Sidebar from './Sidebar.vue';

const page = usePage();
const user = computed(() => page.props.auth?.user);
const sidebarOpen = ref(false);

const toggleSidebar = () => {
  sidebarOpen.value = !sidebarOpen.value;
};

const closeSidebar = () => {
  sidebarOpen.value = false;
};

// Función para obtener saludo según la hora
const getGreeting = () => {
  const hour = new Date().getHours();
  if (hour < 12) return 'Buenos días';
  if (hour < 18) return 'Buenas tardes';
  return 'Buenas noches';
};

// Función para logout - CORREGIDA
const logout = () => {
  if (confirm('¿Estás seguro de que quieres cerrar sesión?')) {
    router.post('/logout'); // ← Cambiar por petición POST
  }
};
</script>

<template>
  <div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <Sidebar :open="sidebarOpen" @close="closeSidebar" />

    <!-- Contenido principal -->
    <div class="flex-1 flex flex-col w-0">
      <!-- Topbar mejorada -->
      <header class="bg-white shadow-sm border-b border-gray-200 z-10 sticky top-0 w-full">
        <div class="flex items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
          <div class="flex items-center space-x-4">
            <!-- Botón de abrir sidebar en móviles -->
            <button 
              class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors" 
              @click="toggleSidebar"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>

            <!-- Saludo personalizado -->
            <div class="flex flex-col">
              <h1 class="text-xl font-bold text-gray-900">
                {{ getGreeting() }}, {{ user?.nombre?.split(' ')[0] || 'Usuario' }}
              </h1>
              <p class="text-sm text-gray-600 hidden sm:block">
                {{ new Date().toLocaleDateString('es-ES', { 
                  weekday: 'long', 
                  year: 'numeric', 
                  month: 'long', 
                  day: 'numeric' 
                }) }}
              </p>
            </div>
          </div>

          <!-- Acciones del usuario -->
          <div class="flex items-center space-x-3">
            <!-- Notificaciones -->
            <button class="p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-full transition-colors relative">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 17h5l-3.403-3.403A4.954 4.954 0 0121 9a5 5 0 10-9.9.8L15 17z"/>
              </svg>
              <!-- Badge de notificaciones -->
              <span class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
            </button>

            <!-- Dropdown del usuario -->
            <div class="relative group">
              <button class="flex items-center space-x-2 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                  <span class="text-white font-semibold text-sm">
                    {{ user?.nombre?.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase() || 'U' }}
                  </span>
                </div>
                <div class="hidden md:block text-left">
                  <p class="text-sm font-medium text-gray-900">{{ user?.nombre || 'Usuario' }}</p>
                  <p class="text-xs text-gray-500">Ver perfil</p>
                </div>
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>

              <!-- Menu dropdown -->
              <div class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                <div class="p-4 border-b border-gray-200">
                  <p class="font-medium text-gray-900">{{ user?.nombre || 'Usuario' }}</p>
                  <p class="text-sm text-gray-500">{{ user?.correo || 'Sin email' }}</p>
                </div>
                <div class="py-2">
                  <a href="/perfil" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Mi Perfil
                  </a>
                  <a href="/configuracion" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Configuración
                  </a>
                  <div class="border-t border-gray-200 my-2"></div>
                  <button @click="logout" class="flex items-center w-full px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Cerrar Sesión
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Breadcrumb -->
        <div class="px-4 py-2 bg-gray-50 border-t border-gray-200 sm:px-6 lg:px-8">
          <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm">
              <li>
                <a href="/dashboard" class="text-gray-500 hover:text-gray-700">Dashboard</a>
              </li>
              <li class="flex items-center">
                <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                </svg>
                <span class="text-gray-900 font-medium">{{ $page.component }}</span>
              </li>
            </ol>
          </nav>
        </div>
      </header>

      <!-- Contenido principal -->
      <main class="flex-1 overflow-y-auto">
        <div class="p-6">
          <!-- Container con máximo ancho -->
          <div class="max-w-7xl mx-auto">
            <slot />
          </div>
        </div>
      </main>

      <!-- Footer -->
      <footer class="bg-white border-t border-gray-200 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between text-sm text-gray-600">
          <p>&copy; 2025 Sistema de Gestión. Todos los derechos reservados.</p>
          <div class="flex items-center space-x-4">
            <span>Versión 1.0.0</span>
            <div class="flex items-center space-x-1">
              <div class="w-2 h-2 bg-green-400 rounded-full"></div>
              <span>Sistema en línea</span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<style scoped>
/* Asegurar que el dropdown funcione correctamente */
.group:hover .group-hover\:opacity-100 {
  opacity: 1;
}

.group:hover .group-hover\:visible {
  visibility: visible;
}
</style>