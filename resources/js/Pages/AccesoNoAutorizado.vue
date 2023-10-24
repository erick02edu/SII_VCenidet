<template>
    <div class="h-screen flex items-center justify-center bg-slate-800">
      <div class="text-center">
        <img src="/img/IconoTec.png" class=" w-36  ml-28">

        <h1 class="text-4xl font-semibold text-[#0284c7] mb-4">Acceso No Autorizado</h1>
        <p class=" text-gray-200 ">No tienes permisos para acceder a esta página.</p>
        <button @click="volver" class="mt-6  px-6 py-2 rounded-md bg-[#0284c7] text-white font-semibold ">Volver</button>
      </div>
    </div>
  </template>

<script>

    export default {

    methods:{
        volver(){
            window.history.back();
        }
    }

  }

</script>
