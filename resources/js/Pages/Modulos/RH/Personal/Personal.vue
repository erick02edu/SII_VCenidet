<template>
    <Head title="Personal" />
    <AuthenticatedLayout>
    <template #header>
            Lista del Personal
    </template>


    <h3 class="text-m text-gray-900 dark:text-white py-1 ml-1">
                Buscar por:

                <input type="radio" value="Nombre" name="Campos" v-model="campoBusqueda" required >Nombre
                <input type="radio" value="CURP" name="Campos" v-model="campoBusqueda" required> curp

        </h3>

        <div class="inline-flex w-full" >

            <div class="relative text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200">
                <input
                class=" border-gray-100 dark:border-gray-500 bg-white dark:bg-slate-700 dark:text-gray-200 h-10 px-4 pr-20 rounded-lg text-sm focus:outline-none"
                    type="text"
                    placeholder="Buscar..."
                    v-model="PersonalBuscar"
                    @input="HacerBusqueda()"
                />
            </div>

            <div class="justyfy-end flex w-full">
                <button :type="type" @click="VerificarUsuario()" class="ml-auto  rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7]"  :class="{'ml-auto rounded-md bg-slate-500 opacity-30 px-6 py-2.5 mb-4 text-center text-sm text-gray-500 hover:bg-gray-300 cursor-not-allowed' : !seleccionado}" :disabled="!seleccionado"
                v-if="$page.props.user.permissions.includes('Asignar cuentas de usuarios al personal')">
                    Asignar cuenta de usuario
                </button>

                <button :type="type" @click="VerificarPlaza()" class="ml-3  rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7]"  :class="{'ml-3 rounded-md bg-slate-500 opacity-30 px-6 py-2.5 mb-4 text-center text-sm text-gray-500 hover:bg-gray-300 cursor-not-allowed' : !seleccionado}" :disabled="!seleccionado"
                v-if="$page.props.user.permissions.includes('Asignar Plazas al personal')" >
                    Asignar Plaza
                </button>

                <button :type="type" @click="showElement" class=" ml-3 mr-2 rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7] "
                v-if="$page.props.user.permissions.includes('Agregar Personal')">
                    Nuevo
                </button>
            </div>

        </div>



    <!-- Capa oscura -->
    <div :class="{ hidden: !isVisible }" class="fixed inset-0 bg-black opacity-50">
    </div>

    <div id="modalContainer">

        <!-- Main modal -->
        <div :class="{ hidden: !isVisible }">
            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-screen overflow-auto">

                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Agregar Personal
                    </h3>
                    <button type="button" @click="hideElement" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">
            <form @submit.prevent="crearPersonal"  class="w-full ">
                    <div class="flex flex-wrap -mx-3 mb-6 overflow-auto">

                        <div class="w-full md:w-1/2 px-3">

                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                CURP
                            </label>
                            <input id="Capacidad"  maxlength="18" v-model="NuevoPersonal.CURP" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="XXXXXXXXXXXXXXXXXX">
                            <p v-if="MostrarmensajeCurp!=false" :class="{ 'text-sm text-green-500':exitoCURP, 'text-sm text-red-600':!exitoCURP }">{{ mensajeCurp }}</p>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">

                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                RFC
                            </label>
                            <input id="NombreAula" maxlength="13" v-model="NuevoPersonal.RFC"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="XXXXXXXXXXXXX">

                            <p v-if="MostrarmensajeRFC!=false" :class="{ 'text-sm text-green-500':exitoRFC, 'text-sm text-red-600':!exitoRFC }">{{  mensajeRFC }}</p>

                        </div>


                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Nombre
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Nombre" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="0">
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Apellido Paterno
                            </label>
                            <input id="NombreAula" v-model="NuevoPersonal.ApellidoP"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="">
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Apellido Materno
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.ApellidoM" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="">
                        </div>


                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Fecha de Nacimiento
                            </label>
                            <input id="NombreAula" v-model="NuevoPersonal.FechaNacimiento"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="date" placeholder="">
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Numero de tarjeta
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.numTarjeta" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="number" placeholder="0">
                        </div>


                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                 Direccion (*opcional)
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Direccion" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="">
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                 Telefono (*opcional)
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Telefono" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="tel" placeholder="">
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                 Correo Personal (*opcional)
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.CorreoPers" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="email" placeholder="">
                        </div>


                    </div>


                    <!-- Modal footer -->
                    <div class="flex items-center px-6 py-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar</button>
                        <button @click="hideElement" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        <button @click="validarCURP" v-if="NuevoPersonal.CURP.length==18"  type="button" class="text-white bg-[#487c9f] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Obtener Informacion</button>
                    </div>

                </form>

        </div>

            </div>
        </div>
        </div>
        </div>
