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
            },
            RolesActuales:Array,
            ListaRolesTotal:Array,
            rolesMarcar:Array
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

            this.ObtenerRolesUsuario()

            this.NuevoRol.RolesSeleccionados=this.$page.props.rolesMarcar
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
                    <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-xl sm:rounded-lg">

                        <form @submit.prevent="AsignarRol" class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">
                                <div class="grid grid-cols-1">
                                    <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Nombre del usuario</label>
                                        <input readonly
                                            id="name"
                                            v-model="NuevoRol.name"
                                            class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="text"
                                        />
                                        <input readonly hidden
                                            id="id"
                                            v-model="NuevoRol.id"
                                            class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="text"
                                        />
                                </div>
                            </div>

                            <br>
                            <strong class="pl-8 dark:text-gray-200">Roles actuales del usuario</strong>
                            <div class="pl-8">
                                <label v-for="(Rol, index) in RolesActuales" :key="index">
                                <span class="pl-2 pt-6 dark:text-gray-200">{{Rol}}</span><br>
                                </label>
                            </div>
                            <span v-if="RolesActuales.length==0" class="pl-8 dark:text-gray-200">Este usuario no tiene un rol asignado actualmente</span>


                            <br>

                            <strong class="pl-8 dark:text-gray-200">Marque los roles que tendra este usuario</strong>
                            <div class="pl-8">
                                <label v-for="(Rol, index) in ListaRolesTotal" :key="index">

                                    <input type="checkbox" v-model="NuevoRol.RolesSeleccionados" :value="Rol.id" />
                                    <span class="pl-2 pt-6 dark:text-gray-200">{{Rol.name}}</span>

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
                                class='w-auto bg-[#014E82] hover:bg-[#0284c7] rounded-lg shadow-xl font-medium text-white px-4 py-2'
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

