<template>
  <div class="flex">
    <!-- Sidebar solo si hay usuario -->
    <Sidebar v-if="$page.props.auth.user" :open="sidebarOpen" @close="sidebarOpen = false"/>
    <div class="flex-1 flex flex-col min-h-screen">
      <!-- Aquí podrías poner tu Navbar si lo tienes -->
      <main class="p-6 flex-1">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import Sidebar from './Sidebar.vue';

const sidebarOpen = ref(false);
</script>
