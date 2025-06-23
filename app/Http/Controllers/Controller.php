<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

abstract class Controller
{
    public function __construct() {
        $hoje = date('Y-m-d');
        $ultimos30 = date('Y-m-d', strtotime('-30 days'));
        //Não iniciados adm
        define('TESTE', $ultimos30);
        define('NAO_INICIADO_ADM', DB::table('chamados')->where('status', 1)->count());
        define('NAO_INICIADO_ADM_30', DB::table('chamados')->where('status', 1)->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('NAO_INICIADO_ADM_CURRENT',
                    DB::table('chamados')
                        ->where('status', 1)
                        ->whereMonth('dt_conclusao', date('n'))
                        ->whereYear('dt_conclusao', date('Y'))->count());

        define('NAO_INICIADO_USER', DB::table('chamados')->where(['status' => 1, 'solicitante' => session('user_id')])->count());

        define('EM_EXECUCAO_ADM', DB::table('chamados')->where('status', 2)->count());
        define('EM_EXECUCAO_ADM_30', DB::table('chamados')->where('status', 2)->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('EM_EXECUCAO_USER', DB::table('chamados')->where(['status' => 2, 'solicitante' => session('user_id')])->count());

        define('PENDENTE_ADM', DB::table('chamados')->where('status', 2)->count());
        define('PENDENTE_ADM_30', DB::table('chamados')->where(['status' => 2])->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('PENDENTE_USER', DB::table('chamados')->where(['status' => 2, 'solicitante' => session('user_id')])->count());

        define('FINALIZADO_ADM', DB::table('chamados')->where('status', 4)->count());
        define('FINALIZADO_ADM_30', DB::table('chamados')->where('status', 4)->whereBetween('dt_criacao', [$ultimos30, $hoje])->count());
        define('FINALIZADO_ADM_CURRENT',
                    DB::table('chamados')
                        ->where('status', 4)
                        ->whereMonth('dt_conclusao', date('n'))
                        ->whereYear('dt_conclusao', date('Y'))->count());

        define('FINALIZADO_USER', DB::table('chamados')->where(['status' => 4, 'solicitante' => session('user_id')])->count());
        define('FINALIZADO_USER_CURRENT',
                    DB::table('chamados')
                        ->where('status', 4)
                        ->where('solicitante', session('user_id'))
                        ->whereMonth('dt_conclusao', date('n'))
                        ->whereYear('dt_conclusao', date('Y'))->count());

        define('NAO_VISTO_NAO_INICIADO_ADM', DB::table('chamados')->where(['status' => 1, 'visto_adm' => 0])->count());
        define('NAO_VISTO_EM_EXECUCAO_ADM', DB::table('chamados')->where(['status' => 2, 'visto_adm' => 0])->count());
        define('NAO_VISTO_EM_EXECUCAO_USER', DB::table('chamados')->where(['status' => 2, 'visto_user' => 0, 'solicitante' => session('user_id')])->count());
        define('NAO_VISTO_FINALIZADO_USER', DB::table('chamados')->where(['status' => 4, 'visto_user' => 0, 'solicitante' => session('user_id')])->count());
        define('NAO_VISTO_TODOS_ADM', DB::table('chamados')->where(['visto_adm' => 0])->count());
        define('TODOS_ADM', DB::table('chamados')->count());
        define('NAO_VISTO_TODOS_USER', DB::table('chamados')->where(['visto_user' => 0, 'solicitante' => session('user_id')])->count());
        define('TODOS_USER', DB::table('chamados')->where(['solicitante' => session('user_id')])->count());
    }

    protected function formataDataTime($data) {
        if($data == null) return '';
        $date = date_create($data);
        return date_format($date, 'd/m/Y H:i:s');
    }
}
