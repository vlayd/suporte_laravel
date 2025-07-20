<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        // "SELECT COUNT(C.id),U.id AS idUser,C.id AS idCha,nome FROM `usuarios` AS U LEFT JOIN suporte.chamados AS C ON U.id = C.solicitante GROUP BY U.nome ORDER BY COUNT(C.id) DESC;";
        $dados = [
            'usuarios' => $this->usuariosTabela(),
            'breadcrumb' => $this->breadcrumb([
                ['Gerenciar', route('status')], ['Informações', route('status')], ['Status']
            ]),
            'titulo' => 'Lista de Usuários'
        ];

        return view('usuario.index', $dados);
    }

    public function tabela(Request $request)
    {
        $dados = [
            'usuarios' => $this->usuariosTabela($request['join']??''),
        ];
        return view('usuario.tabela', $dados);
    }

    private function usuariosTabela($join = '')
    {
        return DB::connection('rh')->table('usuarios AS U')
                ->select(['U.id AS idUser', 'C.id AS idCha', 'U.nome', 'U.foto', 'S.nome AS nomeSetor'])
                ->selectRaw('COUNT(C.id) AS qtChamado')
                ->join('rh.setores AS S', 'U.setor', '=', 'S.id', $join)
                ->join('suporte.chamados AS C', 'U.id', '=', 'C.solicitante', $join)
                ->groupBy('U.nome')
                ->orderByDesc('qtChamado')
                ->where('rh', 1)
                ->get();
    }

    public function atualiza()
    {
        $content = file_get_contents('https://setor-rh.com/lista_servidores.php?teste=');
        $servidores = json_decode($content);
        $situacao = ['Não', 'Sim'];
        foreach($servidores as $servidor){
            $fotoApi = str_replace(' ', '%20', $servidor->foto);
            $foto = explode('.', $servidor->foto);
            $nomeFoto = $servidor->id.'.'.end($foto);
            $pathFoto = PATH_FOTO.$servidor->id;
            $urlFoto = 'https://setor-rh.com/'.$fotoApi;
            $valores = [
                'nome' => $servidor->nome,
                'rh' => array_search($servidor->situacao, $situacao),
                'setor' => $servidor->setor,
                'foto' => $nomeFoto,
            ];
            $atributos = [
                'id' => $servidor->id,
            ];
            try {
                DB::connection('rh')->table('usuarios')->updateOrInsert($atributos, $valores);
                if(!$this->verificaLink($urlFoto) || $nomeFoto == 'no-image.png') continue;
                $img = $pathFoto.'/'.$nomeFoto;
                if(!file_exists($img)){
                    if(!file_exists($pathFoto)) mkdir($pathFoto, 0755, true);
                    file_put_contents($img, file_get_contents($urlFoto));
                }
            } catch (\Throwable $th) {
                continue;
            }
        }
        echo 'success';
    }
}
