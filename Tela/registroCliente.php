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
?>
<main>

    <div class="row">
        <div class="col s12 m10 l8 offset-l2 offset-m1 card">
            <div class="row">
                <div class="col s12">
                    <form action="../Controle/clienteControle.php?function=inserir" method="post">
                        <div class="row">
                            <div class="input-field col s4">
                                <input name="nome" id="nome" type="text">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field col s4">
                                <input name="telefone" id="telefone" type="text">
                                <label for="telefone">Telefone</label>
                            </div>
                            <div class="col s4">
                                <div class="switch">
                                    <span class="left teal-text">Número do wats?</span>
                                    <label class="right">
                                        Off
                                        <input type="checkbox"
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
</body>
</html>

