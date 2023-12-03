<script setup>

        import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
        import Pagination from '@/Components/Pagination.vue'
        import { Head, useForm } from '@inertiajs/vue3';
        import { Link } from '@inertiajs/vue3'
        import Checkbox from '@/Components/Checkbox.vue';

        const props=defineProps({
            rol:{
                type:Array,
                required:true,
            },
            usuarios:Array,
            carreras:Array,
            permisos:Array,
            mensaje:String,
            tipoMensaje:String
        })

</script>


<script>

    import axios from 'axios';

    export default {

        mounted() {
        },

        components:{
            Link
        },


        data() {
            return {
                NuevoPermiso: {
                    idUsuario:0,
                    PermisosSeleccionados:[],
                    CarrerasSeleccionadas:[],
                },

                setTimeoutBuscador:'',
                CarreraBuscar:'',
                PermisoBuscar:'',

                Activado:[],
                isCheckad:false,

                data:[],

                ListaPermisos:[],


                isVisibleCarrera:false,
                isVisiblePermisos:false,

                carrerasActuales:[],
                carrerasFaltantes:[],

                permisosActuales:[],
                permisosFaltantes:[],

            }

        },

        methods: {
            contarTiempo(NombreBuscador){
                this.$page.props.mensaje=null
                clearTimeout(this.setTimeoutBuscador);
                if(NombreBuscador=='Carrera'){
                    this.setTimeoutBuscador=setTimeout(this.HacerBusquedaCarrera,360)
                }
                else if(NombreBuscador=='Permisos'){
                    this.setTimeoutBuscador=setTimeout(this.HacerBusquedaPermisos,360)
                }
            },


            HacerBusquedaCarrera(){
                axios.get('/Carreras.buscar',{   params:{ Carrera:this.CarreraBuscar,idUsuario:this.NuevoPermiso.idUsuario}   })
                .then(response => {

                    this.resultadosBusqueda=response.data;
                    this.carrerasFaltantes=this.resultadosBusqueda;
                })
                .catch(error => {
                    console.error('Error al hacer la busqueda:', error);
                });
            },

            HacerBusquedaPermisos(){
                axios.get('/Permisos.buscar',{   params:{ Permiso:this.PermisoBuscar,idUsuario:this.NuevoPermiso.idUsuario}   })
                .then(response => {
                    this.resultadosBusqueda=response.data;
                    this.permisosFaltantes=this.resultadosBusqueda;
                })
                .catch(error => {
                    console.error('Error al hacer la busqueda:', error);
                });
            },

            showElementCarreras() {
                this.$page.props.mensaje=null
                const idsDescartar = this.carrerasActuales.map(item => item.id);
                // Filtrar la ListaCompleta para excluir los elementos cuyos IDs estén en idsDescartar
                this.carrerasFaltantes = this.$page.props.carreras.filter(item => !idsDescartar.includes(item.id));
                this.isVisibleCarrera = true;
            },
            hideElementCarreras() {
                this.isVisibleCarrera= false;
                this.CarreraBuscar=''
            },

            showElementPermisos() {
                this.$page.props.mensaje=null
                // Check if this.permisosActuales is defined and is an array
                if (Array.isArray(this.permisosActuales)) {
                const idsDescartar = this.permisosActuales.map(item => item.id);
                this.permisosFaltantes = this.$page.props.permisos.filter(item => !idsDescartar.includes(item.id));
                // Now you can use idsDescartar as needed
                } else {
                // Handle the case where this.permisosActuales is not properly initialized
                console.error("this.permisosActuales is not properly initialized.");
                }

                this.isVisiblePermisos = true;
            },

            hideElementPermisos() {
                this.isVisiblePermisos= false;
                this.PermisoBuscar=''
            },


            EliminarPermisoSistema(idPermisoSistema){
                console.log('Eliminar carrera',idPermisoSistema);
                console.log('Usuario',this.NuevoPermiso.idUsuario);
                // this.$inertia.get(route("PermisosCarreras.eliminar"), {
                //      idUsuario: this.NuevoPermiso.idUsuario,
                //      idCarrera:idCarreraEliminar
                // });

                axios.get('/Permisos.remover',{
                    params:{
                        idUsuario:this.NuevoPermiso.idUsuario,
                        idPermiso:idPermisoSistema
                    }
                })
                .then(response => {
                    this.$page.props.mensaje=response.data.mensaje;
                    this.$page.props.tipoMensaje=response.data.tipoMensaje;
                })
                .catch(error => {
                    console.error('Error al hacer la busqueda:', error);
                });

                this.ObtenerPermisosSistema();
            },

            EliminarPermisoCarrera(idCarreraEliminar){

                console.log('Eliminar carrera',idCarreraEliminar);
                console.log('Usuario',this.NuevoPermiso.idUsuario);
                // this.$inertia.get(route("PermisosCarreras.eliminar"), {
                //      idUsuario: this.NuevoPermiso.idUsuario,
                //      idCarrera:idCarreraEliminar
                // });

                axios.get('/PermisosCarreras.Eliminar',{
                    params:{
                        idUsuario:this.NuevoPermiso.idUsuario,
                        idCarrera:idCarreraEliminar
                    }
                })
                .then(response => {
                    this.$page.props.mensaje=response.data.mensaje;
                    this.$page.props.tipoMensaje=response.data.tipoMensaje;
                })
                .catch(error => {
                    console.error('Error al hacer la busqueda:', error);
                });

                this.ObtenerPermisosCarrera();
            },


            ObtenerTodosLosPermisos(){
                this.$page.props.mensaje=null
                this.ObtenerPermisosCarrera();
                this.ObtenerPermisosSistema();
            },

            ObtenerPermisosCarrera(){

                this.carrerasActuales=[];
                if(this.NuevoPermiso.idUsuario!=0){
                    //OBTENER PERMISOS CARRERA
                    axios.get(`/PermisosCarrera.buscar/${this.NuevoPermiso.idUsuario}`)
                    .then(response => {
                        this.resultadosBusqueda=response.data;
                        console.log('CARRERAS ACTUALES OBTENIDAS:',this.resultadosBusqueda);
                        for(let i=0; i<this.resultadosBusqueda.length; i++){
                            console.log('Carrera ACTUAL ---------',this.resultadosBusqueda[i]);
                            var carrera=this.resultadosBusqueda[i]
                            this.carrerasActuales.push(carrera);
                        }
                    })
                    .catch(error => {
                        console.error('Error al hacer la busqueda:', error);
                    });

                }
            },

            ObtenerPermisosSistema(){
                    // this.$page.props.mensaje=null
                    this.permisosActuales=[];
                    //OBTENER PERMISOS SISTEMA
                    axios.get(`/Permisos.buscarUsuario/${this.NuevoPermiso.idUsuario}`)
                    .then(response => {
                        this.resultadosBusqueda=response.data;
                        console.log('PERMISOS ACTUALES OBTENIDAS:',this.resultadosBusqueda);
                        for(let i=0; i<this.resultadosBusqueda.length; i++){
                            console.log('PERMISO ACTUAL ---------',this.resultadosBusqueda[i]);
                            var permisosSistema=this.resultadosBusqueda[i]
                            this.permisosActuales.push(permisosSistema);
                        }
                    })
                    .catch(error => {
                        console.error('Error al hacer la busqueda:', error);
                    });
            },

            AgregarPermisosCarreras(){

                axios.get('/PermisosCarreras.asignar',{
                    params:{
                        CarrerasSelecionadas: this.NuevoPermiso.CarrerasSeleccionadas,
                        idUsuario: this.NuevoPermiso.idUsuario,
                    }
                })
                .then(response => {
                    this.$page.props.mensaje=response.data.mensaje;
                    this.$page.props.tipoMensaje=response.data.tipoMensaje;
                })
                .catch(error => {
                    console.error('Error al hacer la busqueda:', error);
                });

                this.hideElementCarreras();
                this.ObtenerPermisosCarrera();

            },


            AsignarPermisosSistema(){

                axios.get('/Permisos.asignarUsuario',{
                    params:{
                        PermisosSeleccionados: this.NuevoPermiso.PermisosSeleccionados,
                        idUsuario: this.NuevoPermiso.idUsuario,
                    }
                })
                .then(response => {
                    this.$page.props.mensaje=response.data.mensaje;
                    this.$page.props.tipoMensaje=response.data.tipoMensaje;
                })
                .catch(error => {
                    console.error('Error al hacer la busqueda:', error);
                });


                this.hideElementPermisos();

                this.ObtenerPermisosSistema()

            },

        },

    };
