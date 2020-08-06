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
    include_once "../Modelo/Ordem.php";
    include_once "../Controle/clientePDO.php";
    include_once "../Controle/ordemPDO.php";
    $ordemPDO = new OrdemPDO();
    $stmt = $ordemPDO->selectOrdemIdordem($_GET['id_ordem']);
    $ordem = new ordem($stmt->fetch());
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
                    <form action="../Controle/ordemControle.php?function=editar" method="post">
                        <div class="row center">
                            <h5>Editar Ordem</h5>
                        </div>
                        <div class="row">
                            <div class="input-field col s3">
                                <select name="id_cliente" id="id_cliente">
                                    <?php
                                    $clientePDO = new clientePDO();
                                    $clientes = $clientePDO->selectCliente();
                                    while ($linha = $clientes->fetch()){
                                        $cliente = new cliente($linha);
                                        echo "<option value='".$cliente->getId_cliente()."' ".($cliente->getId_cliente()== $ordem->getId_cliente()? "selected":"").">".$cliente->getNome()."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="id_cliente">Cliente</label>
                            </div>
                            <div class="input-field col s4">
                                <input type="text" name="id_ordem" value="<?php echo $_GET['id_ordem'] ?>" hidden>
                                <input name="equipamento" id="equipamento" value="<?php echo $ordem->getEquipamento() ?>" type="text">
                                <label for="equipamento">Equipamento</label>
                            </div>
                            <div class="input-field col s2">
                                <input name="valor" id="valor" value="<?php echo $ordem->getValor() ?>" type="text">
                                <label for="valor">Valor</label>
                            </div>
                            <div class="input-field col s3">
                                <select id="status" name="status">
                                    <option value="<?php echo ordem::PENDENTE ?>" <?php echo (ordem::PENDENTE == $ordem->getStatus()?"selectd":"") ?>>Pendente</option>
                                    <option value="<?php echo ordem::ORCADO ?>" <?php echo (ordem::ORCADO == $ordem->getStatus()?"selectd":"") ?>>Orcado</option>
                                    <option value="<?php echo ordem::REALIZANDO ?>"  <?php echo (ordem::REALIZANDO == $ordem->getStatus()?"selectd":"") ?>>Realizando</option>
                                    <option value="<?php echo ordem::PRONTO ?>"  <?php echo (ordem::PRONTO == $ordem->getStatus()?"selectd":"") ?>>Pronto</option>
                                    <option value="<?php echo ordem::ENTREGUE ?>"  <?php echo (ordem::ENTREGUE == $ordem->getStatus()?"selectd":"") ?>>Entregue</option>
                                    <option value="<?php echo ordem::PAGO ?>"  <?php echo (ordem::PAGO == $ordem->getStatus()?"selectd":"") ?>>Pago</option>
                                </select>
                                <label for="status">Status</label>
                            </div>
                            <div class="input-field col s12">
                                <textarea name="descricao" class="materialize-textarea" id="descricao" type="text"><?php echo $ordem->getDescricao() ?></textarea>
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
    $("select").formSelect();
</script>
</body>
</html>

