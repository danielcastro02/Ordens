<?php
include_once '../Base/requerLogin.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <?php
    include_once '../Base/header.php';
    include_once "../Modelo/Cliente.php";
    include_once "../Modelo/Ordem.php";
    include_once "../Modelo/Comentario.php";
    include_once "../Modelo/Usuario.php";
    include_once "../Controle/clientePDO.php";
    include_once "../Controle/usuarioPDO.php";
    include_once "../Controle/clientePDO.php";
    include_once "../Controle/ordemPDO.php";
    include_once "../Controle/comentarioPDO.php";
    $ordemPDO = new OrdemPDO();
    $clientePDO = new ClientePDO();
    $cliente = $clientePDO->selectClienteIdCliente($_GET['id_cliente']);
    $cliente = new cliente($cliente->fetch());
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
                <h4><?php echo $cliente->getNome() ?></h4>
                <p>Celular: <?php echo $cliente->getTelefone(); ?></p><?php
                if ($cliente->getIs_wats() == 1) {
                    echo "<a class='btn green darken-2' target='_blank' href='https://api.whatsapp.com/send?phone=55" . $cliente->getClenPhone() . "'>Link do whats</a>";
                }
                ?>
                </div>
                <div class="col s12">
                    <h4 class="textoCorPadrao2 center">Ordens</h4>
                    <div class="divider" style="margin-bottom: 0px"></div>
                    <ul class="collection">
                        <?php
                        $stmtOrdem = $ordemPDO->selectOrdemIdCliente($cliente->getId_cliente());
                        if ($stmtOrdem) {
                            while ($linha = $stmtOrdem->fetch()) {
                                $ordem = new Ordem($linha);

                                $stmtClienteOrdem = $clientePDO->selectIdOrdem($ordem->getId_cliente());
                                $cliente = new Cliente();
                                $cliente->atualizar($stmtClienteOrdem->fetch());
                                ?>
                                <li class="collection-item avatar">
                                    <div class="col center-align divListParteEsquerda">
                                        <!--ID--> <p style="font-size: 25px"><?php echo $ordem->getId_ordem() ?></p>
                                        <!--                                <div style="margin-bottom: 15px"><span>Status</span></div>-->
                                        <div style="height: 15px"></div>
                                        <?php
                                        $corDoBadge = "";
                                        $statusBadge = "";
                                        if(ordem::PENDENTE == $ordem->getStatus()){
                                            $statusBadge = "Pendente";
                                            $corDoBadge = "#00000";
                                        }else if(ordem::ORCADO == $ordem->getStatus()){
                                            $statusBadge = "Orçado";
                                            $corDoBadge = "#4169E1";
                                        }else if(ordem::REALIZANDO == $ordem->getStatus()){
                                            $statusBadge = "Realizado";
                                            $corDoBadge = "#FFD700";
                                        }else if(ordem::IMPEDIDO == $ordem->getStatus()){
                                            $statusBadge = "Impedido";
                                            $corDoBadge = "#5e35b1";
                                        }else if(ordem::PRONTO == $ordem->getStatus()){
                                            $statusBadge = "Pronto";
                                            $corDoBadge = "#39FF14";
                                        }else if(ordem::ENTREGUE == $ordem->getStatus()){
                                            $statusBadge = "Entregue";
                                            $corDoBadge = "#E53935";
                                        }else if(ordem::PAGO == $ordem->getStatus()){
                                            $statusBadge = "Pago";
                                            $corDoBadge = "#008000";
                                        }
                                        ?>

                                        <span style="background-color: <?php echo $corDoBadge ?>" class="new badge badgeStatus"><?php echo $statusBadge ?></span>
                                    </div>
                                    <div class="moreVertIcon col">
                                        <a href="#!" x="<?php echo $ordem->getId_ordem()?>" class="abrirDescricao black-text"><i class="material-icons">more_vert</i></a>
                                    </div>
                                    <div class="divWraper col infoPrincipal" x="<?php echo $ordem->getId_ordem()?>">
                                        <span class="title">Cliente: <?php echo $cliente->getNome() ?></span>
                                        <p>Chegou: <?php echo $ordem->getDataChegadaFormated()?>
                                            <br class="hide-on-med-and-up ">
                                            Saiu: <?php echo $ordem->getEntregaFormated() ?>
                                            <br>
                                            Preço: R$ <?php echo $ordem->getValor() ?>
                                        </p>
                                    </div>
                                    <div class="divWraper col maisDetalhes" x="<?php echo $ordem->getId_ordem()?>">
                                        <span class="title">Mais detalhes</span>
                                        <p>
                                            Pagamento: <?php echo $ordem->getPagoFormated()?>
                                        </p>
                                        <p >
                                            <?php echo $ordem->getDescricao()?>
                                        </p>
                                    </div>
                                    <a href="../Tela/verOrdem.php?id_ordem=<?php echo $ordem->getId_ordem() ?>" class="itemListUsuario terceiroItem"><i class="material-icons indigo-text">description</i></a>
                                    <a href="../Tela/editarOrdem.php?id_ordem=<?php echo $ordem->getId_ordem() ?>" class="itemListUsuario primeiroItem"><i class="material-icons textoCorPadrao2">edit</i></a>
                                    <a class="itemListUsuario segundoItem modal-trigger deletarPessoa" idPessoa="<?php echo $ordem->getId_ordem() ?>"><i class="material-icons red-text text-darken-2">clear</i></a>

                                </li>
                                <?php
                            }
                        } else {?>
                            <div class="card-title center" style="padding-top: 8px">
                                Nenhuma ordem registrada

                                <div class="row col s12">
                                    <a href="<?php echo $pontos . 'Tela/registroCliente.php' ?>" class="black-text col offset-s4 s4">
                                        <li class="btnAdicionarPessoa" >
                                            Nova ordem
                                            <i style="line-height: 32px; height: 26px" class="material-icons textoCorPadrao2">add</i>
                                        </li>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </ul>
                    <br>
                    <div class="row center">
                        <a href="../index.php" class="btn corPadrao3">Voltar</a>
                    </div>
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

