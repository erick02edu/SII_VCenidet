<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>



    <div class="min-h-screen flex flex-col sm:justify-start items-center pt-6 sm:pt-12 bg-gray-100">

            <img src="/img/IconoTec.png" alt="Error al cargar imagen" class="w-50 h-20 pl-4">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg  border-t-4 border-[#316385]">

            <p class="flex items-center justify-center w-full py-4 text-lg font-black"> Restablecimiento de contraseña</p>
            <div class="mb-4 text-sm text-gray-600">
                Ingrese su direccion de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.
            </div>

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="flex items-center justify-end mt-7 mb-7">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Enviar enlace a mi correo
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
