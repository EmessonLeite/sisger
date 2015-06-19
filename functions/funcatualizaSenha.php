<?php
    function atualizaSenha($senha, $id) {

        /** Conecta com o banco */
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBSA,USER, PASS);

        /** Escreve a query que atualiza a senha*/
        $atualiza = $pdo->prepare("UPDATE usuarios set senha = PASSWORD(?) WHERE id = ?");
        $atualiza->bindValue(1, $senha);
        $atualiza->bindValue(2, $id);

        /** Execulta a query */
        $atualiza->execute();

        /** Se tiver atualizado retorna verdadeiro se não falso */
        return ($atualiza->rowCount() == 1) ? true : false;
    }
?>