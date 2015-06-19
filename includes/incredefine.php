<?php

/**
 * @var string $erro
 * Cria a variavel que vai fazer a interação com o usuario
 */
$erro = '';

/** Inclui a função de atualizar a senha */
require_once('functions/funcatualizaSenha.php');

/**
 * @var int $parametro
 * Decodifica a hora que o usuario solicitou o email que está concatenada com o id do usuario
 */
$parametro = base64_decode($url->getURL(1));

/**
 * @var int $data
 * Recupera a data que o usuario solicitou o email em segundos
 */
$data = substr($parametro, 0, 10);

/**
 * @var int $dataAtual
 * Pega a data atual em segundos
 */
$dataAtual = strtotime(date("Y-m-d H:i:s"));

/**
 * @var int $id
 * Recupera o id do usuario que solicitou o email
 */
$id = substr($parametro, 10);

/** Checa se o limite de 30 minutos para recuperar a senha foi atingido */
if ($dataAtual < $data + 1800) {
    /**
     * Verifica se foi enviado via POST o form
     */
    if (isset($_POST['enviar']) && is_string($_POST['enviar'])) {
        /**
         * @var string $senha
         * @var string $confSenha
         */
        $senha = $_POST['senha'];
        $confSenha = $_POST['confsenha'];

        /** Checa a as senha informadas são iguais */
        if ($senha == $confSenha) {
            /** Chama a função de atualizar senha */
            if (atualizaSenha($senha, $id)) {
                /**
                 * @var string $info
                 * Informa o usuario da redefinição de senha
                 */
                $info = "Senha redefinida com sucesso.";

                /** Redireciona pro login */
                echo "<meta http-equiv='refresh' content=1;url='" . RAIZ . "login'>";
            } else {
                /**
                 * @var string $erro
                 * Informa o usuario se não foi possivel redefinir a senha
                 */
                $erro = "Erro ao redefinir senha. Digite novamente.";
            }
        } else {
            /**
             * @var string $erro
             * Informa o usuario se as senha não forem iguais
             */
            $erro = "As senha não combinam. Digite novamente.";
        }
    }
} else {
    /**
     * @var string $erro
     * Informa o usuario que o limite de 30 minutos foi atingido
     */
    $erro = "O link expirou. Solicite outro email.";

    /** Redireciona o usuario para a pagina de encio de email */
    echo "<meta http-equiv='refresh' content=5;url='" . RAIZ . "recuperaSenha'>";
}

/**
 * @var string $info
 * @var string $erro
 * Retorna alguma interação para o usuario
 */
$erro = ($erro != '') ? "<p id='erro'>{$erro}</p>" : '';
$info = (isset($info)) ? "<p id='info'>{$info}</p>" : '';

/** Inclui a pagina de redefinição de senha */
include_once('pages/pgredefine.php');
