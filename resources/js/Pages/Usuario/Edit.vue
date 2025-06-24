<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  usuario: Object,
});

const form = useForm({
  nombre: props.usuario.nombre,
  correo: props.usuario.correo,
  clave: '',
  rol: props.usuario.rol,
  carnet: props.usuario.vendedor?.carnet || '',
  nombre_vendedor: props.usuario.vendedor?.nombre || '',
});


const submit = () => {
  form.post(route('usuarios.update', props.usuario.id));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Editar Usuario" />

        <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

            <form @submit.prevent="submit" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Usuario</label>
                <input v-model="form.nombre" type="text" class="mt-1 block w-full rounded border-gray-300" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input v-model="form.nombre_vendedor" type="text" class="mt-1 block w-full rounded border-gray-300" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Correo</label>
                <input v-model="form.correo" type="email" class="mt-1 block w-full rounded border-gray-300" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña (dejar en blanco si no cambia)</label>
                <input v-model="form.clave" type="password" class="mt-1 block w-full rounded border-gray-300" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <select v-model="form.rol" class="mt-1 block w-full rounded border-gray-300" required>
                <option value="">Seleccione un rol</option>
                <option value="administrador">Admin</option>
                <option value="vendedor">Vendedor</option>
                <option value="cliente">Cliente</option>
                <option value="cliente-canal">Cliente Canal</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Carnet</label>
                <input v-model="form.carnet" type="text" class="mt-1 block w-full rounded border-gray-300" required />
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <Link
                :href="route('usuarios.index')"
                class="inline-block px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors duration-200"
                >
                Cancelar
                </Link>
                <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                :disabled="form.processing"
                >
                Guardar cambios
                </button>
            </div>
            </form>
        </div>
  </AuthenticatedLayout>
</template>