</div>

        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-2 dark:border-slate-700 border-gray-300 bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            RFC
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Nombre
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            CURP
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Correo Personal
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Telefono
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200"
                        v-if="$page.props.user.permissions.includes('Editar información del personal') || $page.props.user.permissions.includes('Eliminar al personal')">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(persona,index) in personal" v-bind:id="`fila${persona.id}`" :class="{ 'border-[#0292c7f8] border-4 rounded-sm ': Activar[index] , 'text-gray-700 pt-2  hover:border-slate-400 hover:border-4 hover:rounded-sm': !Activar[index] }"  @click="asignarPlaza(persona,index)">
                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-sm ">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ persona.RFC }}</p>
                        </td>
                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ persona.Nombre }} {{ persona.ApellidoP }} {{ persona.ApellidoM }}</p>
                        </td>
                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ persona.CURP }}</p>
                        </td>
                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-5 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ persona.CorreoPers }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-sm">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ persona.Telefono }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-6 py-5 text-sm"
                        v-if="$page.props.user.permissions.includes('Editar información del personal') || $page.props.user.permissions.includes('Eliminar al personal')">


                            <Link :href="route('Personal.edit',persona.id)" class="p-3 rounded-md bg-[#014E82] mx-2 inline-flex mb-1"
                            v-if="$page.props.user.permissions.includes('Editar información del personal')">
                                <i class="fa-solid fa-pen text-white"></i>
                            </Link>

                            <a type="button" @click="showDelete(persona.id)" class="p-3 rounded-md bg-[#dc2626] mx-2 inline-flex mb-1"
                            v-if="$page.props.user.permissions.includes('Eliminar al personal')">
                                        <i class="fa-solid fa-trash text-white"></i>
                            </a>

                                    <div>
                                        <div :class="{ hidden: !isvisibleDelete }"  tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
                                            <div class="relative w-full max-w-md max-h-full">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <button @click="hideDelete" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                    <div class="p-6 text-center">
                                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                        </svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Esta seguro de eliminar a este personal: {{ idBorrarSeleccionado }} </h3>
                                                        <Link @click="hideDelete" method="delete" :href="route('Personal.destroy', idBorrarSeleccionado)" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Si, estoy seguro
                                                        </Link>
                                                        <button @click="hideDelete" data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        </td>

                    </tr>
                </tbody>

            </table>

        </div>


            <!-- Capa oscura -->
    <div :class="{ hidden: !isvisibleAsignacion }" class="fixed inset-0 bg-black opacity-50">
    </div>

    <div id="modalContainer">

        <!-- Main modal -->
        <div :class="{ hidden: !isvisibleAsignacion }">
            <div id="defaultModal" tabindex="-1" aria-hidden="true"  class="fixed inset-0 flex items-center justify-center z-50">
                <div class="relative w-full max-w-2xl max-h-full">

                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white" v-if="contenidoModal=='Plaza'">
                        Agregar Plaza a personal
                    </h3>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white" v-if="contenidoModal=='Usuario'">
                        Agregar cuenta a personal
                    </h3>
                    <button type="button" @click="hideAsignacion" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
        </div>
        <!-- Modal body -->
        <div class="p-6 space-y-6">

            <form @submit.prevent="AsignarPersonal(contenidoModal)"  class="w-full " >
                    <div class="flex-wrap -mx-3 mb-6 overflow-auto">

                        <label class="md:w-5/6 block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2 pl-4 " for="grid-last-name">
                                <p class="mb-2">Nombre del personal</p>
                                <input id="Capacidad" :value="`${personalSeleccionado.Nombre} ${personalSeleccionado.ApellidoP} ${personalSeleccionado.ApellidoM}`" readonly  class=" appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="0">
                                <input id="Capacidad" v-model="InfoAsignacion.idPersonal" readonly  class=" hidden appearance-none w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="0">
                        </label>

                        <label v-if="contenidoModal=='Plaza'" class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2 pl-4" for="grid-last-name">
                                Plazas disponibles
                        </label>

                        <label v-if="contenidoModal=='Usuario'" class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2 pl-4" for="grid-last-name">
                                Cuentas disponibles
                        </label>

                        <select v-if="contenidoModal=='Plaza'" class=" ml-4 md:w-5/6 appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="categorias" v-model="InfoAsignacion.idPlaza" required>

                        <option :value='0'> Seleccione una plaza </option>

                        <option
                            v-for="(plaza,index) in plazasDisponibles"
                            :key="plaza.id"
                            :value="plaza.id"
                        >
                            <span v-for="categoria in categorias">
                                <p v-if="categoria.id==plaza.idCategoria">{{ categoria.Clave }}-{{ categoria.Descripcion }}</p>
                            </span>
                            <!-- {{ plaza.idCategoria}} -->
                        </option>
                        </select>



                        <select v-if="contenidoModal=='Usuario'" class=" ml-4 md:w-5/6 appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" name="categorias" v-model="InfoAsignacion.idCuenta" required>

                        <option :value='0'> Seleccione una cuenta </option>

                        <option
                            v-for="(usuario,index) in usuarios"
                            :key="usuario.id"
                            :value="usuario.id"
                        >

                                <p>{{ usuario.email }}</p>

                            <!-- {{ plaza.idCategoria}} -->
                        </option>
            </select>





                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center px-6 py-2 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

                        <button type="submit" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Asignar</button>
                        <button @click="hideAsignacion" data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>

                    </div>

                </form>

        </div>

            </div>
        </div>
        </div>
        </div>


                    <!-- Capa oscura -->
        <div :class="{ hidden: !isvisiblePregunta }" class="fixed inset-0 bg-black opacity-50">
        </div>

        <div :class="{ hidden: !isvisiblePregunta}"  tabindex="-1" class="fixed inset-0 flex items-center justify-center z-50">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button @click="hidePregunta" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" v-if="contenidoModal=='Plaza'">
                            El personal {{ personalSeleccionado.Nombre }} {{ personalSeleccionado.ApellidoP }} {{ personalSeleccionado.ApellidoM}} ya tiene asignada la plaza:

                            <span v-for="plaza in plazas">
                                <span v-if="plaza.id==personalSeleccionado.idPlaza">

                                    <span v-for="categoria in categorias">
                                        <span v-if="plaza.idCategoria==categoria.id">
                                            {{ categoria.Clave }}-{{ categoria.Descripcion }}
                                        </span>
                                    </span>

                                </span>
                            </span>

                            <p>¿Que desea realizar?</p>
                        </h3>

                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" v-if="contenidoModal=='Usuario'">
                            El personal {{ personalSeleccionado.Nombre }} {{ personalSeleccionado.ApellidoP }} {{ personalSeleccionado.ApellidoM}} ya tiene asignada una cuenta:

                            <span v-for="usuario in usuarios">
                                <span v-if="usuario.id==personalSeleccionado.idUsuario">
                                    {{ usuario.email }}
                                </span>
                            </span>

                            <p>¿Que desea realizar?</p>
                        </h3>

                        <div @click="showAsignacion" type="button" class="text-white bg-[#014E82] hover:bg-[#0284c7] focus:ring-4 focus:outline-none focus:bg-[#0284c7] dark:focus:bg-[#0284c7] font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Asignar una nueva cuenta
                        </div>
                        <button @click="hidePregunta" data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar accion</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

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

    mounted() {
        this.hideDelete()
        this.hideAsignacion()
        this.seleccionado=false
        this.Activar=this.$page.props.filas
        this.Activar.push('false')

    },


    computed: {
        URL_API_CURP() {
        return "https://apimarket.mx/api/renapo/grupo/valida-curp?curp=" + this.NuevoPersonal.CURP;
        },
        URL_API_RFC() {
        return "https://apimarket.mx/api/sat/grupo/obtener-rfc?curp=" + this.NuevoPersonal.CURP;
        }
    },

    props:{
         personal:Array,
         plazas:Array,
         plazasDisponibles:Array,
         usuarios:Array,
         categorias:Array,
         filas:Array
    },

    data() {
    return {

       infoEditar: {
          NombreAula:'',
          Capacidad:0,
          Ubicacion:''
      },


      isVisible: false,
      isvisibleDelete:false,
      isvisibleAsignacion:true,
      isvisiblePregunta:false,

      idBorrarSeleccionado:0,

      PersonalBuscar:'',
      campoBusqueda:'CURP',

      NuevoPersonal:{
          RFC:'',
          Nombre:'',
          ApellidoP:'',
          ApellidoM:'',
          CURP:'',
          FechaNacimiento:'',
          numTarjeta:0,
          Direccion:'',
          Telefono:'',
          CorreoPers:'',
          Estatus:'',
          Estudio1:'',
          Estudio2:'',
          Estudio3:'',
          idPlaza:0,
          idUsuario:0,
      },

      InfoAsignacion:{
        idPersonal:'',
        idPlaza:'0',
        idCuenta:'0'
      },

      contenidoModal:'',

      Activar:[],

      mensajeCurp:'',
      mensajeRFC:'',

      exitoCURP:false,
      exitoRFC:false,

      MostrarmensajeCurp:false,
      MostrarmensajeRFC:false,

      personalSeleccionado:[],
      seleccionado:false,
    }
  },

  methods: {

    //METODO PARA REALIZAR SOLICITUD A API CURP
    validarCURP(){


        this.MostrarmensajeRFC=true
        this.MostrarmensajeCurp=true

        //URLS PARA LLAMADA A LA API
        const urlCURP=this.URL_API_CURP;
        const urlRFC=this.URL_API_RFC;

        // Opciones de la solicitud
        const requestOptions = {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer fd32ed13-ab6c-4918-8e52-1546288d5d6e',
                'Accept': 'application/json',
            },
        };

        // Realizar la solicitud para curp
        fetch(urlCURP, requestOptions)
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(response => {
            console.log('DATOS PERSONALES:',response); // Hacer algo con la respuesta JSON


            console.log('mensaje CURP:',response.message)

            if(response.message=='Exitoso'){
                this.exitoCURP=true
            }
            else{
                this.mensajeCurp=response.message
            }

            this.NuevoPersonal.Nombre=response.data.nombres
            this.NuevoPersonal.ApellidoP=response.data.apellidoPaterno
            this.NuevoPersonal.ApellidoM=response.data.apellidoMaterno

            const fechaDDMMAA=response.data.fechaNacimiento
            const FechaPorPartes = fechaDDMMAA.split('/');
            const dia = FechaPorPartes[0];
            const mes = FechaPorPartes[1];
            const año = FechaPorPartes[2];


            const fechaYYMMDD = `${año}-${mes}-${dia}`;

            this.NuevoPersonal.FechaNacimiento=fechaYYMMDD;


        })
        .catch(error => {
            console.error('Error en obtener datos personales:', error);
        });

        // Realizar la solicitud para RFC



        fetch(urlRFC, requestOptions)
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(response => {

            console.log('mensaje RFC:',response.message)
            this.mensajeRFC=response.message

            console.log('RFC:',response.data.rfc); // Hacer algo con la respuesta JSON
            this.NuevoPersonal.RFC=response.data.rfc

        })
        .catch(error => {
            console.error('Error en obtener RFC:', error);

        });


    },

    async crearPersonal(){
        await this.$inertia.post(route('Personal.store'),this.NuevoPersonal)
        this.hideElement()
    },


    HacerBusqueda(){

        console.log(this.PersonalBuscar);

        axios.get('Personal.buscar',{   params:{ personal:this.PersonalBuscar,campo:this.campoBusqueda}   })
        .then(response => {

            this.resultadosBusqueda=response.data;
            // console.log('RESULTADOS:');
            // console.log(this.$page.props.plazas);
            this.$page.props.personal=this.resultadosBusqueda;
        })
        .catch(error => {
            console.error('Error al hacer la busqueda:', error);
        });
    },


    showElement() {
      this.isVisible = true;
      this.MostrarmensajeCurp=true
      this.exitoCURP=true
    },


    hideElement() {
      this.isVisible = false;
      this.MostrarmensajeCurp=false;
      this.MostrarmensajeRFC=false;
    },

    showAsignacion() {
        this.isvisiblePregunta=false;
        console.log('Abrir asignacion');
        this.isvisibleAsignacion = true;
    },

    hideAsignacion() {
        console.log('cerrar asignacion');
        this.isvisibleAsignacion = false;
    },

    showDelete(id){
        this.idBorrarSeleccionado=id;
        this.isvisibleDelete = true;
    },
    hideDelete(){
        this.isvisibleDelete = false;
    },


    showPregunta(){
        this.isvisiblePregunta=true;
    },

    hidePregunta(){
        this.isvisiblePregunta=false;
    },

    asignarPlaza(persona,index){
        console.log('Asignar plaza para',persona);
        var cont=0;


        if(this.personalSeleccionado.id==persona.id){
            //si selecciona el mismo
            this.Activar.forEach(function(fila, indice, arreglo) {
                arreglo[indice] = false;
            });

            this.personalSeleccionado=[]
            this.seleccionado=false;
        }
        else{
            //Si no selecciono el mismo
            this.Activar.forEach(function(fila, indice, arreglo) {

                if(cont==index){
                    arreglo[indice] = true; //
                }
                else{
                    arreglo[indice] = false;
                }
                cont=cont+1

            });

            this.personalSeleccionado=persona
           this.seleccionado=true;
        }

    },

    VerificarPlaza(){

        this.contenidoModal='Plaza';
        console.log('contenido',this.contenidoModal)

        if(this.personalSeleccionado.idPlaza!=null){
            console.log('Plaza ya asignada')
            this.InfoAsignacion.idPersonal=this.personalSeleccionado.id
            this.showPregunta()
        }
        else{
            console.log('Plaza aun sin asignar')


            this.InfoAsignacion.idPersonal=this.personalSeleccionado.id
            this.showAsignacion()
        }
    },


    VerificarUsuario(){
        this.contenidoModal='Usuario';
        if(this.personalSeleccionado.idUsuario!=null){
            console.log('Este personal ya tiene un cuenta')
            this.InfoAsignacion.idPersonal=this.personalSeleccionado.id
            this.showPregunta()
        }
        else{
            console.log('Personal aun sin asignar cuenta')

            this.InfoAsignacion.idPersonal=this.personalSeleccionado.id
            this.showAsignacion()
        }
    },



    async AsignarPersonal(contenido){

        if(contenido=='Plaza'){
            await this.$inertia.post(route('Personal.asignarPlaza'),this.InfoAsignacion)
        }
        if(contenido=='Usuario'){
            await this.$inertia.post(route('Personal.asignarCuenta'),this.InfoAsignacion)
        }
        this.hideAsignacion()

    }




  }
};
</script>








