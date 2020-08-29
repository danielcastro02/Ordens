<?php
include_once '../Base/requerLogin.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php
    include_once '../Controle/relatorio_mensalPDO.php';
    include_once '../Controle/descricaoPDO.php';
    include_once '../Modelo/Relatorio_mensal.php';
    include_once '../Modelo/Descricao.php';
    $relatorioPDO = new Relatorio_mensalPDO();
    $descricaoPDO = new DescricaoPDO();
    include_once '../Base/header.php';
    ?>
<body class="homeimg">
<?php
include_once '../Base/navBar.php';
?>
<main>

    <div class="row">
        <div class="col s10 offset-s1">
            <form action="./resumoCaixa.php" method="post" name="relatorio" id="relatorio" class="col s12">
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

            <div class="row">
                <?php
                if (isset($_POST['id_relatorio'])) {
                    $movimentoPDO = new MovimentoPDO();
                    $atual = $relatorioPDO->selectRelatorio_mensalId($_POST['id_relatorio']);
                    $atual = new relatorio_mensal($atual->fetch());
                    $anterior = $relatorioPDO->selectRelatorio_mensalId($atual->getAnterior());
                    $anterior = new relatorio_mensal($anterior->fetch());

                    $saldo = $anterior->getSaldofinal();

                    $stmt = $movimentoPDO->selectMovimentoId_mes($_POST['id_relatorio']);
                    if ($stmt) {
                        while ($linha = $stmt->fetch()){
                            $movimento = new movimento($linha);
                            if($movimento->getOperacao()=='entrada'){
                                $saldo = $saldo+$movimento->getValor();
                            }else{
                                $saldo = $saldo-$movimento->getValor();
                            }
                        }
                    }
                    $retiradaDaniel = $movimentoPDO->selectRetiradasDaniel($atual->getId());
                    $totalEntradas = $movimentoPDO->selectTotalEntradas($atual->getId());
                    $totalGastos = $movimentoPDO->selectTotalGastos($atual->getId());
                    $retiradaFrancisco = $movimentoPDO->selectRetiradasFrancisco($atual->getId());
                    $total = $saldo+$retiradaDaniel+$retiradaFrancisco;
                    $dividendoDaniel = ($total/2)+300;
                    $dividendoFrancisco = ($total/2)-300;
                    $restanteDanel = $dividendoDaniel - $retiradaDaniel;
                    $restanteFrancisco = $dividendoFrancisco - $retiradaFrancisco;
                ?>
                <div class="col s4 right-divider">
                    <h5>Totais</h5>
                    <p>Saldo Inicial: <?php echo "R$ ".$anterior->getSaldofinal(); ?></p>
                    <p>Entradas: <?php echo "R$ ".$totalEntradas; ?></p>
                    <p>Gastos: <?php echo "R$ ".$totalGastos; ?></p>
                    <p>Retiradas: <?php echo "R$ ".($retiradaFrancisco+$retiradaDaniel); ?></p>
                    <p>Saldo: <?php echo "R$ ".$saldo; ?></p>
                </div>
                <div class="col s3 right-divider">
                    <h5>Daniel</h5>
                    <p>Total: <?php echo "R$ " . $dividendoDaniel ?></p>
                    <p>Retirado: <?php echo "R$ " . $retiradaDaniel ?></p>
                    <p>Restante: <?php echo "R$ " . $restanteDanel ?></p>
                </div>
                <div class="col s3 right-divider">
                    <h5>Francisco</h5>
                    <p>Total: <?php echo "R$ " . $dividendoFrancisco ?></p>
                    <p>Retirado: <?php echo "R$ " . $retiradaFrancisco ?></p>
                    <p>Restante: <?php echo "R$ " . $restanteFrancisco ?></p>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</main>
<?php
include_once '../Base/footer.php';
?>
<script>
    $("select").formSelect();
</script>
</body>
</html>

