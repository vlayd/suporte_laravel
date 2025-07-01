<?php

define('NAME_APP', 'Suporte TI');

define('PATH_APOIO', 'assets/img/apoio/');
define('PATH_UPLOAD', 'assets/upload/chamado/');

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

define(
    'SELECT_CHAMADO_INDEX',
    [
        'chamados.id AS idChamado',
        'chamados.dt_criacao',
        'chamados.atendente',
        'chamados.solicitante',
        'chamados.dt_conclusao',
        'chamados.titulo',
        'chamados.status',
        'chamados.visto_adm',
        'chamados.visto_user',
        'S.nome AS nomeSolicitante',
        'A.nome AS nomeAtendente',
        'servicos.nome AS nomeServico',
        'status.cor',
        'status.nome AS nomeStatus'
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
        'servicos.id AS idServico',
        'servicos.id_categoria AS idCategoria',
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
        'servicos.nome AS nomeServico',
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
        'chat.anexo',
        'anexos.arquivo',
        'U.nome',
        'U.foto',
    ]
);
