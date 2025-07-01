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

        $dados = [
            'naoIniciados' => ['todos' => NAO_INICIADO, '30' => NAO_INICIADO_30, 'nao_visto' => NAO_INICIADO_NAO_VISTO],
            'emExecucao' => ['todos' => EM_EXECUCAO, '30' => EM_EXECUCAO_30, 'nao_visto' => EM_EXECUCAO_NAO_VISTO],
            'pendentes' => ['todos' => PENDENTE, '30' => PENDENTE_30, 'nao_visto' => PENDENTE_NAO_VISTO],
            'finalizados' => ['todos' => FINALIZADO, '30' => FINALIZADO_30, 'nao_visto' => FINALIZADO_NAO_VISTO],
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
