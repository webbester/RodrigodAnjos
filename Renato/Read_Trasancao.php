<?php

/*session_start();
#region ABRE SESSION
if(!isset($_SESSION['login']))
    header("location:\Estudo Dirigido Banco de dados\Login\login.php");*/


include 'banco_de_dados.php';

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
       
       transacao.Tipo_moeda_id,
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
       JOIN tipo_moeda on tipo_moeda.id = transacao.Tipo_moeda_id;");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)){ ?>
    <table  cellpadding="8px">
        <form method="POST" action="Update_transacao.php">
            <input type="hidden" value="<?php echo "{$linha['id']}";?>" name="id_transacao"> </input>
            <!-- Primeira linha-->
            <tr>
                <td>Nome usuario</td>
                <td><input value="<?php echo "{$linha['nome_usuario']}";?>" name="Nome_Usuario"></td></input></td>
                <td>Tipo Transação</td>
                <td><select name="tipo_transacao">
                        <option value="<?php echo "{$linha['tipo_transacao_id']}"?>"><?php echo "{$linha['nome_tipo_transacao']}"?></option>
                        <?php $tp_transacao = $linha['nome_tipo_transacao'];
                        $tps_trans = $conn->query("select id, nome from tipo_transacao where nome not in (select nome from tipo_transacao where nome = '$tp_transacao')");
                        while($linha_1 = $tps_trans->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php
                        }
                        ?>
                    </select></td>
            </tr>
            <!-- Segunda linha-->
            <tr>
                <td>Banco Origem</td>

                <td>
                    <select name="banco_origem">
                        <option value="<?php if ($linha['Banco_origem_id'] <> NULL) echo "{$linha['Banco_origem_id']}"; else echo "" ?>"><?php if($linha['nome_banco_origem'] <> NULL) echo "{$linha['nome_banco_origem']}"; else echo "";?></option>
                        <?php $nm_bd_ori = $linha['nome_banco_origem'];
                        $bancos_origem = $conn->query("select id, nome from banco where nome not in (select nome from banco where nome = '$nm_bd_ori')");
                        while($linha_1 = $bancos_origem->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td>Banco Destino</td>
                <td>    <select name="banco_destino">
                        <option value="<?php if ($linha['Banco_destino_id'] <> NULL) echo "{$linha['Banco_destino_id']}"; else echo ""?>"><?php if($linha['nome_banco_destino'] <> NULL) echo "{$linha['nome_banco_destino']}"; else echo "";?></option>
                        <?php $nm_bd_dest = $linha['nome_banco_destino'];
                        $bancos_destino = $conn->query("select id, nome from banco where nome not in (select nome from banco where nome = '$nm_bd_dest')");
                        while($linha_1 = $bancos_destino->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php
                        }
                        ?>
                    </select></td>
            </tr>
            <!-- Terceira linha-->
            <tr>
                <td>Forma Pagamento</td>
                <td>    <select name="formas_pagamento">
                        <option value="<?php echo "{$linha['forma_pagamento_id']}"?>"><?php echo "{$linha['nome_forma_pagamento']}"?></option>
                        <?php $nm_form_pag = $linha['nome_forma_pagamento'];
                        $formas_pag = $conn->query("select id, nome from forma_pagamento where nome not in (select nome from forma_pagamento where nome = '$nm_form_pag')");
                        while($linha_1 = $formas_pag->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php
                        }
                        ?>
                    </select></td>
                <td>Moeda</td>
                <td><select name="Tipo_Moeda">
                        <option  value="<?php echo "{$linha['tipo_moeda']}"?>"><?php echo "{$linha['nome_tipo_moeda']}"?></option>
                        <?php $nm_tp_moeda = $linha['nome_tipo_moeda'];
                        $tp_moeda = $conn->query("select id, nome from tipo_moeda where nome not in(select nome from tipo_moeda where nome = '$nm_tp_moeda')");
                        while($linha_1 = $tp_moeda->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option  value=" <?php echo "{$linha_1['id']}";?>"><?php echo "{$linha_1['nome']}";?></option>
                            <?php
                        }
                        ?>
                    </select></td>
            </tr>
            <tr>
                <td>Valor</td>
                <td><input value="<?php echo "{$linha['Valor']}";?>"></td></input></td>
                <td>Data</td>
                <td><input value="<?php echo "{$linha['Data']}";?>"></td></input></td>
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
                    <td><a href="Execute_Delete.php?id_transacao=<?php echo "{$linha['id']}"?>&usr_id=<?php echo "{$linha['Usuario_id']}" ?>">Excluir</a>
                </td>
            </tr>
        </form>
    </table>
    <br><hr>
   <?php //echo "{$linha['nome_usuario']}"."{$linha['nome_tipo_transacao']}<br>"; ?>

    <?php
    }
    ?>