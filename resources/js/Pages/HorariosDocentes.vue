<template>

    <Head title="Horarios" />
    <AuthenticatedLayout>
    <template #header>
            Lista de Horarios
    </template>

    <div class="inline-flex w-full" >

        <div class="relative text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200">
            <input
                class=" border-gray-100 dark:border-gray-500 bg-white dark:bg-slate-700 h-10 px-4 pr-20 rounded-lg text-sm focus:outline-none"
                type="text"
                placeholder="Buscar..."
                v-model="UsuarioBuscar"
                @input="HacerBusqueda()"
            />
        </div>

        <button :type="type" @click="showElement" class=" ml-auto mr-9 rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7]  ">
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
                            Previsualizacion
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Profesor
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Periodo
                        </th>

                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <!--FILAS-->
                <tbody>
                    <tr v-for="(horario,index) in horarios" class="text-gray-700">

                        <td class="border-b border-t-8 border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">


                            <iframe

                                width="600"
                                height="300"
                                :src="Urls[index]"
                                frameborder="0"
                                style="border:0"
                                class=" overflow-y-auto"


                            ></iframe>

                        </td>

                        <td class="border-b border-t-8 border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">

                            <div v-for="(profesor,index) in profesores">
                                <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap" v-if="profesor.id==horario.idProfesor">
                                    {{ profesor.Nombre }} {{ profesor.ApellidoP }} {{ profesor.ApellidoM }}
                                </p>
                            </div>



                        </td>

                        <td class="border-b border-t-8 border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">

                            <div v-for="periodo in periodos">
                                <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap"
                                v-if="horario.idPeriodo==periodo.id"
                                >
                                {{ periodo.mesInicio }} {{ periodo.AñoInicio }}-{{ periodo.mesTermino }} {{ periodo.AñoTermino }}
                                </p>
                            </div>
                        </td>


                        <td class="border-b border-t-8 border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">


                            <Link :href="route('HorariosDocentes.edit',horario.id)"  class="p-3 rounded-md bg-[#014E82] mx-2 " >
                                <i class="fa-solid fa-pen text-white"></i>
                            </Link>


                            <a type="button" @click="showDelete(horario.id)" class="p-3 rounded-md bg-[#dc2626] mx-2" >
                                    <i class="fa-solid fa-trash text-white"></i>
                            </a>

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

</script>

<script>
import axios from 'axios';

export default {

    components:{
        Link
    },

    mounted() {
        this.Urls=this.$page.props.ListaUrl
        this.isVisible=false
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

        campoBusqueda:'',
        UsuarioBuscar:'',


        mensajeProfesor:null,

    }
  },

  methods: {


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

    crearHorario(){

        this.$inertia.post(route('HorariosDocentes.store'),this.NuevoHorario);
        this.hideElement()
    }

  }
};
</script>
