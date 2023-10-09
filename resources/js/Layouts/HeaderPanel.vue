<template>
    <header class="flex items-center justify-between border-b-2 border-[#014E82] dark:border-slate-500    bg-white  dark:bg-slate-800 px-6 py-4">
        <div class="flex items-center">
            <button @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu" class="text-gray-500 dark:text-white focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="flex items-center">


            <button class="relative inline overflow-hidden dark:text-slate-100 pr-2 pl-3"
            v-tippy="{
                content:'Hola',
                placement: 'left' ,
                arrow: true,
                theme:'mediano'

            }">

                <div class="hover:bg-gray-200 dark:hover:bg-slate-500 pr-1 pl-2 pt-1.5 pb-0.5 rounded-md">
                    <i class="fa-solid fa-bell absolute z-0  "></i>
                    <div class=" bg-red-600 rounded-full pr-1 pl-1 inline relative text-sm z-100 ml-2"> <span class="text-slate-200">1</span> </div>
                </div>
            </button>










            <button @click="toggleDark()" class="relative inline overflow-hidden dark:text-slate-100 pr-3 pl-3 "
            v-tippy="{
                content: refContent,
                placement: 'top' ,
                arrow: true,
                theme: 'mediano'

            }">

                <div @click="CambiarIcono" class="hover:bg-gray-200 dark:hover:bg-slate-500  pr-2 pl-2 pt-0.5 pb-0.5 rounded-md">
                    <i :class="icono"></i>
                </div>

            </button>




            <button @click="GuardarCambios" class="px-4 py-2 bg-[#014E82] rounded-md text-gray-200 ml-5 ">Guardar cambios</button>


        </div>
    </header>
</template>

<script setup>
import Panel from '@/Pages/PanelHorario.vue';

</script>



<script>


    import { useDark,useToggle} from '@vueuse/core'

    import { directive } from 'vue-tippy'
    import { roundArrow } from 'vue-tippy'
    import { ref } from 'vue'


    const isDark=useDark()
    const toggleDark=useToggle(isDark)
    const Hola=['1 notificacion','2 notificacion','3 notificacion ']

    // const refContent = ref(this.notificaciones);

    const refContent = ref(Hola[0]);

    export default {


        directives: {
            tippy: directive,
        },



        mounted() {
            console.log('Modo oscuro inicial:',isDark.value)
            if(isDark.value==false){
                this.icono='fa-solid fa-moon'
            }
            else{
                this.icono='fa-solid fa-sun'
            }

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

            async GuardarCambios(){
                try {
                    const response = await this.$inertia.post(route('Clases.store'), {
                        NuevasClasesLunes: this.NuevasClasesLunes,
                        idHorario:this.$page.props.idHorario
                    });

                    // Handle the response from the server as needed
                } catch (error) {
                    console.error(error);
                }
            }

        },

        data() {
            return {
                icono:'',
                notificaciones:['1 notificacion','2 notificacion','3 notificacion ']
            }
        },


    }

</script>


<style>

    .tippy-box[data-theme~='mediano'] {
        background-color: rgb(51 65 85);

        color: rgb(255, 250, 250);
        box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);
        border-radius: 6px;
        font-size: 15px;
        padding: 5px;
    }

</style>

