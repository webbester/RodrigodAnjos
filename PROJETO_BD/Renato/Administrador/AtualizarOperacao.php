<?php
include 'bd.php';

echo "<a href=\"ReadOperacao.php\">Listar Tipos de Operação<a/><br><br>";
$nome = $_POST['id_operacao'];

$consulta = $conn->query("Select id,nome from operacao where id = '$nome'");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="ExecutaAtualizarOperacao.php" name="form">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_operacao"> </input>
            <tr>
                <td>Nome Banco</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="operacao"> </input></td>
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