</script>




<template>

    <Head title="Asignar Permisos" />
        <AuthenticatedLayout>

                <template #header>

                    <div class="pl-4">
                        Asignar permisos a usuarios de tipo {{ rol.name }}
                    </div>

                </template>
    <!-- Capa oscura -->
    <div :class="{ hidden: !isVisibleCarrera }" class="fixed inset-0  bg-black opacity-50">
    </div>

    <div id="modalContainer">
        <!-- Main modal -->
        <div :class="{ hidden: !isVisibleCarrera }">

            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Agregar carreras
                            </h3>
                        <button type="button" @click="hideElementCarreras" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 w-full">
                        <form @submit.prevent="AgregarPermisosCarreras"  class="w-full">
                            <label class=" w-full block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-first-name">
                                    Seleccione las carreras
                            </label>

                            <div class="flex flex-wrap  mb-6 ">

                                <div class="relative dark:text-white text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200 pb-3">

                                    <input
                                    class=" border-gray-300 dark:border-gray-500 bg-white dark:bg-slate-700 h-10 px-4 pr-20 dark:text-gray-200 rounded-lg text-sm focus:outline-none"
                                    type="text"
                                    placeholder="Buscar carrera"
                                    @keyup="contarTiempo('Carrera')"
                                    v-model="CarreraBuscar"
                                    />

                                </div>


                                <div class="w-full p-3 overflow-y-auto h-64 border rounded-lg border-gray-300 dark:border-gray-500">
                                    <!--TABLA ASIGNAR CARRERA PERMISOS-->
                                    <div class="inline-block min-w-full overflow-hidden rounded-lg shadow mb-4">
                                            <table class="w-full">
                                                <!--Encabezados-->
                                                <thead>
                                                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase  text-gray-500">

                                                        <th class="border-b-2 w-5 pl-5 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">

                                                        </th>

                                                        <th class="border-b-2 w-4/5 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                                            Carreras
                                                        </th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <tr v-for="carrera in carrerasFaltantes" :key="carrera.id" class="text-gray-700">

                                                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                            <input type="checkbox" name="alumnosAgregar"  id="" :value="carrera.id"
                                                            v-model="NuevoPermiso.CarrerasSeleccionadas">
                                                        </td>

                                                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                                {{ carrera.Nivel }} en {{ carrera.Nombre }}
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
                                <button @click="hideElementCarreras" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
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
<!---------------------------------------------------------------------------------------------------------------------------------------->
    <!-- Capa oscura -->
    <div :class="{ hidden: !isVisiblePermisos }" class="fixed inset-0  bg-black opacity-50">
    </div>

    <div id="modalContainer">
        <!-- Main modal -->
        <div :class="{ hidden: !isVisiblePermisos }">

            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">

                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Agregar Permisos
                            </h3>
                        <button type="button" @click="hideElementPermisos" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 space-y-6 w-full">
                        <form @submit.prevent="AsignarPermisosSistema"  class="w-full">
                            <label class=" w-full block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-first-name">
                                    Seleccione los permisos
                            </label>

                            <div class="flex flex-wrap  mb-6 ">

                                <div class="relative dark:text-white text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200 pb-3">

                                    <input
                                    class=" border-gray-300 dark:border-gray-500 bg-white dark:bg-slate-700 h-10 px-4 pr-20 dark:text-gray-200 rounded-lg text-sm focus:outline-none"
                                    type="text"
                                    placeholder="Buscar permisos"
                                    v-model="PermisoBuscar"
                                    @keyup="contarTiempo('Permisos')"
                                    />



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
                                                            Permisos del sistema
                                                        </th>
                                                    </tr>
                                                </thead>


                                                <tbody>
                                                    <tr v-for="permiso in permisosFaltantes" :key="permiso.id" class="text-gray-700">

                                                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                            <input type="checkbox" name="alumnosAgregar"  id="" :value="permiso.id"
                                                            v-model="NuevoPermiso.PermisosSeleccionados">
                                                        </td>

                                                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                                {{ permiso.name }}
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
                                    Asignar Permisos
                                </button>
                                <button @click="hideElementPermisos" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
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
<!---------------------------------------------------------------------------------------------------------------------------------------->


                            <div class="grid grid-cols-1 md:grid-cols-2 mt-5 ml-4">
                                <div class='flex-inline '>

                                    <span class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">
                                        Tipo de usuario:
                                    </span>

                                    <span class="dark:text-white ">
                                        {{ rol.name }}
                                    </span>


                                    <select class="md:w-6/7 mt-2 appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="categorias"
                                    v-model="NuevoPermiso.idUsuario" required
                                    @change="ObtenerTodosLosPermisos"
                                    >
                                        <option :value="0"> Seleccione un usuario </option>

                                        <option
                                            v-for="(usuario,index) in usuarios"
                                            :key="usuario.id"
                                            :value="usuario.id"
                                        >
                                            {{ usuario.name }}
                                        </option>
                                    </select>

                                </div>
                            </div>


                            <div v-if="mensaje"
                            :class="{ 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-1 mb-3 ml-4': tipoMensaje == 'Exitoso', 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-3 mb-3 ml-4': tipoMensaje == 'Error' }">
                                <strong class="font-bold" v-if="tipoMensaje=='Exitoso'">Éxito:</strong>
                                <strong class="font-bold" v-if="tipoMensaje=='Error'">Érror:</strong>
                                <span class="block sm:inline">{{ mensaje}}</span>
                            </div>


                            <p class="dark:text-white ml-4">
                                Permisos Asignados
                            </p>


                            <!-- <div class="inline-block min-w-full overflow-hidden rounded-lg shadow mb-4 ml-8"> -->
                            <div class="flex">

                                <div class="w-1/2 p-4">
                                <!--TABLA CARRERAS PERMISOS-->
                                <table>
                                    <!--Encabezados-->
                                    <thead>
                                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase  text-gray-500">

                                            <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                                Carreras
                                            </th>

                                            <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                                Opciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="carrera in carrerasActuales" :key="carrerasActuales.id" class="text-gray-700">
                                            <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                    <!-- {{ carrera.Nivel }} -->
                                                    {{ carrera.Nivel }} en
                                                    {{ carrera.Nombre }}
                                                </p>
                                            </td>

                                            <td
                                            class="border-b  border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 text-sm text-center">

                                                <span class="p-3 rounded-md bg-[#dc2626] inline-flex "
                                                @click="EliminarPermisoCarrera(carrera.id)" >
                                                    <i class="fa-solid fa-minus text-white"></i>
                                                </span>
                                            </td>
                                        </tr>

                                        <tr class="text-gray-700  hover:bg-slate-600" @click="showElementCarreras" v-if="NuevoPermiso.idUsuario!=0">
                                            <td colspan="2"
                                                class=" w-full  text-center border-b border-gray-200 dark:border-slate-700 px-5 py-5 text-sm hover:bg-slate-600">
                                                <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                    AGREGAR NUEVO PERMISO DE CARRERA +
                                                </p>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                </div>

                                <div class="w-1/2 p-4">
                                <!--TABLA PERMISOS SISTEMA-->
                                <table class="">
                                    <!--Encabezados-->
                                    <thead>
                                        <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase  text-gray-500">

                                            <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                                Permisos del sistema
                                            </th>

                                            <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                                Opciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="permiso in permisosActuales" :key="permisosActuales.id" class="text-gray-700">
                                            <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                                                <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                    <!-- {{ carrera.Nivel }} -->
                                                    {{ permiso.name }}
                                                </p>
                                            </td>

                                            <td
                                            class="border-b  border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 text-sm text-center">

                                                <span class="p-3 rounded-md bg-[#dc2626] inline-flex "
                                                @click="EliminarPermisoSistema(permiso.id)" >
                                                    <i class="fa-solid fa-minus text-white"></i>
                                                </span>

                                            </td>
                                        </tr>

                                        <tr class="text-gray-700  hover:bg-slate-600" v-if="NuevoPermiso.idUsuario!=0" @click="showElementPermisos">
                                            <td colspan="2"
                                                class=" w-full  text-center border-b border-gray-200 dark:border-slate-700 px-5 py-5 text-sm hover:bg-slate-600">
                                                <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">
                                                    AGREGAR NUEVO PERMISO DE SISTEMA +
                                                </p>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                                </div>


                            </div>

                            <!-- <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5 w-full'>

                                <Link
                                    :href="route('Roles.index')"
                                    class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' type="button">
                                    Cancelar
                                </Link>

                                <button
                                type="submit"
                                class='w-auto bg-[#014E82] hover:bg-[#0284c7] rounded-lg shadow-xl font-medium text-white px-4 py-2 '
                                >
                                Asignar Permisos
                                </button>

                            </div> -->






        </AuthenticatedLayout>


</template>

