<template>
    <Head title="Personal" />
    <AuthenticatedLayout>
    <template #header class="pl-1">
            Alta del Personal
    </template>

    <!-- {{ NuevoPersonal }} -->

    <div class="pl-2">
            <form @submit.prevent="crearPersonal"  class="w-full ">
                    <div class="flex flex-wrap -mx-3 mb-6 overflow-auto">

                        <div class="w-full md:w-1/2 px-3 mb-3">

                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                CURP
                            </label>
                            <input id="Capacidad"  maxlength="18" v-model="NuevoPersonal.CURP" class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="XXXXXXXXXXXXXXXXXX" required>
                            <p v-if="MostrarmensajeCurp!=false" :class="{ 'text-sm text-green-500':exitoCURP, 'text-sm text-red-600':!exitoCURP }">{{ mensajeCurp }}</p>

                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">

                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                RFC
                            </label>
                            <input id="NombreAula" maxlength="13" v-model="NuevoPersonal.RFC"  class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="XXXXXXXXXXXXX" required>

                            <p v-if="MostrarmensajeRFC!=false" :class="{ 'text-sm text-green-500':exitoRFC, 'text-sm text-red-600':!exitoRFC }">{{  mensajeRFC }}</p>

                        </div>


                        <div class="w-full md:w-1/2 px-3 mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Nombre
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Nombre" class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="0" required>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Apellido Paterno
                            </label>
                            <input id="NombreAula" v-model="NuevoPersonal.ApellidoP"  class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" required>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Apellido Materno
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.ApellidoM" class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" required>
                        </div>


                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Fecha de Nacimiento
                            </label>
                            <input id="NombreAula" v-model="NuevoPersonal.FechaNacimiento"  class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="date" placeholder="" required>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Numero de tarjeta
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.numTarjeta" class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="number" placeholder="0" required>
                        </div>


                        <div class="w-full md:w-1/2 px-3 ">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                 Direccion (*opcional)
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Direccion" class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" >
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                 Telefono (*opcional)
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Telefono" class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="tel" placeholder="">
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                 Correo Personal (*opcional)
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.CorreoPers" class="appearance-none block w-full bg-white dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="email" placeholder="">
                        </div>


                    </div>


                    <!-- Modal footer -->
                    <div class="flex items-center px-1 py-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar</button>
                        <button @click="hideElement" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        <button @click="validarCURP" v-if="NuevoPersonal.CURP.length==18"  type="button" class="text-white bg-[#487c9f] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Obtener Informacion</button>
                    </div>

                </form>
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



    mounted() {

    },

    computed: {
        URL_API_CURP() {
        return "https://apimarket.mx/api/renapo/grupo/valida-curp?curp=" + this.NuevoPersonal.CURP;
        },
        URL_API_RFC() {
        return "https://apimarket.mx/api/sat/grupo/obtener-rfc?curp=" + this.NuevoPersonal.CURP;
        }
    },

    props:{

    },

    data() {
    return {

      NuevoPersonal:{
          RFC:'',
          Nombre:'',
          ApellidoP:'',
          ApellidoM:'',
          CURP:'',
          FechaNacimiento:'',
          numTarjeta:0,
          Direccion:'',
          Telefono:'',
          CorreoPers:'',
          Estatus:'',
          Estudio1:'',
          Estudio2:'',
          Estudio3:'',
          idPlaza:0,
          idUsuario:0,
      },

    }
  },


  methods: {

    //METODO PARA REALIZAR SOLICITUD A API CURP
    validarCURP(){


        this.MostrarmensajeRFC=true
        this.MostrarmensajeCurp=true

        //URLS PARA LLAMADA A LA API
        const urlCURP=this.URL_API_CURP;
        const urlRFC=this.URL_API_RFC;

        // Opciones de la solicitud
        const requestOptions = {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer fd32ed13-ab6c-4918-8e52-1546288d5d6e',
                'Accept': 'application/json',
            },
        };

        // Realizar la solicitud para curp
        fetch(urlCURP, requestOptions)
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(response => {
            console.log('DATOS PERSONALES:',response); // Hacer algo con la respuesta JSON


            console.log('mensaje CURP:',response.message)

            if(response.message=='Exitoso'){
                this.exitoCURP=true
            }
            else{
                this.mensajeCurp=response.message
            }

            this.NuevoPersonal.Nombre=response.data.nombres
            this.NuevoPersonal.ApellidoP=response.data.apellidoPaterno
            this.NuevoPersonal.ApellidoM=response.data.apellidoMaterno

            const fechaDDMMAA=response.data.fechaNacimiento
            const FechaPorPartes = fechaDDMMAA.split('/');
            const dia = FechaPorPartes[0];
            const mes = FechaPorPartes[1];
            const año = FechaPorPartes[2];


            const fechaYYMMDD = `${año}-${mes}-${dia}`;

            this.NuevoPersonal.FechaNacimiento=fechaYYMMDD;


        })
        .catch(error => {
            console.error('Error en obtener datos personales:', error);
        });

        // Realizar la solicitud para RFC



        fetch(urlRFC, requestOptions)
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(response => {

            console.log('mensaje RFC:',response.message)
            this.mensajeRFC=response.message

            console.log('RFC:',response.data.rfc); // Hacer algo con la respuesta JSON
            this.NuevoPersonal.RFC=response.data.rfc

        })
        .catch(error => {
            console.error('Error en obtener RFC:', error);

        });


    },



    async crearPersonal(){
        await this.$inertia.post(route('Personal.store'),this.NuevoPersonal)
        this.hideElement()
    },

  }
};
</script>








