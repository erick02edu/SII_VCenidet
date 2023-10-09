<template>

    <Head title="Plazas" />
    <AuthenticatedLayout>


        <template #header>
                Lista de Plazas
        </template>


        <h3 class="text-m text-gray-900 dark:text-white py-1 ml-1">
                Buscar por:

                <input type="radio" value="estatus" name="Campos" v-model="campoBusqueda" required > estatus
                <input type="radio" value="horas" name="Campos" v-model="campoBusqueda" required> horas
                <input type="radio" value="unidad" name="Campos" v-model="campoBusqueda" required> unidad
                <input type="radio" value="subunidad" name="Campos" v-model="campoBusqueda" required> subunidad
                <input type="radio" value="diagonal" name="Campos" v-model="campoBusqueda" required> diagonal
        </h3>

        <div class="inline-flex w-full" >

            <div class="relative text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200 pb-4">
                <input
                class=" border-gray-100 dark:border-gray-500 bg-white dark:bg-slate-700 dark:text-gray-200 h-10 px-4 pr-20 rounded-lg text-sm focus:outline-none "
                    type="text"
                    placeholder="Buscar..."
                    v-model="PlazaBuscar"
                    @input="HacerBusqueda()"
                />
            </div>

            <div v-if="$page.props.user.permissions.includes('Agregar Plazas')" class="w-full">
                <button :type="type" @click="showElement" class=" ml-auto mr-9 rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7] "
                >
                    Nuevo
                </button>
            </div>

        </div>


            <!-- Capa oscura -->
    <div :class="{ hidden: !isVisible }" class="fixed inset-0 bg-black opacity-50">
    </div>

    <div id="modalContainer">


        <div v-if="mensajePlazaNueva!=null" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-3 mb-3" role="alert">
            <strong class="font-bold">Éxito:</strong>
            <span class="block sm:inline">{{ mensajePlazaNueva }}</span>
        </div>

        <!-- Main modal -->
        <div :class="{ hidden: !isVisible }">
            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
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
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
            <form @submit.prevent="crearPlaza"  class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">

                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">

                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                    Categoria de la plaza
                                </label>

                                <select class="md:w-6/7 appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="categorias" v-model="NuevaPlaza.idCategoria" required>

                                <option :value="0"> Seleccione categoria </option>

                                <option
                                    v-for="(categoria,index) in categorias"
                                    :key="categoria.id"
                                    :value="categoria.id"
                                >

                                    {{ categoria.Clave }}-{{ categoria.Descripcion }}
                                </option>
                                </select>

                                <p v-if="mensajeCategoria!=null" class="text-sm text-red-600 ">Por favor selecciona una categoria</p>


                            </div>

                            <div class="w-full md:w-1/3 px-3">

                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2"  for="grid-last-name">
                                    Unidad
                                </label>

                                <select name="aplicaciones" class="md:w-2/3 appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" v-model="NuevaPlaza.unidad" @change="PonerSubunidad(NuevaPlaza.unidad)" required>

                                    <option :value="14">
                                       14
                                    </option>
                                    <option :value="18">
                                       18
                                    </option>
                                    <option :value="68">
                                       68
                                    </option>

                                </select>

                            </div>


                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2"  for="grid-last-name">
                                    Subunidad
                                </label>
                                <select class="md:w-1/3 appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="aplicaciones" v-model="NuevaPlaza.subunidad" required>
                                    <option :value='1'>
                                       01
                                    </option>
                                    <option :value='2'>
                                       02
                                    </option>
                                    <option :value='14'>
                                       14
                                    </option>
                                </select>

                            </div>


                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2"  for="grid-last-name">
                                    Diagonal
                                </label>
                                <input id="diagonal" v-model="NuevaPlaza.diagonal"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="Diagonal" required>
                            </div>


                            <div class="w-full md:w-1/2 px-3">
                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2"  for="grid-last-name">
                                    Horas/min a la semana de la plaza
                                </label>
                                <input id="horas" v-model="NuevaPlaza.horas" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="number" placeholder="0" required>
                            </div>


                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar</button>
                            <button @click="hideElement" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
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
    <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <!--Encabezados-->
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500" >
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            ID
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Descripcion Categoria
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Diagonal
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Unidad
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Subunidad
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Horas a la semana
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Estatus de la plaza
                        </th>
                        <th v-if="$page.props.user.permissions.includes('Editar Plazas') || $page.props.user.permissions.includes('Eliminar Plazas')" class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <!--FILAS-->
                <tbody>
                    <tr v-for="plaza in plazas" :key="plaza.id" class="text-gray-700">

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ plaza.id }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <div v-for="(categoria,index) in categorias">
                                <p v-if="plaza.idCategoria==categoria.id" class="text-gray-900 dark:text-gray-200 whitespace-no-wrap"> {{categoria.Clave}}-{{ categoria.Descripcion }}</p>
                            </div>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ plaza.diagonal }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ plaza.unidad }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ plaza.subunidad }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ plaza.horas }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap" v-if="plaza.estatus==0">
                                SIN ASIGNAR
                            </p>

                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap" v-if="plaza.estatus==1">
                                ASIGNADA
                            </p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm" v-if="$page.props.user.permissions.includes('Editar Plazas') || $page.props.user.permissions.includes('Eliminar Plazas')">



                            <div v-if="$page.props.user.permissions.includes('Editar Plazas')">
                                <Link :href="route('Plazas.edit',plaza.id)"  class="p-3 rounded-md bg-[#014E82] mx-2 " >
                                    <i class="fa-solid fa-pen text-white"></i>
                                </Link>
                            </div>

                            <div v-if="$page.props.user.permissions.includes('Eliminar Plazas')">
                                <a type="button" @click="showDelete(plaza.id)" class="p-3 rounded-md bg-[#dc2626] mx-2" >
                                            <i class="fa-solid fa-trash text-white"></i>
                                </a>
                            </div>
                            <!-- Capa oscura -->
                            <div :class="{ hidden: !isvisibleDelete }" class="fixed inset-0 bg-black opacity-50">
                            </div>

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


