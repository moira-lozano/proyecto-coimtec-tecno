<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineOptions({ layout: AuthenticatedLayout });

defineProps({
  auth: Object
});
</script>

<template>
    <div class="p-0 m-0">
      <h2 class="text-xl font-bold mb-2">Bienvenido</h2>
        <p>{{ auth.user.email }}</p>
    </div>
</template>