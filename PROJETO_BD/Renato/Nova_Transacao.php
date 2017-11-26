<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="Style.css" type="text/css" rel="stylesheet">
    <?php
    session_start();
    if(!isset($_SESSION['user']))
        header("location: /Estudo Dirigido Banco de Dados/Login/Login.php");
    require 'banco_de_dados.php';
    ?>
</head>
<body>
<?php $Vazia= ""?>
<header>
    <div id="bemvindo">
        <h2>Gerenciador de Contas</h2>
        <div class="msg_bemvindo"><h1>Bem Vindo, <?php echo $_SESSION['user']?></h1></div>
    </div>
</header>
<div id="principal">
    <nav>
        <div class="menu">
            <a href="Index.php">Inicio</a>
            <a href="Nova_Transacao.php">Nova Transação</a>
            <a href="#">Relatorios</a>
            <a href="Sair.php">Sair</a>
        </div>
    </nav>
    <div id="transacoes">
 <fieldset>
     <h3>Nova Transação</h3>
<table cellpadding="8" cellspacing="8" align="center">
    <form name="Transacao" action="Execute_Insert_Transacao.php" method="post">
        <tr><td colspan="5">Tipo de Transação</td></tr>
        <tr>
            <td colspan="4">
                <select name="Tipo_Transacao" id="select_tans" required="">
                    <option value=""></option>
                    <?php
                    $stmt1 = $conn->prepare("CALL ReturnAllTipo_Transacao(?)");
                    $stmt1->bindParam(1,$Vazia, PDO::PARAM_STR);
                    $stmt1->execute();
                    while($linha = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo "{$linha['Id']}" ?>"><?php echo "{$linha['Nome']}" ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">Banco Origem</td>
            <td colspan="2">Banco Destino</td>
        </tr>
        <tr>
            <td colspan="2">
                <select name="Banco_Origem" id="select" >
                    <option value=""></option>
                    <?php
                    $stmt1 = $conn->prepare("CALL ReturnAllBanco_Origem(?)");
                    $stmt1->bindParam(1, $Vazia, PDO::PARAM_STR);
                    $stmt1->execute();
                    while($linha = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo "{$linha['Id']}" ?>"><?php echo "{$linha['Nome']}" ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td colspan="2">
                <select name="Banco_Destino" id="select">
                    <option value=""></option>
                    <?php
                    $stmt1 = $conn->prepare("CALL ReturnAllBanco_Destino(?)");
                    $stmt1->bindParam(1, $Vazia, PDO::PARAM_STR);
                    $stmt1->execute();
                    while($linha = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo "{$linha['Id']}" ?>"><?php echo "{$linha['Nome']}" ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">Forma de Pagamento</td>
            <td colspan="2">Moeda</td>
        </tr>
        <tr>
            <td colspan="2">
                <select name="Forma_Pagamento" id="select" required="">
                    <option value=""></option>
                    <?php
                    $stmt1 = $conn->prepare("CALL ReturnAllForma_Pagamento(?)");
                    $stmt1->bindParam(1, $Vazia, PDO::PARAM_STR);
                    $stmt1->execute();
                    while($linha = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo "{$linha['Id']}" ?>"><?php echo "{$linha['Nome']}" ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td colspan="2">
                <select name="Moeda" id="select" required="">
                    <option value=""></option>
                    <?php
                    $stmt1 = $conn->prepare("CALL ReturnAllMoeda(?)");
                    $stmt1->bindParam(1, $Vazia, PDO::PARAM_STR);
                    $stmt1->execute();
                    while($linha = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo "{$linha['Id']}" ?>"><?php echo "{$linha['Nome']}" ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">Valor</td>
            <td colspan="2">Data</td>
        </tr>
        <tr>
            <td colspan="2"><input name="Valor" type="number" id="input" required=""></td>
            <td colspan="2"><input name="Data" type="date" required=""></td>
        </tr>
        <tr>
            <td colspan="4">Descrição</td>
        </tr>
        <tr>
            <td colspan="4"><textarea name="Descricao" rows="8" cols="78"></textarea></td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Adicionar">

            </td>
        </tr>

    </form>
    </table>
 </fieldset>
    </div>
</div>
</body>
</html>