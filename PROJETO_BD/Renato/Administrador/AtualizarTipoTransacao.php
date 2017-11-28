<?php
include 'bd.php';

echo "<a href=\"ReadTipoTransacao.php\">Listar Tipos de Operação<a/><br><br>";
$nome = $_POST['id_transacao'];

$consulta = $conn->query("Select id,nome from tipo_transacao where id = '$nome'");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="ExecutaAtualizarTipoTransacao.php" name="form">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_transacao"> </input>
            <tr>
                <td>Nome Banco</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="transacao"> </input></td>
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