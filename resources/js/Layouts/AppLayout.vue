<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
            <div class="p-6 border-b border-gray-200">
                Bienvenido {{ $page.props.auth.user.name }}

                <br>

                Roles: <span v-for="(Rol, index) in Roles" :key="index">
                    {{Rol}}<span v-if="Roles.length-1!=index">, </span>
                </span>
                <span v-if="Roles.length==0">No se tiene ningun rol asignado</span>


            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import { Head } from '@inertiajs/vue3';
</script>

<script>

    import axios from 'axios';

    export default {


        mounted() {
            this.ObtenerRoleUsuario()
        },

        data() {
            return {
                Roles:Array,
                ListaRoles:[],
            }
        },
        methods: {
            async ObtenerRoleUsuario(){

                await axios.get('/RolUsuario') // Ruta de la API en Laravel
                .then(response => {
                    this.ListaRoles = response.data.ListaRoles;
                    this.Roles=this.ListaRoles;
                    console.log("Lista Roles:",response.data.ListaRoles);
                })
                .catch(error => {
                    console.error('Error al obtener datos:', error);
                });
            },
        },
    };
</script>
