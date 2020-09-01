<?php
include_once '../Base/requerLogin.php';
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
                    <form action="../Controle/usuarioControle.php?function=inserir" method="post">
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="nome" id="nome" type="text">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field col s6">
                                <input name="usuario" id="usuario" type="text">
                                <label for="usuario">Usuário</label>
                            </div>
                            <div class="input-field col s6">
                                <input name="senha1" id="senha1" type="password">
                                <label for="senha1">Senha 1</label>
                            </div>
                            <div class="input-field col s6">
                                <input name="senha2" id="senha2" type="password">
                                <label for="senha2">Senha2</label>
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

