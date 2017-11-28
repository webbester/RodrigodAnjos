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
    $ID_BANCO = $_POST['id_banco'];
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
        $stmt = $conn->prepare("CALL ReturnOne_Banco(?)");
        $stmt->bindParam(1,$ID_BANCO, PDO::PARAM_INT );
        $stmt->execute();
        $results  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row){
        ?>
        <h3>Alterar Banco</h3><br><br>
        <fieldset>
            <table cellpadding="8px">
                <form method="POST" action="ExecutaAtualizarBanco.php" name="form">
                    <input type="hidden" value="<?php echo $row['id']; ?>" name="id_banco"> </input>
                    <tr>
                        <td><b>Nome Banco: </b> </td>
                        <td><input  style="width: 720px" class="input" value="<?php echo $row['Nome']; ?>" name="nomebanco"> </input></td>
                        <td>
                            <input  type="submit" value="Alterar" ></input>
                        </td>
                    </tr>

                </form>
            </table>
        </fieldset>
            <?php }?>
    </div>
</div>
</body>
</html>



