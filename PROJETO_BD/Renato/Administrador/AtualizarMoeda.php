<?php
include 'bd.php';

echo "<a href=\"ReadMoeda.php\">Listar Moedas<a/><br><br>";
$nome = $_POST['id_moeda'];

$consulta = $conn->query("Select id,nome from tipo_moeda where id = '$nome'");

while($linha = $consulta->fetch(PDO::FETCH_ASSOC)) { ?>
    <table cellpadding="8px">
        <form method="POST" action="ExecutaAtualizarMoeda.php" name="form">
            <input type="hidden" value="<?php echo "{$linha['id']}"; ?>" name="id_moeda"> </input>
            <tr>
                <td>Nome Banco</td>
                <td><input value="<?php echo "{$linha['nome']}"; ?>" name="moeda"> </input></td>
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