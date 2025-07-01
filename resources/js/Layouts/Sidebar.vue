<template>
  <!-- Overlay en móviles -->
  <div
    class="fixed inset-0 z-30 bg-black bg-opacity-50 transition-opacity lg:hidden"
    v-if="open"
    @click="$emit('close')"
  ></div>

  <!-- Sidebar -->
  <aside
    class="fixed z-40 lg:static inset-y-0 left-0 w-64 bg-white shadow-md transform transition-transform duration-200 ease-in-out
           lg:translate-x-0 lg:block"
    :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
  >
    <div class="flex items-center justify-between px-4 py-3 border-b">
      <h2 class="text-lg font-semibold text-gray-700">Menú</h2>
      <button
        class="lg:hidden text-gray-500 hover:text-gray-700"
        @click="$emit('close')"
      >
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <nav class="mt-4">
      <div v-for="section in visibleSections" :key="section.name" class="mb-4">
        <h3 class="px-4 text-sm font-semibold text-gray-500 uppercase tracking-wide">
          {{ section.name }}
        </h3>
        <ul>
          <li
            v-for="item in section.items"
            :key="item.name"
            class="px-4 py-2 hover:bg-gray-100 transition"
          >
            <a :href="item.href" class="block text-gray-700">{{ item.name }}</a>
          </li>
        </ul>
      </div>
    </nav>
  </aside>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  open: Boolean
});

const page = usePage();
const user = computed(() => page.props.auth?.user);
const permissions = computed(() => user.value?.permissions || []);
const isSuperAdmin = computed(() => user.value?.nombre === 'Super Admin' || permissions.value.includes('super admin'));

// Define secciones del menú
const menuSections = [
  {
    name: 'Administración',
    items: [
      { name: 'Ver Usuarios', href: '/usuarios', permission: 'gestionar usuarios' }
    ]
  },
  {
    name: 'Inventario',
    items: [
      { name: 'Marcas', href: '/marcas', permission: 'ver marcas' },
      { name: 'Licencias', href: '/licencias', permission: 'ver licencias' },
      { name: 'Categorías', href: '/categorias', permission: 'ver categorias' }
    ]
  },
  {
    name: 'Clientes',
    items: [
      { name: 'Listado de Clientes', href: '/clientes', permission: 'gestionar clientes' }
    ]
  },
  {
    name: 'Ventas',
    items: [
      { name: 'Ver Ventas', href: '/ventas', permission: 'ver ventas' }
    ]
  },
  {
    name: 'Reportes',
    items: [
      { name: 'Ver Reportes', href: '/reportes', permission: 'ver reportes' }
    ]
  }
];

// Mostrar todos si es super admin, si no, solo con permisos
const visibleSections = computed(() => {
  return menuSections
    .map(section => ({
      name: section.name,
      items: section.items.filter(item =>
        isSuperAdmin.value || permissions.value.includes(item.permission)
      )
    }))
    .filter(section => section.items.length > 0);
});
</script>
