<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  usuario: Object,
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Detalle del Usuario" />

    <div class="max-w-4xl mx-auto py-10">
      <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6">Detalle del Usuario</h1>

        <div class="space-y-4">
          <div>
            <p class="text-sm text-gray-500">Nombre:</p>
            <p class="text-lg text-gray-900">{{ usuario.nombre }}</p>
          </div>

          <div>
            <p class="text-sm text-gray-500">Correo:</p>
            <p class="text-lg text-gray-900">{{ usuario.correo }}</p>
          </div>

          <div>
            <p class="text-sm text-gray-500">Rol:</p>
            <p class="text-lg text-gray-900">
              <span v-if="usuario.roles.length">
                {{ usuario.roles.map(r => r.name).join(', ') }}
              </span>
              <span v-else class="text-gray-400">Sin rol</span>
            </p>
          </div>

          <div v-if="usuario.vendedor">
            <p class="text-sm text-gray-500">Carnet (Vendedor):</p>
            <p class="text-lg text-gray-900">{{ usuario.vendedor.carnet }}</p>
          </div>
        </div>

        <div class="mt-6">
          <Link href="/usuarios"
                class="text-blue-600 hover:underline">
            ← Volver a la lista
          </Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
