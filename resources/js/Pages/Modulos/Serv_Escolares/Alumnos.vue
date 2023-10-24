<template>
    <Head title="Personal" />
    <AuthenticatedLayout>
    <template #header>
            Lista del Personal
    </template>


        <h3 class="text-m text-gray-900 dark:text-white py-1 ml-1">
                Filtrar por estatus:

                <input type="radio" class="form-radio text-[#0284c7] bg-white shadow-lg border-[#014E82]" value="Todos" name="Campos" v-model="FiltroBusqueda" required >Todos
                <input type="radio" class="form-radio text-[#0284c7] bg-white shadow-lg border-[#014E82]" value="Activos" name="Campos" v-model="FiltroBusqueda" required >Activos
                <input type="radio" class="form-radio text-[#0284c7] bg-white shadow-lg border-[#014E82]" value="Bajas" name="Campos" v-model="FiltroBusqueda" required> Bajas

        </h3>

        <div class="inline-flex w-full" >

            <div class="relative text-gray-700 focus-within:text-gray-700  dark:focus-within:text-slate-200">
                <input
                class=" border-gray-100 dark:border-gray-500 bg-white dark:bg-slate-700 dark:text-gray-200 h-10 px-4 pr-20 rounded-lg text-sm focus:outline-none"
                    type="text"
                    placeholder="Buscar..."
                    v-model="PersonalBuscar"
                />
            </div>

            <div class="relative inline-block text-left pl-3">
                <div>
                    <button type="button"  @click="MostrarOpcionesFiltro" class="inline-flex justify-center w-full rounded-md border border-gray-300 dark:border-slate-500 shadow-sm px-4 py-2 bg-white dark:bg-slate-700  text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 focus:outline-none focus:ring focus:[#014E82] active:bg-gray-200" id="dropdown-menu-button" aria-haspopup="true" aria-expanded="true">
                    <span class="pr-2"> <i class="fa-solid fa-filter"></i>  </span>{{ campoBusquedaVer }}
                    <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9.293 5.293a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L10 7.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 010 0z" clip-rule="evenodd" />
                    </svg>
                    </button>
                </div>

                <div v-if="MostrarFiltro" class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu-button" tabindex="-1">

                    <div class="py-1 dark:bg-slate-700 dark:hover:bg-slate-500 " role="menuitem" tabindex="-1" id="dropdown-menu-item-1" href="#">
                    <span @click="SeleccionarCampo('Nombre','Nombre')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-slate-500 dark:text-gray-200">Nombre</span>
                    </div>

                    <div class="py-1 dark:bg-slate-700 dark:hover:bg-slate-500 " role="menuitem" tabindex="-1" id="dropdown-menu-item-2" href="#">
                    <span @click="SeleccionarCampo('CURP','Curp')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-slate-500 dark:text-gray-200">Curp</span>
                    </div>

                </div>
            </div>






            <div class="justyfy-end flex w-full">
                <button :type="type" @click="VerificarUsuario()" class="ml-auto  rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7]"  :class="{'ml-auto rounded-md bg-slate-500 opacity-30 px-6 py-2.5 mb-4 text-center text-sm text-gray-500 hover:bg-gray-300 cursor-not-allowed' : personalSeleccionado==0}" :disabled="personalSeleccionado==0"
                v-if="$page.props.user.permissions.includes('Asignar cuentas de usuarios al personal')">
                    Asignar cuenta de usuario
                </button>

                <button :type="type" @click="VerificarPlaza()" class="ml-3  rounded-md bg-[#014E82] px-6 py-2.5 mb-4 text-center text-sm text-white hover:bg-[#0284c7]"  :class="{'ml-3 rounded-md bg-slate-500 opacity-30 px-6 py-2.5 mb-4 text-center text-sm text-gray-500 hover:bg-gray-300 cursor-not-allowed' : personalSeleccionado==0}" :disabled="personalSeleccionado==0"
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
                        Agregar alumnos
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
                            <input id="Capacidad"  maxlength="18" v-model="NuevoPersonal.CURP" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="XXXXXXXXXXXXXXXXXX" required>
                            <p v-if="MostrarmensajeCurp!=false" :class="{ 'text-sm text-green-500':exitoCURP, 'text-sm text-red-600':!exitoCURP }">{{ mensajeCurp }}</p>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">

                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                RFC
                            </label>
                            <input id="NombreAula" maxlength="13" v-model="NuevoPersonal.RFC"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-1 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="XXXXXXXXXXXXX" required>

                            <p v-if="MostrarmensajeRFC!=false" :class="{ 'text-sm text-green-500':exitoRFC, 'text-sm text-red-600':!exitoRFC }">{{  mensajeRFC }}</p>

                        </div>


                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Nombre
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Nombre" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="0" required>
                        </div>

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Apellido Paterno
                            </label>
                            <input id="NombreAula" v-model="NuevoPersonal.ApellidoP"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" required>
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Apellido Materno
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.ApellidoM" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" required>
                        </div>


                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Fecha de Nacimiento
                            </label>
                            <input id="NombreAula" v-model="NuevoPersonal.FechaNacimiento"  class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="date" placeholder="" required>
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                Numero de tarjeta
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.numTarjeta" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="number" placeholder="0" required>
                        </div>


                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 dark:text-gray-200 text-xs font-bold mb-2" for="grid-last-name">
                                 Direccion (*opcional)
                            </label>
                            <input id="Capacidad" v-model="NuevoPersonal.Direccion" class="appearance-none block w-full bg-gray-200 dark:bg-slate-600 text-gray-700 dark:text-gray-200 border border-gray-200  dark:border-slate-600 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"  type="text" placeholder="" >
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
                            No.Control
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Nombre
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Fecha Nacimiento
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Curp
                        </th>
                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Direccion
                        </th>

                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200">
                            Genero
                        </th>

                        <th class="border-b-2 border-gray-300 dark:border-slate-700 bg-gray-300 dark:bg-slate-700 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-slate-200"
                        v-if="$page.props.user.permissions.includes('Editar información del personal') || $page.props.user.permissions.includes('Eliminar al personal')">
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>


                    <tr v-for="(alumno,index) in alumnos" v-bind:id="`fila${persona.id}`"  class="text-gray-700"
                    >
                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-xs ">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ alumno.noControl }}</p>
                        </td>
                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-xs">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ alumno.Nombre }} {{ alumno.ApellidoP }} {{ alumno.ApellidoM }}</p>
                        </td>
                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-xs">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ alumno.FechaNac }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-xs">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ alumno.curp }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-xs">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ alumno.Direccion }}</p>
                        </td>

                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-3 py-5 text-xs">
                            <p class="text-gray-900 dark:text-gray-200 whitespace-no-wrap">{{ alumno.Genero }}</p>
                        </td>


                        <td class="border-b border-gray-200 dark:border-slate-700  bg-white dark:bg-slate-800 px-6 py-5 text-sm"
                        v-if="$page.props.user.permissions.includes('Editar información del personal') || $page.props.user.permissions.includes('Eliminar al personal')">


                            <Link :href="route('Personal.edit',persona.id)" class="p-3 rounded-md bg-[#014E82] mx-2 inline-flex mb-2 text-white "
                            v-if="$page.props.user.permissions.includes('Editar información del personal') && persona.Estatus=='A'">
                                Editar <span class="ml-2 "><i class="fa-solid fa-pen text-white"></i></span>
                            </Link>

                            <a type="button" @click="showDelete(persona.id,persona.Estatus)" class="p-3 rounded-md bg-[#dc2626] mx-2 inline-flex mb-1 text-white "
                            v-if="$page.props.user.permissions.includes('Eliminar al personal') && persona.Estatus=='A'">
                                       Baja<span class="ml-2 "> <i class="fa-solid fa-turn-down text-white"></i> </span>
                            </a>


                            <a type="button" @click="showDelete(persona.id,persona.Estatus)" class="p-3 rounded-md bg-[#2f9e56] mx-2 inline-flex mb-1 text-white "
                            v-if="$page.props.user.permissions.includes('Eliminar al personal') && persona.Estatus=='B'">
                                       Alta<span class="ml-2 "> <i class="fa-solid fa-turn-up text-white"></i></span>
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


                                                        <h3  v-if="EstatusActivo=='A'" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Esta seguro de dar de baja a este personal: {{ idBorrarSeleccionado }} </h3>

                                                        <h3 v-if="EstatusActivo=='B'" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Esta seguro de dar de alta a este personal: {{ idBorrarSeleccionado }} </h3>

                                                        <Link v-if="EstatusActivo=='A'" @click="hideDelete" method="delete" :href="route('Personal.destroy', idBorrarSeleccionado)" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Si, estoy seguro
                                                        </Link>


                                                        <Link v-if="EstatusActivo=='B'" @click="hideDelete" method="delete" :href="route('Personal.destroy', idBorrarSeleccionado)" type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-200 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Si, estoy seguro
                                                        </Link>

                                                        <button @click="hideDelete" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
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


    <nav aria-label="Page navigation example mt-4">
                <ul class="inline-flex -space-x-px text-sm">


                    <li v-if="this.Paginator.prev_page_url!=null" >
                    <a :href="this.Paginator.prev_page_url" class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >Previous</a>
                    </li>

                    <li v-if="Paginator.current_page-2 >0">
                        <a :href="`${urlPaginacion}${Paginator.current_page-2}=`"  aria-current="page" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            {{ Paginator.current_page-2 }}</a>
                    </li>

                    <li v-if="Paginator.current_page-1 >0">


                        <a :href="`${urlPaginacion}${Paginator.current_page-1}`" aria-current="page" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            {{ Paginator.current_page-1 }} </a>
                    </li>

                    <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            {{ Paginator.current_page }}</a>
                    </li>

                    <li v-if="Paginator.current_page+1<=cantidadPaginas">
                        <a :href="`${urlPaginacion}${Paginator.current_page+1}`" aria-current="page" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                        >{{ Paginator.current_page+1 }}</a>
                    </li>

                    <li v-if="Paginator.current_page+2<=cantidadPaginas">
                        <a :href="`${urlPaginacion}${Paginator.current_page+2}`" aria-current="page" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            {{ Paginator.current_page+2 }}</a>
                    </li>

                    <li v-if="this.Paginator.next_page_url!=null">
                    <a :href="this.Paginator.next_page_url" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    >Next</a>
                    </li>

                </ul>
            </nav>

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

    // created() {
    //     const urlParams = new URLSearchParams(window.location.search);
    //     const filtroBusqueda = urlParams.get('FiltroBusqueda');

    //     // Ahora puedes usar filtroBusqueda en tu componente
    //     this.FiltroBusqueda = filtroBusqueda;
    // },

    mounted() {

        this.hideDelete()
        this.FiltroBusqueda=this.$page.props.Filtro;

        if(this.Paginator.next_page_url!=null){
            this.urlPaginacion = this.Paginator.next_page_url.slice(0, -1);
        }
        else if(this.Paginator.prev_page_url!=null){
            this.urlPaginacion = this.Paginator.prev_page_url.slice(0, -1);
        }

        this.cantidadPaginas=this.Paginator.last_page

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
         alumnos:Array,
         Paginator:Array,
    },

    data() {
    return {

      urlPaginacion:'',

      isVisible: false,
      isvisibleDelete:false,
      idBorrarSeleccionado:0,

      PersonalBuscar:'',
      campoBusqueda:'CURP',
      campoBusquedaVer:'CURP',


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

      contenidoModal:'',

      Activar:[],

      mensajeCurp:'',
      mensajeRFC:'',

      exitoCURP:false,
      exitoRFC:false,

      MostrarmensajeCurp:false,
      MostrarmensajeRFC:false,

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

    MostrarOpcionesFiltro(){
        if(this.MostrarFiltro==true){
            this.MostrarFiltro=false
        }
        else{
            this.MostrarFiltro=true
        }
    },

    SeleccionarCampo(campo,campoVer){
        this.campoBusqueda=campo
        this.campoBusquedaVer=campoVer
        this.MostrarFiltro=false
        this.HacerBusqueda();
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

        this.personalSeleccionado=0;
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


    showDelete(id,estatus){
        this.idBorrarSeleccionado=id;
        this.EstatusActivo=estatus;
        this.isvisibleDelete = true;
    },


    hideDelete(){
        this.isvisibleDelete = false;
        this.personalSeleccionado=0;
    },

  }
};
</script>








