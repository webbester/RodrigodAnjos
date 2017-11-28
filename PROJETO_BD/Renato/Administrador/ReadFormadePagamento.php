<?php
include 'bd.php';

echo "<a href=\"FormCriarForma_pagamento.php\">Criar Forma de Pagamento<a/><br><br>";

$consulta = $conn->query("Select id,nome from forma_pagamento;");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="AtualizarFormaPagamento.php">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_formapagamento"> </input>
            <tr>
                <td>Forma de Pagamento</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="formapagamento"> </input></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Alterar" ></input>
                </td>
                <td>
                    <a href="ExecutaExcluirFormaPagamento.php?id_formapagamento=<?php echo "{$linha['id']}"?>"> Excluir</a>
                </td>
            </tr>
        </form>
    </table>
    <?php
}
?>