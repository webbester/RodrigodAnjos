<?php
session_start();
require 'banco_de_dados.php';

$stmt = $conn->prepare("CALL Listar_Todas_Transacao(?)");
$stmt->bindParam(1,$_SESSION['id_user'], PDO::PARAM_INT);
$stmt->execute();
$ReturnTrans = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->closeCursor();
foreach ($ReturnTrans as $row){
    ?>
    <table cellpadding="2px">
        <form name="Transacao" action="Update_transacao.php" method="post">
         <tr><td colspan="5px">Tipo de Transação</td></tr>
            <tr>
                <td>
                    <select name="tipo_transacao">
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
                    <select name="banco_origem">
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
                    </select>
                </td>
                <td colspan="2">
                    <select name="banco_destino">
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
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">Forma de Pagamento</td>
                <td colspan="2">Moeda</td>
            </tr>
            <tr>
                <td colspan="2">
                    <select name="formas_pagamento">
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
                    <select name="Tipo_Moeda">
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
                <td colspan="2"><input name="Valor" value="<?php echo $row['Valor']?>" type="number"></td>
                <td colspan="2"><input name="Data" value="<?php echo $row['Data']?>" type="date"></td>
            </tr>
            <tr>
                <td colspan="4">Descrição</td>
            </tr>
            <tr>
                <td colspan="4"><textarea name="Descricao" rows="4" cols="90"><?php echo $row['descricao']?></textarea></td>
            </tr>
        </form>
    </table>
    <?php } ?>