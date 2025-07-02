<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
  correo: '',
  clave: '',
  remember: false
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('clave'),
  })
}
</script>

<template>
    <!-- Este componente NO debe usar AuthenticatedLayout -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <Head title="Iniciar Sesión" />

        <!-- Logo y título -->
        <div class="flex flex-col items-center mb-6">
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
            <h1 class="mt-4 text-2xl font-bold text-gray-900">Mi Sistema</h1>
            <p class="mt-2 text-sm text-gray-600">Laravel v12.19.3 / PHP v8.2.12</p>
        </div>

        <!-- Formulario de login -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="correo" value="Correo Electrónico" />

                    <TextInput
                        id="correo"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.correo"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.correo" />
                </div>

                <div class="mt-4">
                    <InputLabel for="clave" value="Contraseña" />

                    <TextInput
                        id="clave"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.clave"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="mt-2" :message="form.errors.clave" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <input
                            type="checkbox"
                            name="remember"
                            v-model="form.remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        />
                        <span class="ml-2 text-sm text-gray-600">Recordarme</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        ¿Olvidaste tu contraseña?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Iniciar Sesión
                    </PrimaryButton>
                </div>

                <div class="mt-6 text-center">
                    <Link
                        :href="route('register')"
                        class="text-sm text-indigo-600 hover:text-indigo-900"
                    >
                        ¿No tienes cuenta? Regístrate
                    </Link>
                </div>
            </form>
        </div>

        <!-- Botones de acción rápida -->
        <div class="mt-8 flex space-x-4">
            <button
                @click="() => { form.correo = 'admin@example.com'; form.clave = 'password'; }"
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Iniciar Sesión
            </button>
            
            <Link
                :href="route('register')"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            >
                Registrarse
            </Link>
        </div>
    </div>
</template>