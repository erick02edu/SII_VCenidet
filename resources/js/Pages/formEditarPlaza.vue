<template>

    <Head title="Editar Aulas" />
        <AuthenticatedLayout>

                <template #header>
                        Editar Plaza
                </template>
                <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                        <form @submit.prevent="EditarPlaza" class="mb-6">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                            <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Categoria</label>


                            <select v-model="InfoEditar.idCategoria">
                                <option
                                    v-for="(categoria,index) in ListaCategorias"
                                    :key="categoria.id"
                                    :value="categoria.id"
                                    :selected="categoria.Descripcion==InfoEditar.categoriaEditar"
                                >

                                    {{ categoria.Clave }}-{{ categoria.Descripcion }}
                                </option>
                            </select>

                            </div>


                            <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Unidad</label>
                            <!-- <input
                                id="unidad"
                                v-model="InfoEditar.unidad"
                                class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number"
                            /> -->


                            <select name="aplicaciones" class="md:w-2/3 appearance-none bg-white border-gray-300 py-3 px-4 rounded leading-tight focus:outline-none focus-border blue-500 text-gray-700 border" v-model="InfoEditar.unidad" required>

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

                            <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Subunidad</label>
                            <!-- <input
                                id="subunidad"
                                v-model="InfoEditar.subunidad"
                                class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number"
                            /> -->

                                <select class="md:w-1/3 appearance-none bg-white border-gray-300 py-3 px-4 rounded leading-tight focus:outline-none focus-border blue-500 text-gray-700 border" name="aplicaciones" v-model="InfoEditar.subunidad" required>
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

                            <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Diagonal</label>
                            <input
                                id="diagonal"
                                v-model="InfoEditar.diagonal"
                                class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="text"
                            />
                            </div>

                            <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Horas/min a la semana de la plaza</label>
                            <input
                                id="horas"
                                v-model="InfoEditar.horas"
                                class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent" type="number"
                            />
                            </div>

                            <div class="grid grid-cols-1">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold">Estatus</label>

                            Alta <input type="radio" value="A" name="Estatus" v-model="InfoEditar.estatus" required>
                            Baja<input type="radio" value="B" name="Estatus" v-model="InfoEditar.estatus" required>

                            </div>



                            </div>

                            <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5'>
                            <Link
                                :href="route('Plazas.index')"
                                class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' type="button">
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'
                            >
                                Guardar
                            </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



        </AuthenticatedLayout>



    </template>

    <script setup>

        import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
        import Pagination from '@/Components/Pagination.vue'
        import { Head, useForm } from '@inertiajs/vue3';
        import { Link } from '@inertiajs/vue3'

        const props=defineProps({
            plaza:{
                type:Array,
                required:true,
            },

            categoriaEditar:Array,
            ListaCategorias:Array,
        })

        var form=useForm({
            id:props.plaza.id,
            unidad:props.plaza.unidad,
            subunidad:props.plaza.subunidad,
            idCategoria:props.plaza.idCategoria,
            diagonal:props.plaza.diagonal,
            horas:props.plaza.horas,
            estatus:props.plaza.estatus,
            categoriaEditar:props.categoriaEditar,
            ListaCategorias:props.ListaCategorias
        })


    </script>

    <script>

        //console.log($props.Aula);

        export default {

            components:{
                Link
            },

            data() {
                return {
                    InfoEditar: {
                        idCategoria:this.$props.plaza.idCategoria,
                        unidad:this.$props.plaza.unidad,
                        subunidad:this.$props.plaza.subunidad,
                        diagonal:this.$props.plaza.diagonal,
                        horas:this.$props.plaza.horas,
                        estatus:this.$props.plaza.estatus,
                    },


                }
            },

            methods:{
                EditarPlaza(){

                    console.log(this.InfoEditar);

                    this.$inertia.put(
                    route("Plazas.update",this.$props.plaza.id),
                        this.InfoEditar
                    );
                },
            },


        };

    </script>
