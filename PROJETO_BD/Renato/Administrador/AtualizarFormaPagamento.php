<?php
include 'bd.php';

echo "<a href=\"ReadFormadePagamento.php\">Listar Formas de Pagamentos<a/><br><br>";
$nome = $_POST['id_formapagamento'];

$consulta = $conn->query("Select id,nome from forma_pagamento where id = '$nome'");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="ExecutaAtualizarFormaPagamento.php" name="form">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_formapagamento"> </input>
            <tr>
                <td>Nome Banco</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="formapagamento"> </input></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Alterar" ></input>
                </td>
            </tr>
        </form>
    </table>
    <?php
}
?>