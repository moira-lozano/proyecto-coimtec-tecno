<script setup>
import ClienteForm from './Form.vue';
import { useForm } from '@inertiajs/vue3';


const { cliente, usuarios } = defineProps({
  cliente: Object,
  usuarios: Array
});

const form = useForm({
  carnet: cliente.carnet,
  nombre: cliente.nombre,
  nit: cliente.nit,
  correo: cliente.correo,
  empresa: cliente.empresa,
  cod_pais1: cliente.cod_pais1,
  celular1: cliente.celular1,
  cod_pais2: cliente.cod_pais2,
  celular2: cliente.celular2,
  id_usuario: cliente.id_usuario,
});

const submit = () => {
  form.post(route('clientes.update', cliente.id)); // Usa cliente.id
};
</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold text-gray-800 leading-tight">
        Editar Cliente
      </h2>
    </template>

    <ClienteForm
      :form="form"
      :usuarios="usuarios"
      :processing="form.processing"
      :isEdit="true"
      @submit="submit"
    />
  </AuthenticatedLayout>
</template>
