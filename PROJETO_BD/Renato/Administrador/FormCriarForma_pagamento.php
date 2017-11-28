<?php
session_start();
session_destroy();

?>
<html>
<head>
    <title> Gerenciador de Contas </title>
</head>
<body>
<h1 align="center"> Criar Forma de Pagamento </h1>
<table align="center">
    <tr><td>
            <fieldset>
                <form method="post" action="CriarForma_pagamento.php">
                    <table align="center">
                        <td>Forma de Pagamento: </td>
                        <td><input type="text" name="formapagamento" required autofocus></td>
                        </tr>
                        <td></td>
                        <td align="center"><input type="submit" name="enviar" value="Enviar"> |
                            <input type="reset" name="limpar" value="Limpar"></td>

                    </table>
                </form>
            </fieldset>
        </td></tr>
</table>
</body>
</html>
