<?php

namespace App\Http\Controllers;

use App\Services\Operations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChamadoController extends Controller
{
    public function index($tipo)
    {
        if(!$this->retornoTipoLista($tipo)) return redirect('/');
        $dados = [
            'breadcrumb' => $this->breadcrumb([
                ['Chamados', route('chamado', $tipo)], [ucfirst($tipo)]
            ]),
            'titulo' => 'Lista de Chamados',
            'activeLista' => 'active',
            'showLista' => 'show',
            'activeLista' => 'active',
            'activeLista'.$tipo => 'active',
            'tipo' => $tipo,
        ];
        return view('chamado.index', $dados);
    }

    public function listar(Request $request)
    {
        if(!$this->retornoTipoLista($request['lista'])){exit();}
        $chamados = [];
        //Defina se pode alterar o status do chamado
        $confirma = false;
        try {
            $query = DB::table('chamados')
                            ->select(SELECT_CHAMADO_INDEX)
                            ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
                            ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
                            ->join('servicos', 'chamados.servico', '=', 'servicos.id')
                            ->join('categorias', 'servicos.id_categoria', '=', 'categorias.id')
                            ->join('status', 'chamados.status', '=', 'status.id', 'LEFT');
            if($request['intervalo'] == '30'){
                $query->whereDate('dt_criacao', '>=', date('Y-m-d', strtotime('-30 days')))->whereDate('dt_criacao', '<=', date('Y-m-d'));
            }
            if($request['lista'] == 'enviados'){
                $query->where('chamados.solicitante', session('user.id'));                
            } 
            elseif($request['lista'] == 'recebidos'){
                $confirma = true;
                $query->where('categorias.setor', session('user.setor'));
            } 
            $chamados = $query->orderByDesc('dt_alteracao')->get();
            // echo '<pre>';
            // print_r($chamados);exit;
        } catch (\Throwable $th) {
            die("erro: ".$th->getMessage());
        }

        $status = DB::table('status')->get();
        $chamados = json_decode(json_encode($chamados), true);
        $status = json_decode(json_encode($status), true);
        $dados = [
            'chamados' => $chamados,
            'status' => $status,
            'confirma' => $confirma,
            'tipo' => $request['lista'],
        ];
        // return view('chamado.tabela.tabela_'.$request['lista'], $dados);
        return view('chamado.tabela.tabela', $dados);
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
                        ->orderByDesc('dt_alteracao')
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
        $dadosVisto = ['visto_user' => 1];
        $status = DB::table('status')->get();
        $status = json_decode(json_encode($status), true);
        $chamado = (array)DB::table('chamados')
        ->select(SELECT_CHAMADO_DETAIL)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('rh.setores as ST', 'S.setor', '=', 'ST.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('categorias', 'servicos.id_categoria', '=', 'categorias.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->where('chamados.id', $id)
        ->first();

        $confirma = false;
        $cxChat = false;
        if((session('user.nivel') == 2 || session('user.nivel') == 3) && $chamado['setorCategoria'] == session('user.setor')){
            $confirma = true;
            $cxChat = true;
            $dadosVisto = ['visto_adm' => 1];
        } elseif($chamado['statusChamado'] == 2 || $chamado['statusChamado'] == 3) $cxChat = true;

        DB::table('chamados')->where('id', $id)->update($dadosVisto);

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
            'confirma' => $confirma,
            'cxChat' => $cxChat,
            'activeLista' => 'active',
            'titulo' => 'Detalhando Chamado',
        ];

        return view('chamado.detail', $dados);
    }

    public function retornaValores()
    {
        $naoVisto = TODOS['nao_visto']['todos'];
        $dados = [
                'nao_visto' => $naoVisto,
                'nao_iniciado' => NAO_INICIADO['todos']['todos'],
                'nao_iniciado_nao_visto' => NAO_INICIADO['nao_visto']['todos'],
                'em_execucao_nao_visto' => EM_EXECUCAO['nao_visto']['todos'],
        ];
        if(session('user.nivel') != 1) $dados['nao_visto_setor'] = TODOS['nao_visto']['setor'];

        return json_encode($dados);
    }

    public function novoEdit($idChamado = '')
    {        
        $btnOutro = '<a href="'.route('chamado.novo', 'outro').'" class="col-auto btn btn-sm btn-primary text-xs">OUTRO SERVIDOR</a>';
        if(session('user.nivel') == 1) $btnOutro = '';
        $query = DB::table('categorias')->where('status', 1);
        
        if($idChamado != ''){
            if($idChamado == 'outro' && session('user.nivel') != 1){
            $btnOutro = '';
            $query->where('setor', session('user.setor'));
            } else {
                $idChamado = Operations::decriptId($idChamado);
                if($idChamado == null || $idChamado == '') return redirect()->route('chamado', 'enviados')->with('erro', 'Url inválida...!');
                else {
                    $pesquisaStatus = $this->pesquisaStatus($idChamado);
                    if ($pesquisaStatus != 1 && session('user.nivel') == 1) return redirect()->route('chamado', 'enviados')->with('erro', 'Esse chamdo já foi iniciado...!');
                } 
            }            
        }

        $categorias = $query->get();
        $servicos = [];
        $servidores = DB::connection('rh')->table('usuarios')->select(['id', 'nome', 'setor'])->orderBy('nome')->whereNot('rh', 0)->get();

        $dados = [
            'categorias' => $categorias,
            'servidores' => $servidores,
            'servicos' => $servicos,
            'btnOutro' => $btnOutro,
            'breadcrumb' => $this->breadcrumb([
                ['Chamados', route('chamado')], ['Novo']
            ]),
            'titulo' => 'Novo Chamado'
        ];
        if($idChamado != '' && $idChamado != 'outro'){
            $chamado = DB::table('chamados')
                            ->select(SELECT_CHAMADO_EDIT)
                            ->join('servicos', 'chamados.servico', '=', 'servicos.id', 'left')
                            ->where(['chamados.id'=> $idChamado])->first();
            $dados['chamado'] = $chamado;
            $dados['anexos'] = DB::table('anexos')->where(['id_chamado' => $idChamado, 'chat' => 0])->get();
            $dados['servicos'] = DB::table('servicos')->where('id_categoria', $chamado->idCategoria)->get();
            $dados['titulo'] = 'Alterar Chamado';
        }
        return view('chamado/form_save', $dados);
    }

    public function selectServicos(Request $request)
    {
        $servicos = DB::table('servicos')->where('status', 1)->where('id_categoria', $request['id_categoria'])->get();
        $dados = [
            'servicos' => $servicos,
            'idServico' => $request['id_servico'],
        ];
        return view('layouts.select.select_servicos', $dados);
    }

    public function save(Request $request)
    {      
        $rules = [
                'titulo' => 'required',
                'descricao' => 'required',
                'categoria' => 'required|integer',
                'servico' => 'required|integer',
                'anexos.*' => 'extensions:jpeg,png,jpg,gif,pdf,xls,xlsx,doc,docx'
        ];
        $request->validate(
            //rules
            [
                'titulo' => 'required',
                'descricao' => 'required',
                'categoria' => 'required|integer',
                'servico' => 'required|integer',
                'anexos.*' => 'extensions:jpeg,png,jpg,gif,pdf,xls,xlsx,doc,docx'
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
            'dt_criacao' => date("Y-m-d H:i:s"),
            'dt_conclusao' => null,
        ];
        // if(session('user.nivel') != 1) $dados['visto_adm'] = 1;

        $lastId = ''; 
        if(!isset($request['idChamado'])){
            $lastId = DB::table('chamados')->insertGetId($dados);
        } else {
            $lastId = $this->decriptId($request['idChamado']);
            $pesquisaStatus = $this->pesquisaStatus($lastId);
            if ($pesquisaStatus != 1 && session('user.nivel') == 1) return redirect()->route('chamado', 'enviados')->with('erro', 'Esse chamado já foi iniciado...!');
                
            DB::table('chamados')->where('id', $lastId)->update($dados);
        }

        if($request->hasFile('anexos')) $this->uploadFileMultiple($request->file('anexos'), $lastId);

        return redirect()->route('chamado', 'enviados')->with('message', 'Chamado enviado...!');
    }

    public function saveObs(Request $request)
    {
        DB::table('chamados')->where('id', $request['id'])->update(['observacao' => $request['observacao']]);
        return redirect()->route('chamado', 'recebidos')->with('message', 'Observação enviada...!');
    }

    public function saveChat(Request $request)
    {
        $idChamado = $this->decriptId($request['id_chamado']);
        $request->validate(
            //rules
            [
                'anexo_chat.*' => 'extensions:jpeg,png,jpg,gif,pdf,xls,xlsx,doc,docx'
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
            die('erro*Erro ao enviar mensagem!'.$e->getMessage());
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
        $idChamado = $anexo->id_chamado;
        $pesquisaStatus = $this->pesquisaStatus($idChamado);
        if($pesquisaStatus != 1 && session('user.nivel') == 1) return 'error';
        $nomeImage = $anexo->arquivo;
        if($this->deleteAnexo(PATH_UPLOAD_CHAMADO.$idChamado, $nomeImage)){
            DB::table('anexos')->delete($idAnexo);
            return 'success';
        } else  return 'erro';
    }

    public function cancelaChamado(Request $request)
    {
        //Precisa pesquisar status antes pra verificar se o mesmo continua em não iniciado
        $pesquisaStatus = $this->pesquisaStatus($request['idChamado']);
        if($pesquisaStatus != 1 && session('user.nivel') == 1) return 'error';
        $cancelado = DB::table('chamados')->where('id', $request['idChamado'])->update(['status' => 5]);
        if($cancelado == 1) return 'success';
        else echo 'error';
    }

    public function analitico()
    {
        return view('chamado.relatorio.analitico', ['titulo' => 'Relatório Analítico']);
    }

    public function pdfAnalitico(Request $request)
    {
        $primeiroDiaMes = date("Y-m-01");
        $ultimoDiaMes = date("Y-m-t");
        $hoje = date("Y-m-d");
        $inicio = $request['data_inicio']!=''?$request['data_inicio']:$primeiroDiaMes;
        $fim = $request['data_fim']!=''?$request['data_fim']:$hoje;
        $chamados = DB::table('chamados')
        ->select(SELECT_CHAMADO_ANALICO)
        ->join('rh.usuarios as S', 'chamados.solicitante', '=', 'S.id', 'LEFT')
        ->join('rh.usuarios as A', 'chamados.atendente', '=', 'A.id', 'LEFT')
        ->join('rh.setores as ST', 'S.setor', '=', 'ST.id', 'LEFT')
        ->join('servicos', 'chamados.servico', '=', 'servicos.id')
        ->join('categorias', 'servicos.id_categoria', '=', 'categorias.id')
        ->join('status', 'chamados.status', '=', 'status.id', 'LEFT')
        ->whereNot('chamados.status', '5')
        ->whereDate('dt_criacao', '>=', $inicio)
        ->whereDate('dt_criacao', '<=', $fim)
        ->where('categorias.setor', session('user.setor'))
        ->where('chamados.status', 4)
        ->get();
        $dados= [
            'type' => 'analitico',
            'chamados' => $chamados,
            'data' => [
                        'inicio' => $this->formataData($inicio),
                        'fim' => $this->formataData($fim)
                      ]
        ];
        return view('chamado.pdf.gerador', $dados);
    }

    private function retornoTipoLista($tipo)
    {
        if(session('user.nivel') == 1 && $tipo != 'enviados') return false;
        elseif(!in_array($tipo, ['enviados', 'recebidos', 'todos'])) return false;
        return true;
    }

    private function pesquisaStatus($idChamado)
    {
        $pesquisaStatus = DB::table('chamados')->where('id', $idChamado)->first();
        return $pesquisaStatus->status;
    }

}
