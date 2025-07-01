<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth?.user;
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        Bienvenido, {{ user?.nombre ?? 'Invitado' }}
      </div>
    </header>

    <main class="p-6">
      <slot />
    </main>
  </div>
</template>
