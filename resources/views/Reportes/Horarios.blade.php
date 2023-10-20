    {{-- <table>
        <tr>
        <th>Lunes</th>
        </tr>

        @foreach ($ClasesLunes as $Clase)
        <tr>
            <td>{{$Clase->idAula}}</td>
        </tr>
        @endforeach

        <tr>
            <th>Martes</th>
        </tr>

        @foreach ($ClasesMartes as $Clase)
        <tr>
            <td>{{$Clase->idAula}}</td>
        </tr>
        @endforeach


        <tr>
            <th>Miercoles</th>
        </tr>

        @foreach ($ClasesMiercoles as $Clase)
        <tr>
            <td>{{$Clase->idAula}}</td>
        </tr>
        @endforeach


        <tr>
            <th>Jueves</th>
        </tr>

        @foreach ($ClasesJueves as $Clase)
        <tr>
            <td>{{$Clase->idAula}}</td>
        </tr>
        @endforeach


        <tr>
            <th>Viernes</th>
        </tr>

        @foreach ($ClasesViernes as $Clase)
        <tr>
            <td>{{$Clase->idAula}}</td>
        </tr>
        @endforeach


  </table> --}}



<table>

    <thead>
        <tr>
            <td style="width:120px; vertical-align: middle; text-align: center; background:#334155; color:white; height: 30px;">
                Lunes
            </td>

            <td style="width:120px; vertical-align: middle; text-align: center; background:#334155; color:white; height: 30px;">
                Martes
            </td>

            <td style="width:120px; vertical-align: middle; text-align: center; background:#334155; color:white; height: 30px;">
                Miercoles
            </td>

            <td style="width:120px; vertical-align: middle; text-align: center; background:#334155; color:white; height: 30px;">
                Jueves
            </td>

            <td style="width:120px; vertical-align: middle; text-align: center; background:#334155; color:white">
                Viernes
            </td>
        </tr>
    </thead>

    <tbody >


            @for ($i = 0; $i < 100; $i++)

            <tr>
                <!--CLASES LUNES-->
                @if (count($ClasesLunes) > 0)

                        @foreach ($Materias as $Materia )
                            @if ($Materia->id==$ClasesLunes[$i]->idMateria)
                                <td style="vertical-align: middle; text-align: center;height: 100px; background-color: {{ $ClasesLunes[$i]->color }}; color:white; ">{{$Materia->Nombre}}<br>
                            @endif
                        @endforeach


                        @foreach ($Aulas as $Aula )
                            @if ($Aula->id==$ClasesLunes[$i]->idAula)
                                {{$Aula->NombreAula}}<br>
                            @endif
                        @endforeach

                        {{$ClasesLunes[$i]->HInicio}}-{{$ClasesLunes[$i]->HFin}}
                                </td>

                    <?php unset($ClasesLunes[$i]); ?>
                @else
                    <td></td>
                @endif
                <!--CLASES MARTES-->
                @if (count($ClasesMartes) > 0)

                      @foreach ($Materias as $Materia )
                            @if ($Materia->id==$ClasesMartes[$i]->idMateria)
                                <td style="vertical-align: middle; text-align: center;height: 100px; background-color: {{ $ClasesMartes[$i]->color }}; color:white;">{{$Materia->Nombre}}<br>
                            @endif
                        @endforeach


                        @foreach ($Aulas as $Aula )
                            @if ($Aula->id==$ClasesMartes[$i]->idAula)
                                {{$Aula->NombreAula}}<br>
                            @endif
                        @endforeach

                        {{$ClasesMartes[$i]->HInicio}}-{{$ClasesMartes[$i]->HFin}}
                                </td>

                    <?php unset($ClasesMartes[$i]); ?>
                @else
                    <td></td>
                @endif

                <!--CLASES MIERCOLES-->
                @if (count($ClasesMiercoles) > 0)
                      @foreach ($Materias as $Materia )
                            @if ($Materia->id==$ClasesMiercoles[$i]->idMateria)
                                <td style="vertical-align: middle; text-align: center; height: 100px; background-color: {{ $ClasesMiercoles[$i]->color }}; color:white;">{{$Materia->Nombre}}<br>
                            @endif
                        @endforeach


                        @foreach ($Aulas as $Aula )
                            @if ($Aula->id==$ClasesMiercoles[$i]->idAula)
                                {{$Aula->NombreAula}}<br>
                            @endif
                        @endforeach

                        {{$ClasesMiercoles[$i]->HInicio}}-{{$ClasesMiercoles[$i]->HFin}}
                                </td>
                    <?php unset($ClasesMiercoles[$i]); ?>
                @else
                    <td></td>
                @endif
                <!--CLASES JUEVES-->
                @if (count($ClasesJueves) > 0)
                      @foreach ($Materias as $Materia )
                            @if ($Materia->id==$ClasesJueves[$i]->idMateria)
                                <td style="vertical-align: middle; text-align: center; height: 100px; background-color: {{ $ClasesJueves[$i]->color }}; color:white;">{{$Materia->Nombre}}<br>
                            @endif
                        @endforeach


                        @foreach ($Aulas as $Aula )
                            @if ($Aula->id==$ClasesJueves[$i]->idAula)
                                {{$Aula->NombreAula}}<br>
                            @endif
                        @endforeach

                        {{$ClasesJueves[$i]->HInicio}}-{{$ClasesJueves[$i]->HFin}}
                                </td>
                    <?php unset($ClasesJueves[$i]); ?>
                @else
                    <td></td>
                @endif
                <!--CLASES MARTES-->
                @if (count($ClasesViernes) > 0)
                      @foreach ($Materias as $Materia )
                            @if ($Materia->id==$ClasesViernes[$i]->idMateria)
                                <td style="vertical-align: middle; text-align: center; height: 100px; background-color: {{ $ClasesViernes[$i]->color }}; color:white;">{{$Materia->Nombre}}<br>
                            @endif
                        @endforeach


                        @foreach ($Aulas as $Aula )
                            @if ($Aula->id==$ClasesViernes[$i]->idAula)
                                {{$Aula->NombreAula}}<br>
                            @endif
                        @endforeach

                        {{$ClasesViernes[$i]->HInicio}}-{{$ClasesViernes[$i]->HFin}}
                                </td>
                    <?php unset($ClasesViernes[$i]); ?>
                @else
                    <td></td>
                @endif
            </tr>

            @if (count($ClasesLunes)== 0 &&count($ClasesMartes)==0 &&count($ClasesMiercoles)==0 &&count($ClasesJueves)==0 &&count($ClasesViernes)==0)
                @break
            @endif

            @endfor



    </tbody>


</table>


<style>
    .Encabezado{

        background:#334155;
        color: white;
    }
</style>






