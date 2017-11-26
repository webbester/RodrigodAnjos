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
        <?php

        $id_transacao = isset($_POST['id_transacao']) ? $_POST['id_transacao']: NULL;
        $stmt = $conn->prepare("CALL ReturnOneTransacao(?)");
        $stmt->bindParam(1,$id_transacao, PDO::PARAM_INT);
        $stmt->execute();
        $ReturnTrans = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach ($ReturnTrans as $row){
            ?>
            <fieldset>
                <h3>Alterar Transação</h3>
                <table cellpadding="8" cellspacing="8" align="center">
                    <form name="Transacao" action="Execute_Update.php" method="post">
                        <input type="hidden" name="id_transacao" value="<?php echo $row['id']?>">
                        <tr><td colspan="5">Tipo de Transação</td></tr>
                        <tr>
                            <td colspan="4">
                                <select name="Tipo_Transacao" id="select_tans" required="">
                                    <option value="<?php echo $row['Tipo_transacao_id']?>"><?php echo $row['nome_tipo_transacao']?></option>
                                    <?php
                                    $stmt1 = $conn->prepare("CALL ReturnAllTipo_Transacao(?)");
                                    $stmt1->bindParam(1,$row['Tipo_transacao_id'], PDO::PARAM_STR);
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
                                <select name="Banco_Origem" id="select">
                                    <option value=" <?php echo $row['Banco_origem_id']?>"><?php echo $row['nome_banco_origem']?></option>
                                    <?php
                                    $stmt1 = $conn->prepare("CALL ReturnAllBanco_Origem(?)");
                                    $stmt1->bindParam(1, $row['Banco_origem_id'], PDO::PARAM_STR);
                                    $stmt1->execute();
                                    while($linha = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <option value="<?php echo "{$linha['Id']}" ?>"><?php echo "{$linha['Nome']}" ?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="null"></option>
                                </select>
                            </td>
                            <td colspan="2">
                                <select name="Banco_Destino" id="select">
                                    <option value=" <?php echo $row['Banco_destino_id']?>"><?php echo $row['nome_banco_destino']?></option>
                                    <?php
                                    $stmt1 = $conn->prepare("CALL ReturnAllBanco_Destino(?)");
                                    $stmt1->bindParam(1, $row['Banco_destino_id'], PDO::PARAM_STR);
                                    $stmt1->execute();
                                    while($linha = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <option value="<?php echo "{$linha['Id']}" ?>"><?php echo "{$linha['Nome']}" ?></option>
                                        <?php
                                    }
                                    ?>
                                    <option value="null"></option>
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
                                    <option value="<?php echo $row['Forma_pagamento_id'] ?>"><?php echo $row['nome_forma_pagamento']?></option>
                                    <?php
                                    $stmt1 = $conn->prepare("CALL ReturnAllForma_Pagamento(?)");
                                    $stmt1->bindParam(1, $row['Forma_pagamento_id'], PDO::PARAM_STR);
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
                                    <option value="<?php echo $row['Tipo_moeda_id']?>"><?php echo  $row['nome_tipo_moeda']?></option>
                                    <?php
                                    $stmt1 = $conn->prepare("CALL ReturnAllMoeda(?)");
                                    $stmt1->bindParam(1, $row['Tipo_moeda_id'], PDO::PARAM_STR);
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
                            <td colspan="2"><input name="Valor" value="<?php echo $row['Valor']?>" type="number" id="input" required=""></td>
                            <td colspan="2"><input name="Data" value="<?php echo $row['Data']?>" type="date" required=""></td>
                        </tr>
                        <tr>
                            <td colspan="4">Descrição</td>
                        </tr>
                        <tr>
                            <td colspan="4"><textarea name="Descricao" rows="8" cols="78"><?php echo $row['descricao']?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" value="Alterar">
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
