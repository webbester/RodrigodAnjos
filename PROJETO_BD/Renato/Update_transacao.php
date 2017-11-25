<?php

include 'banco_de_dados.php';
$id_transacao = $_POST['id_transacao'];
echo $id_transacao;
$consulta = $conn->query("Select 
       transacao.id,
       transacao.Usuario_id,
	   usuario.nome as nome_usuario,
       
       transacao.Tipo_transacao_id,       
       tipo_transacao.nome as nome_tipo_transacao,
       
       transacao.Banco_origem_id,
       a.nome as nome_banco_origem,
       
       transacao.Banco_destino_id,
       b.nome as nome_banco_destino,
       
       transacao.Forma_pagamento_id,
       forma_pagamento.nome as nome_forma_pagamento,
       
       transacao.Tipo_Moeda_id,
       tipo_moeda.nome as nome_tipo_moeda,
       
       transacao.Valor,
       transacao.Data,
       transacao.descricao
       from transacao 
       JOIN usuario on transacao.usuario_id = usuario.id
       JOIN tipo_transacao on transacao.tipo_transacao_id = tipo_transacao.id
       LEFT JOIN banco a on a.id = banco_origem_id
       LEFT JOIN banco b on b.id = banco_destino_id
       JOIN forma_pagamento on forma_pagamento.id = forma_pagamento_id
       JOIN tipo_moeda on tipo_moeda.id = transacao.tipo_moeda_id
        where transacao.id = '$id_transacao';");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){ ?>
    <table  cellpadding="8px">
        <form method="POST" action="Execute_Update.php" name="form">

            <input type="hidden" value="<?php echo "{$linha['id']}";?>" name="Id_Transacao"> </input>

            <tr>
                <td>Nome usuario</td>
                <td><input value="<?php echo "{$linha['Usuario_id']}";?>" name="Nome_Usuario"></td></input></td>

                <td>Tipo Transação</td>
                <td><select name="Tipo_Transacao">
                        <option  value="<?php echo "{$linha['Tipo_transacao_id']}";?>"><?php echo "{$linha['nome_tipo_transacao']}";?></option>

                        <?php $tp_transacao = $linha['nome_tipo_transacao'];
                        $tps_trans = $conn->query("select id, nome from tipo_transacao where nome not in (select nome from tipo_transacao where nome = '$tp_transacao')");
                        while($linha_1 = $tps_trans->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Banco Origem</td>
                <td>
                    <select name="Banco_Origem">
                        <option value="<?php echo "{$linha['Banco_origem_id']}";?>"><?php echo "{$linha['nome_banco_origem']}";?></option>

                        <?php $nm_bd_ori = $linha['nome_banco_origem'];
                        $bancos_origem = $conn->query("select id, nome from banco where nome not in (select nome from banco where nome = '$nm_bd_ori')");
                        while($linha_1 = $bancos_origem->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php } ?>
                    </select>
                </td>
                <td>Banco Destino</td>
                <td>
                    <select name="Banco_Destino">
                        <option value="<?php echo "{$linha['Banco_destino_id']}";?>"><?php echo "{$linha['nome_banco_destino']}";?></option>

                        <?php $nm_bd_dest = $linha['nome_banco_destino'];
                        $bancos_destino = $conn->query("select id, nome from banco where nome not in (select nome from banco where nome = '$nm_bd_dest')");
                        while($linha_1 = $bancos_destino->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <!-- Terceira linha-->
            <tr>
                <td>Forma Pagamento</td>
                <td>
                    <select name="Formas_Pagamento">
                        <option value="<?php echo "{$linha['Forma_pagamento_id']}";?>"><?php echo "{$linha['nome_forma_pagamento']}"?></option>

                        <?php $nm_form_pag = $linha['nome_forma_pagamento'];
                        $formas_pag = $conn->query("select id, nome from forma_pagamento where nome not in (select nome from forma_pagamento where nome = '$nm_form_pag')");
                        while($linha_1 = $formas_pag->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php } ?>
                    </select>
                </td>
                <td>Moeda</td>
                <td>
                    <select name="Tipo_Moeda">
                        <option value="<?php echo "{$linha['Tipo_Moeda_id']}";?>"><?php echo "{$linha['nome_tipo_moeda']}"?></option>

                        <?php $nm_tp_moeda = $linha['nome_tipo_moeda'];
                        $tp_moeda = $conn->query("select id, nome from tipo_moeda where nome not in(select nome from tipo_moeda where nome = '$nm_tp_moeda')");
                        while($linha_1 = $tp_moeda->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Valor</td>
                <td><input value="<?php echo "{$linha['Valor']}";?> " name="Valor"></td></input></td>

                <td>Data</td>
                <td><input value="<?php echo "{$linha['Data']}";?>" name="Data"></td></input></td>
            </tr>
            <tr>
                <td colspan="4">Descrição</td>
            </tr>
            <tr>
                <td colspan="4">
                    <textarea name="Descricao" rows="4" cols="90" ><?php echo "{$linha['descricao']}";?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Alterar" ></input>
                </td>
            </tr>
        </form>
    </table>
    <br><hr>
    <?php } ?>