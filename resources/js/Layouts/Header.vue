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


            <button class="relative inline overflow-hidden dark:text-slate-100 pr-2 pl-3">
                <div class="hover:bg-gray-200 dark:hover:bg-slate-500 pr-1 pl-2 pt-1.5 pb-0.5 rounded-md">
                    <i class="fa-solid fa-bell absolute z-0  "></i>
                    <div class=" bg-red-600 rounded-full pr-1 pl-1 inline relative text-sm z-100 ml-2"> <span class="text-slate-200">1</span> </div>
                </div>
            </button>


            <button @click="toggleDark()" class="relative inline overflow-hidden dark:text-slate-100 pr-3 pl-3 ">

                <div @click="CambiarIcono" class="hover:bg-gray-200 dark:hover:bg-slate-500  pr-2 pl-2 pt-0.5 pb-0.5 rounded-md">
                    <i :class="icono"></i>
                </div>

            </button>


            <dropdown>


                <template #trigger>

                        <button @click="dropdownOpen = ! dropdownOpen" class="relative inline overflow-hidden dark:text-slate-100 pl-5  ">
                            {{ $page.props.auth.user.name }}
                        </button>

                </template>



                <template #content>
                    <dropdown-link :href="route('profile.show')">
                        Perfil
                    </dropdown-link>

                    <dropdown-link class="w-full text-left" :href="route('logout')" method="post" as="button">
                        Cerrar Sesion
                    </dropdown-link>
                </template>
            </dropdown>



        </div>
    </header>
</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

// import { useDark,useToggle} from '@vueuse/core'

//     const isDark=useDark()
    //const toggleDark=useToggle(isDark)


</script>



<script>


    import { useDark,useToggle} from '@vueuse/core'

    const isDark=useDark()
    const toggleDark=useToggle(isDark)

    export default {

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
            }
        },

        data() {
            return {
                icono:'',
            }
        },

    }




</script>
