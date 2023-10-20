<template>

    <Head title="Panel" />



    <main class="insert-0 container mx-auto lg:flex lg:flex-row transform scale-85 " >


        <!-- <p class="flex font-roboto dark:text-gray-200 justify-center w-full items-center pt-5 ">Horario</p> -->

        <div class="container mx-auto px-6 py-4 "  >

                <table class="w-full whitespace-no-wrap">
                    <thead class="bg-slate-700 text-gray-200 align-left" >
                        <td class="py-3">
                            Lunes
                        </td>

                        <td  class="py-3">
                            Martes
                        </td>

                        <td  class="py-3" >
                            Miercoles
                        </td>

                        <td  class="py-3">
                            Jueves
                        </td>

                        <td  class="py-3">
                            Viernes
                        </td>

                    </thead>

                    <tbody class="align-top" >

                        <td class="border-0">
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesLunes" :key="index"  id="Lunes"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-5 py-5 mt-1 dark:text-gray-200 text-xs">

                                <span v-for="materia in materias">
                                    <span v-if="materia.id==clase.idMateria">{{ materia.Nombre }}</span>
                                </span>

                                <span v-for="aula in aulas">
                                    <p v-if="aula.id==clase.idAula">{{ aula.NombreAula }}</p>
                                </span>

                                {{ clase.HInicio }}-{{ clase.HFin }}
                                </div>

                            </tr>



                        </td>

                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesMartes" :key="index"  id="Martes"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-5 py-5 mt-1 dark:text-gray-200 text-xs">

                                <span v-for="materia in materias">
                                    <span v-if="materia.id==clase.idMateria">{{ materia.Nombre }}</span>
                                </span>

                                <span v-for="aula in aulas">
                                    <p v-if="aula.id==clase.idAula">{{ aula.NombreAula }}</p>
                                </span>

                                {{ clase.HInicio }}-{{ clase.HFin }}
                                </div>
                            </tr>


                        </td>


                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesMiercoles" :key="index"  id="Miercoles"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-5 py-5 mt-1 dark:text-gray-200 text-xs">

                                <span v-for="materia in materias">
                                    <span v-if="materia.id==clase.idMateria">{{ materia.Nombre }}</span>
                                </span>

                                <span v-for="aula in aulas">
                                    <p v-if="aula.id==clase.idAula">{{ aula.NombreAula }}</p>
                                </span>

                                {{ clase.HInicio }}-{{ clase.HFin }}
                                </div>

                            </tr>


                        </td>


                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesJueves" :key="index"  id="Jueves"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-5 py-5 mt-1 dark:text-gray-200 text-xs">

                                <span v-for="materia in materias">
                                    <span v-if="materia.id==clase.idMateria">{{ materia.Nombre }}</span>
                                </span>

                                <span v-for="aula in aulas">
                                    <p v-if="aula.id==clase.idAula">{{ aula.NombreAula }}</p>
                                </span>

                                {{ clase.HInicio }}-{{ clase.HFin }}
                                </div>
                            </tr>


                        </td>


                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesViernes" :key="index"  id="Viernes"   >
                                <div :style="{ backgroundColor: clase.color }" class="px-5 py-5 mt-1 dark:text-gray-200 text-xs">

                                <span v-for="materia in materias">
                                    <span v-if="materia.id==clase.idMateria">{{ materia.Nombre }}</span>
                                </span>

                                <span v-for="aula in aulas">
                                    <p v-if="aula.id==clase.idAula">{{ aula.NombreAula }}</p>
                                </span>

                                {{ clase.HInicio }}-{{ clase.HFin }}
                                </div>
                            </tr>

                        </td>



                    </tbody>

                </table>

        </div>


    </main>


</template>

<script setup>
    import { Head } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    
</script>

<script>
    import { useDark,useToggle} from '@vueuse/core'

    const isDark=useDark()
    const toggleDark=useToggle(isDark)

export default {

    props:{
        infoHorario:Array,
        materias:Array,
        aulas:Array,
        grupos:Array,
        idHorario:'',
        ClasesLunes:Array,
        ClasesMartes:Array,
        ClasesMiercoles:Array,
        ClasesJueves:Array,
        ClasesViernes:Array,
    },

    mounted(){
        this.NuevasClasesLunes=this.$page.props.ClasesLunes
        this.NuevasClasesMartes=this.$page.props.ClasesMartes
        this.NuevasClasesMiercoles=this.$page.props.ClasesMiercoles
        this.NuevasClasesJueves=this.$page.props.ClasesJueves
        this.NuevasClasesViernes=this.$page.props.ClasesViernes

        if(isDark.value==false){
                this.icono='fa-solid fa-moon'
            }
            else{
                this.icono='fa-solid fa-sun'
        }
    },



    data(){
        return{

            icono:'',

            ListaMartes:[1,2,4],
            ListaMiercoles:[1,2],
            ListaJueves:[1,3,4],
            ListaViernes:[1,5,2],


            NuevasClasesLunes:[],
            NuevasClasesMartes:[],
            NuevasClasesMiercoles:[],
            NuevasClasesJueves:[],
            NuevasClasesViernes:[],

            backgroundColor:'background-color',

            isVisible:false,

            NuevaClase:{
                HoraInicio:'12:00',
                dia:'',
                color:'',
            },

            Edicion:true,

            claseEditar:[],

        }

    },


    computed: {
        fondo() {
            // Concatena la clase de fondo con el valor de NuevaClase.color
            return `background-color: ${this.ListaLunes[0].hex};`;
        },
    },


    methods:{

        CambiarIcono(){
                if(isDark.value==true){
                    this.icono='fa-solid fa-moon'
                }
                else{
                    this.icono='fa-solid fa-sun'
                }
        },

    },
}
</script>


