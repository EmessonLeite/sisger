<?php
/** Aqui entra a lista de todos os funicionarios com link para os comentários */
?>

<section class="listagemCadastro">
    <div class="camposSection">
        <div id="lista-pessoas">
            <table id="funcionarios">
                <?php
                for ($i = 0; $i < count($usuariosAvaliacao); $i++) {
                    $usuario = $usuariosAvaliacao[$i];
                    if ($i % 4 == 0)
                        echo "<tr>";
                    ?>
                    <td>
                        <a href="<?php echo "paVisualizarComentarios/{$avaliacao[0]['referente']}/{$usuario['id']}"; ?>" class="funcionarios">
                            <img class="fotos-perfil" src="imagens/perfil/<?php echo $usuario['foto']; ?>"><br/>
                            <p class="nomes"><?php echo $usuario['apelido']; ?></p>
                        </a>
                    </td>
                    <?php
                    if ($i % 4 == 3)
                        echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <a href='#frmExcluir' name='frmExcluir' rel='leanModal' id='btnExcluir'></a>
</section>
