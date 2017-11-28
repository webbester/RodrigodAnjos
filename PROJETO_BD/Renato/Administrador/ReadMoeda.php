<?php
include 'bd.php';
echo "<a href=\"FormCriarMoeda.php\">Criar Moedas<a/><br><br>";

$consulta = $conn->query("Select id,nome from tipo_moeda;");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="AtualizarMoeda.php">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_moeda"> </input>
            <tr>
                <td>Nome Banco</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="moeda"> </input></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Alterar" ></input>
                </td>
                <td>
                    <a href="ExecutaExcluirMoeda.php?id_moeda=<?php echo "{$linha['id']}"?>"> Excluir</a>
                </td>
            </tr>
        </form>
    </table>
    <?php
}
?>