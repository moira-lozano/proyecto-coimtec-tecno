<script setup>
import { ref, computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';

const sidebarOpen = ref(false);
const { props } = usePage();
const user = props.auth?.user || {};
const permissions = user.permissions || [];

const puede = (permiso) => permissions.includes(permiso);

// Agrupar menús por secciones
const menuSections = computed(() => [
  {
    title: 'Administración',
    items: [
      {
        label: 'Usuarios',
        href: '/usuarios',
        icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
        permission: 'gestionar usuarios',
      },
    ],
  },
  {
    title: 'Almacén',
    showIfAny: ['ver marcas', 'ver categorias', 'ver licencias'],
    items: [
      {
        label: 'Marcas',
        href: '/marcas',
        icon: 'M5 13l4 4L19 7',
        permission: 'ver marcas',
      },
      {
        label: 'Categorías',
        href: '/categorias',
        icon: 'M3 7h18M3 12h18M3 17h18',
        permission: 'ver categorias',
      },
      {
        label: 'Licencias',
        href: '/licencias',
        icon: 'M5 13l4 4L19 7',
        permission: 'ver licencias',
      },
    ],
  },
  {
    title: 'Ventas',
    items: [
      {
        label: 'Ventas',
        href: '/ventas',
        icon: 'M3 3h2l.4 2M7 13h10l4-8H5.4m2.6 8L6 5H3m4 8v4a2 2 0 002 2h10a2 2 0 002-2v-4',
        permission: 'ver ventas',
      },
      {
        label: 'Reportes',
        href: '/reportes',
        icon: 'M9 17v-2m3 2v-4m3 2v-6M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
        permission: 'ver reportes',
      },
    ],
  },
]);
</script>

<template>
  <AuthenticatedLayout>
    <ul>
      <template v-for="section in menuSections" :key="section.title">
        <!-- Mostrar sección si hay al menos un permiso válido -->
        <template v-if="!section.showIfAny || section.showIfAny.some(p => puede(p))">
          <li class="mt-4 px-4 text-xs font-bold uppercase text-gray-500">{{ section.title }}</li>

          <ul>
            <li
              v-for="item in section.items"
              :key="item.label"
              v-if="puede(item.permission)"
            >
              <Link
                :href="item.href"
                class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100"
                :class="{ 'bg-blue-100 text-blue-700 border-r-4 border-blue-700': $page.url.startsWith(item.href) }"
              >
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    :d="item.icon"
                  />
                </svg>
                {{ item.label }}
              </Link>
            </li>
          </ul>
        </template>
      </template>
    </ul>
  </AuthenticatedLayout>
</template>
