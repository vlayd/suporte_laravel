<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Services\Operations;

abstract class Controller
{
    public function __construct()
    {
        // $hoje = date('Y-m-d', strtotime('+1 days'));
        // $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        // //Não iniciados adm
        define(
            'TODOS',
            [
                'nao_visto' =>
                [
                    'setor' => $this->tabelaChamados(naoVisto: true, setor: session('user.setor')),
                    'todos' => $this->tabelaChamados(naoVisto: true),
                ],

            ]
        );
        define(
            'NAO_INICIADO',
            [
                'setor' =>
                [
                    '30' => $this->tabelaChamados('1', periodo: true, setor: session('user.setor')),
                    'todos' => $this->tabelaChamados('1', setor: session('user.setor')),
                ],
                'nao_visto' =>
                [
                    '30' => $this->tabelaChamados('1', periodo: true, naoVisto: true),
                    'todos' => $this->tabelaChamados('1', naoVisto: true),
                ],
                'todos' =>
                [
                    '30' => $this->tabelaChamados('1', periodo: true),
                    'todos' => $this->tabelaChamados('1'),
                ],
            ]
        );
        define(
            'EM_EXECUCAO',
            [
                'setor' => [
                    '30' => $this->tabelaChamados('2', periodo: true, setor: session('user.setor')),
                    'todos' => $this->tabelaChamados('2', setor: session('user.setor')),
                ],
                'nao_visto' => [
                    '30' => $this->tabelaChamados('2', periodo: true, naoVisto: true),
                    'todos' => $this->tabelaChamados('2', naoVisto: true),
                ],
                'todos' => [
                    '30' => $this->tabelaChamados('2', periodo: true),
                    'todos' => $this->tabelaChamados('2'),
                ],
            ]
        );
        define(
            'PENDENTE',
            [
                'setor' => [
                    '30' => $this->tabelaChamados('3', periodo: true, setor: session('user.setor')),
                    'todos' => $this->tabelaChamados('3', setor: session('user.setor')),
                ],
                'nao_visto' => [
                    '30' => $this->tabelaChamados('3', periodo: true, naoVisto: true),
                    'todos' => $this->tabelaChamados('3', naoVisto: true),
                ],
                'todos' => [
                    '30' => $this->tabelaChamados('3', periodo: true),
                    'todos' => $this->tabelaChamados('3'),
                ],
            ]
        );
        define(
            'FINALIZADO',
            [
                'setor' => [
                    '30' => $this->tabelaChamados('4', periodo: true, setor: session('user.setor')),
                    'todos' => $this->tabelaChamados('4', setor: session('user.setor')),
                ],
                'nao_visto' => [
                    '30' => $this->tabelaChamados('4', periodo: true, naoVisto: true),
                    'todos' => $this->tabelaChamados('4', naoVisto: true),
                ],
                'todos' => [
                    '30' => $this->tabelaChamados('4', periodo: true),
                    'todos' => $this->tabelaChamados('4'),
                ],
            ]
        );
    }

    protected function formataDataTime($data)
    {
        if ($data == null) return '';
        $date = date_create($data);
        return date_format($date, 'd/m/Y H:i:s');
    }

    protected function formataData($data)
    {
        if ($data == null) return '';
        $date = date_create($data);
        return date_format($date, 'd/m/Y');
    }

    private function getWhere($idStatus = '', $naoVisto = '')
    {
        $where = [];
        if ($idStatus != '') $where['chamados.status'] = $idStatus;
        if (session('user.nivel') == 1) $where['solicitante'] = session('user.id');
        if ($naoVisto != '') {
            if (session('user.nivel') == 1) $where['visto_user'] = $naoVisto;
            else $where['visto_adm'] = $naoVisto;
        }
        return $where;
    }

    protected function uploadFile($anexo, $idChamado, $chat = 0)
    {
        $nomeName = $anexo->getClientOriginalName();
        $fileName = time() . '.' . $anexo->extension();
        $anexo->move(public_path(PATH_UPLOAD_CHAMADO . $idChamado), $fileName);

        $dados = [
            'nome' => $nomeName,
            'arquivo' => $fileName,
            'id_chamado' => $idChamado,
            'chat' => $chat,
        ];
        DB::table('anexos')->insert($dados);
    }

