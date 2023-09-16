<script setup>

        import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
        import Pagination from '@/Components/Pagination.vue'
        import { Head, useForm } from '@inertiajs/vue3';
        import { Link } from '@inertiajs/vue3'
        import Checkbox from '@/Components/Checkbox.vue';

        const props=defineProps({
            usuario:{
                type:Array,
                required:true,
            }
        })

        var form=useForm({
            id:props.usuario.id,
            name:props.usuario.name,
            Email:props.usuario.email,
        })
</script>


<script>


    export default {

        mounted() {
            this.ObtenerListaRoles()
            this.ObtenerRolesUsuario()
        },
        components:{
            Link
        },
        data() {
            return {
                NuevoRol: {
                    id:this.$props.usuario.id,
                    name:this.$props.usuario.name,
                    RolesSeleccionados:[],
                },

                Activado:[],

                data:[],
                Roles:Array,
                ListaRoles:[],

                RolesUsuario:Array,

            }

        },

        methods: {

            async ObtenerRolesUsuario(){


                await axios.get( route("GetRolesUsuario",this.$props.usuario.id) ) // Ruta de la API en Laravel
                .then(response => {

                    console.log("Lista Roles usuario:",response.data.ListaRolesUsuario);

                    this.RolesUsuario=response.data.ListaRolesUsuario;

                })
                .catch(error => {
                    console.error('Error al obtener datos:', error);
                });



            },

            async ObtenerListaRoles(){

                await axios.get('/GetRoles') // Ruta de la API en Laravel
                .then(response => {
                    this.ListaRoles = response.data.ListaRoles;

                    this.Roles=this.ListaRoles;

                })
                .catch(error => {
                    console.error('Error al obtener datos:', error);
                });


            },

            AsignarRol(){

                //console.log('Roles seleccionados:', this.NuevoRol.RolesSeleccionados);
                this.$inertia.get(route("Roles.asignar",this.NuevoRol))

            },
        },

    };
</script>




<template>



    <Head title="Asignar Rol" />
        <AuthenticatedLayout>

                <template #header>
                        Asignar Rol
                </template>
                <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                        <form @submit.prevent="AsignarRol" class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                                <div class="grid grid-cols-1">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre del usuario</label>
                                        <input readonly
                                            id="name"
                                            v-model="NuevoRol.name"
                                            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text"
                                        />
                                        <input readonly hidden
                                            id="id"
                                            v-model="NuevoRol.id"
                                            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text"
                                        />
                                </div>
                            </div>

                            <br>
                            <strong class="pl-8">Roles actuales del usuario</strong>
                            <div class="pl-8">
                                <label v-for="(Rol, index) in RolesUsuario" :key="index">
                                <span class="pl-2 pt-6">{{Rol}}</span>
                                </label>
                            </div>
                            <span v-if="RolesUsuario.length==0" class="pl-8">Este usuario no tiene un rol asignado actualmente</span>


                            <br>

                            <strong class="pl-8">Marque los roles que tendra este usuario</strong>
                            <div class="pl-8">
                                <label v-for="(Rol, index) in Roles" :key="index">

                                    <input type="checkbox" v-model="NuevoRol.RolesSeleccionados" :value="Rol.id" />
                                    <span class="pl-2 pt-6">{{Rol.name}}</span>

                                </label>
                            </div>

                            <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5'>
                                <Link
                                    :href="route('Users.index')"
                                    class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' type="button">
                                    Cancelar
                                </Link>

                                <button
                                type="submit"
                                class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 '
                                >
                                Asignar Roles
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </AuthenticatedLayout>


</template>

