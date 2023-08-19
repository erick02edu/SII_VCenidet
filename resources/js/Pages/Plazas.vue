<template>

    <Head title="Plazas" />
    <AuthenticatedLayout>
    <template #header>
            Lista de Plazas
    </template>

    <div id="modalContainer">
        <button :type="type" @click="showElement" class="rounded-md bg-[#014E82] px-5 py-3 mb-4 text-center text-sm text-white hover:bg-[#0284c7] ">
            Nuevo
        </button>

        <!-- Main modal -->
        <div :class="{ hidden: !isVisible }">

            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Agregar Plaza
                    </h3>
                <button type="button" @click="hideElement" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>

        <!-- Modal body -->
        <div class="p-6 space-y-6">
            <form @submit.prevent="crearPlaza"  class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Categoria de la plaza
                            </label>
                            <input id="categoria" v-model="NuevaPlaza.categoria"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="Categoria">
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                Horas/min a la semana de la plaza
                            </label>
                            <input id="horas" v-model="NuevaPlaza.horas" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="number" placeholder="0">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    Estatus de la plaza
                                </label>
                                <input id="estatus" v-model="NuevaPlaza.estatus" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Estatus">

                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar</button>
                        <button @click="hideElement" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                    </div>
            </form>

        </div>

            </div>
        </div>
        </div>
        </div>
    </div>
</div>


    <!--TABLA DE PLAZAS-->
    <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <!--Encabezados-->
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-300 bg-gray-300 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            ID
                        </th>
                        <th class="border-b-2 border-gray-300 bg-gray-300 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Categoria
                        </th>
                        <th class="border-b-2 border-gray-300 bg-gray-300 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Horas a la semana
                        </th>
                        <th class="border-b-2 border-gray-300 bg-gray-300 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Estatus de la plaza
                        </th>
                        <th class="border-b-1 border-gray-300 bg-gray-300 px-1 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <!--FILAS-->
                <tbody>
                    <tr v-for="plaza in plazas" :key="plaza.id" class="text-gray-700">

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ plaza.id }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ plaza.categoria }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ plaza.horas }}</p>
                        </td>
                        
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ plaza.estatus }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">

                            <Link :href="route('Plazas.edit',plaza.id)" class="p-3 rounded-md bg-[#014E82] mx-2 ">
                                <i class="fa-solid fa-pen text-white"></i>
                            </Link>


                            <a type="button" @click="showDelete(plaza.id)" class="p-3 rounded-md bg-[#dc2626] mx-2">
                                        <i class="fa-solid fa-trash text-white"></i>
                            </a>

                            <div>
                                        <div :class="{ hidden: !isvisibleDelete }" v-bind:id="`Modal${plaza.id}`" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
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
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Esta seguro de eliminar la plaza con el id: {{ idBorrarSeleccionado }} </h3>
                                                        <Link @click="hideDelete" method="delete" :href="route('Plazas.destroy', idBorrarSeleccionado)" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Si, estoy seguro
                                                        </Link>
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
        this.hideDelete()
    },

    props:{
         plazas:Array
    },

    data() {
    return {

       infoEditar: {
          categoria:'',
          horas:0,
          estatus:''
      },


      isVisible: false,
      isvisibleDelete:false,

      idBorrarSeleccionado:0,


      NuevaPlaza:{
          categoria:'',
          horas:0,
          estatus:''
      }

    }
  },

  methods: {

    async crearPlaza(){
        await this.$inertia.post(route('Plazas.store'),this.NuevaPlaza)
        this.hideElement()

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

  }
};
</script>
