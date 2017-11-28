<?php
include 'bd.php';

echo "<a href=\"FormTipoTransacao.php\">Criar Tipo de Transação<a/><br><br>";

$consulta = $conn->query("Select id,nome from tipo_transacao;");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="AtualizarTipoTransacao.php">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_transacao"> </input>
            <tr>
                <td>Tipo de transação</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="transacao"> </input></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Alterar" ></input>
                </td>
                <td>
                    <a href="ExecutaExcluirTipoTransacao.php?id_transacao=<?php echo "{$linha['id']}"?>"> Excluir</a>
                </td>
            </tr>
        </form>
    </table>
    <?php
}
?>