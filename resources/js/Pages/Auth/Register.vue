<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    correo: '',
    clave: '',
    clave_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('clave', 'clave_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Registro" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nombre" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                   
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="correo" value="Correo electrónico" />

                <TextInput
                    id="correo"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.correo"
                    required
                    
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
                    
                />

                <InputError class="mt-2" :message="form.errors.clave" />
            </div>

            <div class="mt-4">
                <InputLabel for="clave_confirmation" value="Confirmar Contraseña" />

                <TextInput
                    id="clave_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.clave_confirmation"
                    required
                   
                />

                <InputError class="mt-2" :message="form.errors.clave_confirmation" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    ¿Ya estás registrado?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Registrarse
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
