<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php
    include_once '../Base/header.php';
    include_once "../Modelo/Cliente.php";
    include_once "../Controle/clientePDO.php";
    ?>
    <title></title>

<body class="homeimg">
<?php
include_once '../Base/navBar.php';
?>
<main>

    <div class="row">
        <div class="col s12 m10 l8 offset-l2 offset-m1 card">
            <div class="row">
                <div class="col s12">
                    <form action="../Controle/ordemControle.php?function=inserir" method="post">
                        <div class="row">
                            <div class="input-field col s4">
                                <select name="id_ciente">
                                    <?php
                                    $clientePDO = new clientePDO();
                                    $clientes = $clientePDO->selectCliente();
                                    while ($linha = $clientes->fetch()){
                                        $cliente = new cliente($linha);
                                        echo "<option value='".$cliente->getId_cliente()."'>".$cliente->getNome()."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-field col s5">
                                <input name="equipamento" id="equipamento" type="text">
                                <label for="equipamento">Equipamento</label>
                            </div>
                            <div class="input-field col s3">
                                <input name="valor" id="valor" type="text">
                                <label for="valor">Valor</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea name="descricao" id="descricao" type="text"></textarea>
                                <label for="descricao">Descricao</label>
                            </div>
                        </div>
                        <div class="row center">
                            <a class="btn corPadrao3" href="../index.php">Voltar</a>
                            <button type="submit" class="btn corPadrao2">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<?php
include_once '../Base/footer.php';
?>

<script>
    $("#telefone").mask("(00) 00000-0000");
</script>
</body>
</html>