<script>

    import axios from 'axios';


    export default {



        directives:{

            'canPermiso':{
                async mounted(el, binding) {
                    //Obtemos la instancia del elemento
                    const vm = binding.instance;
                    // binding.value contiene el valor que pasaste a la directiva
                    console.log(binding.value);
                    //Obtenemos el permiso enviado a traves de la directiva
                    vm.Permiso=binding.value;

                    console.log("Id a enviar:",vm.$data.userID);
                    console.log("Permiso a revisar:",vm.Permiso);

                    //Datos a enviar a la ruta
                    const userID=vm.$data.userID;
                    const Permiso=vm.Permiso;

                    const response=await axios.post('/Permisos/can',{userID,Permiso})
                    .catch(error => {
                        console.error('Error al obtener datos:', error);
                    });
                    vm.resultado=response.data.decision;
                    console.log("Tiene permisos de",Permiso,":",vm.decision);

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


        components:{
            Link
        },

        mounted() {
            this.hideDelete()
        },

        props:{
            plazas:Array,
            categorias:Array,
        },

        data() {
        return {


            links:[
                { label: "1", url: "/page/1", active: true },
                { label: "2", url: "/page/2", active: false },
                { label: "3", url: "/page/3", active: false },
                { label: "4", url: "/page/4", active: false },
            ],

            campoBusqueda:'estatus',

            //Info para poder obtener los permisos del usuario
            items: [],
            userID:this.$page.props.auth.user.id, // Obtiene el ID del usuario
            ListaRoles:[],
            Rol:"",
            Permiso:"",
            decision:"",
            resultadosBusqueda:"",

        infoEditar: {
            categoria:'',
            horas:0,
            estatus:''
        },


        isVisible: false,
        isvisibleDelete:false,

        idBorrarSeleccionado:0,

        PlazaBuscar:'',
        //Mensajes
        mensajeCategoria:null,
        mensajePlazaNueva:null,

        NuevaPlaza:{
            idCategoria:0,
            horas:0,
            estatus:'',
            diagonal:'',
            unidad:'',
            subunidad:'',
        }

        }
    },

    methods: {

        HacerBusqueda(){

            this.mensajePlazaNueva=null;

            console.log(this.PlazaBuscar);

            axios.get('Plazas.buscar',{   params:{ plaza:this.PlazaBuscar,campo:this.campoBusqueda}   })
            .then(response => {

                this.resultadosBusqueda=response.data;
                console.log('RESULTADOS:');
                console.log(this.$page.props.plazas);

                this.$page.props.plazas=this.resultadosBusqueda;
            })
            .catch(error => {
                console.error('Error al hacer la busqueda:', error);
            });
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

        async crearPlaza(){

            if(this.NuevaPlaza.idCategoria==0){
                this.mensajeCategoria="Por favor ingresa una categoria";
            }
            else{
                await this.$inertia.post(route('Plazas.store'),this.NuevaPlaza)
                this.hideElement()
                this.mensajePlazaNueva='Plaza registrada correctamente'
            }


        },

        showElement() {
        this.isVisible = true;
        },
        hideElement() {
        this.isVisible = false;
        this.mensajeCategoria=null;
        },

        showDelete(id){

            this.idBorrarSeleccionado=id;

            this.isvisibleDelete = true;
        },
        hideDelete(){
            this.isvisibleDelete = false;
        },

        PonerSubunidad(unidad){
            console.log(unidad);

            if(unidad=='14'){
                this.NuevaPlaza.subunidad='1';
            }
            else if(unidad=='18'){
                this.NuevaPlaza.subunidad='2';
            }
            else if(unidad=='68'){
                this.NuevaPlaza.subunidad='14';
            }
        },




    }
};
</script>

<script setup>

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3';
    import  Pagination from '@/Components/Pagination.vue';
    import { ref, computed } from 'vue';


</script>
