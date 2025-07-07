<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index()
    {
        $dados = [
            'categorias' => DB::table('categorias')->get()
        ];
        return view('categoria.index', $dados);
    }

    public function save(Request $request)
    {
        $nome = $request['nomeModal'];
        $id = $request['idModal'];
        $status = $request['statusModal']??0;
        if($nome == '') return 'Digite o nome!';
        $dados = [
            ['nome', $nome]
        ];
        if($id != '') $dados[] = ['id', '!=', $id];

        $pesquisa = DB::table('categorias')->where($dados)->count();
        if($pesquisa > 0) return 'A categoria já existe!';

        $dadosSave = [
            'nome' => $nome,
            'status' => $status
        ];
        if($id != '') DB::table('categorias')->where('id', $id)->update($dadosSave);
        else DB::table('categorias')->insert($dadosSave);
        return 'success';
    }
}
