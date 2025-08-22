<?php use Mpdf\Mpdf;

$listaChamados = '';
$nomeRelatorio = 'relatorio'.str_replace('/', '', $data['inicio']).'_'.str_replace('/', '', $data['fim']).'.pdf';
foreach($chamados as $chamado){
    $date = date_create($chamado->dt_criacao);
    $dateFormatada = date_format($date, 'd/m/Y');
    $atendente = explode(' ', $chamado->nomeAtendente)[0];
    $listaChamados .= '
        <tr>
            <td class="tdData">'.$dateFormatada.'</td>
            <td class="tdServico">'.$chamado->nomeServico.'</td>
            <td class="tdSetor">'.$chamado->siglaSetor.'</td>
            <td class="tdAtendente">'.$atendente.'</td>
            <td class="tdStatus">'.$chamado->nomeStatus.'</td>
            <td class="tdObs">'.$chamado->observacao.'</td>
        </tr>
    ';
}
$html = '
<html>
    <head>
        <title>Relatório</title>
        <style>
            table {
                width: 100%;
            }
            table {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
            }
            th {
                background-color: #66c08a;
            }
            .thtop {
                color: black;
            }
            .tdData{
                width: 10%;
            }
            .tdStatus{
                width: 12%;
            }
            td.tdTipo {
                text-align: left;
                padding-left: 40mm;
                width: 50%;
            }
            td {
                text-align: center;
            }
            .card_setor {
                border: 1px solid black;
                border-bottom-style: none;
                border-radius: 7px 7px 0 0;
                height: 20px;
                background: #01963D;
                width: 100%;
                margin-top: 7mm;
                text-align: center;
                padding: 8px 12px;
            }
            .card_foot {
                border: 1px solid black;
                border-top-style: none;
                border-radius: 0 0 7px 7px;
                height: 20px;
                background: #01963D;
                width: 100%;
                text-align: right;
                padding: 8px 12px;
            }

            tbody tr:nth-child(even) {
                background-color: #DFF2E6;
            }
            .titulo {
                font-weight: bold;
                font-size: 1.5em;
                text-align: center;
                margin-bottom:12px;
            }
            .dados {
                text-align: center;
            }
            .images {
            }
            .logproc {
                height: 20mm;
                margin-left: 95mm;
            }
            .loggov {
                height: 20mm;
            }
            .imgTipo {
                width: 10mm;
                height: 7mm;
            }

            .info_all {
                font-size: 9px;
                margin-top: 1mm;
                margin-bottom: -1mm;
            }
            .info_all, .info_footer, .info_footer1, .info_footer2, .info_footer3 {
                border: none;
            }
            .info_footer1 {
                text-align: left;
                width: 20%;
            }
            .info_footer2 {
                text-align: center;
            }
            .info_footer3 {
                text-align: right;
                width: 20%;
            }

            .tb_total {
                margin-top: 12mm;
            }
            .geral {
                text-align: right;
            }

        </style>
    </head>

    <body>
        <h2 class="dados">Relatório de Atividades de '.$data['inicio'].' a  '.$data['fim'].'</h2>
        <table>
            <thead>
                <tr>
                    <th><div class="thtop">Data</div></th>
                    <th><div class="thtop">Serviço</div></th>
                    <th><div class="thtop">Setor</div></th>
                    <th><div class="thtop">Atendente</div></th>
                    <th><div class="thtop">Status</div></th>
                    <th><div class="thtop">Observação</div></th>
                </tr>
            </thead>
            <tbody>'.
            $listaChamados
            .'</tbody>
        </table>
    </body>
</html> ';

$mpdf = new Mpdf();
$mpdf->SetHTMLHeader('
<div class="images">
    <img class="loggov" src="assets/img/apoio/imggov.png" alt="">
    <img class="logproc" src="assets/img/apoio/logo.png" alt="">
</div>
', write: true);
$mpdf->defaultfooterline = 0;
$mpdf->SetHTMLFooter('
<hr>
<div style="font-size: 0.7em;">
    <div style="text-align: center;">
        Endereço: Avenida Nações Unidas, nº 2870 - Estaçao Experimental - CEP 69.918-172, Rio Branco<br>
        Telefone: (068) 3223-7000. E-mal: procon.acre@gmail.com
    </div>
    <table class="info_all">
        <tr class="info_footer">
            <td class="info_footer1">Gerado em: {DATE d/m/Y} às '.date("H:i:s", strtotime('+2 hours')).'</td>
            <td class="info_footer2">Relatório Analítico de Chamados da TI</td>
            <td class="info_footer3">{PAGENO}/{nbpg}</td>
        </tr>
    </table>
</div>

');
// echo $html;exit;
$mpdf->AddPage('L', mgh: 2, mgt: 30, mgb: 20, mgf: 2, mgr: 10, mgl: 10);
$mpdf->WriteHTML($html);
$mpdf->Output($nomeRelatorio, 'I');
exit;
