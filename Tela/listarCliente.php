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
    <title>Login</title>
    <?php
    include_once '../Base/header.php';
    ?>
<body class="homeimg">
<?php
include_once '../Base/iNav.php';
include_once '../Controle/clientePDO.php';
$clientePDO = new ClientePDO();
include_once '../Controle/ordemPDO.php';
include_once '../Modelo/Cliente.php';
include_once '../Modelo/Ordem.php';
$clientePDO = new ClientePDO();
$ordemPDO = new OrdemPDO();
?>
<main>
    <div class="row containerMeu">
        <div class="card col s12">
            <h4 class="textoCorPadrao2 center">Clientes</h4>
            <div class="divider" style="margin-bottom: 0"></div>
            <ul class="collection">
                <?php
                $stmtCliente = $clientePDO->selectCliente();
                if ($stmtCliente) {
                    while ($linha = $stmtCliente->fetch()) {
                        $cliente = new Cliente($linha);
                        ?>
                        <li class="collection-item avatar" style="max-height: 84px !important">
                            <div class="col center-align divListParteEsquerda">
                                <div><span>Status</span></div>
                                <?php
                                    $statusBadge = "";
                                    $corDoBadge = "";
                                    if($cliente::ST_DEVENDO == $cliente->getSTATUS()){
                                        $statusBadge = "Devendo";
                                        $corDoBadge = "#E53935";
                                    }else{
                                        $statusBadge = "Em Dia";
                                        $corDoBadge = "#39FF14";
                                    }
                                ?>

                                <span style="background-color: <?php echo $corDoBadge ?>; white-space: nowrap;" class="new badge badgeStatus"><?php echo $statusBadge ?></span>
                            </div>
                            <div class="moreVertIcon col">
                                <a href="#!" x="<?php echo $cliente->getId_cliente()?>" class="abrirDescricao black-text"><i class="material-icons">more_vert</i></a>
                            </div>
                            <div class="divWraper col infoPrincipal" style="max-height: 64px"  x="<?php echo $cliente->getId_cliente()?>">
                                <span class="title"><?php echo $cliente->getNome() ?></span>
                                <p><?php echo $cliente->getTelefone() ?><br>
                                    Wats: <?php echo $cliente->getIs_wats() == 1 ? "Sim" : "Não" ?>
                                </p>
                            </div>
                            <div class="divWraper col maisDetalhes" style="max-height: 64px" x="<?php echo $cliente->getId_cliente()?>">
                                <span class="title">Mais detalhes</span>
                                <p >
                                    Id: <?php echo $cliente->getId_cliente()?>
                                    <br>
                                </p>
                            </div>
                            <a href="./verCliente.php?id_cliente=<?php echo $cliente->getId_cliente() ?>" class="itemListUsuario terceiroItem"><i class="material-icons indigo-text">description</i></a>
                            <a href="./editarPessoa.php?id_pessoa=<?php echo $cliente->getId_cliente() ?>" class="itemListUsuario primeiroItem"><i class="material-icons textoCorPadrao2">edit</i></a>
                            <a class="itemListUsuario segundoItem modal-trigger deletarPessoa" idPessoa="<?php echo $cliente->getId_cliente() ?>"><i class="material-icons red-text text-darken-2">clear</i></a>

                        </li>
                        <?php
                    }
                } else {?>
                    <div class="card-title center" style="padding-top: 8px">
                        Nenhum Cliente cdastrado

                        <div class="row col s12">
                            <a href="<?php echo $pontos . 'Tela/registroCliente.php' ?>" class="black-text col offset-s4 s4">
                                <li class="btnAdicionarPessoa" >
                                    Adicionar Cliente
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
