<template>

    <Head title="Editar Grupo" />
        <AuthenticatedLayout>

                <template #header>
                    Editar grupo
                </template>
                <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-xl sm:rounded-lg">

                        <form @submit.prevent="EditarGrupo" class="mb-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5 mx-7">

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Semestre</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.Semestre"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent"
                                    type="number"
                                />
                                </div>

                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Especialidad</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.Especialidad"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent"
                                    type="text"
                                />
                                </div>


                                <div class="grid grid-cols-1">
                                <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Letra</label>
                                <input
                                    id="NombreAula"
                                    v-model="InfoEditar.Letra"
                                    class="py-2 px-3 rounded-lg border-2 border-[#0285c7c6] dark:text-gray-200 dark:bg-slate-700 mt-1 focus:outline-none focus:ring-2 focus:[#014E82] focus:border-transparent"
                                    type="text"
                                />
                                </div>



                                <div class="grid grid-cols-1">

                                    <label class="uppercase md:text-sm text-xs text-gray-500 dark:text-gray-200 text-light font-semibold">Periodo</label>

                                    <select class="appearance-none mt-1 block w-full bg-gray-200 dark:bg-slate-700 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    v-model="InfoEditar.idPeriodo">
                                        <option value="0">Selecciona un periodo</option>
                                        <option
                                            v-for="periodo in periodos"
                                            :key="periodo.id"
                                            :value="periodo.id"
                                        >
                                            {{ periodo.mesInicio }} {{ periodo.AñoInicio }}-{{ periodo.mesTermino }} {{ periodo.AñoTermino }}

                                        </option>
                                    </select>
                                </div>



                            </div>

                            <div class='flex justify-end md:gap-8 gap-4 pt-5 pb-5 pr-5'>
                            <Link
                                :href="route('Grupos.index')"
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
            grupo:{
                type:Array,
                required:true,
            },
            periodos:Array
        })


        var form=useForm({
            id:props.grupo.id,
            Semestre:props.grupo.Semestre,
            Especialidad:props.grupo.Especialidad,
            Letra:props.grupo.Letra,
            idPeriodo:props.grupo.idPeriodo
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
                        Semestre:this.$props.grupo.Semestre,
                        Especialidad:this.$props.grupo.Especialidad,
                        Letra:this.$props.grupo.Letra,
                        idPeriodo:this.$props.grupo.idPeriodo
                    },
                }
            },

            methods:{
                EditarGrupo(){
                    console.log(this.InfoEditar);
                    this.$inertia.put(
                    route("Grupos.update",this.$props.grupo.id),
                        this.InfoEditar
                    );
                },
            },


        };

    </script>
