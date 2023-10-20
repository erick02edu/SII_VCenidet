<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Sistema Integral de Información del CENIDET
        </template>

        <div class="bg-white dark:bg-slate-700 overflow-hidden shadow-sm sm:rounded-lg ">
            <div class="p-6 border-b border-gray-200  dark:border-gray-700 dark:text-gray-200">
                Bienvenido {{ $page.props.auth.user.name }}

                <br><br><br>
                {{ $page.props.user.permissions }}
            </div>



        </div>


        <Bar :data="InfoData" class=" w-80 max-h-80 pt-8" />


    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    import { Head } from '@inertiajs/vue3';
</script>

<script>

    import axios from 'axios';

    import { useDark,useToggle} from '@vueuse/core'
    const isDark=useDark()
    const toggleDark=useToggle(isDark)


    import { Bar } from 'vue-chartjs'
    import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

    ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)



    export default {


        name: 'BarChart',
        components: { Bar },


        mounted() {
            //this.ObtenerRoleUsuario()
            console.log('controlador:',this.$page.props.rolesName)
            this.ListaRoles=this.$page.props.rolesName
        },

        beforeCreate(){

            this.total=[80,72,8]
            console.log('Numero de personal por Rol',this.$page.props.InfoGrafica)

        },

        props:{
            InfoGrafica:Array,
            rolesName:Array
        },

        data() {
            return {
                Roles:Array,
                ListaRoles:[],
                color:'',


                InfoData: {
                    labels: [ 'Admin', 'Usuarios de Rh', 'Profesores'],
                    datasets: [
                        {
                        label: 'Numero de usuarios con este rol',
                        backgroundColor: '#014E82',
                        data: this.$page.props.InfoGrafica,
                        }
                    ]
                }



            }
        },
        methods: {
            async ObtenerRoleUsuario(){

                await axios.get('/RolUsuario') // Ruta de la API en Laravel
                .then(response => {
                    this.ListaRoles = response.data.ListaRoles;
                    this.Roles=this.ListaRoles;
                    console.log("Lista Roles:",response.data.ListaRoles);
                })
                .catch(error => {
                    console.error('Error al obtener datos:', error);
                });
            },
        },
    };
</script>
