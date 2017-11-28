<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../Style.css" type="text/css" rel="stylesheet">
    <?php
    session_start();
    if(!isset($_SESSION['user']))
        header("location: /Estudo Dirigido Banco de Dados/Login/Login.php");
    require '../banco_de_dados.php';
    ?>
</head>
<body>
<header>
    <div id="bemvindo">
        <h2>Gerenciador de Contas</h2>
        <div class="msg_bemvindo"><h1>Bem Vindo, <?php echo $_SESSION['user']?></h1></div>
    </div>
</header>
<div id="principal">
    <nav>
        <div class="menu">
            <a href="../Index.php">Inicio</a>
            <a href="Nova_Transacao.php">Nova Transação</a>
            <a href="#">Relatorios</a>
            <a href="Administrador.php">Administrador</a>
            <a href="Sair.php">Sair</a>
        </div>
    </nav>
    <div id="transacoes">
        <h3>Cadastro de Banco</h3><br><br>
        <fieldset>
            <table align="center">
                        <form method="post" action="Criarbanco.php">
                            <table align="center">
                                <tr>
                                    <td><strong>Nome do banco: </strong></td>
                                    <td><input style="width: 600px" class="input" type="text" name="nomebanco" required autofocus></td>
                                    <td align="center"><input type="submit" name="enviar" value="Enviar"> |
                                    <td><input type="reset" name="limpar" value="Limpar"></td>
                                </tr>
                            </table>
                        </form>
                </td></tr>
        </table>
        </fieldset>
    </div>
</div>
</body>
</html>


