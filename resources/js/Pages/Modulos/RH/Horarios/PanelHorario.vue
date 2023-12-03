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

        <p class="flex font-roboto dark:text-gray-200 items-center pt-5 ml-32 ">
            <div class="w-1/2">
            EDITAR HORARIO<br>
            </div>
            Docente:{{ ProfesorHorario.Nombre }} {{ ProfesorHorario.ApellidoP }} {{ ProfesorHorario.ApellidoM }}<br>
            Periodo del horario:{{ PeriodoHorario.mesInicio }} {{ PeriodoHorario.AñoInicio }}
            -{{ PeriodoHorario.mesTermino }} {{ PeriodoHorario.AñoTermino }}<br>


        </p>

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
                            <tr class="text-gray-200" :class="{ 'animate-pulse':clase.bordeError!=null  }"  v-for="(clase,index) in NuevasClasesLunes" :key="index"  id="Lunes"
                            @click="showElement('Lunes',clase,index)" >

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
                            <tr class="text-gray-200" :class="{ 'animate-pulse':clase.bordeError!=null  }"   v-for="(clase,index) in NuevasClasesMartes" :key="index"  id="Martes"  @click="showElement('Martes',clase,index)" >

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
                            <tr class="text-gray-200" :class="{ 'animate-pulse':clase.bordeError!=null  }"   v-for="(clase,index) in NuevasClasesMiercoles" :key="index"  id="Miercoles"  @click="showElement('Miercoles',clase,index)" >
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
                            <tr class="text-gray-200" :class="{ 'animate-pulse':clase.bordeError!=null  }"   v-for="(clase,index) in NuevasClasesJueves" :key="index"  id="Jueves"  @click="showElement('Jueves',clase,index)" >

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
                            <tr class="text-gray-200" :class="{ 'animate-pulse':clase.bordeError!=null  }"  v-for="(clase,index) in NuevasClasesViernes" :key="index"  id="Viernes"  @click="showElement('Viernes',clase,index)" >

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
                                                <div v-if="msjHoraInvalidas==true"
                                                    class="text-red-400 text-xs ">
                                                    {{ msjInvalido }}
                                                </div>
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
                                                <p v-if="mensajeAula==true" class="text-sm text-red-600 ">Por favor elige un aula</p>
                                                <select name="periodos" v-model="claseEditar.idAula" class="dark:bg-slate-700 dark:text-slate-200 rounded-sm ">

                                                    <option value="0">
                                                        Seleccione un aula
                                                    </option>

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
                                                    Selecciona el una materia para la clase
                                                </label>
                                                <p v-if="mensajeMateria==true" class="text-sm text-red-600 ">Por favor elige una materia</p>
                                                <select name="periodos" v-model="claseEditar.idMateria" class="dark:bg-slate-700
                                                    dark:text-slate-200 rounded-sm w-full ">

                                                    <option value="0">
                                                        Seleccione una materia
                                                    </option>

                                                    <option
                                                        v-for="materia in materias"
                                                        :key="materia.id"
                                                        :value="materia.id"
                                                    >
                                                        {{ materia.Nombre }}

                                                    </option>
                                                </select>
                                            </div>

                                            <div class="w-full md:w-full px-3 mb-6 md:mb-0 pt-3 pb-3 ">
                                                <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-1" for="grid-first-name" select>
                                                    Selecciona un grupo
                                                </label>
                                                <p v-if="mensajeGrupo==true" class="text-sm text-red-600 ">Por favor elige un grupo</p>
                                                <select name="periodos" v-model="claseEditar.idGrupo" class="dark:bg-slate-700 dark:text-slate-200 rounded-sm ">
                                                    <option value="0">
                                                        Seleccione un grupo
                                                    </option>

                                                    <option
                                                        v-for="grupo in grupos"
                                                        :key="grupo.id"
                                                        :value="grupo.id"
                                                    >
                                                        {{ grupo.Semestre }}-{{grupo.Letra }} {{ grupo.Especialidad }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="w-full md:w-1/3 px-3 mb-6 mt-3 md:mb-0">
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
                                            <button @click="ComprobarClase(claseEditar.dia)"  class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
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
        periodos:Array,
        idHorario:'',
        ClasesLunes:Array,
        ClasesMartes:Array,
        ClasesMiercoles:Array,
        ClasesJueves:Array,
        ClasesViernes:Array,
        PeriodoHorario:Array,
        ProfesorHorario:Array,
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
            msjInvalido:'',

            mensajeAula:false,
            mensajeMateria:false,
            mensajeGrupo:false,
            msjHoraInvalidas:false,
        }

    },


    computed: {
        fondo() {
            // Concatena la clase de fondo con el valor de NuevaClase.color
            return `background-color: ${this.ListaLunes[0].hex};`;
        },
    },


    methods:{

        ComprobarCampos(){
            var camposValidos=true;

            if(this.claseEditar.idAula==0){
                this.mensajeAula=true;
                camposValidos=false;
            }
            else{
                this.mensajeAula=false;
            }

            if(this.claseEditar.idMateria==0){
                this.mensajeMateria=true;
                camposValidos=false;
            }
            else{
                this.mensajeMateria=false;
            }

            if(this.claseEditar.idGrupo==0){
                this.mensajeGrupo=true;
                camposValidos=false;
            }
            else{
                this.mensajeGrupo=false;
            }

            return camposValidos;

        },


        validarHorasMayor(hora1, hora2) {
            // Divide las horas y minutos en cada cadena
            const [h1, m1] = hora1.split(':').map(Number);
            const [h2, m2] = hora2.split(':').map(Number);

            // Crea objetos Date para las dos horas, estableciendo la fecha en 1970-01-01
            const date1 = new Date(1970, 0, 1, h1, m1);
            const date2 = new Date(1970, 0, 1, h2, m2);

            // Compara las fechas para determinar cuál es mayor
            if (date1 > date2) {
                //this.msjHoraInvalidas=true
                return false; //Es mayor la hora Inicio
            } else {
                //this.msjHoraInvalidas=false
                return true; //Es menor la hora inicio
            }
        },



        posicionaClaseEntreHoras(dia){
            if(dia=='Lunes'){
                var NuevasClasesDia=this.NuevasClasesLunes
            }

            if(dia=='Martes'){
                var NuevasClasesDia=this.NuevasClasesMartes
            }

            if(dia=='Miercoles'){
                var NuevasClasesDia=this.NuevasClasesMiercoles
            }

            if(dia=='Jueves'){
                var NuevasClasesDia=this.NuevasClasesJueves
            }

            if(dia=='Viernes'){
                var NuevasClasesDia=this.NuevasClasesViernes
            }
                //Ejeemplo
                //8:00 a 9:00 <-Comprobar
                //11:00 a 12:00 <- Dia lunes


                //Obtener el ultimo elemento del arreglo que sera la clase que verificaremos ingresada
                const claseComprobar=this.claseEditar;
                console.log('Clase a comprobar:',claseComprobar);


                //Recorrer la lista de clases para determinar su posicion
                for (let i = 0; i < NuevasClasesDia.length; i++) {

                    const claseActual = NuevasClasesDia[i];

                    const indiceClaseComparar=NuevasClasesDia.indexOf(claseComprobar);


                    // if(i!=indiceClaseComparar){

                        console.log('Horas a comparar:',claseComprobar.HInicio," y ",claseActual.HInicio)
                                                                //   8::00   ,    11:00
                        var resultado=this.validarHorasMayor(claseComprobar.HInicio,claseActual.HInicio)
                        console.log('Resultado de la comparacion:',resultado)

                        //La horaInicio de comparar fue menor a continuacion se comparar con la hora siguiente de la horaComprobar
                        //comprobar que la hora final no sea mayor a la hora inicio de la siguiente clase
                        //Por ejemplo comparar que las
                        //HFinal de comprobar       9::00     no sea mayor a la hora inicio de la siguiente clase
                        //HInicio siguiente clase   11:00
                        if(resultado==true){//La horaInicio de clase a comparar fue menor




                            console.log('Horas a comparar 2:',claseComprobar.HFin," y ",claseActual.HInicio)
                                                        // 9:00          ,    11:00
                            resultado=this.validarHorasMayor(claseComprobar.HFin,claseActual.HInicio)
                            console.log('Resultado de la comparacion 2:',resultado)
                            if(resultado==true){
                                //mover la clase comprobar antes de la clase actual

                                //Obtener el indice de la clase que estamos comprobando
                                const indiceEliminar = NuevasClasesDia.indexOf(claseComprobar);

                                NuevasClasesDia.splice(indiceEliminar, 1);
                                // i es la posicion en la que va a quedar la claseComprobar
                                NuevasClasesDia.splice(i,0,claseComprobar);

                                this.msjHoraInvalidas=false;
                                this.msjInvalido='';

                            }
                            else{

                                // this.msjHoraInvalidas=true;
                                // this.msjInvalido='La hora final ingresada se empalma con la hora de inicio de la siguiente clase: '+ claseActual.HInicio+ '. Por favor revisa la hora fin'

                                // console.log('La hora final ingresada ',claseComprobar.HFin ,'se empalma con la hora de inicio de la siguiente clase',claseActual.HInicio)

                                if(i!=indiceClaseComparar){


                                    //PENDIENTE--------------------------------------------------------------
                                    const indiceEliminar = NuevasClasesDia.indexOf(claseComprobar);
                                    NuevasClasesDia.splice(indiceEliminar, 1);
                                    NuevasClasesDia.splice(i,0,claseComprobar);
                                    //------------------------------------------------------------------------
                                    this.msjHoraInvalidas=true;
                                    this.msjInvalido='Hay horas que se estan empalmando por favor revisar las horas ingresadas';
                                    //this.msjInvalido='La hora final ingresada se empalma con la hora de inicio de la siguiente clase: '+ claseActual.HInicio+ '. Por favor revisa la hora fin'
                                    console.log('La hora final ingresada ',claseComprobar.HFin ,'se empalma con la hora de inicio de la siguiente clase',claseActual.HInicio)

                                    return false;
                                }
                                else{



                                    return true;
                                }

                            }
                            //En este caso el indice es i
                            //return true;
                            break;


                        // }

                    }
                }

                if(dia=='Lunes'){
                    this.NuevasClasesLunes=NuevasClasesDia;
                }
                if(dia=='Martes'){
                    this.NuevasClasesMartes=NuevasClasesDia;
                }
                if(dia=='Miercoles'){
                    this.NuevasClasesMiercoles=NuevasClasesDia;
                }
                if(dia=='Jueves'){
                    this.NuevasClasesJueves=NuevasClasesDia;
                }
                if(dia=='Viernes'){
                    this.NuevasClasesViernes=NuevasClasesDia;
                }
        },

        moverClasesHaciaAdelante(dia){

            console.log('----------HACIA ADELANTE COMPROBACION------------')

            if(dia=='Lunes'){
                var NuevasClasesDia=this.NuevasClasesLunes
            }

            if(dia=='Martes'){
                var NuevasClasesDia=this.NuevasClasesMartes
            }

            if(dia=='Miercoles'){
                var NuevasClasesDia=this.NuevasClasesMiercoles
            }

            if(dia=='Jueves'){
                var NuevasClasesDia=this.NuevasClasesJueves
            }

            if(dia=='Viernes'){
                var NuevasClasesDia=this.NuevasClasesViernes
            }


                //Obtener el ultimo elemento del arreglo que sera la clase que verificaremos ingresada
                const claseComprobar=this.claseEditar;
                console.log('Clase a comprobar:',claseComprobar);


                //Recorrer la lista de clases para determinar su posicion
                for (let i = 0; i < NuevasClasesDia.length; i++) {


                    const claseActual = NuevasClasesDia[i];

                    const indiceClaseComparar=NuevasClasesDia.indexOf(claseComprobar);

                    if(i!=indiceClaseComparar){
                                                            //8:00                   10:00
                        console.log('Horas a comparar:',claseComprobar.HInicio," y ",claseActual.HInicio)

                        var resultado=this.validarHorasMayor(claseComprobar.HInicio,claseActual.HInicio)
                        console.log('Resultado de la comparacion:',resultado)



                        var moverUltimo=false;

                        if(resultado==false){

                            //moverla delante de la clase actual y comprobar que no se empalmen con la siguiente en su hora final
                            if(NuevasClasesDia.length>=i+1){
                                console.log('Va al ultimo');
                                var moverUltimo=true;
                                var resultado=true; //ya no necesitas comprobar que la siguiente clase es menor ya que no hay siguiente clase
                            }
                            else{
                                var siguienteClase=NuevasClasesDia[i+1];
                                //si la siguiente clase es mayor
                                var resultado=this.validarHorasMayor(claseComprobar.HInicio,SiguienteClase.HInicio)
                            }


                            if(resultado==true){//Ver si el siguiente es menor lo cual indicaria que ese es el espacio que le corresponde

                                if(moverUltimo!=true){
                                    console.log('Siguiente clase',siguienteClase);
                                                                       //12:00             y       13:00
                                    console.log('Horas a comparar 2:',claseComprobar.HFin," y ",siguienteClase.HInicio)

                                    resultado=this.validarHorasMayor(claseComprobar.HFin,siguienteClase.HInicio)
                                    console.log('Resultado de la comparacion 2:',resultado)
                                }
                                //Comprobar que no se empalme
                                if(resultado==true){
                                    //Obtener el indice de la clase que estamos comprobando
                                    const indiceEliminar = NuevasClasesDia.indexOf(claseComprobar);

                                    NuevasClasesDia.splice(indiceEliminar, 1);

                                    NuevasClasesDia.splice(i, 0, claseComprobar);

                                    this.msjHoraInvalidas=false;
                                    this.msjInvalido='';
                                }
                                else{
                                    this.msjHoraInvalidas=true;
                                    this.msjInvalido='Hay horas que se estan empalmando por favor revisar las horas ingresadas';
                                    //this.msjInvalido='La hora final ingresada se empalma con la hora de inicio de la siguiente clase: '+ siguienteClase.HInicio+ '. Por favor revisa la hora fin'
                                    console.log('La hora final ingresada ',claseComprobar.HFin ,'se empalma con la hora de inicio de la siguiente clase',siguienteClase.HInicio)

                                    return false;
                                }
                            }

                        }
                    }
                }

                if(dia=='Lunes'){
                    this.NuevasClasesLunes=NuevasClasesDia;
                }
                if(dia=='Martes'){
                    this.NuevasClasesMartes=NuevasClasesDia;
                }
                if(dia=='Miercoles'){
                    this.NuevasClasesMiercoles=NuevasClasesDia;
                }
                if(dia=='Jueves'){
                    this.NuevasClasesJueves=NuevasClasesDia;
                }
                if(dia=='Viernes'){
                    this.NuevasClasesViernes=NuevasClasesDia;
                }

        },

        ComprobarEmpalmes(){

            var Empalmes=false//Esta variabkle determina si hubo al menos un empalme
            var DiasRecorrer=[];
            for(let i = 0; i < 5 ; i ++){
                if(i==0){
                    DiasRecorrer=this.NuevasClasesLunes
                    var dia='Lunes'

                }
                if(i==1){
                    DiasRecorrer=this.NuevasClasesMartes
                    var dia='Martes'

                }
                if(i==2){
                    DiasRecorrer=this.NuevasClasesMiercoles
                    var dia='Miercoles'

                }
                if(i==3){
                    DiasRecorrer=this.NuevasClasesJueves
                    var dia='Jueves'

                }
                if(i==4){
                    DiasRecorrer=this.NuevasClasesViernes
                    var dia='Viernes'

                }
                // console.log(dia)
                // console.log('Longitud dia:',DiasRecorrer.length)
                //Recorrer dia
                for (let j = 0; j < DiasRecorrer.length; j++) {

                    var indiceSiguiente=j+1
                    // console.log(indiceSiguiente);
                    if(DiasRecorrer.length>indiceSiguiente){

                        var claseActual=DiasRecorrer[j];
                        var claseSiguiente=DiasRecorrer[j+1];


                        var resultado=this.validarHorasMayor(claseActual.HFin,claseSiguiente.HInicio)
                        // console.log('Resultado de la comparacion empalme',resultado)
                        if(resultado==false){


                            const indiceEmpalme1 = DiasRecorrer.indexOf(claseActual);
                            const indiceEmpalme2 = DiasRecorrer.indexOf(claseSiguiente);

                            console.log('Hay un empalme entre la clase:'+indiceEmpalme1+' y la clase:'+indiceEmpalme2+' del dia '+dia)
                            if(dia=='Lunes'){
                                console.log('ActivarErroEmpalme');
                                this.NuevasClasesLunes[indiceEmpalme1].bordeError=true;
                                this.NuevasClasesLunes[indiceEmpalme2].bordeError=true;
                                console.log('ActivarErroEmpalme2');
                            }

                            if(dia=='Martes'){
                                console.log('ActivarErroEmpalme');
                                this.NuevasClasesMartes[indiceEmpalme1].bordeError=true;
                                this.NuevasClasesMartes[indiceEmpalme2].bordeError=true;
                                console.log('ActivarErroEmpalme2');
                            }

                            if(dia=='Miercoles'){
                                console.log('ActivarErroEmpalme');
                                this.NuevasClasesMiercoles[indiceEmpalme1].bordeError=true;
                                this.NuevasClasesMiercoles[indiceEmpalme2].bordeError=true;
                                console.log('ActivarErroEmpalme2');
                            }

                            if(dia=='Jueves'){
                                console.log('ActivarErroEmpalme');
                                this.NuevasClasesJueves[indiceEmpalme1].bordeError=true;
                                this.NuevasClasesJueves[indiceEmpalme2].bordeError=true;
                                console.log('ActivarErroEmpalme2');
                            }

                            if(dia=='Viernes'){
                                console.log('ActivarErroEmpalme');
                                this.NuevasClasesViernes[indiceEmpalme1].bordeError=true;
                                this.NuevasClasesViernes[indiceEmpalme2].bordeError=true;
                                console.log('ActivarErroEmpalme2');
                            }

                            Empalmes=true;

                        }else{

                            const indiceClaseActual = DiasRecorrer.indexOf(claseActual);
                            const indiceClaseSiguiente = DiasRecorrer.indexOf(claseSiguiente);
                            if(dia=='Lunes'){
                                this.NuevasClasesLunes[indiceClaseActual].bordeError=null;
                                this.NuevasClasesLunes[indiceClaseSiguiente].bordeError=null;
                            }

                            if(dia=='Martes'){
                                this.NuevasClasesMartes[indiceClaseActual].bordeError=null;
                                this.NuevasClasesMartes[indiceClaseSiguiente].bordeError=null;
                            }

                            if(dia=='Miercoles'){
                                this.NuevasClasesMiercoles[indiceClaseActual].bordeError=null;
                                this.NuevasClasesMiercoles[indiceClaseSiguiente].bordeError=null;
                            }

                            if(dia=='Jueves'){
                                this.NuevasClasesJueves[indiceClaseActual].bordeError=null;
                                this.NuevasClasesJueves[indiceClaseSiguiente].bordeError=null;
                            }

                            if(dia=='Viernes'){
                                this.NuevasClasesViernes[indiceClaseActual].bordeError=null;
                                this.NuevasClasesViernes[indiceClaseSiguiente].bordeError=null;
                            }


                        }

                    }
                    else{
                        // console.log('ultimo dia no se comprueba')
                    }

                }
            }


            return Empalmes;
        },




        ComprobarClase(dia){

            const camposValidos=this.ComprobarCampos();
            const FechaInicioMayor=this.validarHorasMayor(this.claseEditar.HInicio,this.claseEditar.HFin)

            const FechasIguales=this.HorasIguales(this.claseEditar.HInicio,this.claseEditar.HFin)

            if(camposValidos==true){
                if(FechaInicioMayor==true){

                    if(FechasIguales==false){
                        console.log('FECHAS IGUALES:',FechasIguales)

                        var resultado1=this.posicionaClaseEntreHoras(dia);
                        var resultado2=this.moverClasesHaciaAdelante(dia);

                        console.log('RES1:',resultado1,'RES2',resultado2);
                        if(resultado1==false || resultado2==false){
                            this.ComprobarEmpalmes();
                        }else{
                            this.ComprobarEmpalmes();
                            this.hideElement();
                        }

                    }
                    else{
                        this.msjHoraInvalidas=true;
                        this.msjInvalido='La fechas de inicio y fin deben ser diferentes';
                    }
                }
                else{
                    this.msjHoraInvalidas=true;
                    this.msjInvalido='La fecha de inicio debe ser menor a la fecha de fin';
                }
            }


        },

        HorasIguales(hora1, hora2) {
            // Convertir las cadenas a objetos de fecha para facilitar la comparación
            var fecha1 = new Date("1970-01-01T" + hora1 + ":00");
            var fecha2 = new Date("1970-01-01T" + hora2 + ":00");

            // Comparar las horas
            return fecha1.getTime() === fecha2.getTime();
        },

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

            const camposValidos=this.ComprobarCampos();
            const FechaInicioMayor=this.validarHorasMayor(this.claseEditar.HInicio,this.claseEditar.HFin)
            const FechasIguales=this.HorasIguales(this.claseEditar.HInicio,this.claseEditar.HFin)


            if(camposValidos==true){
                if(FechaInicioMayor==true){

                    if(FechasIguales==false){

                        this.isVisible=false

                    }
                    else{
                        this.msjHoraInvalidas=true;
                        this.msjInvalido='La fechas de inicio y fin deben ser diferentes';
                    }
                }
                else{
                    this.msjHoraInvalidas=true;
                    this.msjInvalido='La fecha de inicio debe ser menor a la fecha de fin';
                }
            }



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
                idHorario:this.$page.props.idHorario,
                bordeError:null
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

                if(this.ComprobarEmpalmes()==false){

                    const response = await this.$inertia.post(route('Clases.store'), {
                        NuevasClasesLunes: this.NuevasClasesLunes,
                        NuevasClasesMartes: this.NuevasClasesMartes,
                        NuevasClasesMiercoles: this.NuevasClasesMiercoles,
                        NuevasClasesJueves: this.NuevasClasesJueves,
                        NuevasClasesViernes: this.NuevasClasesViernes,
                        idHorario:this.$page.props.idHorario
                    });
                }

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
                this.isVisible=false
            }

            if(clase.dia=='Martes'){
                const indice = this.NuevasClasesMartes.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesMartes.splice(indice, 1);
                this.isVisible=false
            }

            if(clase.dia=='Miercoles'){
                const indice = this.NuevasClasesMiercoles.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesMiercoles.splice(indice, 1);
                this.isVisible=false
            }

            if(clase.dia=='Jueves'){
                const indice = this.NuevasClasesJueves.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesJueves.splice(indice, 1);
                this.isVisible=false
            }


            if(clase.dia=='Viernes'){
                const indice = this.NuevasClasesViernes.indexOf(clase);//Hallar el indice de la clase dentro del array
                 // Utilizar splice para eliminar el registro
                this.NuevasClasesViernes.splice(indice, 1);
                this.isVisible=false
            }

        }
    },
}
</script>




