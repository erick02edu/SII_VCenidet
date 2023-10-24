<!--

  <template>

    <Head title="Horarios" />

    <div id = "pdfContent">


            <div class="border-[#014E82] border-4  bg-[#014E82] flex justify-end">
                <p class="text-white mr-8 text-sm pb-1">
                Centro Nacional de Investigacion y desarrollo tecnologico</p>
            </div>

        <Bar :data="InfoData" class=" w-80 max-h-80 pt-8" />

    </div>


  </template>

<script>

import html2pdf from "html2pdf.js";

import { Head } from '@inertiajs/vue3';
import axios from 'axios';


import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name: 'BarChart',
    components: { Bar },

    data() {





        return {
            numPaginas:[1,2,3,4,5],


            InfoData: {
                    labels: [ 'Admin', 'Usuarios de Rh', 'Profesores'],
                    datasets: [
                        {
                        label: 'Numero de usuarios con este rol',
                        backgroundColor: '#014E82',
                        data: {'Admin':12,'Usuarios de Rh':13,'Profesores':14}
                        }
                    ]
            }
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
</script> -->


<template>

    <button @click="generarPDF">Generar PDF</button>

    <div>
      <div id="pdfContent">
        <div class="border-[#014E82] border-4 bg-[#014E82] flex justify-end">
          <p class="text-white mr-8 text-sm pb-1">
            Centro Nacional de Investigación y Desarrollo Tecnológico
          </p>
        </div>

        <!-- Renderiza la gráfica en un elemento HTML -->
        <canvas id="myChart" class="w-80 max-h-80 pt-8"></canvas>
      </div>
    </div>
  </template>

  <script>
  import html2pdf from "html2pdf.js";
  import { Head } from "@inertiajs/vue3";
  import axios from "axios";
  //ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

  import { Chart, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js/auto';

  Chart.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

  export default {
    name: "BarChart",
    data() {
      return {
        numPaginas: [1, 2, 3, 4, 5],
      };
    },
    props: {
      usuarios: Array,
    },
    mounted() {
      // Renderiza la gráfica después de que el componente se monte
      this.renderChart();

    },




    methods: {
      renderChart() {
        const ctx = document.getElementById("myChart").getContext("2d");

        // Configura tus datos de gráfica aquí
        const data = {
          labels: ["Admin", "Usuarios de Rh", "Profesores"],
          datasets: [
            {
              label: "Numero de usuarios con este rol",
              backgroundColor: "#014E82",
              data: [12, 13, 14],
            },
          ],
        };

        // const options = {
        //   responsive: true,
        //   maintainAspectRatio: false,
        // };

        new Chart(ctx, {
          type: "bar",
          data: data,
        });
      },


      generarPDF() {
        const element = document.getElementById("pdfContent");
        const pdfOptions = {
          margin: 10,
          filename: "Graficas.pdf",
          image: { type: "jpeg", quality: 0.98 },
          html2canvas: { scale: 2 },
          jsPDF: { unit: "mm", format: "a4", orientation: "portrait" },
        };

        const pdf = new html2pdf().from(element).set(pdfOptions);
        pdf.save();
        //window.history.back();
      },
    },
  };
  </script>
