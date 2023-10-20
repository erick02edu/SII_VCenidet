
    <div class="min-h-screen flex flex-col sm:justify-start items-center pt-6 sm:pt-12 bg-gray-100" >

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg  border-t-4 border-[#316385]">

            <div class="p-4">
            <h2 class="text-2xl font-semibold text-gray-800">¡Bienvenido, {{ $username }} al SII CENIDET!</h2>
            <img class="w-full h-48 object-cover" src="https://upload.wikimedia.org/wikipedia/commons/9/9d/TecNM_logo.png" alt="Imagen del correo">

            <p class="text-gray-700 mt-4">
                Tus credenciales de inicio de sesión son:<br>
                Correo: {{ $email }}<br>
                Para obtener tu contraseña consulta con el administrador del sistema o realizo el cambio de contraseña en el siguiente <a href="{{route('password.email')}}">Link</a>
            </p>

            <a href="{{ route('login') }}" >Iniciar sesion</a>

            </div>

        </div>
    </div>


