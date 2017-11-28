<?php
include 'bd.php';

echo "<a href=\"FormCriarOperacao.php\">Criar Operação<a/><br><br>";

$consulta = $conn->query("Select id,nome from operacao;");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="AtualizarOperacao.php">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_operacao"> </input>
            <tr>
                <td>Tipo de Operação</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="operacao"> </input></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Alterar" ></input>
                </td>
                <td>
                    <a href="ExecutaExcluirOperacao.php?id_operacao=<?php echo "{$linha['id']}"?>"> Excluir</a>
                </td>
            </tr>
        </form>
    </table>
    <?php
}
?>