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



        <div style="
            width:100%;
            display:inline-flex;

        ">
            <img style="
                width: 25%;


            "
            src="https://www.cdcuauhtemoc.tecnm.mx/wp-content/uploads/2021/08/Logo-TecNM.png" alt="Error al cargar imagen">

            <p style="
                text-align: end;
                width:100%;
                padding-top: 2%;
                font-size:14px;
                font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            ">SII CENIDET</p>

        </div>




        <header style="padding-top:1%;">
            <p
            style="
                font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                font-size:20px;

            "
            >Tu horarios para el periodo {{ $periodo['mesInicio'] }}  {{ $periodo['AñoInicio'] }}-{{ $periodo['mesTermino'] }} {{ $periodo['AñoTermino'] }}  esta listo<br>

            </p>


        </header>

        <p style="
            font-size:14px;
        ">
            Puedes consultar tu horario dando clic en el siguiente boton
            {{-- <strong>{{ $Titulo }}</strong> --}}
        </p>


        <button style="
        background-color: #014E82;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;">

            <a href="{{ route('HorariosDocentes.index') }}" style="
                text-decoration: none;
                color: white;
                font-size:80%;
                font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            ">Ver mis horarios</a>

        </button>


    </div>
</div>

<style>

    .tarjeta{
        background-color: #d31c1c;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 300px;
        margin: auto;
    }

</style>






