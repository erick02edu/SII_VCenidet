<template>
    <Head title="Plazas"/>
    <AuthenticatedLayout>
    <template #header>
            Periodos de aplicacion
    </template>

    <form @submit.prevent="AplicarCambios()">
        <div id="modalContainer" class=" mt-3">
            <button :type="type" @click="showElement" class="rounded-md bg-[#014E82] px-5 py-3 mb-2 text-center text-sm text-white hover:bg-[#0284c7]  ">
                Aplicar cambios
            </button>
        </div>
    </form>

    <div v-if="mensajeActualizar!=null" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 mb-3" role="alert">
        <strong class="font-bold">Éxito:</strong>
        <span class="block sm:inline">{{ mensajeActualizar }}</span>
    </div>

    <div v-if="mensajeEliminar!=null" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-3" role="alert">
        <strong class="font-bold">Éxito:</strong>
        <span class="block sm:inline">{{ mensajeEliminar }}</span>
    </div>



        <!--TABLA DE APLICACION DE PERIODOS-->
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <!--Encabezados-->
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">

                        <th class="border-b-2 border-gray-300 bg-gray-300 px-1 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            id Aplicacion
                        </th>

                        <th class="border-b-2 border-gray-300 bg-gray-300 px-2 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Descripcion de la aplicacion
                        </th>

                        <th class="border-b-2 border-gray-300 bg-gray-300 px-1 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Periodo
                        </th>

                        <th class="border-b-2 border-gray-300 bg-gray-300 px-1 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <!--FILAS-->
                <tbody>
                    <tr v-for="(aplicacion,index) in aplicaciones" :key="aplicacion.id" class="text-gray-700">

                        <td class="border-b border-gray-200 bg-white px-2 py-4 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ aplicacion.id }}</p>

                        </td>

                        <td class="border-b border-gray-200 bg-white px-2 py-4 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ aplicacion.descripcion }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-2 py-5 text-sm">

                            <select name="aplicaciones" v-model="ListaIDPeriodos[index]">
                                <option
                                    v-for="periodo in periodos"
                                    :key="periodo.id"
                                    :value="periodo.id"
                                    :selected="aplicacion.idPeriodo==periodo.id"
                                >
                                    {{ periodo.mesInicio }} {{ periodo.AñoInicio }}-{{ periodo.mesTermino }} {{ periodo.AñoTermino }}
                                    <!-- --id:{{ periodo.id }} -->
                                </option>
                            </select>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <a type="button" @click="showDelete(aplicacion.id,index)" class="p-3 rounded-md bg-[#dc2626] mx-2">
                                    <i class="fa-solid fa-trash text-white"></i>
                            </a>

                            <div>
                                <div :class="{ hidden: !isvisibleDelete }" v-bind:id="`Modal${aplicacion.id}`" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
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
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Esta seguro de eliminar esta aplicacion </h3>
                                                    <button @click="Eliminar(idBorrarSeleccionado)" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                        Si, estoy seguro
                                                    </button>
                                                    <button @click="hideDelete" data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
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

        <!-- Lista id aplicaciones: {{ ListaIDAplicaciones }}
        Opciones seleccionadas: {{ ListaIDPeriodos }} -->


    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3'
</script>

<script>

import axios from 'axios';

export default {

    components:{
        Link
    },

    props:{
         aplicaciones:Array,
         periodos:Array
    },

    mounted(){

        this.aplicaciones.forEach((aplicacion, index) => {
            this.ListaIDPeriodos[index]=aplicacion.idPeriodo;
            this.ListaIDAplicaciones[index]=aplicacion.id;

        });

    },

    data() {
    return {
      isVisible: false,
      isvisibleDelete:false,
      idEliminar:0,
      idBorrarSeleccionado:0,

      ListaIDPeriodos:[],
      ListaIDAplicaciones:[],

      mensajeActualizar:null,
      mensajeEliminar:null,
    }
  },

  methods: {
    showDelete(id,index){
        this.idBorrarSeleccionado=id;
        this.idEliminar=index
        this.isvisibleDelete = true;
    },
    hideDelete(){
        this.isvisibleDelete = false;
    },

    async Eliminar(id){

        console.log('Eliminar');

        this.hideDelete();

        await this.$inertia.delete(
        route("Aplicaciones.destroy",id),id)
        // .then(response => {

        //     // Manejar la respuesta JSON aquí
        //     if (response.data && response.data.mensaje) {
        //         console.log(response.data.mensaje);
        //         this.mensajeEliminar = response.data.mensaje;
        //     } else {
        //         console.error("La respuesta no contiene el campo 'mensaje'");
        //     }

        // })
        // .catch(error => {
        //     // Manejar errores aquí
        //     console.error(error);
        // });

        this.mensajeEliminar="Aplicacion de Periodo eliminada correctamente";
        this.mensajeActualizar=null;

        // await axios.delete( route("Aplicaciones.destroy",id) ) // Ruta de la API en Laravel
        //     .then(response => {

        //             console.log("Mensaje:",response.data.mensaje);

        //             this.mensajeEliminar=response.data.mensaje;

        //         })
        //         .catch(error => {
        //             console.error('Error al obtener el mensaje:', error);
        //     });

    },

    AplicarCambios(){

        const ListaIDAplicaciones=this.ListaIDAplicaciones
        const ListaIDPeriodos=this.ListaIDPeriodos

        axios.post('AplicacionActualizar', { ListaIDAplicaciones,ListaIDPeriodos })
        .then(response => {

          console.log(response.data.respuesta);


        })
        .catch(error => {
          console.error(error);
        });

        this.mensajeActualizar=null;
        
        this.mensajeActualizar="Se ha actualizado el periodo de las aplicaciones";
        this.mensajeEliminar=null;
    }
  }

};
</script>

