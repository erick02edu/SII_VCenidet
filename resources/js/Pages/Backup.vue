<template>
    <Head title="Backup" />
    <AuthenticatedLayout>
    <template #header>
            Respaldo y Restauracion de la Base de datos
    </template>


    <div id="modalContainer" class="px-5">
        <button :type="type" @click="GenerarBackup" class="rounded-md bg-[#014E82] px-5 py-3 mb-2 text-center text-sm text-white hover:bg-[#0284c7]  ">
            Generar Respaldo
        </button>
    </div>

    {{ backups }}

    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { Link } from '@inertiajs/vue3'
</script>

<script>

import axios from 'axios';

export default {

    components:{
        Link
    },

    props:{
          backups:Array
         //backups:''
    },

    data() {
    return {

    }
  },

  methods: {
    async GenerarBackup(){

        await this.$inertia.get(route('GenerarBackup'))


    }
  }

};
</script>

