<template>
  <!-- Overlay en móviles -->
  <div
    class="fixed inset-0 z-30 bg-black bg-opacity-50 transition-opacity lg:hidden"
    v-if="open"
    @click="$emit('close')"
  ></div>

  <!-- Sidebar -->
  <aside
    class="fixed z-40 lg:static inset-y-0 left-0 w-64 bg-gradient-to-b from-slate-900 to-slate-800 shadow-xl transform transition-all duration-300 ease-in-out
           lg:translate-x-0 lg:block"
    :class="{ '-translate-x-full': !open, 'translate-x-0': open }"
  >
    <!-- Header del sidebar -->
    <div class="flex items-center justify-between px-6 py-4 border-b border-slate-700">
      <div class="flex items-center space-x-2">
        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center">
          <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
          </svg>
        </div>
        <h2 class="text-lg font-bold text-white">Dashboard</h2>
      </div>
      <button
        class="lg:hidden text-slate-400 hover:text-white transition-colors"
        @click="$emit('close')"
      >
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Información del usuario -->
    <div class="px-6 py-4 border-b border-slate-700">
      <div class="flex items-center space-x-3">
        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
          <span class="text-white font-semibold text-sm">
            {{ getUserInitials(user?.nombre) }}
          </span>
        </div>
        <div>
          <p class="text-white font-medium text-sm">{{ user?.nombre || 'Usuario' }}</p>
          <p class="text-slate-400 text-xs">{{ getUserRole() }}</p>
        </div>
      </div>
    </div>

    <!-- Navegación -->
    <nav class="mt-6 px-3">
      <div v-for="section in visibleSections" :key="section.name" class="mb-6">
        <h3 class="px-3 mb-3 text-xs font-semibold text-slate-400 uppercase tracking-wider">
          {{ section.name }}
        </h3>
        <ul class="space-y-1">
          <li
            v-for="item in section.items"
            :key="item.name"
          >
            <a 
              :href="item.href" 
              class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200
                     text-slate-300 hover:text-white hover:bg-slate-700/50 hover:translate-x-1"
              :class="{ 'bg-blue-600 text-white shadow-lg': isCurrentPage(item.href) }"
            >
              <component :is="getIcon(item.icon)" class="mr-3 h-5 w-5 flex-shrink-0" />
              {{ item.name }}
              <span v-if="item.badge" 
                    class="ml-auto bg-blue-500 text-white text-xs px-2 py-0.5 rounded-full">
                {{ item.badge }}
              </span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Footer del sidebar -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-slate-700">
      <div class="flex items-center justify-between text-slate-400 text-xs">
        <span>Versión 1.0</span>
        <div class="flex items-center space-x-1">
          <div class="w-2 h-2 bg-green-400 rounded-full"></div>
          <span>Online</span>
        </div>
      </div>
    </div>
  </aside>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  open: Boolean
});

const page = usePage();
//usePage().props.auth.user

const user = computed(() => page.props.auth?.user);
const permissions = computed(() => {
  // Obtener permisos de diferentes formas posibles
  const userPermissions = user.value?.permissions || [];
  const directPermissions = user.value?.direct_permissions || [];
  const rolePermissions = user.value?.role_permissions || [];
  
  // Combinar todos los permisos
  return [...userPermissions, ...directPermissions, ...rolePermissions];
});

const userRoles = computed(() => user.value?.roles || []);

// Verificar si es super admin
const isSuperAdmin = computed(() => {
  const isNamedSuperAdmin = user.value?.nombre === 'Super Admin' || user.value?.nombre === 'Gerente General';
  const hasRole = userRoles.value.some(role => role.name === 'super-admin');
  const hasPermission = permissions.value.includes('super admin');
  
  console.log('Debug Super Admin:', {
    isNamedSuperAdmin,
    hasRole,
    hasPermission,
    userRoles: userRoles.value,
    permissions: permissions.value,
    userName: user.value?.nombre
  });
  
  return isNamedSuperAdmin || hasRole || hasPermission;
});

// Iconos para cada sección
const iconComponents = {
  UsersIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>`,
  CubeIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"/></svg>`,
  UserGroupIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/></svg>`,
  CashIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>`,
  ChartBarIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg>`,
  CreditCardIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 6v2h12V8H4z" clip-rule="evenodd"/></svg>`,
  TagIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V3a1 1 0 011-1h7c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>`,
  CollectionIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>`,
  KeyIcon: () => `<svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd"/></svg>`
};

// Define secciones del menú con iconos mejorados
const menuSections = [
  {
    name: 'Administración',
    items: [
      { 
        name: 'Gestión de Usuarios', 
        href: '/usuarios', 
        permission: 'gestionar usuarios',
        icon: 'UsersIcon'
      }
    ]
  },
  {
    name: 'Inventario',
    items: [
      { 
        name: 'Marcas', 
        href: '/marcas', 
        permission: 'ver marcas',
        icon: 'TagIcon'
      },
      { 
        name: 'Licencias', 
        href: '/licencias', 
        permission: 'ver licencias',
        icon: 'KeyIcon'
      },
      { 
        name: 'Categorías', 
        href: '/categorias', 
        permission: 'ver categorias',
        icon: 'CollectionIcon'
      }
    ]
  },
  {
    name: 'Clientes',
    items: [
      { 
        name: 'Gestión de Clientes', 
        href: '/clientes', 
        permission: 'gestionar clientes',
        icon: 'UserGroupIcon'
      }
    ]
  },
  {
    name: 'Ventas',
    items: [
      { 
        name: 'Ver Ventas', 
        href: '/ventas', 
        permission: 'ver ventas',
        icon: 'CashIcon'
      },
      { 
        name: 'Pagos', 
        href: '/pagos', 
        permission: 'ver pagos',
        icon: 'CreditCardIcon'
      }
    ]
  },
  {
    name: 'Reportes',
    items: [
      { 
        name: 'Análisis y Reportes', 
        href: '/reportes', 
        permission: 'ver reportes',
        icon: 'ChartBarIcon'
      }
    ]
  }
];

// Filtrar secciones visibles según permisos
const visibleSections = computed(() => {
  console.log('Filtering sections with:', {
    isSuperAdmin: isSuperAdmin.value,
    permissions: permissions.value,
    user: user.value
  });

  const filtered = menuSections
    .map(section => ({
      name: section.name,
      items: section.items.filter(item => {
        const hasPermission = isSuperAdmin.value || permissions.value.includes(item.permission);
        console.log(`Item: ${item.name}, Permission: ${item.permission}, Has access: ${hasPermission}`);
        return hasPermission;
      })
    }))
    .filter(section => section.items.length > 0);
    
  console.log('Visible sections:', filtered);
  return filtered;
});

// Funciones auxiliares
const getUserInitials = (name) => {
  if (!name) return 'U';
  return name.split(' ').map(word => word[0]).join('').substring(0, 2).toUpperCase();
};

const getUserRole = () => {
  if (isSuperAdmin.value) return 'Super Administrador';
  if (userRoles.value.length > 0) {
    const roleNames = {
      'administracion': 'Administrador',
      'encargado_almacen': 'Encargado de Almacén',
      'encargado_comercial': 'Encargado Comercial',
      'vendedor': 'Vendedor'
    };
    return roleNames[userRoles.value[0].name] || userRoles.value[0].name;
  }
  return 'Usuario';
};

const getIcon = (iconName) => {
  return {
    template: iconComponents[iconName] || iconComponents.CubeIcon
  };
};

const isCurrentPage = (href) => {
  return window.location.pathname === href;
};
</script>