    protected function uploadFileMultiple($anexos, $idChamado, $chat = 0)
    {
        $i = 0;
        foreach ($anexos as $anexo) {
            $nomeName = $anexo->getClientOriginalName();
            $fileName = time() . $i . '.' . $anexo->extension();
            $anexo->move(public_path(PATH_UPLOAD_CHAMADO . $idChamado), $fileName);

            $dados = [
                'nome' => $nomeName,
                'arquivo' => $fileName,
                'id_chamado' => $idChamado,
                'chat' => $chat,
            ];
            DB::table('anexos')->insert($dados);
            $i++;
        }
    }

    protected function breadcrumb(array $list)
    {
        $breadcrumb = '<nav aria-label="breadcrumb">
                            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                                <li class="breadcrumb-item text-white">
                                    <a class="text-white" href="' . asset('') . '">
                                        <i class="fas fa-home text-white text-sm opacity-10"></i>
                                    </a>
                                </li>';
        foreach ($list as $item) {
            $item1 = 'opacity-5 active';
            $item2 = 'aria-current="page"';
            $item3 = '<h6 class="font-weight-bolder mb-0 text-white">' . $item[0] . '</h6>';
            $nome = $item[0];
            if (isset($item[1])) {
                $item1 = '';
                $item2 = '';
                $item3 = '';
                $nome = '<a class="text-white" href="' . $item[1] . '">' . $item[0] . '</a>';
            }
            $breadcrumb .= '<li class="breadcrumb-item text-white ' . $item1 . '" ' . $item2 . '>' . $nome . '</li>';
        }
        return $breadcrumb . '</ol>' . $item3 . '</nav>';
    }

    protected function decriptId($id)
    {
        $id = Operations::decriptId($id);
        if ($id == null || $id == '') return redirect()->route('index');
        else return $id;
    }

    protected function deleteAnexo($path, $nome)
    {
        try {
            if (file_exists($path . '/' . $nome)) {
                unlink($path . '/' . $nome);
                return true;
            }
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected function verificaLink($link)
    {
        // $link = str_replace(' ', '%20', $link);
        $file_headers = @get_headers($link);
        if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') return false;
        else return true;
    }

    protected function tabelaChamados($idStatus = '', $naoVisto = false, $periodo = false, $setor = '')
    {
        $vistoPor = 'visto_user';
        if (session('user.nivel') != 1)  $vistoPor = 'visto_adm';

        $hoje = date('Y-m-d');
        $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        $query = DB::table('chamados')
                    ->join('servicos', 'chamados.servico', '=', 'servicos.id', 'LEFT')
                    ->join('categorias', 'servicos.id_categoria', '=', 'categorias.id');
        if ($idStatus != '') $query->where('chamados.status', $idStatus);
        if ($naoVisto) $query->where($vistoPor, 0);
        if ($periodo)  $query->whereDate('dt_criacao', '>=', $ultimos30)->whereDate('dt_criacao', '<=', $hoje);
        if (!empty($setor))  $query->where('categorias.setor', session('user.setor'));
        if (session('user.nivel') == 1) $query->where('solicitante', session('user.id'));
        if (session('user.nivel') == 3) $query->where('categorias.setor', session('user.setor'));
        return $query->count();
    }

    public static function  quatidadeVisto($statusChamado, $visto, $idCategoria)
    {
        $conta = DB::table('chamados')
                    ->join('servicos', 'chamados.servico', '=', 'servicos.id', 'LEFT')
                    ->join('categorias', 'servicos.id_categoria', '=', 'categorias.id')
                    ->where([
                        'chamados.status' => $statusChamado,
                        'visto_adm' => $visto,
                        'categorias.id' => $idCategoria,
                    ])->count();
        if($conta > 0 && $visto==0) return '<span class="text-danger fw-bold">'.$conta.'</span>';
        return $conta;
    }
}
