<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChamadoController extends Controller
{
    public function index()
    {
        return view('chamado.index');
    }

    public function listar()
    {
        $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_INDEX)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->get();
        $status = DB::table('status')->get();
        $chamados = json_decode(json_encode($chamados), true);
        $status = json_decode(json_encode($status), true);
        // dd($chamados);
        $dados = [
            'chamados' => $chamados,
            'status' => $status,
        ];
        return view('chamado.tabela', $dados);
    }

    public function listar30()
    {
        $hoje = date('Y-m-d');
        $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_INDEX)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->whereBetween('dt_criacao', [$ultimos30, $hoje])
        ->get();
        $status = DB::table('status')->get();
        $chamados = json_decode(json_encode($chamados), true);
        $status = json_decode(json_encode($status), true);
        // dd($chamados);
        $dados = [
            'chamados' => $chamados,
            'status' => $status,
        ];
        return view('chamado.tabela', $dados);
    }

    public function detail($id)
    {
        $id = Operations::decriptId($id);
        if($id == null) return redirect()->route('/');
        $chamado = (array)DB::table('chamados')
        ->select(SELECT_CHAMADO_DETAIL)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->where('chamados.id', $id)
        ->first();

        $anexosMain = DB::table('anexos')->where(['id_chamado' => $id, 'chat' => 0])->get()->toArray();
        $anexosMain = json_decode(json_encode($anexosMain), true);

        $chamado['dt_criacao'] = $this->formataDataTime($chamado['dt_criacao']);
        $chamado['dt_conclusao'] = $this->formataDataTime($chamado['dt_conclusao']);

        $dados = [
            'chamado' => $chamado,
            'anexosMain' => $anexosMain,
        ];

        return view('chamado.detail', $dados);
    }

    public function novo()
    {
        return view('chamado/form_save');
    }
}
