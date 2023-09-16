<template>


    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
         class="fixed inset-0 z-20 bg-[#014E82] transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-[#014E82] transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">

         <div class="flex justify-center items-center mt-8">
            <div class="flex items-center">
                <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                        fill="#014E82" stroke="#014E82" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"/>
                    <path
                        d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                        fill="white"/>
                </svg>

                <span class="mx-2 text-2xl font-semibold text-white">Dashboard</span>

            </div>
        </div>


        <nav class="mt-10" x-data="{ isMultiLevelMenuOpen: false }" >
            <nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                <template #icon>
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                    </svg>
                </template>
                Inicio

            </nav-link>


            <nav-link :href="route('FechaReinscripcion.index')" :active="route().current('Plazas.Index')" v-canPermiso="'Ver Roles'" v-show="none" >
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                    Horario reinscripcion
            </nav-link>

            <nav-link :href="route('Aplicaciones.index')" :active="route().current('Aplicaciones.index')" v-canPermiso="'Ver Roles'" v-show="none" >
                <template #icon>
                    <i class="fa-solid fa-calendar-days"></i>
                </template>
                    Periodo aplicación
            </nav-link>

            <nav-link :href="route('Promedio.index')" :active="route().current('Plazas.Index')" v-canPermiso="'Ver Roles'" v-show="none" >
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                    Promedio Semestres
            </nav-link>

            <!--Poner v show=none en elemento seguido de la directiva can-->
            <nav-link :href="route('Users.index')" :active="route().current('Users.Index')" >

                <template #icon>
                    <i class="fa-solid fa-user"></i>
                </template>
                Usuarios

            </nav-link>

            <nav-link :href="route('Roles.index')" :active="route().current('Roles.Index')" v-canPermiso="'Ver Roles'" v-show="none" >

                <template #icon>
                    <i class="fa-solid fa-users"></i>
                </template>
                Roles

            </nav-link>


            <nav-link :href="route('Plazas.index')" :active="route().current('Plazas.index')" v-canPermiso="'Ver Plazas'" v-show="none" >
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                Plazas
            </nav-link>


            <nav-link :href="route('backup.index')" :active="route().current('backup.index')" >
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                Respaldar Base
            </nav-link>

        </nav>
    </div>


</template>

<script>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'

import axios from 'axios';

export default {

    directives:{
        'canRol':{
            async mounted(el, binding) {

                //Obtemos la instancia del elemento
                const vm = binding.instance;
               // binding.value contiene el valor que pasaste a la directiva
                console.log(binding.value);
                //Obtenemos el rol enviado a traves de la directiva
                vm.Rol=binding.value;

                //Ejecutamos el metodo canRol y obtenemos el resultado
                const resultado= await vm.canRol(vm.Rol);
                vm.resultado=resultado

                console.log("El resultado fue:",vm.resultado)

                if(vm.resultado==true){

                    el.style.display = 'block';  // Mostrar elemento
                }
                else{

                    el.style.display = 'none';  // Ocultar elemento
                }

            },
        },

        'canPermiso':{
            async mounted(el, binding) {
                //Obtemos la instancia del elemento
                const vm = binding.instance;
                // binding.value contiene el valor que pasaste a la directiva
                console.log(binding.value);
                //Obtenemos el permiso enviado a traves de la directiva
                vm.Permiso=binding.value;

                //Ejecutamos el metodo canPermiso y obtenemos el resultado
                var resultado= await vm.canPermiso(vm.Permiso);
                vm.resultado=resultado

                console.log("Directiva result:",vm.resultado);

                if(vm.resultado==true){
                    console.log("ver")
                    el.style.display = 'block';  // Mostrar elemento
                }
                else{
                    console.log("ocultar")
                    el.style.display = 'none';  // Ocultar elemento
                }
            }
        }
    },
    //Objeto DATA
    data() {
        return {
        items: [],
        userID:this.$page.props.auth.user.id, // Obtiene el ID del usuario
        ListaRoles:[],
        Rol:"",
        Permiso:"",
        decision:"",

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
        //Funcion can para saber rol de un usuario
        //True si tiene ese rol--False no tiene ese rol
        async canRol(Rol){
            const userID=this.userID
            const response=await axios.post('/Roles/can',{userID,Rol})

            this.ListaRoles=response.data.roles;

            if(this.ListaRoles.includes(Rol)){
                console.log("Rol asignado")
                return true;
            }
            else{
                console.log("Rol no asignado")
                return false;
            }
        },

        async canPermiso(Permiso){

            const userID=this.userID
            const response=await axios.post('/Permisos/can',{userID,Permiso})
            .catch(error => {
                console.error('Error al obtener datos:', error);
                return false;
            });

            this.decision=response.data.decision;

            console.log("Tiene permisos de",Permiso,":",this.decision);


            return this.decision


        },



    },

}
</script>
