<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        // "SELECT COUNT(C.id),U.id AS idUser,C.id AS idCha,nome FROM `usuarios` AS U LEFT JOIN suporte.chamados AS C ON U.id = C.solicitante GROUP BY U.nome ORDER BY COUNT(C.id) DESC;";
        $dados = [
            'usuarios' => DB::connection('rh')->table('usuarios AS U')
                            ->select(['U.id AS idUser', 'C.id AS idCha', 'U.nome'])
                            ->selectRaw('COUNT(C.id) AS qtChamado')
                            ->join('suporte.chamados AS C', 'U.id', '=', 'C.solicitante')
                            ->groupBy('U.nome')
                            ->orderByDesc('qtChamado')
                            ->get(),
            'breadcrumb' => $this->breadcrumb([
                ['Gerenciar', route('status')], ['Informações', route('status')], ['Status']
            ]),
        ];
        
        return view('usuario.index', $dados);
    }
}
