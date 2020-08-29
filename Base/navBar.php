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
//if (!isset($_SESSION)) {
//    session_start();
//}
//include_once $pontos . 'Modelo/Usuario.php';
//$logado = new usuario(unserialize($_SESSION['logado']));
?>

<style>
    nav.nav-extended {
        height: 45px !important;
    }

    header, main, footer, .preFooter {
        padding-left: 245px;
    }

    html {
        max-width: 100vw;
    }

    @media only screen and (max-width: 992px) {
        header, main, footer, .preFooter {
            padding-left: 0px;
        }
    }

    nav {
        background-color: rgba(6, 2, 43, 0.9) !important;
        transition: ease-in 0.2s;
    }

    nav:hover {
        background-color: rgba(6, 2, 43, 0.95) !important;
    }

    /*!*Muda a cor do icone do select na nav*!*/
    /*.select-wrapper .caret{*/
    /*    fill: #fff !important;*/
    /*}*/
    /*Muda a cor do que esta escrito dentro do campo selected*/
    .mudaCor .select-wrapper input.select-dropdown {
        color: white !important;
    }
</style>

<div class="navbar-fixed evitarEstouro" style="max-height: 45px; max-width: 100%">
    <nav class="nav-extended evitarEstouro" style="max-height: 45px; max-width: 100vw !important">

        <a href="#" data-target="slide-out" class="sidenav-trigger" style="height: 45px;">
            <i class="material-icons white-text">menu</i>
        </a>
        <!--        Tinha um select aqui e eu (Victor Xavier) apaguei-->

        <!--            ul com o a foto e nome de quem esta logado, tambem é um dropdown-->
        <ul class="right">
            <li>
                <a href="#" class='dropdown-trigger black-text iconeFotoNav' data-target='dropPessoal'>
                    <div class="left-align diviComFotoPerfil fotoPerfil"
                         style="background-image: url('<?php echo $pontos ?>Img/Perfil/default.png');">
                    </div>
                </a>
                <!--                    O dropdown referente-->
                <ul id="dropPessoal" class="dropdown-content">
                    <li><a href="<?php echo $pontos; ?>Tela/perfil.php" class="black-text">Meu perfil</a></li>
                    <li><a href="<?php echo $pontos; ?>Tela/assinaturas.php" class="black-text">Minhas ordens</a></li>
                    <!--                        li com o divider-->
                    <li class="divider" tabindex="-1"></li>
                    <li>
                        <a class="waves-effect black-text"
                           href="<?php echo $pontos ?>Controle/usuarioControle.php?function=logout">
                            <i class="material-icons black-text" style="font-size: 1.5rem">power_settings_new</i>
                            Sair
                        </a>
                    </li>
                </ul>

            </li>
        </ul>
    </nav>
</div>

<!--        Btn fixed floating-->
<div class="fixed-action-btn">
    <a href="<?php echo $pontos ?>Tela/registroOrdem.php" class="btn-floating btn-large green tooltipped z-depth-5"
       x="0" data-tooltip="Nova ordem">
        <i class="large material-icons" style="font-size: 1.5625rem">add</i>
    </a>
</div>

<!--SidNavBar que deve se tornar padrão-->

<ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
        <div style="background-color: #06022B; max-height: 45px;">
            <!--            <img class="iconAlvo" src="-->
            <?php //echo $pontos ?><!--Img/Financeiramente-04-ALVO.svg">-->
            <span style="margin-left: 10px; font-size: 20px; color: white;">Ordens</b></span>
        </div>
    </li>
    <li class="no-padding">
        <ul class="collapsible">
            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="<?php echo $pontos ?>index.php">
                    <i class="material-icons changeColor" style="color: black; font-size: 1.5rem">home</i>
                    Inicio
                </a>
            </li>

            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="#!">
                    <i class="material-icons changeColor" style="color: black; font-size: 1.5rem">supervisor_account</i>
                    Administração
                    <i class="large material-icons right animi black-text">arrow_drop_down</i>
                </a>

                <div class="collapsible-body bodyColorCollapsible">
                    <ul>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/listarUsuario.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Usuários
                            </a>
                        </li>
                        <li class="divider" style="margin-top: 0px;" tabindex="-1"></li>
                    </ul>
                </div>
            </li>



            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="#!">
                    <i class="material-icons changeColor" style="color: black; font-size: 1.5rem">library_add</i>
                    Registro
                    <i class="large material-icons right animi black-text">arrow_drop_down</i>
                </a>
                <div class="collapsible-body bodyColorCollapsible">
                    <ul>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/registroCliente.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Cliente
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/registroOrdem.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Ordem
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/registroUsuario.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Usuario
                            </a>
                        </li>
                        <li class="divider" style="margin-top: 0px;" tabindex="-1"></li>
                    </ul>
                </div>
            </li>

            <!--para listagem-->
            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="#!">
                    <i class="material-icons changeColor" style="color: black; font-size: 1.5rem">list</i>
                    Listar
                    <i class="large material-icons right animi black-text">arrow_drop_down</i>
                </a>
                <div class="collapsible-body bodyColorCollapsible">
                    <ul>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/listarCliente.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Cliente
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/listarOrdem.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Ordem
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/listarUsuario.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Usuarios
                            </a>
                        </li>
                        <li class="divider" style="margin-top: 0px;" tabindex="-1"></li>
                    </ul>
                </div>
            </li>


            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="#!">
                    <i class="material-icons changeColor" style="color: black; font-size: 1.5rem">list</i>
                    Caixa
                    <i class="large material-icons right animi black-text">arrow_drop_down</i>
                </a>
                <div class="collapsible-body bodyColorCollapsible">
                    <ul>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/entrada.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Entrada
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/saida.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Saída
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/novaDescricao.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Nova Descrição
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/listarDescricao.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Listar Descrição
                            </a>
                        </li>
                        <li class="divider" style="margin-top: 0px;" tabindex="-1"></li>
                    </ul>
                </div>
            </li>


            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="#!">
                    <i class="material-icons changeColor" style="color: black; font-size: 1.5rem">list</i>
                    Relatórios
                    <i class="large material-icons right animi black-text">arrow_drop_down</i>
                </a>
                <div class="collapsible-body bodyColorCollapsible">
                    <ul>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/consultaRelatorio.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Consultar Relatório
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/novoRelatorio.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Novo Relarório
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/listarRelatorio.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Listar Relatórios
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $pontos . 'Tela/resumoCaixa.php' ?>">
                                <i class="material-icons icons-internos">arrow_right</i>
                                Resumo de Caixa
                            </a>
                        </li>

                        <li class="divider" style="margin-top: 0px;" tabindex="-1"></li>
                    </ul>
                </div>
            </li>


            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="#!">
                    <i class="material-icons giraEmudaCor" style="color: black; font-size: 1.5rem">settings</i>
                    Configurações
                </a>
            </li>
            <!--    Essa li abrange a fução de collapsible, é importante ter a função em java scrit para fazer a seta girar e da classe-->
            <!--    animi (na folha css), anime e a propriedade "x"-->

            <li>
                <a class="waves-effect black-text collapsible-header anime" x="0" href="#!">
                    <i class="material-icons changeColor" style="color: black; font-size: 1.5rem">help_outline</i>
                    Sobre
                    <i class="large material-icons right animi black-text">arrow_drop_down</i>
                </a>

                <div class="collapsible-body bodyColorCollapsible">
                    <ul style="margin-left: 10px">
                        <li style="height: 25px; line-height: 25px">Projeto começado</li>
                        <li style="height: 25px; line-height: 25px">dia 05/08/2020</li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <div class="divider"></div>
    </li>

    <!-- <li><a class="subheader">Financeiramente todos os direitos reservados © 2020 FinanceirameneApp</a></li>-->
    <li class="linhaDobtSair hide">
        <a class="waves-effect black-text" href="<?php echo $pontos ?>Controle/usuarioControle.php?function=logout">
            <i class="material-icons black-text" style="font-size: 1.5rem">power_settings_new</i>
            Sair
        </a>
    </li>

</ul>


<div id="modalSair" class="modal">
    <div class="modal-content">
        <h4>Atenção</h4>
        <p>Você realmente deseja sair? Se sair não receberá nenhuma notificação do app...</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn corPadrao2">Cancelar</a>
        <a href="<?php echo $pontos; ?>Controle/usuarioControle.php?function=logout&url=<?php echo $_SERVER["REQUEST_URI"]; ?>"
           class="btSair modal-close waves-effect waves-green btn red darken-2">Sair</a>
    </div>
</div>


<script>
    $('.sidenav').sidenav();
    $('.collapsible').collapsible();
    $('.modal').modal();

    $('.dropdown-trigger').dropdown({
        coverTrigger: false
    });

    $(".anime").each(function () {
        if ($(this).attr("x") == 1) {
            $(this).children(".animi").attr("style", "transform: rotate(180deg); color: black;");
            $(this).children(".giraEmudaCor").attr("style", "color: #0F8F00; font-size: 1.5rem; transform: rotate(180deg);");
            $(this).children(".changeColor").attr("style", "color: black; font-size: 1.5rem");
        }

    });

    $(".anime").click(function () {
        if ($(this).attr("x") == 0) {
            $(".anime").attr("x", "0");
            $(".animi").attr("style", "transform: rotate(0deg); color: black;");
            $(".changeColor").attr("style", "color: black; font-size: 1.5rem;");
            $(".giraEmudaCor").attr("style", "color: black; font-size: 1.5rem; transform: rotate(0deg);");

            $(this).children(".changeColor").attr("style", "color: #0F8F00; font-size: 1.5rem");
            $(this).children(".giraEmudaCor").attr("style", "color: #0F8F00; font-size: 1.6rem; transform: rotate(180deg);");
            $(this).children(".animi").attr("style", "transform: rotate(180deg);");
            $(this).attr("x", "1");
        } else {
            $(this).children(".giraEmudaCor").attr("style", "color: black; font-size: 1.5rem; transform: rotate(0deg);");
            $(this).children(".changeColor").attr("style", "color: black; font-size: 1.5rem");
            $(this).children(".animi").attr("style", "transform: rotate(0deg); color: black;");
            $(this).attr("x", "0");
        }
    });
    if (interfaceAndroid != undefined) {
        $('.btSair').click(function () {
            $.ajax({url: '<?php echo $pontos ?>Controle/usuarioControle.php?function=eliminaToken'});
            interfaceAndroid.logOut();
        });
        $(".toatsURI").click(function () {
            alert('<?php echo $_SERVER['REQUEST_URI'] ?>');
        });
    }

</script>
