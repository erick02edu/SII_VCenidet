<?php

namespace App\Http\Controllers;
use Spatie\Backup\BackupDestination\Backup;
use Inertia\Inertia;
use Illuminate\Support\Facades\Artisan;
use Exception;

class BackupController extends Controller
{
    public function index()
    {
        $backups =' Backup::all();';

        return Inertia::render('Backup',['backups'=>$backups]);

    }

    public function Generar(){

        // Ejecutar la operación de respaldo
        try {

            Artisan::call('backup:run', [
                '--only-db' => true,
                '--disable-notifications' => true,
            ]);

            // Obtén la salida del comando (opcional)
            $output = Artisan::output();


        } catch (Exception $e) {
            // Manejar el error de manera adecuada
             echo 'Error: ' . $e->getMessage();
             return response()->json($e);

        }

        return response()->json($output);
    }
}

