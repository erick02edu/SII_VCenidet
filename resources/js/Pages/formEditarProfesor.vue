<template>

    <Head title="Editar Rol" />
        <AuthenticatedLayout>

                <template #header>
                        Editar Profesor
                </template>
                <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-xl sm:rounded-lg">

                        <form @submit.prevent="EditarProfesor" class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Nombre</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.Nombre"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="text"
                                />
                                </div>

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Apellido Paterno</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.ApellidoP"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="text"
                                />
                                </div>

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Apellido Materno</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.ApellidoM"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="text"
                                />
                                </div>

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Fecha de nacimiento</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.FechaNac"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="date"
                                />
                                </div>

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Genero</label>
                                     <select  class="appearance-none block w-full mt-1 bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white" name="aplicaciones" v-model="InfoEditar.genero" required>
                                            <option :value="'M'">
                                            Masculino
                                            </option>
                                            <option :value="'F'">
                                            Femenino
                                            </option>
                                            <option :value="'NB'">
                                            No binario
                                            </option>
                                    </select>
                                </div>

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Numero de telefono</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.NumeroTel"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="text"
                                />
                                </div>


                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Especialidad</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.Especialidad"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent" type="text"
                                />
                                </div>

                            </div>

                            <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5'>
                            <Link
                                :href="route('Profesores.index')"
                                class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2' type="button">
                                Cancelar
                            </Link>
                            <button
                                type="submit"
                                class='w-auto bg-[#014E82] hover:bg-[#0284c7] rounded-lg shadow-xl font-medium text-white px-4 py-2'
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
            profesor:{
                type:Array,
                required:true,
            }
        })


        var form=useForm({
            id:props.profesor.id,
            Nombre:props.profesor.Nombre,
            ApellidoP:props.profesor.ApellidoP,
            ApellidoM:props.profesor.apellidoM,
            FechaNac:props.profesor.FechaNac,
            genero:props.profesor.genero,
            NumeroTel:props.profesor.NumeroTel,
            Especialidad:props.profesor.Especialidad,
        })

    </script>

    <script>

        export default {

            components:{
                Link
            },

            data() {
                return {
                    InfoEditar: {
                        Nombre:this.$props.profesor.Nombre,
                        ApellidoP:this.$props.profesor.ApellidoP,
                        ApellidoM:this.$props.profesor.ApellidoM,
                        FechaNac:this.$props.profesor.FechaNac,
                        genero:this.$props.profesor.genero,
                        NumeroTel:this.$props.profesor.NumeroTel,
                        Especialidad:this.$props.profesor.Especialidad,
                    },
                }
            },

            methods:{
                EditarProfesor(){
                    console.log(this.InfoEditar);
                    this.$inertia.put(
                    route("Profesores.update",this.$props.profesor.id),
                        this.InfoEditar
                    );
                },
            },


        };

    </script>
