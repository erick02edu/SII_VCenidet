  <!-- <template>
    <Bar :data="InfoData"  idth="100" height="90"/>
  </template>

  <script>

  import { Bar } from 'vue-chartjs'
  import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

  export default {

    name: 'BarChart',
    components: { Bar },

    data() {
      return {


        InfoData: {
          labels: [ 'January', 'February', 'March'],
          datasets: [
            {
              label: 'Data One',
              backgroundColor: '#f87979',
              data: [40, 20, 12]
            }
          ]
        }


      }
    }
  }
  </script> -->



  <template>

    <Head title="Horarios" />

    <div v-show="none">

    <!-- <div> -->

    <div id = "pdfContent">

        <div  v-for="usuario in usuarios" class = "html2pdf__page-break" >

            <span class="flex justify-between">

            <div class="ml-2">
                <img src="/img/LogoSep.jpg" alt="Descripción de la imagen" class="w-40 h-30">
            </div>

            <div  class="mr-10">
                <img src="/img/LogoTecReportes.png" alt="Descripción de la imagen" class="w-30 h-20">
            </div>

            </span>
            <div class="border-[#014E82] border-4  bg-[#014E82] flex justify-end"> <p class="text-white mr-8 text-sm pb-1">Centro Nacional de Investigacion y desarrollo tecnologico</p> </div>

            <strong> Informacion del usuario </strong>
            <br>

            <strong>Nombre de usuario:</strong><span>{{usuario.name}}</span><br>
            <strong>Email:</strong><span>{{usuario.email}}</span>


        </div>

    </div>

</div>


  </template>

<script>

import html2pdf from "html2pdf.js";

import { Head } from '@inertiajs/vue3';
import axios from 'axios';



export default {


    data() {
        return {
            numPaginas:[1,2,3,4,5]
        }
    },

    props:{
        usuarios:Array
    },

    mounted() {
        this.generarPDF()

    },

    methods: {
    generarPDF() {

        var element=document.getElementById('pdfContent');//Primer elemento
        var anotherElement=document.getElementById('pdfContent');//Segundo elemento

        const pdfOptions = {
        margin: 10,
        filename: 'Usuarios.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        };


        var pdf=new html2pdf().from(element).set(pdfOptions);

        pdf.save()

        window.history.back();





    },

  },
};
</script>
