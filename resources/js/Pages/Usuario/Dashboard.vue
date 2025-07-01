<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
defineProps({ auth: Object });
</script>

<template>
  <AuthenticatedLayout>
    <div class="p-0 m-0">
      <h2 class="text-xl font-bold mb-2">Bienvenido</h2>
      <p>{{ auth.user.correo }}</p>
    </div>
  </AuthenticatedLayout>
</template>
