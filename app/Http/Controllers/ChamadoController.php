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
        $dados = [
            'chamados' => $chamados,
            'status' => $status,
        ];
        return view('chamado.tabela', $dados);
    }

    public function listar30()
    {
        $hoje = date('Y-m-d', strtotime('+1 days'));
        $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_INDEX)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->whereBetween('dt_criacao', [$ultimos30, $hoje])
        // ->where('dt_criacao', now()->subDays(30)->endOfDay())
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

        $anexosMain = DB::table('anexos')->where(['id_chamado' => $id])->get()->toArray();
        $anexosMain = json_decode(json_encode($anexosMain), true);
        $chats = DB::table('chat')
        ->select(SELECT_CHAT_DETAIL)
        ->join('rh.usuarios as U', 'chat.id_usuario', '=', 'U.id')
        ->join('anexos', 'chat.id', '=', 'anexos.chat')
        ->where('chat.id_chamado', $id)
        ->get();

        $chats = json_decode(json_encode($chats), true);
        dd($chats);

        $chamado['dt_criacao'] = $this->formataDataTime($chamado['dt_criacao']);
        $chamado['dt_conclusao'] = $this->formataDataTime($chamado['dt_conclusao']);

        $dados = [
            'chamado' => $chamado,
            'anexosMain' => $anexosMain,
            'chats' => $chats,
        ];

        return view('chamado.detail', $dados);
    }

    public function novo()
    {
        $categorias = DB::table('categorias')->get();
        $servicos = DB::table('servicos')->get();
        $servidores = DB::connection('rh')->table('usuarios')->orderBy('nome')->whereNot('rh', 0)->get();

        $dados = [
            'categorias' => $categorias,
            'servidores' => $servidores,
            'servicos' => $servicos,
        ];
        return view('chamado/form_save', $dados);
    }

    public function selectServicos(Request $request)
    {
        $servicos = DB::table('servicos')->where('id_categoria', $request['id_categoria'])->get();

        $dados = [
            'servicos' => $servicos,
            'idServico' => $request['id_servico'],
        ];
        echo view('chamado.select.select_servicos', $dados);
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
            ],
            //error messages
            [
                'titulo.required' => 'Digite o título...',
                'categoria.required' => 'Escolha uma categoria...',
                'servico.required' => 'Escolha um serviço...',
                'descricao.required' => 'Descreve o chamado...',
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

        DB::table('chamados')->insert($dados);

        return redirect()->route('chamado')->with('message', 'Chamado enviado...!');
    }
}
