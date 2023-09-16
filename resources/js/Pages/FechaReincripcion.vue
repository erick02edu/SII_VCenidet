<template>
    <Head title="Plazas" />
    <AuthenticatedLayout>
    <template #header>
            Generar fecha y hora de reinscripcion
    </template>

    <div class="p-6 space-y-6">

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Fecha Inicial
                        </label>
                    <input id="FechIni" v-model="NuevaFecha.FechIni"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="date" placeholder="00/00/00" required>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Fecha Final
                        </label>
                    <input id="FechFin" v-model="NuevaFecha.FechFin"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="date" placeholder="00/00/00" required>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Cantidad de alumnos
                        </label>
                    <input id="CantAlumnos" v-model="NuevaFecha.CantAlumnos"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="number" placeholder="0" required>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Hora Inicio
                        </label>
                    <input id="HrInicio" v-model="NuevaFecha.HrInicio"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="time" placeholder="0"  required>
                </div>

                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                            Hora Termino
                        </label>
                    <input id="HrFin" v-model="NuevaFecha.HrFin"   class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="time" placeholder="0"  required>
                </div>


    </div>


    <div id="modalContainer" class="px-5">
        <button :type="type" @click="showElement" class="rounded-md bg-[#014E82] px-5 py-3 mb-2 text-center text-sm text-white hover:bg-[#0284c7]  ">
            Generar fecha de reinscripcion
        </button>
    </div>

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

    data() {
    return {
      isVisible: false,

      NuevaFecha:{
        FechIni:"",
        FechFin:"",
        CantAlumnos:0,
        HrInicio:"12:00:00",
        HrFin:"23:00:00",
      },
    }
  },

  methods: {

  }

};
</script>

