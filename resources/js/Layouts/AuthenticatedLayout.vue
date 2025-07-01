<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const user = props.auth?.user || {};
const permissions = user.permissions || [];

// Estadísticas del dashboard (puedes cambiar estos valores por datos reales)
const stats = computed(() => [
  {
    name: 'Total Usuarios',
    value: '24',
    change: '+4.75%',
    changeType: 'positive',
    icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
  },
  {
    name: 'Clientes Activos',
    value: '156',
    change: '+12.5%',
    changeType: 'positive',
    icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z'
  },
  {
    name: 'Productos',
    value: '89',
    change: '+2.1%',
    changeType: 'positive',
    icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10'
  },
  {
    name: 'Ventas del Mes',
    value: 'Bs. 45,280',
    change: '+8.2%',
    changeType: 'positive',
    icon: 'M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L6 5H3m4 8v4a2 2 0 002 2h10a2 2 0 002-2v-4m-6 4h.01M9 17h.01'
  }
]);

const quickActions = computed(() => [
  {
    name: 'Nueva Venta',
    description: 'Registrar una nueva venta',
    href: '/ventas/crear',
    icon: 'M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L6 5H3m4 8v4a2 2 0 002 2h10a2 2 0 002-2v-4m-6 4h.01M9 17h.01',
    color: 'bg-blue-500',
    permission: 'ver ventas'
  },
  {
    name: 'Agregar Cliente',
    description: 'Registrar nuevo cliente',
    href: '/clientes/crear',
    icon: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
    color: 'bg-green-500',
    permission: 'gestionar clientes'
  },
  {
    name: 'Gestionar Inventario',
    description: 'Ver y actualizar stock',
    href: '/inventario',
    icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10',
    color: 'bg-purple-500',
    permission: 'ver inventario'
  },
  {
    name: 'Ver Reportes',
    description: 'Consultar reportes y estadísticas',
    href: '/reportes',
    icon: 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
    color: 'bg-orange-500',
    permission: 'ver reportes'
  }
]);

const puede = (permiso) => permissions.includes(permiso);

const visibleActions = computed(() => {
  return quickActions.value.filter(action => !action.permission || puede(action.permission));
});

// Actividad reciente simulada
const recentActivity = [
  {
    id: 1,
    type: 'venta',
    description: 'Nueva venta registrada por Bs. 1,250',
    time: 'Hace 2 horas',
    icon: 'M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L6 5H3m4 8v4a2 2 0 002 2h10a2 2 0 002-2v-4'
  },
  {
    id: 2,
    type: 'cliente',
    description: 'Nuevo cliente registrado: María González',
    time: 'Hace 4 horas',
    icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'
  },
  {
    id: 3,
    type: 'inventario',
    description: 'Stock actualizado para 5 productos',
    time: 'Hace 6 horas',
    icon: 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10'
  }
];
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      Dashboard
    </template>

    <div class="space-y-6">
      <!-- Mensaje de bienvenida -->
      <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-sm p-6 text-white">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <div class="h-12 w-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
            </div>
          </div>
          <div class="ml-4">
            <h2 class="text-2xl font-bold">¡Bienvenido, {{ user.nombre }}!</h2>
            <p class="text-blue-100">Laravel v12.19.3 / PHP v8.2.12</p>
          </div>
        </div>
      </div>

      <!-- Estadísticas -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          v-for="stat in stats"
          :key="stat.name"
          class="bg-white rounded-lg shadow-sm p-6 border border-gray-200"
        >
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="stat.icon" />
                </svg>
              </div>
            </div>
            <div class="ml-4 flex-1">
              <p class="text-sm font-medium text-gray-600">{{ stat.name }}</p>
              <p class="text-2xl font-bold text-gray-900">{{ stat.value }}</p>
              <p class="text-sm" :class="stat.changeType === 'positive' ? 'text-green-600' : 'text-red-600'">
                {{ stat.change }} respecto al mes anterior
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Acciones rápidas -->
      <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
          <h3 class="text-lg font-medium text-gray-900">Acciones Rápidas</h3>
          <p class="text-sm text-gray-600">Accede rápidamente a las funciones más utilizadas</p>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <a
              v-for="action in visibleActions"
              :key="action.name"
              :href="action.href"
              class="relative group bg-gray-50 p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-500 hover:bg-gray-100 rounded-lg transition-colors duration-200"
            >
              <div>
                <span class="rounded-lg inline-flex p-3 ring-4 ring-white" :class="action.color">
                  <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="action.icon" />
                  </svg>
                </span>
              </div>
              <div class="mt-4">
                <h3 class="text-lg font-medium text-gray-900 group-hover:text-blue-600">
                  {{ action.name }}
                </h3>
                <p class="mt-2 text-sm text-gray-500">
                  {{ action.description }}
                </p>
              </div>
              <span class="pointer-events-none absolute top-6 right-6 text-gray-300 group-hover:text-gray-400">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M20 4h1a1 1 0 00-1-1v1zm-1 12a1 1 0 102 0h-2zM8 3a1 1 0 000 2V3zM3.293 19.293a1 1 0 101.414 1.414l-1.414-1.414zM19 4v12h2V4h-2zm1-1H8v2h12V3zm-.707.293l-16 16 1.414 1.414 16-16-1.414-1.414z" />
                </svg>
              </span>
            </a>
          </div>
        </div>
      </div>

      <!-- Actividad reciente -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Actividad reciente -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
          <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Actividad Reciente</h3>
          </div>
          <div class="p-6">
            <div class="flow-root">
              <ul class="-mb-8">
                <li v-for="(activity, activityIdx) in recentActivity" :key="activity.id">
                  <div class="relative pb-8">
                    <span
                      v-if="activityIdx !== recentActivity.length - 1"
                      class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                    ></span>
                    <div class="relative flex space-x-3">
                      <div>
                        <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                          <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="activity.icon" />
                          </svg>
                        </span>
                      </div>
                      <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                        <div>
                          <p class="text-sm text-gray-900">{{ activity.description }}</p>
                        </div>
                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                          <time>{{ activity.time }}</time>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Información del sistema -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
          <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Información del Sistema</h3>
          </div>
          <div class="p-6">
            <dl class="space-y-4">
              <div>
                <dt class="text-sm font-medium text-gray-500">Versión Laravel</dt>
                <dd class="text-sm text-gray-900">v12.19.3</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Versión PHP</dt>
                <dd class="text-sm text-gray-900">v8.2.12</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Usuario actual</dt>
                <dd class="text-sm text-gray-900">{{ user.nombre }} ({{ user.correo }})</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Rol</dt>
                <dd class="text-sm text-gray-900">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    Super Admin
                  </span>
                </dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Última conexión</dt>
                <dd class="text-sm text-gray-900">Ahora</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>