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
    $stmt = $ordemPDO->selectOrdemIdordem($_GET['id_ordem']);
    $ordem = new ordem($stmt->fetch());
    $clientePDO = new ClientePDO();
    $cliente = $clientePDO->selectIdOrdem($ordem->getId_cliente());
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
                    <div class="row center">
                        <h5>Editar Ordem</h5>
                        <div class="col s12 horizontal-divider"></div>
                        <div class="col s12">
                            <div class="row">
                                <div class="col s3 right-divider">
                                    <h1><?php echo $ordem->getId_ordem() ?></h1>
                                </div>
                                <div class="col s9 left-align ">
                                    <h4><?php echo $ordem->getEquipamento() ?></h4>
                                    <p>R$ <?php echo $ordem->getValor() ?></p>
                                    <p>Cliente: <?php echo $cliente->getNome() ?> </p>
                                    <p>Celular: <?php echo $cliente->getTelefone() ?></p>
                                    <?php
                                    if ($cliente->getIs_wats() == 1) {
                                        echo "<a class='btn green darken-2 right' target='_blank' href='https://api.whatsapp.com/send?phone=55" . $cliente->getClenPhone() . "'>Link do whats</a>";
                                    }
                                    ?>
                                    <span style="white-space: pre-wrap; user-select: text;">Descrição:<br><?php echo $ordem->getDescricao() ?></span>
                                </div>
                                <br>
                                <?php
                                switch ($ordem->getStatus()){
                                    case ordem::PENDENTE:
                                        ?><a href="../Controle/ordemControle.php?function=setOrderOrcado&id_ordem=<?php echo $ordem->getId_ordem() ?>" class="btn blue lighten-1">Orçado</a> <?php
                                        break;
                                    case ordem::ORCADO:
                                        ?><a href="../Controle/ordemControle.php?function=setOrderRealizado&id_ordem=<?php echo $ordem->getId_ordem() ?>" class="btn yellow darken-3">Realizando</a> <?php
                                        break;
                                    case ordem::REALIZANDO:
                                        ?><a href="../Controle/ordemControle.php?function=setOrderImpedido&id_ordem=<?php echo $ordem->getId_ordem() ?>" style="background-color: #5e35b1" class="btn purple">Impedido</a> <?php
                                        ?><a href="../Controle/ordemControle.php?function=setOrderPronto&id_ordem=<?php echo $ordem->getId_ordem() ?>" class="btn yellow darken-3">Realizado</a> <?php
                                        break;
                                    case ordem::IMPEDIDO:
                                        ?><a href="../Controle/ordemControle.php?function=setOrderPronto&id_ordem=<?php echo $ordem->getId_ordem() ?>" class="btn green lighten-2">Pronto</a> <?php
                                        ?><a href="../Controle/ordemControle.php?function=setOrderRealizando&id_ordem=<?php echo $ordem->getId_ordem() ?>" class="btn yellow">Realizando</a> <?php
                                        break;
                                    case ordem::PRONTO:
                                        ?><a href="../Controle/ordemControle.php?function=setOrderEntregue&id_ordem=<?php echo $ordem->getId_ordem() ?>" class="btn red lighten-1">Entregue</a> <?php
                                        break;
                                    case ordem::ENTREGUE:
                                        ?><a href="../Controle/ordemControle.php?function=setOrderPago&id_ordem=<?php echo $ordem->getId_ordem() ?>" class="btn green darken-2">Pago</a> <?php
                                        break;
                                    case ordem::PAGO:
                                        ?><a href="#!" class="btn green darken-2">Tudo Certo</a> <?php
                                        break;
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col s12 horizontal-divider"></div>
                        <div class="col s12">
                            <div class="row">
                                <div class="col s10 offset-s1">
                                    <h4>Comentários</h4>
                                    <?php
                                    $comentarioPDO = new ComentarioPDO();
                                    $usuarioPDO = new UsuarioPDO();
                                    $comentarios = $comentarioPDO->selectComentarioIdOrdem($ordem->getId_ordem());
                                    if ($comentarios) {
                                        while ($linha = $comentarios->fetch()) {
                                            $comentario = new comentario($linha);
                                            $usuariocoment = $usuarioPDO->selectUsuarioIdUsuario($comentario->getId_usuario());
                                            $usuariocoment = new usuario($usuariocoment->fetch());
                                            ?>
                                            <div class="row left-align">
                                                <p><?php echo $usuariocoment->getNome() . ' - ' . $comentario->getHoraFormated(); ?></p>
                                                <p><?php echo $comentario->getComentario() ?></p>
                                                <div class="col s12 horizontal-divider"></div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <form class="row" method="post"
                                          action="../Controle/comentarioControle.php?function=inserir">
                                        <div class="input-field col s10">
                                            <input type="text" name="comentario" id="comentario">
                                            <input type="text" name="id_ordem"
                                                   value="<?php echo $ordem->getId_ordem(); ?>"
                                                   hidden>
                                            <label for="comentario">Comentário</label>
                                        </div>
                                        <div class="col s2">
                                            <button type="submit" class="btn green darken-2">-></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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

