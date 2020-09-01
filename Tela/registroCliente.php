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
        <div class="col s10 offset-s1 card">
            <h4 class="textoCorPadrao2 center">Cadastrar cliente</h4>
            <div class="divider"></div>
            <div class="row">
                <div class="col s12">
                    <form action="../Controle/clienteControle.php?function=inserir" method="post">
                        <div class="row">
                            <div class="input-field col l5 s10 offset-s1">
                                <input name="nome" id="nome" type="text">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="input-field col l4 s10 offset-s1">
                                <input name="telefone" id="telefone" type="text">
                                <label for="telefone">Telefone</label>
                            </div>
                            <div class="col l3 s6 offset-s3 m5 offset-m4 divSwitch">
                                <label class="teal-text">Número do wats?</label>
                                <div class="switch">
                                    <label>
                                        Não
                                        <input type="checkbox"
                                               name="is_wats"
                                               value="1">
                                        <span class="lever"></span>
                                        Sim
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="row center">
                            <a class="btn corPadrao3 btReCliFooter" href="../index.php">Voltar</a>
                            <button type="submit" class="btn corPadrao2 btReCliFooter">Confirmar</button>
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

