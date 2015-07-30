<?php

/** @var string */
$erro = "";

/** @var Horario */
$horarioBusiness = Horario::getInstance();

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//ABRIR HORARIO ################################################################
if (isset($form['abrirHorario'])) {
    /** remove o indice abrirHorario do array */
    unset($form['abrirHorario']);

    /** Insere o ID do usuario no array */
    $form['idUsuario'] = $idUsuario;

    /** Tenta abrir um novo horario, caso não consiga, exibe uma mensagem de erro */
    try {
        $horarioBusiness->DarEntrada($form);
    } catch (Exception $e) {
        $erro = "<div id='erro'>{$e->getMessage()}</div>";
    }
}
//FECHAR HORARIO ###############################################################
if(isset($form['entradaSaida']) && $form['entradaSaida'] === 'Dar saída'){
    /** remove o indice entradaSaida do array */
    unset($form['entradaSaida']);

    /** Tenta fechar o horario, caso não consiga, exibe uma mensagem de erro */
    try {
        $horarioBusiness->DarSaida($idUsuario);
    } catch (Exception $e) {
        $erro = "<div id='erro'>{$e->getMessage()}</div>";
    }
}

//CORRIGIR HORARIO #############################################################
if (isset($form['corrigir'])) {
    /** remove o indice abrirHorario do array */
    unset($form['corrigir']);

    /** Insere o ID do usuario no array */
    $form['idUsuario'] = $idUsuario;
    
    /** Tenta abrir um novo horario, caso não consiga, exibe uma mensagem de erro */
    try {
        $horarioBusiness->Corrigir($form);
    } catch (Exception $e) {
        $erro = "<div id='erro'>{$e->getMessage()}</div>";
    }
}

//EXCLUIR HORARIO ##############################################################
if(isset($form['excluir'])) {
    $horarioBusiness->Deletar($form['idExcluido']);
}

//EXIBIR HORARIOS ##############################################################
$btnLabel = (!count($horarioBusiness->buscarAberto($idUsuario))) ? "Dar entrada" : "Dar saída" ;

/** @var array dados para filtrar os horarios */
$filtro = array(
    "idUsuario" => $idUsuario,
    "dataInicio" => "1970-01-01 00:00:00",
    "dataFim" => "2100-01-01 00:00:00"
);

/** @var array horarios do usuarios selecionado */
$horarios = $horarioBusiness->BuscarHorarios($filtro);

/** @var array usuarios que utilizam o ponto */
$usuarios = $horarioBusiness->getUsuarios();

/** Inclue a pagina inicial do ponto */
include_once('pages/pgpwHome.php');
