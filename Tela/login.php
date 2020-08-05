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
        <div class="col s12 m6 l4 offset-l4 offset-m3 card">
            <div class="row">
                <div class="col s12">
                    <form action="../Controle/usuarioControle.php?function=login" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <input name="usuario" id="usuario" type="text">
                                <label for="usuario">Usuário</label>
                            </div>
                            <div class="input-field col s12">
                                <input name="senha" id="senha" type="password">
                                <label for="senha">Senha</label>
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

