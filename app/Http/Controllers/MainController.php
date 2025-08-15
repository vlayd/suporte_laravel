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
            'categorias30' => $this->listaMain(periodo: '30'),
            'categorias' => $this->listaMain(),
            'servicos30' => $this->listaMain('S', periodo: '30'),
            'servicos' => $this->listaMain('S'),
            'naoIniciados' => ['todos' => $this->tabelaChamados('1'), '30' => $this->tabelaChamados('1'), 'nao_visto' => $this->tabelaChamados('1')],
            'emExecucao' => ['todos' => $this->tabelaChamados('1'), '30' => $this->tabelaChamados('1'), 'nao_visto' => $this->tabelaChamados('1')],
            'pendentes' => ['todos' => $this->tabelaChamados('1'), '30' => $this->tabelaChamados('1'), 'nao_visto' => $this->tabelaChamados('1')],
            'finalizados' => ['todos' => $this->tabelaChamados('1'), '30' => $this->tabelaChamados('1'), 'nao_visto' => $this->tabelaChamados('1')],
            'breadcrumb' => $this->breadcrumb([
                ['Home']
            ]),
            'activeHome' => 'active'
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

    //O default C é categoria e o outro é S, serviço
    private function listaMain($item = 'C', $join = 'inner', $periodo = '')
    {
        $hoje = date('Y-m-d');
        $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        $query = DB::table('chamados AS CH')
                ->select(["$item.nome AS nome", "$item.id AS id", 'CH.dt_criacao', 'CH.visto_adm', 'CH.status'])
                ->selectRaw("COUNT($item.nome) AS quantidade")
                ->join('servicos AS S', 'CH.servico', '=', 'S.id')
                ->join('categorias AS C', 'S.id_categoria', '=', 'C.id', $join)
                ->groupBy("$item.nome")
                ->orderByDesc('quantidade')
                ->whereNot('CH.status', 4);
        if($periodo == '30') $query = $query->whereDate('dt_criacao', '<=', $hoje)->whereDate('dt_criacao', '>=', $ultimos30);
        return $query->get();
    }
}
