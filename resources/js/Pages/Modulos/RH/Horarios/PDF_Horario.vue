
<template>

<div v-show="none">
<div id="pdfContent">

    <Head title="Panel" />

    <main class="insert-0 container mx-auto lg:flex lg:flex-row overflow-y-auto" >


        <div class="container mx-auto px-6 py-4 overflow-y-auto"  >

                <table class="whitespace-no-wrap">
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
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in this.$page.props.ClasesLunes" :key="index"  id="Lunes"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-10 py-5 mt-1 dark:text-gray-200 ">

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
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in this.$page.props.ClasesMartes" :key="index"  id="Martes"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-10 py-5 mt-1 dark:text-gray-200 ">

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
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in this.$page.props.ClasesMiercoles" :key="index"  id="Miercoles"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-10 py-5 mt-1 dark:text-gray-200 ">

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
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in this.$page.props.ClasesJueves" :key="index"  id="Jueves"  >

                                <div :style="{ backgroundColor: clase.color }" class="px-10 py-5 mt-1 dark:text-gray-200 ">

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
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in this.$page.props.ClasesViernes" :key="index"  id="Viernes"   >
                                <div :style="{ backgroundColor: clase.color }" class="px-10 py-5 mt-1 dark:text-gray-200">

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


</div>
</div>
</template>

<script setup>
    import { Head } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    
</script>

<script>
    import { useDark,useToggle} from '@vueuse/core'
    import html2pdf from "html2pdf.js";

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





    async mounted(){

        await this.generarPDF()
        window.close();
    },




    data(){
        return{

            icono:'',

            // NuevasClasesLunes:[],
            // NuevasClasesMartes:[],
            // NuevasClasesMiercoles:[],
            // NuevasClasesJueves:[],
            // NuevasClasesViernes:[],

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

    async generarPDF() {



        var element=document.getElementById('pdfContent');//obtener elemento

        const pdfOptions = {
        margin: 10,
        filename: 'Horario.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' },//Hoja horizontal
        };

        const pdf=new html2pdf().from(element).set(pdfOptions).outputPdf();

        console.log(pdf)

        await pdf.save();



        //window.history.back();
    },

    },
}
</script>



