<?php

/** Inclui o arquivo de configurações gerais do projeto */
include_once('Classes/config.inc.php');

/** @var Url*/
$url = Url::getInstance();

if ($url->getURL(0) != 'login') {
    session_start();
    
    /**Verifica se a sessão existe */
    if(isset($_SESSION['id']) && is_int($_SESSION['id']) && is_string($_SESSION['apelido'])){
        /**
         * ID do usuario logado
         * @var int
         */
        $idUsuario = $_SESSION['id'];
        
        /**
         * Apelido do usuario logado
         * @var string
         */
        $apelido = $_SESSION['apelido'];

        /**
         * Foto do usuario logado
         * @var string
         */
        $foto = $_SESSION['foto'];
    }else{
        /** Caso não exista sessão, redireciona para a pagina de login */
        echo "<META http-equiv='refresh' content='0;URL=" . RAIZ . "login'> ";
        exit;
    }
    
    /** Incluindo o topo, conteudo e rodape */
    include_once('includes/inctopo.php');
    include_once('includes/incconteudo.php');
    include_once('includes/incrodape.php');
} else {
    include_once("includes/inc{$url->getURL(0)}.php");
}