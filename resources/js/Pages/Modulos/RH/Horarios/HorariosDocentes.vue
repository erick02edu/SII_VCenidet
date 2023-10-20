<template>

    <Head title="Horarios" />
    <AuthenticatedLayout>
    <template #header>
            Lista de Horarios
    </template>

    <div class="inline-flex w-full" >

        <div class="relative text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200 mb-4">
            <input
                class=" border-gray-100 dark:border-gray-500 bg-white dark:bg-slate-700 h-10 px-4 pr-20 rounded-lg text-sm focus:outline-none"
                type="text"

                placeholder="Buscar.... "
                v-model="UsuarioBuscar"
                @input="HacerBusqueda()"
            />
        </div>


        <div class="relative inline-block text-left pl-3">
        <div>
            <button type="button"  @click="MostrarOpcionesFiltro" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-500 shadow-sm px-4 py-2 bg-white dark:bg-slate-700  text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 focus:outline-none focus:ring focus:[#014E82] active:bg-gray-200" id="dropdown-menu-button" aria-haspopup="true" aria-expanded="true">
             <span class="pr-2"> <i class="fa-solid fa-filter"></i>  </span>{{ campoBusqueda }}
            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9.293 5.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L10 7.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 010 0z" clip-rule="evenodd" />
            </svg>
            </button>
        </div>

        <div v-if="MostrarFiltro" class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu-button" tabindex="-1">

            <div class="py-1 dark:bg-slate-700 dark:hover:bg-slate-500 " role="menuitem" tabindex="-1" id="dropdown-menu-item-1" href="#">
            <span @click="SeleccionarCampo('Profesor')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-slate-500 dark:text-gray-200">Profesor</span>
            </div>

            <div class="py-1 dark:bg-slate-700 dark:hover:bg-slate-500 " role="menuitem" tabindex="-1" id="dropdown-menu-item-2" href="#">
            <span @click="SeleccionarCampo('Periodo')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-slate-500 dark:text-gray-200">Periodo</span>
            </div>

        </div>
        </div>



        <button :type="type" @click="showElement" class=" ml-auto mr-9 rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7]  "
        v-if="$page.props.user.permissions.includes('Crear y Editar Horarios')">
            Crear Horario
        </button>
    </div>






    <!-- Capa oscura -->
    <div :class="{ hidden: !isVisible }" class="fixed inset-0 bg-black opacity-50">
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
                        Crear nuevo horario
                    </h3>
                <button type="button" @click="hideElement" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
            <form @submit.prevent="crearHorario"  class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-first-name" select>
                                Selecciona un profesor
                            </label>

                            <select class="dark:bg-slate-700 dark:text-slate-200 rounded-sm mb-2 " name="periodos" v-model="NuevoHorario.idProfesor" required>

                                <option :value="0"> Seleccione un profesor </option>

                                <option
                                    v-for="(profesor,index) in profesores"
                                    :key="profesor.id"
                                    :value="profesor.id"
                                >

                                    {{ profesor.Nombre }} {{ profesor.ApellidoP }}  {{ profesor.ApellidoM }}
                                </option>
                            </select>

                            <p v-if="mensajeProfesor!=null" class="text-sm text-red-600 ">Por favor selecciona un profesor</p>

                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-1" for="grid-first-name" select>
                                Selecciona el periodo del horario
                            </label>

                            <select name="periodos" v-model="NuevoHorario.idPeriodo" class="dark:bg-slate-700 dark:text-slate-200 rounded-sm ">
                                <option
                                    v-for="periodo in periodos"
                                    :key="periodo.id"
                                    :value="periodo.id"
                                >
                                    {{ periodo.mesInicio }} {{ periodo.AñoInicio }}-{{ periodo.mesTermino }} {{ periodo.AñoTermino }}

                                </option>
                            </select>

                        <!-- Modal footer -->
                        <div class="flex items-center pt-5 pr-5 pb-5 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200 br-4">
                            <button type="submit" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
                            <button @click="hideElement" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        </div>

                        </div>

                </div>
            </form>
        </div>

            </div>
        </div>
        </div>
        </div>
    </div>


    <!--TABLA DE PLAZAS-->
    <div class="inline-block min-w-full overflow-hidden shadow">
            <table class="w-full whitespace-no-wrap">
                <!--Encabezados-->
                <thead>
                    <tr class="border-b-10 bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 mb-10" >
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Horario
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Detalles
                        </th>

                    </tr>
                </thead>
                <!--FILAS-->
                <tbody>
                    <tr v-for="(horario,index) in horarios" class="text-gray-700">

                        <td class="border-b border-t-8 border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-2 py-2 text-sm h-64 w-3/5">


                            <iframe

                                width="300"
                                :src="Urls[index]"
                                frameborder="0"
                                style="border:0"
                                class=" overflow-y-auto overflow-x-auto  w-full h-full "


                            ></iframe>

                        </td>

                        <td class="border-b border-t-8 border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">

                            <div class="dark:text-gray-200 p-3">
                                Informacion:
                                <div v-for="(profesor,index) in profesores">
                                    <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap" v-if="profesor.id==horario.idProfesor">
                                        Nombre del profesor:{{ profesor.Nombre }} {{ profesor.ApellidoP }} {{ profesor.ApellidoM }}
                                    </p>
                                </div>

                                <div v-for="periodo in periodos">
                                    <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap"
                                    v-if="horario.idPeriodo==periodo.id"
                                    >
                                    Periodo:{{ periodo.mesInicio }} {{ periodo.AñoInicio }}-{{ periodo.mesTermino }} {{ periodo.AñoTermino }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-5 dark:text-gray-200">

                                <p class="mb-2 pl-3">Acciones:</p>

                                <Link :href="route('HorariosDocentes.edit',horario.id)"  class="p-3 rounded-md bg-[#014E82] mx-2 inline-flex mb-1"
                                v-if="$page.props.user.permissions.includes('Crear y Editar Horarios')">
                                    <i class="fa-solid fa-pen text-white"></i>
                                </Link>



                                <a type="button" @click="showDelete(horario.id)" class="p-3 rounded-md bg-[#dc2626] mx-2 inline-flex mb-1"
                                v-if="$page.props.user.permissions.includes('Eliminar Horarios')">
                                        <i class="fa-solid fa-trash text-white"></i>
                                </a>


                                <Link :href="route('HorariosDocentes.ver',horario.id)"  class="p-3 rounded-md bg-[#fff16f] mx-2 inline-flex mb-1"
                                v-if="$page.props.user.permissions.includes('Ver horarios')"
                                v-tippy="{
                                    content:'Ver Horario',
                                    placement: 'top' ,
                                    arrow: true,
                                    theme: 'Basic'
                                }"
                                >
                                    <i class="fa-solid fa-eye text-white"></i>
                                </Link>


                                <a :href="route('HorariosDocentes.PDF',horario.id)" target="_blank" class="p-3 rounded-md bg-[#dc2626] mx-2 inline-flex mb-1"
                                >
                                    <i class="fa-solid fa-file-pdf text-white"></i>
                                </a>


                                <a :href="route('HorariosDocentes.Excel',horario.id)" target="_blank" class="p-3 rounded-md bg-[#38b640] mx-2 inline-flex mb-1"
                                >
                                    <i class="fa-regular fa-file-excel text-white"></i>
                                </a>



                                                            <!-- Capa oscura -->
                            <div :class="{ hidden: !isvisibleDelete }" class="fixed inset-0 bg-black opacity-25">
                            </div>

                            <div>
                                <div :class="{ hidden: !isvisibleDelete }" v-bind:id="`Modal${horario.id}`" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
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
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Esta seguro de eliminar el horario:{{ idBorrarSeleccionado }} </h3>
                                                <Link @click="hideDelete" method="delete" :href="route('HorariosDocentes.destroy', idBorrarSeleccionado)" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                    Si, estoy seguro
                                                </Link>
                                                <button @click="hideDelete" data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                                            </div>
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
    import Pagination from '@/Components/Pagination.vue'
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3'


    import { useDark,useToggle} from '@vueuse/core'
    import { directive } from 'vue-tippy'
    import { ref } from 'vue'


</script>

<script>
import axios from 'axios';

export default {


    directives: {
        tippy: directive,
    },

    components:{
        Link
    },

    mounted() {
        this.Urls=this.$page.props.ListaUrl
        this.isVisible=false
        this.isvisibleDelete=false
    },

    props:{
         profesores:Array,
         horarios:Array,
         periodos:Array,
         ListaUrl:Array
    },

    data() {
    return {

        iframeSrc: '/HorariosDocentes/1/edit',

        // Urls:['/HorariosDocentes/1/edit','/HorariosDocentes/2/edit', '/HorariosDocentes/3/edit'],
        Urls:[],
        NuevoHorario:{
            idProfesor:0,
            idPeriodo:0
        },

        isVisible:'',
        isvisibleDelete:'',

        campoBusqueda:'Profesor',
        UsuarioBuscar:'',


        mensajeProfesor:null,
        idBorrarSeleccionado:0,

        MostrarFiltro:false
    }
  },

  methods: {

    MostrarOpcionesFiltro(){

        if(this.MostrarFiltro==true){
            this.MostrarFiltro=false
        }
        else{
            this.MostrarFiltro=true
        }

    },

    SeleccionarCampo(campo){
        this.campoBusqueda=campo
        this.MostrarFiltro=false
    },

    HacerBusqueda(){

        console.log(this.UsuarioBuscar);

        axios.get('Users.buscar',{   params:{ usuario:this.UsuarioBuscar,campo:this.campoBusqueda}   })
        .then(response => {

            this.resultadosBusqueda=response.data;
            // console.log('RESULTADOS:');
            // console.log(this.$page.props.plazas);
            this.$page.props.usuarios=this.resultadosBusqueda;
        })
        .catch(error => {
            console.error('Error al hacer la busqueda:', error);
        });
    },

    showElement() {
      this.isVisible = true;
    },
    hideElement() {
      this.isVisible = false;
    },

    showDelete(id){
        this.idBorrarSeleccionado=id;
        this.isvisibleDelete = true;
    },

    hideDelete(){
        this.isvisibleDelete = false;
    },

    crearHorario(){
        this.$inertia.post(route('HorariosDocentes.store'),this.NuevoHorario);
        this.hideElement()
    },



  }
};
</script>

<style>

    .tippy-box[data-theme~='Basic'] {
        background-color: rgb(51 65 85);

        color: rgb(255, 250, 250);
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        font-size: 15px;
        padding: 5px;
    }

</style>
