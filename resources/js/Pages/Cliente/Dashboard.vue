<script setup>
import FlowbiteLayout from '@/Layouts/FlowbiteLayout.vue';

defineOptions({ layout: FlowbiteLayout });

defineProps({
  auth: Object
});
</script>

<template>
  <div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-2">Bienvenido</h2>
    <p>{{ auth.user.email }}</p>
  </div>
</template>
