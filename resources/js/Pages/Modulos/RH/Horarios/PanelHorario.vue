<template>

    <Head title="Panel" />

    <!-- Crear Horario-->
    <!-- {{ infoHorario }} -->
    <!-- ID: {{ id }} -->
    <!-- {{ materias }} <br>
    {{ aulas }} -->


    <!-- <Header v-if="Edicion" /> -->

    <header class="flex items-center justify-between border-b-2 border-[#014E82] dark:border-slate-500 w-screen    bg-white  dark:bg-slate-800 px-6 py-4" v-if="Edicion">
        <div class="flex items-center">

            <button @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu" class="text-gray-500 dark:text-white focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>


            <div class="dark:text-gray-200 justify-start pl-2">

                <span><button @click="GuardarCambios" class="px-4 py-2 rounded-md dark:text-gray-200 ml-2 mr-5 ">Volver</button></span>

            </div>

        </div>

        <div class="flex items-center">

            <div class="dark:text-gray-200 pr-2">
                <span> <i class="fa-solid fa-users pr-1"></i>
                    Rol: </span>
                    <span v-for="(rol,index) in Roles">
                        {{rol}}
                        <span v-if="Roles.length-1!=index">,</span>
                    </span>

                <span v-if="Roles.length==0">Sin rol</span>
            </div>

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




            <button @click="GuardarCambios" class="px-4 py-2 bg-[#014E82] rounded-md text-gray-200 ml- relative inline-flex ">Guardar cambios</button>


        </div>
    </header>



