<?php
$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}

$url = $_SERVER['REQUEST_URI'];
//
//require_once $pontos . 'vendor/autoload.php'; // change path as needed
?>
<style>

    .chip{
        background-color: transparent !important;
    }

    nav{
        height: 64px !important;
        background-color: rgba(6, 2, 43, 9) !important;
    }
    @media only screen and (max-width : 600px) {
        nav{ height: 45px!important;}
    }

    nav ul a:hover {
        color: white !important;
        background-color: rgba(219, 106, 33, 0.9) !important;
    }

</style>
<nav class="nav-extended" style="position: relative;">
    <div class="nav-wrapper" style="margin-left: auto; margin-right: auto; width: 95%">
        <a href="#" class="brand-logo">Ordens</a>
        <a href="#" class="left hide-on-med-and-up" style="max-width: 260px; max-height: 45px; margin-top: -14px;">
            <img src="<?php echo $pontos;?>Img/logoNavDeslogado.png" style="max-width: 245px; max-height: 69px;">
        </a>
        <ul class="right">
            <li>
                <a class="modal-trigger chip" href="#modalLogin">
                        Entrar
                </a>
            </li>
            <li>
                <a class="modal-trigger hide-on-small-and-down chip" href="#modalRegistro" id="registro">
                        Cadastre-se
                </a>
            </li>

        </ul>
    </div>
</nav>

<div id="modalRegistro" class="modal">
    <div class="modal-content">
        <h4>Registre-se</h4>
        <div class="row">
            <form action="<?php echo $pontos; ?>Controle/usuarioControle.php?function=inserirUsuario" id="formModal" method="post">
                <div class="row center">
                    <div class="input-field col s12 l6">
                        <input id="Nome" type="text" name="nome"required="true">
                        <label for="Nome">Nome</label>
                    </div>
                    <div class="input-field col s12 l6">
                        <input type="text" name="telefone" required="true" id="telefone">
                        <label for="telefone">Telefone</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="email" name="email" required="true" id="email">
                        <label for="email">E-mail</label>
                    </div>
                    <div class = "input-field col s12 l6">
                        <input type="password" name="senha1" id="senha1Mod" required="true">
                        <label for="senha1Mod">Senha</label>
                    </div>
                    <div class = "input-field col s12 l6">
                        <input type="password" name="senha2" id="senha2Mod" required="true">
                        <label for="senha2Mod">Repita a senha</label>
                    </div>
                </div>
<!--                <div class="row center">-->
<!--                    <label>-->
<!--                        <input type="checkbox" required/>-->
<!--                        <span>Eu concordo com a política de privacidade disponível -->
<!--                            <a href="https://markeyvip.com/Portfolio/politica.php"target="_blank">Neste link</a>-->
<!--                        </span>-->
<!--                    </label>-->
<!--                </div>-->
                <style>
                    .g-recaptcha>div{
                        margin-right: auto;
                        margin-left: auto;
                    }
                </style>
                <div class="row">
                    <span class="g-recaptcha" style="padding-left: auto; padding-right: auto;" data-sitekey="6LdSGcIUAAAAAMYl8rJbwwgDioD8alzSK19ouPor"></span>
                </div>
                <div class="modal-footer">
                    <div class="row center">
                        <a href="#!" class="modal-close waves-effect waves-green btn waves-effect -flat corPadrao3 white-text">Cancelar</a>
                        <button type="submit" class="waves-effect waves-green btn waves-effect -flat corPadrao2 white-text">Registrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<div id="modalLogin" class="modal transparent z-depth-0">
    <div class="row">
        <div class="col l6 offset-l3 m8 s12 offset-m2 offset-s0 card" >
            <div class="modal-content" style="max-height: 100%; overflow: auto;">
                <h4>Identifique-se</h4>
                <div class="row">
                    <form action="<?php echo $pontos; ?>Controle/usuarioControle.php?function=login"  method="post">
                        <div class="row center">
                            <div class="input-field col s12">
                                <?php
                                echo "<input type='text' name='url' value='.." . $url . "' hidden='true'/>";
                                ?>
                                <input id="Usuario" type="text" name="usuario" required="true">
                                <label for="Usuario">Celular ou e-mail</label>
                            </div>

                            <div class = "input-field col s12">
                                <span>
                                     <i id="toggle-password" class="material-icons right iconeOlho">visibility</i>
                                </span>
                                <input id="Senha" type="password" name="senha">
                                <label for="Senha">Senha</label>
                            </div>
                        </div>
                        <div class="row center">
                            <a href="#!" class="modal-close waves-effect waves-green btn waves-effect -flat corPadrao3 white-text">Cancelar</a>
                            <button type="submit" class="waves-effect waves-green btn waves-effect -flat corPadrao2 white-text">Entrar</button>
                        </div>
                        <div class="row center">
                            <a class="teal-text" href="<?php echo $pontos ?>Tela/recuperaSenha.php">Esqueci minha senha!</a>
                            <br>
                            Ainda não está cadastrado? 
                            <a class="teal-text modal-trigger" href="#modalRegistro">Cadastre-se</a>
                        </div>
                        <?php
                        if (isset($_GET['msg'])) {
                            if ($_GET['msg'] == "senhaerrada") {
                                echo "<script>M.toast({html: 'Você errou alguma coisa!<br> Ainda não é cadastrado? <a class='teal-text modal-trigger' href='#modalRegistro'>Cadastre-se</a>', classes: 'rounded'});</script>";
                            }
                        }
                        ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // codigo para o olhinho
    $("#toggle-password").mousedown(function() {
        var tipoType = $("#Senha").attr("type");
        if (tipoType === "password") {
            $("#Senha").prop("type", "text");
            $(this).html("visibility_off");
        } else {
            $("#Senha").prop("type", "password");
            $(this).html("visibility");
        }
    });

    $('.dropdown-trigger').dropdown({
        coverTrigger: false
    });
    $('.modal').modal();
    $("#telefoneModal").mask("(00) 00000-0000");
    $("#telefone").mask("(00) 00000-0000");


    $("#formModal").submit(function () {
        if ($("#telefoneModal").val().length != 15) {
            M.toast({html: 'Digite um número de celular válido!', classes: 'rounded'})
            return false;
        } else {
            var dados = $(this).serialize();
            var resposta = true;
            $.ajax({
                url: '<?php echo $pontos; ?>Controle/usuarioControle.php?function=verificaTelefone',
                type: 'POST',
                data: dados,
                async: false,
                success: function (data) {
                    if (data == 'true') {
                        resposta = false;
                        $('#telefoneModal').attr('class', 'invalid');
                        M.toast({html: "O telefone já existe no sistema!", classes: 'rounded'});
                    } else {
                        $('#telefoneModal').attr('class', 'valid');
                    }
                }
            });
            if ($("#senha1Mod").val() != $("#senha2Mod").val()) {
                resposta = false;
                M.toast({html: "Senhas não coincidem!", classes: 'rounded'});
            }
            if (resposta) {
                $("#preLoader").show();
            }
            return resposta;
        }
    });
</script>