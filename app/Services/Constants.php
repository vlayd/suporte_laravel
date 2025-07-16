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
    'SELECT_CHAMADO_ANALICO',
    [
        'chamados.dt_criacao',
        'chamados.atendente',
        'chamados.status',
        'S.setor AS numSetor',
        'A.nome AS nomeAtendente',
        'ST.nome AS nomeSetor',
        'servicos.nome AS nomeServico',
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
