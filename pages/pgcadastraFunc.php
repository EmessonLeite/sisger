<section class="listagemCadastro">
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
                        <td><a href='{$url->getURL(0)}/excluir/{$usuario['id']}'>Excluir</a></td>
                    </tr>
                ";
            }
            ?>

        </table>
        <!--
            <div class="paginacao">
                <input type="button" class="btnPaginacao" value="◄◄" onclick="window.location = ''"/>
                <input type="text" value="1"/> / 1
                <input type="button" class="btnPaginacao" value="►►" onclick="window.location = ''"/>
            </div>
        /-->
    </div>
</section>