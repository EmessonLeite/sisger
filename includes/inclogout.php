<?php
/** Destroy a sessão e redireciona para a pagina */
session_destroy();
echo "<META http-equiv='refresh' content='0;URL=" . RAIZ . "login'> ";
exit;
