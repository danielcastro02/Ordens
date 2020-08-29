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
    ?>
    <title></title>

<body class="homeimg">
<?php
include_once '../Base/navBar.php';
include_once "../Controle/clientePDO.php";
include_once "../Modelo/Cliente.php";
$clientePDO = new ClientePDO();
$cliente = $clientePDO->selectClienteIdCliente($_GET['id_pessoa']);
$cliente = new cliente($cliente->fetch());
?>
<main>

    <div class="row">
        <div class="col s8 offset-s2 m10 l8 offset-l2 offset-m1 card">
            <h4 class="textoCorPadrao2 center">Editar cliente</h4>
            <div class="divider"></div>
            <div class="row">
                <div class="col s12">
                    <form action="../Controle/clienteControle.php?function=editar" method="post">
                        <div class="row">
                            <div class="input-field col l5 s10 offset-s1">
                                <input name="nome" id="nome" value="<?php echo $cliente->getNome() ?>" type="text">
                                <input name="id_cliente" id="" type="text" value="<?php echo $cliente->getId_cliente() ?>" hidden>
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field col l4 s10 offset-s1">
                                <input name="telefone" id="telefone" value="<?php echo $cliente->getTelefone() ?>" type="text">
                                <label for="telefone">Telefone</label>
                            </div>
                            <div class="col l3 s6 offset-s3 divSwitch">
                                <label class="teal-text">Número do wats?</label>
                                <div class="switch">
                                    <label>
                                        Off
                                        <input type="checkbox" <?php echo $cliente->getIs_wats()==1? "selected": "" ?>
                                               name="is_wats"
                                               value="1">
                                        <span class="lever"></span>
                                        On
                                    </label>
                                </div>

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
