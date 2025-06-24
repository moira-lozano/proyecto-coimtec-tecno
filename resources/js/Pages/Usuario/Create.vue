<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const form = useForm({
  correo: '',
  clave: '',
  clave_confirmation: '',
  rol: '',
  nombre: '',
  carnet: '',
});

const submit = () => {
  form.post(route('usuarios.store'), {
    onFinish: () => form.reset('clave', 'clave_confirmation'),
  });
};
</script>

<template>
<AuthenticatedLayout>
  <Head title="Registrar Usuario y Vendedor" />

  <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Registrar Usuarios</h1>

    <form @submit.prevent="submit" class="space-y-4">
      <!-- Nombre -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Nombre</label>
        <input v-model="form.nombre" type="text" class="mt-1 block w-full rounded border-gray-300" required />
        <p v-if="form.errors.nombre" class="text-red-600 text-sm mt-1">{{ form.errors.nombre }}</p>
      </div>

      <!-- Correo -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Correo</label>
        <input v-model="form.correo" type="email" class="mt-1 block w-full rounded border-gray-300" required />
        <p v-if="form.errors.correo" class="text-red-600 text-sm mt-1">{{ form.errors.correo }}</p>
      </div>

      <!-- Contraseña -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Contraseña</label>
        <input v-model="form.clave" type="password" class="mt-1 block w-full rounded border-gray-300" required />
        <p v-if="form.errors.clave" class="text-red-600 text-sm mt-1">{{ form.errors.clave }}</p>
      </div>

      <!-- Confirmación de Contraseña -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
        <input v-model="form.clave_confirmation" type="password" class="mt-1 block w-full rounded border-gray-300" required />
        <p v-if="form.errors.clave_confirmation" class="text-red-600 text-sm mt-1">{{ form.errors.clave_confirmation }}</p>
      </div>

      <!-- Rol -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Rol</label>
        <select v-model="form.rol" class="mt-1 block w-full rounded border-gray-300" required>
          <option value="">Seleccione un rol</option>
          <option value="administrador">Admin</option>
          <option value="vendedor">Vendedor</option>
          <option value="cliente">Cliente</option>
          <option value="cliente-canal">Cliente Canal</option>
        </select>
        <p v-if="form.errors.rol" class="text-red-600 text-sm mt-1">{{ form.errors.rol }}</p>
      </div>

      <!-- Carnet del Vendedor -->
      <div>
        <label class="block text-sm font-medium text-gray-700">Carnet</label>
        <input v-model="form.carnet" type="text" class="mt-1 block w-full rounded border-gray-300" required />
        <p v-if="form.errors.carnet" class="text-red-600 text-sm mt-1">{{ form.errors.carnet }}</p>
      </div>

      <!-- Botones -->
      <div class="flex justify-end space-x-4 pt-4">
        <Link
          href="/usuarios"
          class="px-4 py-2 text-gray-700 border border-gray-300 rounded hover:bg-gray-100"
        >
          Cancelar
        </Link>
        <button
          type="submit"
          class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
          :disabled="form.processing"
        >
          Guardar
        </button>
      </div>
    </form>
  </div>
</AuthenticatedLayout>
</template>
