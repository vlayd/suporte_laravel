<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicoController extends Controller
{
    public function index()
    {
        $dados = [
            'categorias' => DB::table('categorias')->get(),
            'breadcrumb' => $this->breadcrumb([
                ['Gerenciar', route('servico')], ['Informações', route('servico')], ['Serviços']
            ]),
            'titulo' => 'Gerenciar Serviços',
            'servicos' => DB::table('servicos')
                                ->select(SELECT_SERVICOS_INDEX)
                                ->join('categorias', 'servicos.id_categoria', 'categorias.id')
                                ->get()
        ];
        return view('servico.index', $dados);
    }

    public function save(Request $request)
    {
        $nome = $request['nomeModal'];
        $id = $request['idModal'];
        $categoria = $request['categoriaModal'];
        $status = $request['statusModal']??0;
        $dados = [
            ['nome', $nome]
        ];
        if($id != '') $dados[] = ['id', '!=', $id];

        $pesquisa = DB::table('servicos')->where($dados)->count();
        if($pesquisa > 0) return 'A categoria já existe!';

        $dadosSave = [
            'nome' => $nome,
            'status' => $status,
            'id_categoria' => $categoria,
        ];
        if($id != '') DB::table('servicos')->where('id', $id)->update($dadosSave);
        else DB::table('servicos')->insert($dadosSave);
        return 'success';
    }
}
