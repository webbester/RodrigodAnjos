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
        <?php
        $stmt1  = $conn->prepare("CALL ReturnAll_Banco()");
        $stmt1->execute();
        $Results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        $stmt1->closeCursor();
        echo "<h3>Cadastro de Banco</h3></br>";
        echo "<a class='Voltar' href='FormCriarBanco.php'>Cadastrar Novo Banco</a></br></br>";
        foreach ($Results as $row){?>
<fieldset>
            <table cellpadding="8px">
                <form method="POST" action="AtualizarBanco.php">
                    <input type="hidden" value="<?php echo $row['Id'] ?>" name="id_banco"> </input>
                    <tr>
                        <td><strong>Nome: </strong></td>
                        <td><input style="width: 680px" class="input" value="<?php echo $row['Nome']; ?>" name="nomebanco"> </input></td>
                        <td>
                            <input type="submit" value="Alterar" ></input>
                        </td>
                        <td>
                            <a class="Excluir" href="ExecutaExcluirBanco.php?id_banco=<?php echo "{$linha['id']}"?>"> Excluir</a>
                        </td>
                    </tr>
                </form>
            </table>
</fieldset>
        <?php } ?>
    </div>
</div>
</body>
</html>

