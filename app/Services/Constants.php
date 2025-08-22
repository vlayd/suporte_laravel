<?php
//________________________TEXTOS BASE________________________________
define('URL_BASE', 'http://10.51.3.227/');
define('NAME_APP', 'Suporte');

//________________________PATH_______________________________________
define('CDN', URL_BASE.'cdn/');
define('CDN_JS', URL_BASE.'cdn/assets/js/');
define('CDN_ASSETS', URL_BASE.'cdn/assets/');
define('CDN_JS_INIT', URL_BASE.'cdn/assets/js/init/');
define('CDN_JS_CORE', URL_BASE.'cdn/assets/js/core/');
define('CDN_JS_PLUGINS', URL_BASE.'cdn/assets/js/plugins/');
define('CDN_FONTAWESOME', URL_BASE.'cdn/assets/fontawesome/');

define('RH_USUARIOS', URL_BASE.'rh/public/assets/upload/usuarios/');

define('PATH_APOIO', 'assets/img/apoio/');
define('PATH_PERFIL', 'assets/upload/perfil/');
define('PATH_UPLOAD', 'assets/upload/');
define('PATH_UPLOAD_CHAMADO', 'assets/upload/chamado/');
define('PATH_FOTO', 'assets/upload/perfil/');

//________________________JS_______________________________________
define('CDN_JS_CORE_ALL', '
<script src="'.CDN_JS_CORE.'jquery-3.6.0.min.js"></script>
<script src="'.CDN_JS_CORE.'popper.min.js"></script>
<script src="'.CDN_JS_CORE.'bootstrap.min.js"></script>
');

define('CDN_JS_FONTAWESOME_ALL', '
<script src="'.CDN_FONTAWESOME.'js/all.min.js"></script>
<script src="'.CDN_FONTAWESOME.'fontawesome/js/all.min.js"></script>
');

define('CDN_JS_DATATABLES', '
<script src="'.CDN_JS_PLUGINS.'datatables.js"></script>
<script src="'.CDN_JS_INIT.'datatables.js"></script>
');

define('CDN_JS_MASK', '
<script src="'.CDN_JS_PLUGINS.'jquery.mask.min.js"></script>
<script src="'.CDN_JS_INIT.'jquery.mask.js"></script>
');

define('CDN_JS_TOAST', '
<script src="'.CDN_JS_PLUGINS.'jquery.toast.min.js"></script>
<script src="'.CDN_JS_INIT.'jquery.toast.js"></script>
');

define('CDN_JS_SWEETALERT2', '
<script src="'.CDN_JS_PLUGINS.'sweetalert2.min.js"></script>
<script src="'.CDN_JS_INIT.'sweetalert2.js"></script>
');

//________________________ARRAYS UTEIS________________________________
define('EXTENSION_IMG', [
    'pdf' => PATH_APOIO.'pdf.jpg',
    'xls' => PATH_APOIO.'excel.png',
    'xlsx' => PATH_APOIO.'excel.png',
    'doc' => PATH_APOIO.'word.jpg',
    'docx' => PATH_APOIO.'word.jpg',
    'jpg' => PATH_APOIO.'picture.png',
    'jpeg' => PATH_APOIO.'picture.png',
    'png' => PATH_APOIO.'picture.png',
    'gif' => PATH_APOIO.'picture.png',
    'file' => PATH_APOIO.'file.png',
]);


// ________________SELECT____________________
define(
    'SELECT_CHAMADO_INDEX',
    [
        'chamados.id AS idChamado',
        'chamados.dt_criacao',
        'chamados.atendente',
        'chamados.solicitante',
        'chamados.dt_conclusao',
        'chamados.dt_alteracao',
        'chamados.titulo',
        'chamados.status',
        'chamados.visto_adm',
        'chamados.visto_user',
        'chamados.observacao',
        'S.nome AS nomeSolicitante',
        'A.nome AS nomeAtendente',
        'servicos.nome AS nomeServico',
        'categorias.setor AS setorCategoria',
        'status.cor',
        'status.nome AS nomeStatus'
    ]
);

define(
    'SELECT_CHAMADO_ANALICO',
    [
        'chamados.dt_criacao',
        'chamados.atendente',
        'chamados.status',
        'chamados.observacao',
        'S.setor AS numSetor',
        'A.nome AS nomeAtendente',
        'ST.nome AS nomeSetor',
        'ST.sigla AS siglaSetor',
        'servicos.nome AS nomeServico',
        'status.nome AS nomeStatus',
        'categorias.setor',
    ]
);

define(
    'SELECT_CHAMADO_EDIT',
    [
        'chamados.id AS idChamado',
        'chamados.dt_criacao',
        'chamados.titulo',
        'chamados.status',
        'chamados.solicitante',
        'chamados.descricao',
        'chamados.servico',
        'servicos.id_categoria AS idCategoria',
        'servicos.nome AS nomeServico',
    ]
);

define(
    'SELECT_CHAMADO_DETAIL',
    [
        'chamados.id AS idChamado',
        'chamados.dt_criacao',
        'chamados.atendente',
        'chamados.solicitante',
        'chamados.dt_conclusao',
        'chamados.dt_criacao',
        'chamados.titulo',
        'chamados.descricao',
        'chamados.status AS statusChamado',
        'chamados.visto_adm',
        'chamados.visto_user',
        'S.nome AS nomeSolicitante',
        'A.nome AS nomeAtendente',
        'ST.nome AS nomeSetor',
        'servicos.nome AS nomeServico',
        'categorias.nome AS categoria',
        'categorias.setor AS setorCategoria',
        'status.cor',
        'status.nome AS nomeStatus'
    ]
);

define(
    'SELECT_CHAT_DETAIL',
    [
        'chat.id AS idChat',
        'chat.id_chamado',
        'chat.id_usuario',
        'chat.texto',
        'chat.data',
        'U.nome',
        'U.foto',
    ]
);

define(
    'SELECT_SERVICOS_INDEX',
    [
        'servicos.id AS idServico',
        'servicos.nome AS nomeServico',
        'servicos.status',
        'categorias.id AS idCategoria',
        'categorias.nome AS nomeCategoria',
    ]
);

define(
    'SELECT_CATEGORIA_SETOR',
    [
        'categorias.id AS id',
        'categorias.nome AS nome',
        'categorias.status',
        'rh.setores.id AS idSetor',
        'rh.setores.nome AS setor',
    ]
);
