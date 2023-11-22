<template>

    Se ingreso a la vista <br>
    num Horarios={{ numHorarios }}
    <div v-for="(horario,index) in ListaHorarios" :key="index">
        Personas:<br>
        {{ Listapersonal[index] }}
        {{ index }}<br>
        Plaza:{{ Listaplaza[index] }}
        categoria:{{ Listacategoria[index].Descripcion }}
        Dep.Adscripcio{{ ListaDepartamentoAdscripcion[index].Nombre }}

        <br><br><br>
        Dias lunes:<br>
        {{ ListaDiaLunes[index][0].HInicio }}
    </div>

</template>

<script>
  import html2pdf from "html2pdf.js";

  export default {

        props:{
            ListaHorarios:Array,
            Listapersonal:Array,
            periodo:Array,
            Listacategoria:Array,
            Listaplaza:Array,
            ListaDepartamentoAdscripcion:Array,
            ListaEncargadoDepAdscripcion:Array,
            ListaDiaLunes:Array,
            ListaDiaMartes:Array,
            ListaDiaMiercoles:Array,
            ListaDiaJueves:Array,
            ListaDiaViernes:Array,
            ListaDiaSabado:Array,

            ListaHorasTotalesLunes:0,
            ListaminutosTotalesLunes:0,
            ListaHorasTotalesMartes:0,
            ListaminutosTotalesMartes:0,
            ListaHorasTotalesMiercoles:0,
            ListaminutosTotalesMiercoles:0,
            ListaHorasTotalesJueves:0,
            ListaminutosTotalesJueves:0,
            ListaHorasTotalesViernes:0,
            ListaminutosTotalesViernes:0,
            ListaHorasTotalesSabado:0,
            ListaminutosTotalesSabado:0,
            ListaHorasSemana:0,
            ListaMinutosSemana:0,

            numHorarios:0

        },

        async mounted() {
            //await this.generarPDF();
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
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' },//Hoja horizontal
                };

                const pdf=new html2pdf().from(element).set(pdfOptions).outputPdf();
                console.log(pdf)
                await pdf.save();

            },
        }

    }
</script>






