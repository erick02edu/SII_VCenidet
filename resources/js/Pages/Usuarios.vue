<template>

    <Head title="Usuarios" />
    <AuthenticatedLayout>
    <template #header>
            Lista de Usuario
    </template>

    <h3 class="text-m  text-gray-900 dark:text-white py-1 ml-1">
        Buscar por:

        <input type="radio" value="name" name="Campos" v-model="campoBusqueda" required > Nombre
        <input type="radio" value="email" name="Campos" v-model="campoBusqueda" required> Email

    </h3>


    <div class="inline-flex w-full" >

        <div class="relative text-gray-700 focus-within:text-gray-700">
            <input
                class=" border-gray-300 bg-white h-10 px-4 pr-20 rounded-lg text-sm focus:outline-none"
                type="text"
                placeholder="Buscar..."
                v-model="UsuarioBuscar"
                @input="HacerBusqueda()"
            />
        </div>

        <button :type="type" @click="showElement" class=" ml-auto mr-9 rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7] ">
            Nuevo
        </button>


    </div>



    <div id="modalContainer">
        <!-- <button :type="type" @click="showElement" class="rounded-md bg-[#014E82] px-5 py-3 mb-4 text-center text-sm text-white hover:bg-[#0284c7] ">
            Nuevo
        </button> -->

        <!-- Main modal -->
        <div :class="{ hidden: !isVisible }">

            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Agregar Usuario
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
            <form @submit.prevent="crearUsuario"  class="w-full max-w-lg">
                    <div class="flex flex-wrap -mx-3 mb-6">

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
                                Nombre
                            </label>
                            <input id="Nombre" v-model="NuevoUsuario.name"  class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="nombre" required>
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
                                email
                            </label>
                            <input id="email" v-model="NuevoUsuario.email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="text" placeholder="email" required>
                        </div>

                        <div class="w-full px-3">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                                    Contraseña
                                </label>
                                <input id="password" v-model="NuevoUsuario.password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="password" placeholder="contraseña" required>
                        </div>


                        <br>
                        <strong class="pl-8">Marque los roles que tendra este usuario</strong>
                        <div class="pl-8">
                            <label v-for="(Rol, index) in Roles" :key="index">
                                <input type="checkbox" v-model="NuevoUsuario.RolesSeleccionados" :value="Rol.id" />
                                <span class="pl-2 pt-6">{{Rol.name}}</span>
                            </label>
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
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-300 bg-gray-300 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            ID
                        </th>
                        <th class="border-b-2 border-gray-300 bg-gray-300 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th class="border-b-2 border-gray-300 bg-gray-300 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Email
                        </th>
                        <th class="border-b-1 border-gray-300 bg-gray-300 px-1 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <!--FILAS-->
                <tbody>
                    <tr v-for="usuario in usuarios" :key="usuario.id" class="text-gray-700">

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ usuario.id }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ usuario.name }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ usuario.email }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">

                            <Link :href="route('Users.edit',usuario.id)" class="p-3 rounded-md bg-[#014E82] mx-2 ">
                                <i class="fa-solid fa-pen text-white"></i>
                            </Link>


                            <a type="button" @click="showDelete(usuario.id,usuario.name)" class="p-3 rounded-md bg-[#dc2626] mx-2">
                                        <i class="fa-solid fa-trash text-white"></i>
                            </a>

                            <Link :href="route('Users.editRole',usuario.id)" class="p-3 rounded-md bg-[#FFD200]  mx-2 ">
                                <strong>Ver Rol <span>  <i class="fa-solid fa-user-plus pl-1"></i> </span> </strong>
                            </Link>

                            <div>
                                        <div :class="{ hidden: !isvisibleDelete }" v-bind:id="`Modal${usuario.id}`" tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
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
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Esta seguro de eliminar al usuario: {{ nameBorrarSeleccionado }} </h3>
                                                        <Link @click="hideDelete" method="delete" :href="route('Users.destroy', idBorrarSeleccionado)" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
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
        this.ObtenerListaRoles()
        this.hideDelete()
    },

    props:{
         usuarios:Array
    },

    data() {
    return {

       infoEditar: {
          name:'',
          email:''
      },


      isVisible: false,
      isvisibleDelete:false,

      campoBusqueda:'name',
      UsuarioBuscar:'',

      idBorrarSeleccionado:0,
      nameBorrarSeleccionado:"",

      NuevoUsuario:{
          name:'',
          email:'',
          password:'',
          RolesSeleccionados:[],
      },

      Roles:Array,
      ListaRoles:[],

    }
  },

  methods: {


    HacerBusqueda(){

        //this.mensajeUsuarioNuevo=null;

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

    async crearUsuario(){
        await this.$inertia.post(route('Users.store'),this.NuevoUsuario)
        this.hideElement()
    },

    async ObtenerListaRoles(){

        await axios.get('/GetRoles') // Ruta de la API en Laravel
        .then(response => {
            this.ListaRoles = response.data.ListaRoles;
            console.log("Lista Roles:",response.data.ListaRoles[0].name);

            this.Roles=this.ListaRoles;

        })
        .catch(error => {
            console.error('Error al obtener datos:', error);
        });
    },

    showElement() {
      this.isVisible = true;
    },
    hideElement() {
      this.isVisible = false;
    },

    showDelete(id,name){
        this.idBorrarSeleccionado=id;
        this.nameBorrarSeleccionado=name;
        this.isvisibleDelete = true;
    },
    hideDelete(){
        this.isvisibleDelete = false;
    },

  }
};
</script>
