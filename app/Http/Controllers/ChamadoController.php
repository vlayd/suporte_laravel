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
        $where = ['chamados.id', '!=', '0'];
        if(session('user.nivel') != '2') $where = ['solicitante', session('user.id')];
        $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_INDEX)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->where($where)
        ->get();
        $status = DB::table('status')->get();
        $chamados = json_decode(json_encode($chamados), true);
        $status = json_decode(json_encode($status), true);
        $dados = [
            'chamados' => $chamados,
            'status' => $status,
        ];
        return view('chamado.tabela', $dados);
    }

    public function listar30()
    {
        $where = ['chamados.id', '!=', '0'];
        if(session('user.nivel') != '2') $where = ['solicitante', session('user.id')];
        $hoje = date('Y-m-d', strtotime('+1 days'));
        $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_INDEX)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->whereBetween('dt_criacao', [$ultimos30, $hoje])
        ->where([$where])
        ->get();
        $status = DB::table('status')->get();
        $chamados = json_decode(json_encode($chamados), true);
        $status = json_decode(json_encode($status), true);
        $dados = [
            'chamados' => $chamados,
            'status' => $status,
        ];
        return view('chamado.tabela', $dados);
    }

    public function detail($id)
    {
        $id = $this->decriptId($id);
        $dados = ['visto_user' => 1];
        if(session('user.nivel') == 2) $dados = ['visto_adm' => 1];
        DB::table('chamados')->where('id', $id)->update($dados);
        $status = DB::table('status')->get();
        $status = json_decode(json_encode($status), true);
        $chamado = (array)DB::table('chamados')
        ->select(SELECT_CHAMADO_DETAIL)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->where('chamados.id', $id)
        ->first();

        $anexosMain = DB::table('anexos')->where(['id_chamado' => $id])->get()->toArray();
        $anexosMain = json_decode(json_encode($anexosMain), true);
        $chats = DB::table('chat')
        ->select(SELECT_CHAT_DETAIL)
        ->join('rh.usuarios as U', 'chat.id_usuario', '=', 'U.id')
        ->join('anexos', 'chat.id', '=', 'anexos.chat')
        ->where('chat.id_chamado', $id)
        ->get();

        $chats = json_decode(json_encode($chats), true);

        $chamado['dt_criacao'] = $this->formataDataTime($chamado['dt_criacao']);
        $chamado['dt_conclusao'] = $this->formataDataTime($chamado['dt_conclusao']);

        $dados = [
            'chamado' => $chamado,
            'anexosMain' => $anexosMain,
            'chats' => $chats,
            'status' => $status,
        ];

        return view('chamado.detail', $dados);
    }

    public function novoEdit($idChamado = '')
    {
        if($idChamado != '') $idChamado = $this->decriptId($idChamado);
        $categorias = DB::table('categorias')->get();
        $servicos = DB::table('servicos')->get();
        $servidores = DB::connection('rh')->table('usuarios')->select(['id', 'nome'])->orderBy('nome')->whereNot('rh', 0)->get();

        $dados = [
            'categorias' => $categorias,
            'servidores' => $servidores,
            'servicos' => $servicos,
        ];
        if($idChamado != '') $dados['chamado'] = DB::table('chamados')
                                                    ->select(SELECT_CHAMADO_EDIT)
                                                    ->join('servicos', 'chamados.servico', '=', 'servicos.id')
                                                    ->where('chamados.id', $idChamado)->first();
        return view('chamado/form_save', $dados);
    }

    public function selectServicos(Request $request)
    {
        $servicos = DB::table('servicos')->where('id_categoria', $request['id_categoria'])->get();
        $dados = [
            'servicos' => $servicos,
            'idServico' => $request['id_servico'],
        ];
        return view('layouts.select.select_servicos', $dados);
    }

    public function save(Request $request)
    {
        $request->validate(
            //rules
            [
                'titulo' => 'required',
                'descricao' => 'required',
                'categoria' => 'required|integer',
                'servico' => 'required|integer',
                'anexos.*' => 'extensions:jpeg,png,jpg,gif'
            ],
            //error messages
            [
                'titulo.required' => 'Digite o título...',
                'categoria.required' => 'Escolha uma categoria...',
                'servico.required' => 'Escolha um serviço...',
                'descricao.required' => 'Descreve o chamado...',
                'anexos.extensions' => 'Formato não aceito...',
            ]
        );


        $solicitante = session('user.id');
        if(isset($request['solicitante']) && $request['solicitante'] != '') $solicitante = $request['solicitante'];
        $dados = [
            'servico' => $request['servico'],
            'titulo' => $request['titulo'],
            'descricao' => $request['descricao'],
            'solicitante' => $solicitante,
        ];

        $lastId = DB::table('chamados')->insertGetId($dados);
        if($request->hasFile('anexos')) $this->uploadFileMultiple($request->file('anexos'), $lastId);

        return redirect()->route('chamado')->with('message', 'Chamado enviado...!');
    }

    public function updateStatus($idChamado, $idStatus){
        $dados = ['id' => $idChamado, 'status' => $idStatus];
        if($idStatus == 1){
            $dados['atendente'] = 0;
            $dados['dt_conclusao'] = null;
        } elseif($idStatus == 2){
            $dados['atendente'] = session('user.id');
            $dados['dt_conclusao'] = null;
        } elseif($idStatus == 3){
            $dados['atendente'] = session('user.id');
            $dados['dt_conclusao'] = null;
        } elseif($idStatus == 4) {
            $dados['atendente'] = session('user.id');
            $dados['dt_conclusao'] = date("Y-m-d H:i:s");
        }
        if(DB::table('chamados')->where('id', $idChamado)->update($dados)){
            return redirect()->back();
        }
    }
}
