<section class="listagemCadastro">
    <?php echo $erroExcluir; ?>
    <div class="camposSection">
        <table class="listagem">
            <input name="enviar" class="novo" type="submit" value="Novo Funcionário" onclick="window.location = '<?php echo $url->getURL(0); ?>/novo';"/>
            <form method="post" name="frmPesquisa" id="frmPesquisa">
                <input type="text" class="pesquisa" id="filtro" name="filtro" value=""/>
            </form>
            <tr>
                <th>Nome Completo</th>
                <th>E-mail</th>
                <th>Cargo</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php
            foreach ($dadosUsuarios as $usuario) {
                echo "
                    <tr>
                        <td>{$usuario['nome']}</td>
                        <td>{$usuario['email']}</td>
                        <td>{$usuario['cargo']}</td>
                        <td><a href='{$url->getURL(0)}/editar/{$usuario['id']}'>Editar</a></td>
                        <td><a class='exluirFuncionario' href='{$usuario['id']}'>Excluir</a></td>
                    </tr>
                ";
            }
            ?>

        </table>
    </div>
    <a href='#frmExcluir' name='frmExcluir' rel='leanModal' id='btnExcluir'></a>
</section>

<div id="frmExcluir" class="caixaComentarios">
    <form action="" class="frmComentarios">
        <div>
            <p>Excluir funcionario</p>
            <a class="modal_close"></a>
        </div>
        <div>
            <p>Deseja excluir este usuario?</p>
            <input type="button" value="Excluir" id="confirmarExcluir" />
            <input type="hidden" id="idUsuarioExcluido" />
            <input type="button" value="Cancelar" />
        </div>
    </form>
</div>