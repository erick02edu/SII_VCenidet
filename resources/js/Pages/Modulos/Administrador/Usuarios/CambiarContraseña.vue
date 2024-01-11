
<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue'
    import { Head, useForm } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3'
    import Checkbox from '@/Components/Checkbox.vue';


</script>

<script>
    export default {

        components:{
            Link
        },
        props:{
            usuario:Array
        },
        data() {
            return {
                NuevoUsuario: {
                    id:this.$page.props.usuario.id,
                    password:'',
                    passwordRepeat:'',
                },
                msjPassword:false,
            }
        },
        methods: {

            CambiarPassword(){

                if(this.NuevoUsuario.password==this.NuevoUsuario.passwordRepeat){
                    this.$inertia.post(route("User.password",this.NuevoUsuario))
                }
                else{
                    this.msjPassword=true;
                }
            },
        },
    };
</script>

<template>
    <Head title="Asignar tipo usuario" />
        <AuthenticatedLayout>
            <template #header>
                <p class="pl-8">Cambiar contraseña</p>
            </template>
            <div class="py-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-xl sm:rounded-lg">
                        <form @submit.prevent="CambiarPassword" class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7 mb-3">
                                <div class=" grid-cols-1 inline">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">
                                        Nombre del usuario: </label>
                                    <span class="dark:text-gray-200">{{ usuario.name }}</span>
                                </div>
                            </div>


                            <strong class="pl-8 dark:text-gray-200 ">Ingresa la nueva contraseña</strong><br>
                            <input id="Nombre"
                            class="ml-8 mt-1 appearance-none w-1/2 bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border
                             border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none
                            focus:bg-white" v-model="NuevoUsuario.password"
                            type="password" placeholder="Ingrese la nueva contraseña" required>
                            <p v-if="msjPassword==true" class="ml-8 text-sm text-red-600 mb-1  ">La contraseñas deben iguales</p>

                            <div class="w-full my-1"></div>

                            <strong class="pl-8 dark:text-gray-200 ">Repetir la nueva contraseña</strong><br>
                            <input id="Nombre"
                            class="ml-8 mt-1 appearance-none w-1/2 bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border
                             border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none
                            focus:bg-white" v-model="NuevoUsuario.passwordRepeat"
                            type="password" placeholder="Ingrese la nueva contraseña" required>
                            <p v-if="msjPassword==true" class="ml-8 text-sm text-red-600 mb-1  ">La contraseñas deben iguales</p>


                            <div class='flex justify-start ml-8 md:gap-4 gap-4 pt-5 pb-5 pr-4'>
                                <button
                                type="submit"
                                class='w-auto bg-[#014E82] hover:bg-[#0284c7] rounded-lg shadow-xl font-medium text-white px-4 py-2'
                                >
                                Actualizar contraseña
                                </button>
                                <Link
                                    :href="route('Users.index')"
                                    class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' type="button">
                                    Cancelar
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
</template>




