<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
         class="fixed inset-0 z-20 bg-[#014e8200] transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-68 bg-[#014E82] dark:bg-slate-900 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">

         <div class="flex ml-8 items-center mt-8 mb-6 mr-5">
            <div class="flex items-center">
                    <img src="/img/LogoTecNacional3.png" alt="Descripción de la imagen" class="w-30 h-20  ">
            </div>
        </div>

        <nav class="mt-4" x-data="{ isMultiLevelMenuOpen: false }" >
            <nav-link :href="route('dashboard')" :active="route().current('dashboard')"
            >
                <template #icon>
                    <!-- <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg> -->
                    <i class="fa-solid fa-house"></i>
                </template>
                Inicio

            </nav-link>


            <nav-link :href="route('Aplicaciones.index')" :active="route().current('Aplicaciones.index')"
            v-if="$page.props.user.roles.includes('Administrador')"
            >
                <template #icon>
                    <i class="fa-solid fa-clock"></i>
                </template>
                <span class="">Configuración periodos</span>
                    <!-- Periodo aplicación -->
            </nav-link>

            <nav-link :href="route('Users.index')"
            :active="route().current('Users.index') || route().current('Users.edit') || route().current('Users.editRole') "
            v-if="$page.props.user.roles.includes('Administrador')"
            >

                <template #icon>
                    <i class="fa-solid fa-user"></i>
                </template>
                Usuarios

            </nav-link>

            <nav-link :href="route('Roles.index')" :active="route().current('Roles.index')|| route().current('Roles.edit') || route().current('Roles.editPermisos')"
            v-if="$page.props.user.roles.includes('Administrador') "  >
                <template #icon>
                    <i class="fa-solid fa-users"></i>
                </template>
                Tipo de Usuarios

            </nav-link>


            <nav-link :href="route('Avisos.index')" :active="route().current('Avisos.index')|| route().current('Avisos.edit')"
            v-if="$page.props.user.roles.includes('Administrador') "  >
                <template #icon>
                    <i class="fa-solid fa-bullhorn"></i>
                </template>
                Avisos
            </nav-link>

            <nav-link :href="route('Personal.index')" :active="route().current('Personal.index') || route().current('Personal.Activos') || route().current('Personal.Bajas') ||
            route().current('Personal.create') || route().current('Personal.edit') "
            v-if="$page.props.user.roles.includes('Recursos Humanos')" >
                <template #icon>
                    <i class="fa-solid fa-person"></i>
                </template>
                Personal
            </nav-link>

        <!-------- Version escuela---------------------------->
            <!-- <nav-link :href="route('Personal.Reportes')" :active="route().current('Personal.Reportes') "
            v-if="$page.props.user.roles.includes('Recursos Humanos')" >
                <template #icon>
                    <i class="fa-solid fa-person"></i>
                </template>
                Reportes
            </nav-link> -->
            <!----------------------------------------------------->

            <nav-link :href="route('Plazas.index')" :active="route().current('Plazas.index') || route().current('Plazas.edit')"
            v-if="$page.props.user.roles.includes('Recursos Humanos') "
            >
                <template #icon>
                    <i class="fa-solid fa-user-tie"></i>
                </template>
                Plazas
            </nav-link>

            <nav-link :href="route('categorias.index')" :active="route().current('categorias.index') || route().current('categorias.edit')"
            v-if="$page.props.user.roles.includes('Recursos Humanos') ">
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                Categorias Plazas
            </nav-link>


            <nav-link :href="route('HorariosDocentes.index')" :active="route().current('HorariosDocentes.index')"
            v-if="$page.props.user.roles.includes('Recursos Humanos')">
                <template #icon>
                    <i class="fa-regular fa-calendar"></i>
                </template>
                Horarios
            </nav-link>


            <nav-link :href="route('Departamentos.index')" :active="route().current('Departamentos.index')|| route().current('Departamentos.edit')"
            v-if="$page.props.user.roles.includes('Recursos Humanos') ">
                <template #icon>
                    <i class="fa-solid fa-building-user"></i>
                </template>
                Jefes
            </nav-link>


             <!----------VERSION ESCUELA ------------>
                <!--


                <nav-link :href="route('Calificaciones.index')" :active="route().current('Calificaciones.index')"
                v-if="$page.props.user.roles.includes('Administrador')">
                    <template #icon>
                        <i class="fa-solid fa-clipboard"></i>
                    </template>
                    Calificaciones
                </nav-link> -->

            <!----------------------------------------->


            <nav-link :href="route('backup.index')" :active="route().current('backup.index')"
            v-if="$page.props.user.roles.includes('Administrador')">
                <template #icon>
                    <i class="fa-solid fa-database"></i>
                </template>
                Respaldar Base
            </nav-link>



        </nav>

        <br>
    </div>


</template>

<script>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

import axios from 'axios';


export default {



    //Objeto DATA
    data() {
        return {
        items: [],
        userID:this.$page.props.auth.user.id, // Obtiene el ID del usuario
        ListaRoles:[],
        Rol:"",
        Permiso:"",
        decision:"",


        tooltipContent:'Soy el contenido'
        };
    },

    components: {
        NavLink,
        Link,
    },

    setup() {
        let showingTwoLevelMenu = ref(false)

        return {
            showingTwoLevelMenu
        }
    },

    methods:{

    },



}
</script>



<style scoped>
.max-h-64 {
  /* Establece una altura máxima */
  max-height: 16rem;
}

.overflow-y-auto::-webkit-scrollbar {
  width: 3px; /* Ancho de la barra de desplazamiento */
}

.overflow-y-auto::-webkit-scrollbar-thumb {
  background-color:#757c81a5; /* Color del pulgar de la barra de desplazamiento */
  border-radius: 2px; /* Bordes redondeados del pulgar */
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
  background-color: #b8bdc1; /* Color del pulgar de la barra de desplazamiento al pasar el mouse */
}
</style>