<div class="bg-gray-200 w-screen min-h-screen dark:bg-gray-800 overflow-x-auto overflow-y-auto">
    <main class="inset-0 h-auto w-screen bg-gray-200 dark:bg-gray-800 overflow-x-auto overflow-y-auto pb-10 " >

        <!-- {{ NuevasClasesLunes }} -->

        <!-- <button @click="GuardarCambios" class="px-4 py-2 bg-[#014E82] rounded-md dark:text-gray-200 ml-5 mt-4">Guardar cambios</button> -->

        <p class="flex font-roboto dark:text-gray-200 justify-center w-full items-center pt-5 ">Editar Horario</p>

        <div class="container mx-auto px-6 py-4 w-auto "  >

                <table class="w-full whitespace-no-wrap">
                    <thead class="bg-slate-700 text-gray-200 align-left" >
                        <td class="py-3 w-auto">
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
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesLunes" :key="index"  id="Lunes"  @click="showElement('Lunes',clase,index)" >

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

                            <tr class="dark:text-gray-200 hover:bg-slate-300 hover:cursor-pointer"  @click="Aumentar('Lunes')">
                                <div class="px-1 py-5 mt-2">
                                + Nueva clase
                                </div>
                            </tr>

                        </td>

                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesMartes" :key="index"  id="Martes"  @click="showElement('Martes',clase,index)" >

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

                            <tr class="dark:text-gray-200 hover:bg-slate-300 hover:cursor-pointer  "  @click="Aumentar('Martes')">
                                <div class="p-5 mt-2">
                                + Nueva clase
                                </div>
                            </tr>

                        </td>


                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesMiercoles" :key="index"  id="Miercoles"  @click="showElement('Miercoles',clase,index)" >
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

                            <tr class="dark:text-gray-200 hover:bg-slate-300 hover:cursor-pointer  "  @click="Aumentar('Miercoles')">
                                <div class="p-5 mt-2">
                                + Nueva clase
                                </div>
                            </tr>

                        </td>


                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesJueves" :key="index"  id="Jueves"  @click="showElement('Jueves',clase,index)" >

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

                            <tr class="dark:text-gray-200 hover:bg-slate-300 hover:cursor-pointer  "  @click="Aumentar('Jueves')">
                                <div class="p-5 mt-2">
                                + Nueva clase
                                </div>
                            </tr>

                        </td>


                        <td>
                            <tr class="dark:text-gray-200P"  v-for="(clase,index) in NuevasClasesViernes" :key="index"  id="Viernes"  @click="showElement('Viernes',clase,index)" >

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

                            <tr class="dark:text-gray-200 hover:bg-slate-300 hover:cursor-pointer  "  @click="Aumentar('Viernes')">
                                <div class="p-5 mt-2">
                                + Nueva clase
                                </div>
                            </tr>

                        </td>



                    </tbody>

                </table>

        </div>




                                            <!--MODAL PARA UNA NUEVA CLASE-->
                                            <div id="modalContainer">
                                                <!-- Main modal -->
                                                <div :class="{ hidden: !isVisible } " >

                                                    <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                                                        <div class="relative w-full max-w-2xl max-h-full">

                                                            <!-- Modal content -->
                                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">

                                                                <!-- Modal header -->
                                                                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                        Editar Clase
                                                                    </h3>
                                                                    <button type="button" @click="hideElement()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                        </svg>
                                                                        <span class="sr-only">Close modal</span>
                                                                    </button>

                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="p-6 space-y-6">
                                                                    <form @submit.prevent=""  class="w-full max-w-lg">
                                                                        <div class="flex flex-wrap -mx-3 mb-6">

                                                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                                                    <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-first-name">
                                                                                        Hora Inicio
                                                                                    </label>
                                                                                    <input id="Nombre" v-model="claseEditar.HInicio"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="time" placeholder="" required>
                                                                                </div>


                                                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                                                    <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-first-name">
                                                                                        Hora fin
                                                                                    </label>
                                                                                    <input id="Nombre" v-model="claseEditar.HFin"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="time" placeholder="" required>
                                                                                </div>




                                                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 pt-3 pb-3">
                                                                                    <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-1" for="grid-first-name" select>
                                                                                        Selecciona el una aula para la clase
                                                                                    </label>

                                                                                    <select name="periodos" v-model="claseEditar.idAula" class="dark:bg-slate-700 dark:text-slate-200 rounded-sm ">
                                                                                        <option
                                                                                            v-for="aula in aulas"
                                                                                            :key="aula.id"
                                                                                            :value="aula.id"
                                                                                        >
                                                                                            {{ aula.NombreAula }}

                                                                                        </option>
                                                                                    </select>


                                                                                </div>



                                                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 pt-3 pb-3">
                                                                                    <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-1" for="grid-first-name" select>
                                                                                        Selecciona un grupo
                                                                                    </label>

                                                                                    <select name="periodos" v-model="claseEditar.idGrupo" class="dark:bg-slate-700 dark:text-slate-200 rounded-sm ">
                                                                                        <option
                                                                                            v-for="grupo in grupos"
                                                                                            :key="grupo.id"
                                                                                            :value="grupo.id"
                                                                                        >
                                                                                            {{ grupo.Semestre }}-{{grupo.Letra }} {{ grupo.Especialidad }}

                                                                                        </option>
                                                                                    </select>
                                                                                </div>


                                                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 pt-3 pb-3">
                                                                                    <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-1" for="grid-first-name" select>
                                                                                        Selecciona el una materia para la clase
                                                                                    </label>

                                                                                    <select name="periodos" v-model="claseEditar.idMateria" class="dark:bg-slate-700 dark:text-slate-200 rounded-sm ">
                                                                                        <option
                                                                                            v-for="materia in materias"
                                                                                            :key="materia.id"
                                                                                            :value="materia.id"
                                                                                        >
                                                                                            {{ materia.Nombre }}

                                                                                        </option>
                                                                                    </select>
                                                                                </div>


                                                                                <div class="w-full md:w-1/2 px-3 mb-6 mt-3 md:mb-0">
                                                                                    <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-first-name">
                                                                                        Selecciona un color
                                                                                    </label>
                                                                                    <input @onchange="CambiarColor" id="Nombre" v-model="claseEditar.color" type="color" placeholder="" class="rounded-lg m-0" required>
                                                                                </div>


                                                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                                                    <input id="Nombre" v-model="claseEditar.dia" readonly  class="appearance-none w-full hidden bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" required>
                                                                                </div>


                                                                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                                                                    <input id="Nombre" v-model="claseEditar.idHorario" readonly  class="appearance-none w-full hidden bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" required>
                                                                                </div>

                                                                            <!-- Modal footer -->
                                                                            <div class="flex items-center mt-5 p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-slate-500 ">
                                                                                <button @click="hideElement()"  class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                                                                                <button @click="EliminarClase(claseEditar)" data-modal-hide="defaultModal" type="button" class="text-gray-200 bg-red-600  hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 focus:z-10  dark:border-gray-500  ">Eliminar esta clase</button>
                                                                                </div>
                                                                            </div>

                                                                             <!-- {{ NuevasClasesLunes }} -->

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

    </main>
</div>

    <!-- Capa oscura -->
    <div :class="{ hidden: !isVisible }" class="fixed inset-0  bg-black opacity-50">
    </div>


