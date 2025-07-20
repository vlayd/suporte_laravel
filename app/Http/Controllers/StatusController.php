<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function index()
    {
        $dados = [
            'status' => DB::table('status')->get(),
            'breadcrumb' => $this->breadcrumb([
                ['Gerenciar', route('status')], ['Informações', route('status')], ['Status']
            ]),
            'titulo' => 'Gerenciar Status'
        ];
        return view('status.index', $dados);
    }

    public function save(Request $request)
    {
        $nome = $request['nomeModal'];
        $id = $request['idModal'];
        if($nome == '') return 'Digite o nome!';
        $dados = [
            ['nome', $nome]
        ];
        if($id != '') $dados[] = ['id', '!=', $id];

        $pesquisa = DB::table('status')->where($dados)->count();
        if($pesquisa > 0) return 'A categoria já existe!';

        $dadosSave = [
            'nome' => $nome,
        ];
        DB::table('status')->where('id', $id)->update($dadosSave);
        return 'success';
    }
}
