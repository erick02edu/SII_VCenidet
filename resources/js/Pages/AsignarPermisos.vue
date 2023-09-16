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
            }
        })

        var form=useForm({
            id:props.rol.id,
            name:props.rol.name,
        })
</script>


<script>


    export default {

        mounted() {
            this.ObtenerListaPermisos()
            this.ObtenerPermisosRol()
        },
        components:{
            Link
        },
        data() {
            return {
                NuevoPermiso: {
                    id:this.$props.rol.id,
                    name:this.$props.rol.name,
                    PermisosSeleccionados:[],
                },

                Activado:[],

                data:[],
                Permisos:Array,
                ListaPermisos:[],

                PermisosRol:Array,

            }

        },

        methods: {

            async ObtenerPermisosRol(){


                await axios.get( route("GetPermisosRol",this.$props.rol.id) ) // Ruta de la API en Laravel
                .then(response => {

                    console.log("Lista permisos del rol:",response.data.ListaPermisosRol);

                    this.PermisosRol=response.data.ListaPermisosRol;

                })
                .catch(error => {
                    console.error('Error al obtener datos:', error);
                });



            },

            async ObtenerListaPermisos(){

                await axios.get('/GetPermisos') // Ruta de la API en Laravel
                .then(response => {
                    this.ListaPermisos = response.data.ListaPermisos;

                    this.Permisos=this.ListaPermisos;

                })
                .catch(error => {
                    console.error('Error al obtener datos:', error);
                });


            },

            AsignarPermisos(){

                //console.log('Roles seleccionados:', this.NuevoRol.RolesSeleccionados);
                this.$inertia.get(route("Permisos.asignar",this.NuevoPermiso))

            },
        },

    };
</script>




<template>



    <Head title="Asignar Permisos" />
        <AuthenticatedLayout>

                <template #header>
                        Asignar Permisos a Rol
                </template>
                <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                        <form @submit.prevent="AsignarPermisos" class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                                <div class="grid grid-cols-1">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Nombre del Rol</label>
                                        <input readonly
                                            id="name"
                                            v-model="NuevoPermiso.name"
                                            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text"
                                        />
                                        <input readonly hidden
                                            id="id"
                                            v-model="NuevoPermiso.id"
                                            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text"
                                        />
                                </div>
                            </div>

                            <br>
                            <strong class="pl-8">Permisos actuales de este rol</strong>
                            <div class="pl-8">
                                <label v-for="(permisos, index) in PermisosRol" :key="index">
                                <span class="pl-2 pt-6">{{permisos}}</span>
                                </label>
                            </div>


                            <span v-if="PermisosRol.length==0" class="pl-8">Este rol no tiene permisos asignados</span>

                            <br>
                            <strong class="pl-8">Marque los permisos que tendra este rol</strong>
                            <div class="pl-8">
                                <label v-for="(permisos, index) in Permisos" :key="index">

                                    <input type="checkbox" v-model="NuevoPermiso.PermisosSeleccionados" :value="permisos.id" />
                                    <span class="pl-2 pt-6">{{permisos.name}}</span>

                                </label>
                            </div>

                            <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5'>
                                <Link
                                    :href="route('Roles.index')"
                                    class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' type="button">
                                    Cancelar
                                </Link>

                                <button
                                type="submit"
                                class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2 '
                                >
                                Asignar Permisos
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </AuthenticatedLayout>


</template>

