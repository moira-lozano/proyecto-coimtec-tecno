<template>
  <h1>Bienvenido, {{ usuario.correo }}</h1>
</template>

<script setup>
defineProps({ usuario: Object });
</script>
