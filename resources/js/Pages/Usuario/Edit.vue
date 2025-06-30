<script setup>
import { useForm, Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  usuario: Object,
});

const editarRol = ref(false); // 👈 checkbox para decidir si se quiere editar el rol

const form = useForm({
  nombre: props.usuario.nombre,
  correo: props.usuario.correo,
  clave: '',
  rol: props.usuario.rol || '', // aseguramos string
  carnet: props.usuario.vendedor?.carnet || '',
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

             <!-- Pregunta para editar el rol -->
            <div>
                <label class="inline-flex items-center">
                <input type="checkbox" v-model="editarRol" class="rounded border-gray-300 mr-2" />
                ¿Desea modificar el rol?
                </label>
            </div>

            <!-- Rol -->
            <div v-if="editarRol">
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <select v-model="form.rol" class="mt-1 block w-full rounded border-gray-300">
                <option value="">Seleccione un rol</option>
                <option value="vendedor">Vendedor</option>
                <option value="cliente">Cliente</option>
                <option value="cliente-canal">Cliente Canal</option>
                </select>
                <p v-if="form.errors.rol" class="text-red-600 text-sm mt-1">{{ form.errors.rol }}</p>
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
