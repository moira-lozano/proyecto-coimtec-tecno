<script setup>
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const canLogin = page.props.canLogin;
const canRegister = page.props.canRegister;
const laravelVersion = page.props.laravelVersion;
const phpVersion = page.props.phpVersion;
</script>

<template>
  <Head title="Bienvenido" />

  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white flex flex-col items-center justify-center px-4">
    <!-- Logo -->
    <div class="mb-6">
      <img src="https://laravel.com/img/logomark.min.svg" class="h-16" alt="Laravel" />
    </div>

    <!-- Título -->
    <h1 class="text-3xl font-bold mb-2">Bienvenido al sistema</h1>
    <p class="text-center mb-6 text-sm text-gray-500">Laravel v{{ laravelVersion }} / PHP v{{ phpVersion }}</p>

    <!-- Botones de acceso -->
    <div class="space-x-4" v-if="canLogin">
      <Link
        :href="route('login')"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
      >
        Iniciar Sesión
      </Link>

      <Link
        v-if="canRegister"
        :href="route('register')"
        class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition"
      >
        Registrarse
      </Link>
    </div>
  </div>
</template>
