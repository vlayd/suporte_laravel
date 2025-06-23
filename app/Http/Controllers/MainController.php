<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        if(!session('user')){
            return view('login/index');
        }
        $naoIniciados = NAO_INICIADO_ADM;
        $naoIniciados30 = NAO_INICIADO_ADM_30;
        $emExecucao = EM_EXECUCAO_ADM;
        $emExecucao30 = EM_EXECUCAO_ADM_30;
        $pendentes = PENDENTE_ADM;
        $pendentes30 = PENDENTE_ADM_30;
        $finalizados = FINALIZADO_ADM;
        $finalizados30 = FINALIZADO_ADM_30;
        $dados = [
            'naoIniciados' => ['todos' => $naoIniciados, '30' => $naoIniciados30],
            'emExecucao' => ['todos' => $emExecucao, '30' => $emExecucao30],
            'pendentes' => ['todos' => $pendentes, '30' => $pendentes30],
            'finalizados' => ['todos' => $finalizados, '30' => $finalizados30],
        ];

        return view('home/index', $dados);
    }

    private function testConnection()
    {
        // try {
        //     DB::connection()->getPdo();
        //     echo 'tudo certo';exit;
        // } catch (\Exception $e) {
        //     die("Could not connect to the database.  Please check your configuration. error:" . $e );
        // }
    }
}
