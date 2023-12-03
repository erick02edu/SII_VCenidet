

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/05dc881a1f.js" crossorigin="anonymous"></script>
</head>

</html>


<div style="width: 100%; background: #f3f2f0; height:100%; padding-top:20px; padding-bottom:20px;">

    <div style="
        background-color:  #ffffff;
        border-radius: 10px;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 50%;
        margin:auto;
    ">

        {{-- <h2 class="text-2xl font-semibold text-gray-800">¡Bienvenido, {{ $username }} al SII CENIDET!</h2> --}}
        <div style="width: :100%; text-align:center;">
            <img style="width: 35%;"
            src="https://upload.wikimedia.org/wikipedia/commons/9/9d/TecNM_logo.png" alt="Imagen del correo">
        </div>

        <div style="width: :100%; text-align:center; margin-top:2%; font-size:20px;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif  ">
            <strong>
                ¡Bienvenido {{ $username}} al SII CENIDET!
            </strong>
        </div>

        <div style="width:90%; padding-left:7%; padding-top:2%; margin-bottom:4%;
        text-alignt:center; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        text-size: 13px ">

            Te damos la bienvedia ahora eres parte del nuestro equipo.<br>
            Para continuar se te envia tus credenciales de inicio de sesion
            <br><br>
            {{-- Correo: {{ $email }}<br> --}}
            <i class="fa-solid fa-envelope"></i> Correo: {{ $email }} <br><br>

            Para obtener tu contraseña consulta con el administrador del sistema o puedes realizar el cambio de contraseña presionando el siguiente boton
            <br>
            <br>

            <div style="width: 100% text-center">
                <button style="
                background-color: #014E82;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;">


                    <a href="{{route('password.email')}}" style="
                    text-decoration: none;
                    color: white;
                    font-size:80%;
                    font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                    ">Cambiar mi contraseña</a>

                </button>
            </div>

        </div>


    </div>
</div>
