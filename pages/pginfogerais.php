<link rel='stylesheet' href='../css/infogerais.css'/>
<div id="tabela-inf" class="tbConteudo">
    <div id="toda-infogerais">
        <div id="titulo">
            <label>Informações gerais</label>
        </div>

        <div id="conteudo-info">
            <p class="titulo-inf">Posto: <label class="sub-titulo-inf"><?php echo $dadosUsuarioAvaliacao[0]['cargo']; ?></label></p>

            <p class="titulo-inf">Entrou no projeto em: <label class="sub-titulo-inf"><?php echo $dadosUsuarioSelecionado[0]['dataEntrada']; ?></label></p>

            <p class="titulo-inf">E-mail: <label class="sub-titulo-inf"><?php echo $dadosUsuarioSelecionado[0]['email']; ?></label></p>

            <p class="titulo-inf">Telefone: <label class="sub-titulo-inf"><?php echo $dadosUsuarioSelecionado[0]['telefone']; ?></label></p>

            <p class="titulo-inf">Horas trabalhadas: <label class="sub-titulo-inf"><?php echo $dadosUsuarioAvaliacao[0]['horasTrabalhadas']; ?></label></p>

            <p class="titulo-inf">Folgas: <label class="sub-titulo-inf"><?php echo $dadosUsuarioAvaliacao[0]['folgas']; ?></label></p>

            <p class="titulo-inf">Faltas: <label class="sub-titulo-inf"><?php echo $dadosUsuarioAvaliacao[0]['faltas']; ?></label></p>

            <p class="titulo-inf">Atrasos: <label class="sub-titulo-inf"><?php echo $dadosUsuarioAvaliacao[0]['atrasos']; ?></label></p>

            <p class="titulo-inf">Vídeos / Livros: <label class="sub-titulo-inf"><?php echo $dadosUsuarioAvaliacao[0]['videosLivros']; ?></label></p>
        </div>

    </div>
</div>