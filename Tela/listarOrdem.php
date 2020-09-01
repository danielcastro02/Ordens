<?php
if(!isset($_SESSION)){
    session_start();
}
include_once '../Base/requerLogin.php';
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Listagem Ordens</title>
    <?php
    include_once '../Base/header.php';
    ?>
<body class="homeimg">
<?php
include_once '../Base/iNav.php';
include_once '../Controle/ordemPDO.php';
include_once '../Controle/clientePDO.php';
include_once '../Modelo/Cliente.php';
include_once '../Modelo/Ordem.php';
$clientePDO = new ClientePDO();
$ordemPDO = new OrdemPDO();
?>
<main>
    <div class="row containerMeu">
        <div class="card col s12">
            <h4 class="textoCorPadrao2 center">Ordens</h4>
            <div class="divider" style="margin-bottom: 0px"></div>
            <ul class="collection">
                <?php
                $stmtOrdem = $ordemPDO->selectOrdem();
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
                                    <br class="hide-on-med-and-up"/>
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
                                    Sobre: <?php echo $ordem->getDescricao()?>
                                </p>
                            </div>
                            <a href="./verOrdem.php?id_ordem=<?php echo $ordem->getId_ordem() ?>" class="itemListUsuario terceiroItem"><i class="material-icons indigo-text">description</i></a>
                            <a href="./editarOrdem.php?id_ordem=<?php echo $ordem->getId_ordem() ?>" class="itemListUsuario primeiroItem"><i class="material-icons textoCorPadrao2">edit</i></a>
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
</main>
<div id="modalDeletar" class="modal">
    <form action="../Controle/pessoaControle.php?function=deletar" method="post">
        <div class="modal-content">
            <input type="text" name="id_pessoa" value="" id="inputIdPessoa" hidden>
            <h4>Atenção</h4>
            <p>Você realmente deseja deletar essa pessoa</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn corPadrao2">Cancelar</a>
            <button type="submit" class="modal-close waves-effect waves-green btn red darken-1">Deletar</button>
        </div>
    </form>
</div>
<?php
include_once '../Base/footer.php';
?>
</body>
</html>
<script>
    // Script para fazer o toggle do descrição

    $('.abrirDescricao').click(function (){
        var x = $(this).attr('x');
        $('.infoPrincipal').each(function (){
            if(x == $(this).attr('x')){
                $(this).slideToggle();
            }
        });
        $('.maisDetalhes').each(function (){
            if(x == $(this).attr('x')){
                $(this).slideToggle();
            }
        });
    });

    $('.modal').modal();

    $('.deletarPessoa').click(function () {
        var id_pessoa = $(this).attr('idPessoa');
        $('#inputIdPessoa').val(id_pessoa);
        $('#modalDeletar').modal('open');
    });
</script>