<script setup>
import Form from './Form.vue';
import { useForm } from '@inertiajs/vue3';



defineProps({ usuarios: Array });

const form = useForm({
  carnet: '',
  nombre: '',
  nit: '',
  correo: '',
  empresa: '',
  cod_pais1: '',
  celular1: '',
  cod_pais2: '',
  celular2: '',
  id_usuario: ''
});

const submit = () => form.post('/clientes');

</script>

<template>
  <AuthenticatedLayout>
    <Form :form="form" :usuarios="usuarios" :processing="form.processing" @submit="submit" />
  </AuthenticatedLayout>
</template>