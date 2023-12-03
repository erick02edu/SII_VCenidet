<template>


    <!-- <div class="hidden"> -->
    <div id="pdfContent" class="w-full">

        <!--Encabezado con logos-->
        <div class="w-full h-14 inline-flex align-top ">

            <div class="w-1/3 flex justify-start align-top pl-10 ">
                <img src="/img/LogoSEP.jpg" class="h-14">
            </div>


            <div class="w-1/3 flex justify-center">
                <img src="/img/LogoTecReportes.png" class="h-14">
            </div>

            <div class="w-1/3 flex justify-end mr-10 ">
                <img src="/img/CenidetLogoClaro.png" class="h-14">
            </div>
        </div>


        <!--RECORRER ALUMNOS-->
        <div v-for="index in NumeroAlumnos" :key="index" class="w-2480 h-3508 ">

                <!--Imprimir nombre alumno-->
                <p class="ml-12 mt-5 mb-3">
                    Nombre del alumno:{{ NombreAlumnos[index -1] }}
                </p>


                <table class="ml-12 text-center">
                    <thead>
                        <tr class=" align-top border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="pb-1 border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-1 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                Semestre
                            </th>
                            <th class="pb-1 border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-1 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                Materia
                            </th>
                            <th class="pb-1 border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-1 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                Clave
                            </th>
                            <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 h-10 py-1 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                                Calificacion
                            </th>

                        </tr>
                    </thead>

                    <!--RECORRER CALIFICACIONES DEL ALUMNO ACTUAL-->
                    <tr v-for="Calificacion in CalificacionesTotales[index -1]" class=" align-top w-full h-10 pb-1">



                        <td>
                            {{ Calificacion.NumSemestre }}
                        </td>


                        <td>
                            <span v-for="materia in materias">
                                <span v-if="materia.id==Calificacion.idMateria">
                                    {{ materia.Nombre }}
                                </span>
                            </span>
                        </td>

                        <td>
                            <span v-for="materia in materias">
                                <span v-if="materia.id==Calificacion.idMateria">
                                    {{ materia.Codigo }}
                                </span>
                            </span>
                        </td>




                        <td>
                            {{ Calificacion.Calificacion }}
                        </td>

                    </tr>



                </table>

                <span class="ml-12">Promedio General:{{ PromediosGenerales[index -1] }}</span>


                <!--Espaciado-->
                <div class="ml-12 w-full py-10" >
                    Cenidet
                </div>

        </div>

    </div>
    <!-- </div> -->

</template>


<script>
  import html2pdf from "html2pdf.js";

  export default {

        props:{
            NombreAlumnos:Array,
            NumeroAlumnos:0,
            NumSemestres:Array,
            CalificacionesTotales:Array,
            materias:Array,
            PromediosGenerales:Array
        },

        async mounted() {
            await this.generarPDF();
            //window.close();
        },

        methods:{

            async generarPDF() {
                var element=document.getElementById('pdfContent');//obtener elemento

                const pdfOptions = {
                margin: 0,
                filename: 'Horario.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },//Hoja horizontal
                };

                const pdf=new html2pdf().from(element).set(pdfOptions).outputPdf();
                console.log(pdf)
                await pdf.save();

            },
        }

    }
</script>
