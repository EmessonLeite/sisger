<section>
    <table>
        <tr>
            <th>Nome Completo</th>
            <th>Nome Curto</th>
            <th>Email</th>
            <th>Cargo</th>
        </tr>
        <?php
        foreach ($dadosUsuarios as $usuario) {
            echo "<tr>
                    <td>{$usuario['nome']}</td>
                    <td>{$usuario['apelido']}</td>
                    <td>{$usuario['email']}</td>
                    <td>{$usuario['cargo']}</td>
                  </tr>";
        }
        ?>

    </table>
</section>