<template>


    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
         class="fixed inset-0 z-20 bg-[#014e8200] transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
         class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-68 bg-[#014E82] dark:bg-slate-900 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">

         <div class="flex ml-8 items-center mt-8 mb-6">
            <div class="flex items-center">


                    <img src="/img/LogoTecNacional3.png" alt="Descripción de la imagen" class="w-30 h-20  ">


            </div>
        </div>




        <nav class="mt-4" x-data="{ isMultiLevelMenuOpen: false }" >
            <nav-link :href="route('dashboard')" :active="route().current('dashboard')"
            >
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


            <!-- <nav-link :href="route('Prueba.index')" target="_blank" :active="route().current('Plazas.Index')"  >
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                    Descargar PDF
            </nav-link> -->


            <!-- <nav-link :href="route('FechaReinscripcion.index')" :active="route().current('Plazas.Index')"  >
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                    Horario reinscripcion
            </nav-link> -->

            <nav-link :href="route('Aplicaciones.index')" :active="route().current('Aplicaciones.index')"
            v-if="$page.props.user.permissions.includes('Ver periodos de aplicacion') || $page.props.user.permissions.includes('Agregar Periodos de aplicacion') ||
            $page.props.user.permissions.includes('Editar Información de los periodos de aplicacion') || $page.props.user.permissions.includes('Eliminar Periodos de Aplicacion') ||
            $page.props.user.permissions.includes('Actualizar fechas en los periodos de aplicacion')"
            >
                <template #icon>
                    <i class="fa-solid fa-clock"></i>
                </template>
                    Periodo aplicación
            </nav-link>



            <nav-link :href="route('Users.index')" :active="route().current('Users.index')"
            v-if="$page.props.user.permissions.includes('Agregar Usuarios') || $page.props.user.permissions.includes('Editar Usuarios') ||
            $page.props.user.permissions.includes('Eliminar Usuarios') || $page.props.user.permissions.includes('Ver usuarios') ||
             $page.props.user.permissions.includes('Asignar roles a los usuarios')"
            >

                <template #icon>
                    <i class="fa-solid fa-user"></i>
                </template>
                Usuarios

            </nav-link>



            <nav-link :href="route('Roles.index')" :active="route().current('Roles.index')"  >

                <template #icon>
                    <i class="fa-solid fa-users"></i>
                </template>
                Roles/Permisos

            </nav-link>


            <nav-link :href="route('Personal.index')" :active="route().current('Personal.index')"  >
                <template #icon>
                    <i class="fa-solid fa-person"></i>
                </template>
                Personal
            </nav-link>


            <nav-link :href="route('Plazas.index')" :active="route().current('Plazas.index')"
            v-if="$page.props.user.permissions.includes('Editar Plazas') || $page.props.user.permissions.includes('Eliminar Plazas') ||
            $page.props.user.permissions.includes('Agregar Plazas') || $page.props.user.permissions.includes('Ver Plazas')"
            >
                <template #icon>
                    <i class="fa-solid fa-briefcase"></i>
                </template>
                Plazas
            </nav-link>


            <nav-link :href="route('Profesores.index')" :active="route().current('Profesores.index')"  >
                <template #icon>
                    <i class="fa-solid fa-chalkboard-user"></i>
                </template>
                Profesores
            </nav-link>

            <!-- <nav-link :href="route('Promedio.index')" :active="route().current('Promedio.index')" >
                <template #icon>
                    <i class="fa-solid fa-calculator"></i>
                </template>
                    Promedio Semestres
            </nav-link> -->


            <nav-link :href="route('Materias.index')" :active="route().current('Materias.index')"  >
                <template #icon>
                    <i class="fa-solid fa-book"></i>
                </template>
                    Materias
            </nav-link>


            <nav-link :href="route('HorariosDocentes.index')" :active="route().current('HorariosDocentes.index')"  >
                <template #icon>
                    <i class="fa-regular fa-calendar"></i>
                </template>
                Crear Horario
            </nav-link>

            <nav-link :href="route('Departamentos.index')" :active="route().current('Departamentos.index')"  >
                <template #icon>
                    <i class="fa-solid fa-building-user"></i>
                </template>
                Departamentos
            </nav-link>


            <nav-link :href="route('Aulas.index')" :active="route().current('Aulas.index')"  >
                <template #icon>
                    <i class="fa-solid fa-school"></i>
                </template>
                Aulas
            </nav-link>


            <nav-link :href="route('backup.index')" :active="route().current('backup.index')" >
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
        },

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
