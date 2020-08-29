<?php
include_once "../Modelo/Parametros.php";
$parametros = new Parametros();
if(!$parametros->isContasPublicas()) {
    include_once '../Base/requerLogin.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php
    include_once '../Controle/relatorio_mensalPDO.php';
    include_once '../Modelo/Relatorio_mensal.php';
    include_once '../Modelo/Movimento.php';
    include_once '../Controle/movimentoPDO.php';
    $relatorioPDO = new Relatorio_mensalPDO();
    $movimentoPDO = new MovimentoPDO();
    include_once '../Base/header.php';
    ?>
    <style>
        td, th {
            padding: 15px 15px !important;
        }
    </style>
<body class="homeimg">
<?php
include_once '../Base/navBar.php';
?>

<main>
    <div class="row">
        <div class="col m10 offset-m1 s12">
            <h4 class="textoCorPadrao2 center">Relatórios Mensais</h4>
            <div class="row">
                <form action="./consultaRelatorio.php" method="post" name="relatorio" id="relatorio" class="col s12">
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="id_relatorio">
                                <?php
                                $relatorioPDO = new Relatorio_mensalPDO();
                                $stmt = $relatorioPDO->selectRelatorio_mensal();
                                while ($linha = $stmt->fetch()) {
                                    $relatorio = new relatorio_mensal($linha);
                                    if ($relatorio->getMes() != "Primeiro") {
                                        echo "<option value='" . $relatorio->getId() . "'>" . $relatorio->getMes() . " " . $relatorio->getAno() . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label for="id_relatorio">Mês</label>
                        </div>
                        <div class="col s4 input-field offset-s2">
                            <button class="btn green lighten-1 right" type="submit">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col m8 s12">
                    <div class="card col s12 cardPrincipal" style="padding: 5px 5px 10px; margin-bottom: 0.2rem;">
                        <?php
                        $atual = $relatorioPDO->selectRelatorio_mensalId($_POST['id_relatorio']);
                        $atual = new relatorio_mensal($atual->fetch());
                        echo "<h5>Relatório: " . $atual->getMes() . " de " . $atual->getAno() . "</h5>"
                        ?>

                        <h5>Saldo inicial: <?php
                            $anterior = $relatorioPDO->selectRelatorio_mensalId($atual->getAnterior());
                            $anterior = new relatorio_mensal($anterior->fetch());
                            echo 'R$ ' . $anterior->getSaldofinal();
                            ?></h5>

                        <div class="marginBtn">
                            <a class="btn corPadrao2"
                               href="./graficoLinha.php?id_mes=<?php echo $atual->getId() ?>">Ver
                                gráfico de linhas</a>
                            <a class="btn corPadrao2"
                               href="./imprimirRelatorio.php?id_relatorio=<?php echo $atual->getId() ?>">Imprimir</a>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card col m12 s6 center" style="margin-bottom: 0.2rem;">
                        <span class="card-title">Entradas</span>
                        <p class="bold" style="font-size: 20px;"><?php echo $movimentoPDO->countOperacao($_POST['id_relatorio'], "entrada") ?></p>
                    </div>
                    <div class="card col m12 s6 center">
                        <span class="card-title">Saidas</span>
                        <p class="bold" style="font-size: 20px;"><?php echo $movimentoPDO->countOperacao($_POST['id_relatorio'], "saida") ?></p>
                    </div>
                </div>
            </div>

            <div class="row hide-on-med-and-down">
                <?php
                if (isset($_POST['id_relatorio'])) {
                    $movimentoPDO = new MovimentoPDO();
                    $stmt = $movimentoPDO->selectMovimentoId_mes($_POST['id_relatorio']);
                    if ($stmt) {
                        ?>

                        <table class="bordered striped col s12 white">
                            <thead>
                            <tr>
                                <th class="center" style="width: 60px">Dia</th>
                                <th>Entrada</th>
                                <th>Saida</th>
                                <th>Saldo</th>
                                <th>Descrição</th>
                                <th class="center" style="width: 60px">Anexo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $valor = $anterior->getSaldofinal();
                            while ($linha = $stmt->fetch()) {
                                $movimento = new movimento($linha);
                                ?>

                                <tr>
                                    <td class="center"><?php echo $movimento->getData() ?></td>
                                    <?php
                                    if ($movimento->getOperacao() == 'entrada') {
                                        echo "<td>" . 'R$ ' . $movimento->getValor() . "</td><td></td>";
                                        $valor = $valor + $movimento->getValor();
                                    } else {
                                        echo "<td></td><td>" . 'R$ ' . ($movimento->getValor()) . "</td>";
                                        $valor = $valor - $movimento->getValor();
                                    }
                                    ?>
                                    <td><?php echo 'R$ ' . number_format($valor, 2, '.', ''); ?></td>
                                    <td><?php echo $movimento->getDescricao(); ?></td>
                                    <?php
                                    include_once "../Controle/anexoPDO.php";
                                    include_once "../Modelo/Anexo.php";
                                    $anexoPDO = new AnexoPDO();
                                    $anexo = $anexoPDO->selectAnexoIdMovimento($movimento->getId());
                                    if ($anexo) {
                                        ?>
                                        <td><a href="..<?php echo $anexo->getCaminho(); ?>">Anexo</a></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td>--</td>
                                        <?php
                                    }
                                    ?>
                                </tr>


                                <?php
                            }
                            ?> </tbody>
                        </table>
                        <div class="row">
                            <div class="col s12">
                                <div class="card" style="padding: 1px 10px; border-radius: 4px">
                                    <h5>Saldo final: <?php echo 'R$ ' . number_format($valor, 2, '.', ''); ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo 'Nenhum movimento';
                    }
                }
                ?>
            </div>


            <div class="row hide-on-large-only">
                <div class="col s12">
                <?php
                if (isset($_POST['id_relatorio'])) {
                    $movimentoPDO = new MovimentoPDO();
                    $stmt = $movimentoPDO->selectMovimentoId_mes($_POST['id_relatorio']);
                    if ($stmt) {
                        ?>

                        <ul class="collapsible no-padding">
                            <?php
                            $valor = $anterior->getSaldofinal();
                            while ($linha = $stmt->fetch()) {
                                $movimento = new movimento($linha);
                                ?>

                                <li>
                                    <div class="collapsible-header">Dia <?php echo $movimento->getData() ?>
                                    <?php
                                    if ($movimento->getOperacao() == 'entrada') {
                                        echo "" . '- Entrada: R$ ' . $movimento->getValor();
                                        $valor = $valor + $movimento->getValor();
                                    } else {
                                        echo '- Saída: R$ ' . ($movimento->getValor());
                                        $valor = $valor - $movimento->getValor();
                                    }
                                    ?>
                                    <?php echo ' - Saldo: R$ ' . number_format($valor, 2, '.', ''); ?></div>
                                    <div class="collapsible-body grey lighten-3"><?php echo $movimento->getDescricao(); ?>
                                    <?php
                                    include_once "../Controle/anexoPDO.php";
                                    include_once "../Modelo/Anexo.php";
                                    $anexoPDO = new AnexoPDO();
                                    $anexo = $anexoPDO->selectAnexoIdMovimento($movimento->getId());
                                    if ($anexo) {
                                        ?>
                                        <a href="..<?php echo $anexo->getCaminho(); ?>">Anexo</a></div>
                                        <?php
                                    }else{
                                        ?>
                                       --</div>
                                        <?php
                                    }
                                    ?>
                                </li>


                                <?php
                            }
                            ?>
                        </ul>
                        <div class="row">
                            <div class="col s12">
                                <div class="card" style="padding: 1px 10px; border-radius: 4px">
                                    <h5>Saldo final: <?php echo 'R$ ' . number_format($valor, 2, '.', ''); ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo 'Nenhum movimento';
                    }
                }
                ?>
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
    $('select').formSelect();
    $('.collapsible').collapsible();
</script>
</body>
</html>

