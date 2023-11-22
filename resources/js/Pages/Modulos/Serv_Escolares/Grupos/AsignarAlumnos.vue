<template>

    <Head title="Asignar alumnos" />
    <AuthenticatedLayout>

    <template #header>
           Asignar alumnos
    </template>

    <div class="flex w-full">
        <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
            <strong>Grupo:</strong>
            {{ grupo.Semestre }}-{{ grupo.Letra }}-{{ grupo.Especialidad }}
        </p>

        <button v-if="$page.props.user.roles.includes('Administrador')" @click="showElement"
        class=" ml-auto mr-9 rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7]  ">
            <i class="fa-solid fa-plus dark:text-white pr-2"></i>
            Añadir alumno(s)
            <i class="fa-solid fa-book-open-reader pl-1"></i>
        </button>
    </div>

    <!-- Capa oscura -->
    <div :class="{ hidden: !isVisible }" class="fixed inset-0  bg-black opacity-50">
    </div>

    <div id="modalContainer">
        <!-- Main modal -->
        <div :class="{ hidden: !isVisible }">

            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Agregar alumnos
                            </h3>
                        <button type="button" @click="hideElement" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 w-full">
                        <form @submit.prevent="AgregarAlumnos"  class="w-full">
                            <label class=" w-full block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-first-name">
                                    Seleccione los alumnos para agregar al grupo
                            </label>

                            <div class="flex flex-wrap  mb-6 ">

                                <div class="relative dark:text-white text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200 pb-3">

                                    <input
                                    class=" border-gray-300 dark:border-gray-500 bg-white dark:bg-slate-700 h-10 px-4 pr-20 dark:text-gray-200 rounded-lg text-sm focus:outline-none"
                                    type="text"
                                    :placeholder="'Buscar por ' + campoBusquedaVer"
                                    v-model="AlumnoBuscar"
                                    @keyup="contarTiempo"
                                    />

                                    <div class="relative inline-block text-left pl-3">
                                            <div>
                                                <button type="button"  @click="MostrarOpcionesFiltro" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-500 shadow-sm px-4 py-2 bg-white dark:bg-slate-700  text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 focus:outline-none focus:ring focus:[#014E82] active:bg-gray-200" id="dropdown-menu-button" aria-haspopup="true" aria-expanded="true">
                                                <span class="pr-2"> <i class="fa-solid fa-filter"></i>  </span>{{ campoBusquedaVer }}
                                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M9.293 5.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L10 7.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 010 0z" clip-rule="evenodd" />
                                                </svg>
                                                </button>
                                            </div>

                                            <div v-if="MostrarFiltro" class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu-button" tabindex="-1">
                                                <div class="py-1 dark:bg-slate-700 dark:hover:bg-slate-500 " role="menuitem" tabindex="-1" id="dropdown-menu-item-1" href="#">
                                                <span @click="SeleccionarCampo('Nombre','Nombre')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-slate-500 dark:text-gray-200">Nombre</span>
                                                </div>

                                                <div class="py-1 dark:bg-slate-700 dark:hover:bg-slate-500 " role="menuitem" tabindex="-1" id="dropdown-menu-item-2" href="#">
                                                <span @click="SeleccionarCampo('noControl','No.Control')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-slate-500 dark:text-gray-200">No.Control</span>
                                                </div>



                                            </div>
                                    </div>

                                </div>



                                <div class="w-full p-3 overflow-y-auto h-64 border rounded-lg border-gray-300 dark:border-gray-500">
                                    <!--TABLA ASIGNAR ALUMNOS A UN GRUPO-->
                                    <div class="inline-block min-w-full overflow-hidden rounded-lg shadow mb-4">
                                            <table class="w-full">
                                                <!--Encabezados-->
                                                <thead>
                                                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase  text-gray-500">

                                                        <th class="border-b-2 w-5 pl-5 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">

                                                        </th>

                                                        <th class="border-b-2 w-4/5 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                                            <!-- Alumnos sin grupo {{  NuevoGrupo.AlumnosSeleccionados }} -->
                                                            Alumnos sin grupo
                                                        </th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <tr v-for="alumno in alumnosSinGrupo" :key="alumno.id" class="text-gray-700">

                                                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                            <input type="checkbox" name="alumnosAgregar"  id="" :value="alumno.id" v-model="NuevoGrupo.AlumnosSeleccionados">
                                                        </td>

                                                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                                {{ alumno.noControl }}-{{ alumno.Nombre }} {{ alumno.ApellidoP }} {{ alumno.ApellidoM }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center py-5 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
                                <button type="submit" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Agregar
                                </button>
                                <button @click="hideElement" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Cancelar
                                </button>
                            </div>

                        </form>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>

    <!--TABLA ASIGNAR ALUMNOS A UN GRUPO-->
    <div class="inline-block min-w-full overflow-hidden rounded-lg shadow mb-4">
            <table class="w-full">
                <!--Encabezados-->
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase  text-gray-500">

                        <th class="border-b-2 w-4/5 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Alumno del grupo
                        </th>

                        <th v-if="$page.props.user.roles.includes('Administrador')"
                        class="border-b-2 w-1/5 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700  py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Opciones
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="alumno in alumnos" :key="alumno.id" class="text-gray-700">

   

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                {{ alumno.noControl }}-{{ alumno.Nombre }} {{ alumno.ApellidoP }} {{ alumno.ApellidoM }}
                            </p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800  py-5 text-sm">
                            <span class="p-3 rounded-md bg-[#dc2626] inline-flex mb-1"
                            @click="showDelete(alumno)" >
                                <i class="fa-solid fa-user-minus text-white"></i>
                            </span>

                                    <div>
                                        <div :class="{ hidden: !isvisibleDelete }"  tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
                                            <div class="relative w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button @click="hideDelete" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-6 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>


                                                        <h3  class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                            Esta seguro de eliminar al alumno {{ alumnoEliminarGrupo.Nombre }}{{ alumnoEliminarGrupo.ApellidoP }}
                                                            {{ alumnoEliminarGrupo.ApellidoM }} del Grupo:
                                                            {{ grupo.Semestre }}-{{ grupo.Letra }}-{{ grupo.Especialidad }}

                                                        </h3>
                                                        <button @click="QuitarGrupo"  type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Si, estoy seguro
                                                        </button>


                                                        <button @click="hideDelete" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                        </td>


                    </tr>
                </tbody>

            </table>
    </div>

    </AuthenticatedLayout>

</template>



<script setup>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Pagination from '@/Components/Pagination.vue';
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3';
</script>


<script>
import axios from 'axios';

export default {

    components:{
        Link
    },

    props:{
         grupo:Array,
         alumnos:Array,
         alumnosSinGrupo:Array,
    },



    data() {
        return {
            NuevoGrupo:{
                idGrupo:this.$page.props.grupo.id,
                AlumnosSeleccionados:[],
            },

            isVisible:false,
            isvisibleDelete:false,

            alumnosAgregar:[],
            AlumnoBuscar:'',

            alumnoEliminarGrupo:'',

            MostrarFiltro:false,
            setTimeoutBuscador:'',
            campoBusqueda:'Nombre',
            campoBusquedaVer:'Nombre',


        }
    },

    methods: {
        MostrarOpcionesFiltro(){
            this.$page.props.mensaje=null
            if(this.MostrarFiltro==true){
                this.MostrarFiltro=false
            }
            else{
                this.MostrarFiltro=true
            }
        },

        SeleccionarCampo(campo,campoVer){
            this.campoBusqueda=campo
            this.campoBusquedaVer=campoVer
            this.MostrarFiltro=false
            this.HacerBusqueda();
        },

        contarTiempo(){
            clearTimeout(this.setTimeoutBuscador);
            this.setTimeoutBuscador=setTimeout(this.HacerBusqueda,360)
        },

        HacerBusqueda(){
            console.log(this.AlumnoBuscar);

            axios.get('/Alumnos.buscar',{   params:{ Alumno:this.AlumnoBuscar,campo:this.campoBusqueda,Grupo:true}   })
            .then(response => {

                this.resultadosBusqueda=response.data;
                console.log(this.resultadosBusqueda);
                this.$page.props.alumnosSinGrupo=this.resultadosBusqueda;
            })
            .catch(error => {
                console.error('Error al hacer la busqueda:', error);
            });
        },

        async AgregarAlumnos(){
            await this.$inertia.post(route('Alumnos.AsignarGrupo'),this.NuevoGrupo)
            this.hideElement()
        },

        showElement(){
            this.isVisible = true;
        },

        hideElement() {
            this.isVisible = false;
        },

        showDelete(alumno){
            console.log('Alumno',alumno)
            this.alumnoEliminarGrupo=alumno


            //this.idBorrarSeleccionado=id;
            this.isvisibleDelete = true;
        },


        hideDelete(){
            this.isvisibleDelete = false;
        },

        QuitarGrupo(){
            console.log('Quitar');
            this.alumnoEliminarGrupo.idGrupo=null

            console.log('Alumno sin grupo:',this.alumnoEliminarGrupo)
            this.$inertia.put(
                route("Alumnos.QuitarGrupo",this.alumnoEliminarGrupo.id)
            );
            this.hideDelete();
        }
    },
};
</script>
