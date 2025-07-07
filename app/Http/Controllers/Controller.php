<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Services\Operations;

abstract class Controller
{
    public function __construct() {
        $hoje = date('Y-m-d', strtotime('+1 days'));
        $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        //Não iniciados adm
        define('TESTE', $this->getWhere(1));
        define('NAO_INICIADO', DB::table('chamados')->where($this->getWhere(1))->count());
        define('NAO_INICIADO_30', DB::table('chamados')->where($this->getWhere(1))->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('NAO_INICIADO_CURRENT',
                    DB::table('chamados')
                        ->where('status', 1)
                        ->whereMonth('dt_conclusao', date('n'))
                        ->whereYear('dt_conclusao', date('Y'))->count());
        define('NAO_INICIADO_NAO_VISTO', DB::table('chamados')->where($this->getWhere(1, 0))->count());

        define('EM_EXECUCAO', DB::table('chamados')->where($this->getWhere(2))->count());
        define('EM_EXECUCAO_30', DB::table('chamados')->where($this->getWhere(2))->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('EM_EXECUCAO_NAO_VISTO', DB::table('chamados')->where($this->getWhere(2, 0))->count());

        define('PENDENTE', DB::table('chamados')->where($this->getWhere(3))->count());
        define('PENDENTE_30', DB::table('chamados')->where($this->getWhere(3))->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('PENDENTE_NAO_VISTO', DB::table('chamados')->where($this->getWhere(3, 0))->count());

        define('FINALIZADO', DB::table('chamados')->where($this->getWhere(4))->count());
        define('FINALIZADO_30', DB::table('chamados')->where($this->getWhere(4))->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('FINALIZADO_ADM_CURRENT',
                    DB::table('chamados')
                        ->where('status', 4)
                        ->whereMonth('dt_conclusao', date('n'))
                        ->whereYear('dt_conclusao', date('Y'))->count());
        define('FINALIZADO_NAO_VISTO', DB::table('chamados')->where($this->getWhere(4, 0))->count());
        define('NAO_VISTO', DB::table('chamados')->where($this->getWhere(naoVisto: 0))->count());

    }

    protected function formataDataTime($data) {
        if($data == null) return '';
        $date = date_create($data);
        return date_format($date, 'd/m/Y H:i:s');
    }

    private function getWhere($idStatus = '', $naoVisto = '')
    {
        $where = [];
        if($idStatus != '') $where['status'] = $idStatus;
        if(session('user.nivel') == 1) $where['solicitante'] = session('user.id');
        if($naoVisto != ''){
            if(session('user.nivel') == 1) $where['visto_user'] = $naoVisto;
            else $where['visto_adm'] = $naoVisto;
        }
        return $where;
    }

    protected function uploadFile($anexo, $idChamado, $chat = 0)
    {
        $nomeName = $anexo->getClientOriginalName();
        $fileName = time().'.'.$anexo->extension();
        $anexo->move(public_path(PATH_UPLOAD.$idChamado), $fileName);

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
            $fileName = time().$i.'.'.$anexo->extension();
            $anexo->move(public_path(PATH_UPLOAD.$idChamado), $fileName);

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

    protected function decriptId($id)
    {
        $id = Operations::decriptId($id);
        if($id == null || $id == '') return redirect()->route('index');
        else return $id;
    }

    protected function deleteAnexo($path, $nome) {
        try{
            if(file_exists($path.'/'.$nome)){
                unlink($path.'/'.$nome);
                return true;
            }
        } catch(\Throwable $e){
            return false;
        }
    }
}
