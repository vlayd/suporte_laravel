<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChamadoController extends Controller
{
    public function index()
    {
        $dados = [
            'breadcrumb' => $this->breadcrumb([
                ['Chamados', route('chamado')], ['Lista']
            ])
        ];
        return view('chamado.index', $dados);
    }

    public function listar()
    {
        $where = ['chamados.id', '!=', '0'];
        if(session('user.nivel') != '2') $where = ['solicitante', session('user.id')];
        try {
            $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_INDEX)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->where([$where])
        ->get();
        } catch (\Throwable $th) {
            die($th->getMessage());
        }

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
        ->join('rh.setores as ST', 'S.setor', '=', 'ST.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->where('chamados.id', $id)
        ->first();

        $anexosMain = DB::table('anexos')->where(['id_chamado' => $id, 'chat' => 0])->get();
        $anexosMain = json_decode(json_encode($anexosMain), true);

        $anexosChat = DB::table('anexos')->where([['id_chamado', '=', $id], ['chat', '!=', 0]])->get();
        $anexosChat = json_decode(json_encode($anexosChat), true);

        $chats = DB::table('chat')
        ->select(SELECT_CHAT_DETAIL)
        ->join('rh.usuarios as U', 'chat.id_usuario', '=', 'U.id', 'left')
        ->where('chat.id_chamado', $id)
        ->get();
        $chats = json_decode(json_encode($chats), true);

        $chamado['dt_criacao'] = $this->formataDataTime($chamado['dt_criacao']);
        $chamado['dt_conclusao'] = $this->formataDataTime($chamado['dt_conclusao']);

        $dados = [
            'chamado' => $chamado,
            'anexosMain' => $anexosMain,
            'anexosChat' => $anexosChat,
            'chats' => $chats,
            'status' => $status,
        ];

        return view('chamado.detail', $dados);
    }

    public function novoEdit($idChamado = '')
    {
        if($idChamado != ''){
            $idChamado = Operations::decriptId($idChamado);
            if($idChamado == null || $idChamado == '') return redirect()->route('index');
        }

        $categorias = DB::table('categorias')->get();
        $servicos = [];
        $servidores = DB::connection('rh')->table('usuarios')->select(['id', 'nome', 'setor'])->orderBy('nome')->whereNot('rh', 0)->get();

        $dados = [
            'categorias' => $categorias,
            'servidores' => $servidores,
            'servicos' => $servicos,
            'breadcrumb' => $this->breadcrumb([
                ['Chamados', route('chamado')], ['Novo']
            ])
        ];
        if($idChamado != ''){
            $chamado = DB::table('chamados')
                            ->select(SELECT_CHAMADO_EDIT)
                            ->join('servicos', 'chamados.servico', '=', 'servicos.id', 'left')
                            ->where(['chamados.id'=> $idChamado])->first();
            $dados['chamado'] = $chamado;
            $dados['anexos'] = DB::table('anexos')->where(['id_chamado' => $idChamado, 'chat' => 0])->get();
            $dados['servicos'] = DB::table('servicos')->where('id_categoria', $chamado->idCategoria)->get();
        }
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


        $idSolicitante = session('user.id');
        $setorSolicitante = session('user.setor');
        if(isset($request['solicitante']) && $request['solicitante'] != ''){
            $solicitante = explode('.', $request['solicitante']);
            $idSolicitante = $solicitante[0];
            $setorSolicitante = $solicitante[1];
        }
        $dados = [
            'servico' => $request['servico'],
            'titulo' => $request['titulo'],
            'descricao' => $request['descricao'],
            'solicitante' => $idSolicitante,
            'setor' => $setorSolicitante,
        ];
        if(session('user.nivel') != 1) $dados['visto_adm'] = 1;

        $lastId = '';
        if(!isset($request['idChamado'])){
            $lastId = DB::table('chamados')->insertGetId($dados);
        } else {
            $lastId = $this->decriptId($request['idChamado']);
            DB::table('chamados')->where('id', $lastId)->update($dados);
        }

        if($request->hasFile('anexos')) $this->uploadFileMultiple($request->file('anexos'), $lastId);

        return redirect()->route('chamado')->with('message', 'Chamado enviado...!');
    }

    public function saveChat(Request $request)
    {
        $idChamado = $this->decriptId($request['id_chamado']);
        $request->validate(
            //rules
            [
                'anexo_chat.*' => 'extensions:jpeg,png,jpg,gif'
            ],
            //error messages
            [
                'anexo_chat.extensions' => 'Formato não aceito...',
            ]
        );
        $idChat = '0';
        $dados = [
            'id_chamado' => $idChamado,
            'texto' => $request['descricao'],
            'id_usuario' => session('user.id')
        ];

        try {
            $idChat = DB::table('chat')->insertGetId($dados);
        } catch(\Throwable $e){
            die('erro*Erro ao enviar mensagem!');
        }
        $visto = ['visto_adm' => 0];
        if(session('user.nivel') != 1) $visto = ['visto_user' => 0];
        DB::table('chamados')->where(['id' => $idChamado])->update($visto);

        if($request->hasFile('anexo_chat')) $this->uploadFileMultiple($request->file('anexo_chat'), $idChamado, $idChat);

        die('success*Mensagem enviada!');
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

    public function deleteAnexoChamado(Request $request)
    {
        $idAnexo = $request['id_anexo'];
        $anexo = DB::table('anexos')->find($request['id_anexo']);
        $nomeImage = $anexo->arquivo;
        $idChamado = $anexo->id_chamado;
        if($this->deleteAnexo(PATH_UPLOAD.$idChamado, $nomeImage)){
            DB::table('anexos')->delete($idAnexo);
            echo 'success';
        } else  echo 'erro';
    }

    public function cancelaChamado(Request $request)
    {
        $idChamado = $request['idChamado'];
        $cancelado = DB::table('chamados')->where('id', $idChamado)->update(['status' => 5]);
        if($cancelado == 1) echo 'success';
        else echo 'erro';
    }

    public function analitico()
    {
        return view('chamado.relatorio.analitico');
    }



    public function pdfAnalitico(Request $request)
    {
        $hoje = date('Y-m-d', strtotime('+1 days'));
        $primeiroDiaMes = date("Y-m-01", strtotime('+1 days'));
        $inicio = $request['data_inicio']!=''?$request['data_inicio']:$hoje;
        $fim = $request['data_fim']!=''?$request['data_fim']:$primeiroDiaMes;
        $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_ANALICO)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('rh.setores as ST', 'S.setor', '=', 'ST.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->whereBetween('dt_criacao', [$inicio, $fim])
        ->get();
        // dd($chamados);
        $dados= [
            'type' => 'analitico',
            'chamados' => $chamados,
        ];
        return view('chamado.pdf.gerador', $dados);
    }

}
