<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Backup\BackupDestination\Backup;
use Inertia\Inertia;
use Illuminate\Support\Facades\Artisan;
use Exception;




class BackupController extends Controller
{


    public function __construct()
    {
        //$this->middleware(['permission:Hacer respaldo de la base de datos|Hacer restauración de la base de datos'])->only('index');
    }

    public function index()
    {
        $backups =' Backup::all();';

        return Inertia::render('Backup',['backups'=>$backups]);

    }

    public function Generar(){



        Artisan::call('backup:run');
        //return response()->json(['MEnsjae'=>]);
        dd(Artisan::output());


        //backupFileName = 'backup_SII_CENIDET' . date('Y-m-d_H-i-s') . '.sql';
        // $command = "mysqldump -u root -p sii_del_cenidet > " . storage_path('app/backups/') . $backupFileName;
        // exec($command);

        //return response()->download(storage_path('app/backups/') . $backupFileName);


     }


    public function Prueba(){

        $User=User::all();

        //return inertia::render('Prueba',['usuarios'=> $User]);

        return inertia::render('Modulos/RH/Horarios/FormatoPDFHorarios',['usuarios'=> $User]);
    }
}