</template>

<script setup>
    import { Head } from '@inertiajs/vue3';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    //import Header from '@/Layouts/HeaderPanel.vue';
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

            Roles:this.$page.props.user.roles,

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

        showElement(dia,clase,index) {


            if(dia=='Lunes'){
                this.claseEditar=this.NuevasClasesLunes[index]
            }

            if(dia=='Martes'){
                this.claseEditar=this.NuevasClasesMartes[index]
            }

            if(dia=='Miercoles'){
                this.claseEditar=this.NuevasClasesMiercoles[index]
            }

            if(dia=='Jueves'){
                this.claseEditar=this.NuevasClasesJueves[index]
            }

            if(dia=='Viernes'){
                this.claseEditar=this.NuevasClasesViernes[index]
            }

            this.isVisible = true;
            this.NuevaClase.dia=dia;
            this.NuevaClase.color='#'+clase.hex
        },

        hideElement() {
            this.isVisible=false
        },

        Aumentar(dia){

            const nuevoElemento = {
                HInicio: '11:00',
                HFin: '12:00',
                dia: dia,
                color: '#AE1f20',
                idMateria: 0,
                idAula: 0,
                idGrupo:0,
                idHorario:this.$page.props.idHorario
            };

            if(dia=='Lunes'){
                this.NuevasClasesLunes.push(nuevoElemento)
                const indice = this.NuevasClasesLunes.indexOf(nuevoElemento);
                this.showElement(nuevoElemento.dia,nuevoElemento,indice)
            }

            if(dia=='Martes'){
                this.NuevasClasesMartes.push(nuevoElemento)
                const indice = this.NuevasClasesMartes.indexOf(nuevoElemento);
                this.showElement(nuevoElemento.dia,nuevoElemento,indice)
            }

            if(dia=='Miercoles'){
                this.NuevasClasesMiercoles.push(nuevoElemento)
                const indice = this.NuevasClasesMiercoles.indexOf(nuevoElemento);
                this.showElement(nuevoElemento.dia,nuevoElemento,indice)
            }

            if(dia=='Jueves'){
                this.NuevasClasesJueves.push(nuevoElemento)
                const indice = this.NuevasClasesJueves.indexOf(nuevoElemento);
                this.showElement(nuevoElemento.dia,nuevoElemento,indice)
            }

            if(dia=='Viernes'){
                this.NuevasClasesViernes.push(nuevoElemento)
                const indice = this.NuevasClasesViernes.indexOf(nuevoElemento);
                this.showElement(nuevoElemento.dia,nuevoElemento,indice)
            }


        },

        async GuardarCambios(){

            try {
                const response = await this.$inertia.post(route('Clases.store'), {
                    NuevasClasesLunes: this.NuevasClasesLunes,
                    NuevasClasesMartes: this.NuevasClasesMartes,
                    NuevasClasesMiercoles: this.NuevasClasesMiercoles,
                    NuevasClasesJueves: this.NuevasClasesJueves,
                    NuevasClasesViernes: this.NuevasClasesViernes,
                    idHorario:this.$page.props.idHorario
                });

                // Handle the response from the server as needed
            } catch (error) {
                console.error(error);
            }

        },

        CambiarIcono(){
                if(isDark.value==true){
                    this.icono='fa-solid fa-moon'
                }
                else{
                    this.icono='fa-solid fa-sun'
                }
        },

        EliminarClase(clase){

            if(clase.dia=='Lunes'){
                const indice = this.NuevasClasesLunes.indexOf(clase);//Hallar el indice de la clase dentro del array

                 // Utilizar splice para eliminar el registro
                this.NuevasClasesLunes.splice(indice, 1);
                this.hideElement()
            }

            if(clase.dia=='Martes'){
                const indice = this.NuevasClasesMartes.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesMartes.splice(indice, 1);
                this.hideElement()
            }

            if(clase.dia=='Miercoles'){
                const indice = this.NuevasClasesMiercoles.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesMiercoles.splice(indice, 1);
                this.hideElement()
            }

            if(clase.dia=='Jueves'){
                const indice = this.NuevasClasesJueves.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesJueves.splice(indice, 1);
                this.hideElement()
            }


            if(clase.dia=='Viernes'){
                const indice = this.NuevasClasesViernes.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesViernes.splice(indice, 1);
                this.hideElement()
            }

        }
    },
}
</script>




