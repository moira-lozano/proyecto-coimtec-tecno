<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}

// Obtener versiones de Laravel y PHP para mostrar en el footer
const page = usePage();
const laravelVersion = page.props.laravelVersion || 'unknown';
const phpVersion = page.props.phpVersion || 'unknown';
</script>

<template>
  <div class="min-h-screen bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 flex flex-col justify-center items-center text-white px-4">
    <Head title="Welcome" />

    <h1 class="text-5xl font-extrabold mb-6 drop-shadow-lg">
      ¡Bienvenido a Mi App!
    </h1>

    <p class="text-lg mb-10 max-w-xl text-center drop-shadow">
      E-commerce de ventas de licencias.
    </p>

    <div class="space-x-4">
      <Link
        :href="route('login')"
        class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded shadow hover:bg-gray-100 transition"
      >
        Iniciar sesión
      </Link>

      <Link
        :href="route('register')"
        class="px-6 py-3 bg-indigo-700 hover:bg-indigo-900 rounded font-semibold shadow transition"
      >
        Registrarse
      </Link>
    </div>

    <footer class="mt-20 text-sm opacity-70">
      Laravel v{{ laravelVersion }} • PHP v{{ phpVersion }}
    </footer>
  </div>
</template>

<style scoped>
/* Estilos personalizados aquí */
</style>
