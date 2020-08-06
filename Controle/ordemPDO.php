<?php

include_once __DIR__ . '/../Controle/conexao.php';
include_once __DIR__ . '/../Modelo/Ordem.php';
include_once __DIR__ . '/PDOBase.php';

class OrdemPDO extends PDOBase
{
    /*inserir*/
    function inserir()
    {
        $ordem = new ordem($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('insert into ordem values(default , :id_cliente , :equipamento , :descricao , :status , :data_chegada , :data_entrega , :data_pagamento , :valor);');

        $agora = new DateTime();
        $stmt->bindValue(':id_cliente', $ordem->getId_cliente());

        $stmt->bindValue(':equipamento', $ordem->getEquipamento());

        $stmt->bindValue(':descricao', $ordem->getDescricao());

        $stmt->bindValue(':status', Ordem::PENDENTE);

        $stmt->bindValue(':data_chegada', $agora->format("Y-m-d"));

        $stmt->bindValue(':data_entrega', $ordem->getData_entrega());

        $stmt->bindValue(':data_pagamento', $ordem->getData_pagamento());

        $stmt->bindValue(':valor', $ordem->getValor());

        if ($stmt->execute()) {
            header('location: ../Tela/verOrdem.php?id_ordem=' . $pdo->lastInsertId("id_ordem"));
        } else {
            header('location: ../index.php?msg=ordemErroInsert');
        }
    }

    /*inserir*/

    function editar()
    {
        $ordem = new ordem($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('update ordem set id_cliente = :id_cliente ,equipamento = :equipamento , descricao = :descricao , status = :status, valor = :valor where id_ordem = :id_ordem;');

        $agora = new DateTime();
        $stmt->bindValue(':id_cliente', $ordem->getId_cliente());
        $stmt->bindValue(':id_ordem', $ordem->getId_ordem());

        $stmt->bindValue(':equipamento', $ordem->getEquipamento());

        $stmt->bindValue(':descricao', $ordem->getDescricao());

        $stmt->bindValue(':status', $ordem->getStatus());
        switch ($ordem->getStatus()) {
            case ordem::PAGO:
                $this->updateOrdemTimePago($ordem->getId_ordem());
                break;
            case ordem::ENTREGUE:
                $this->updateOrdemTimeEntregue($ordem->getId_ordem());
                break;
        }

        $stmt->bindValue(':valor', $ordem->getValor());

        if ($stmt->execute()) {
            header('location: ../Tela/verOrdem.php?id_ordem=' . $ordem->getId_ordem());
        } else {
            header('location: ../index.php?msg=ordemErroInsert');
        }
    }
    function updateOrdemTimeEntregue($id_ordem){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("update ordem set data_entrega = now() where id_ordem = :id_ordem");
        $stmt->bindValue(':id_ordem', $id_ordem);
        return $stmt->execute();
    }

    function updateOrdemTimePago($id_ordem){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("update ordem set data_pagamento = now() where id_ordem = :id_ordem");
        $stmt->bindValue(':id_ordem', $id_ordem);
        return $stmt->execute();
    }

    function selectOrdemIndex(){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare("select * from ordem where id_ordem <> :pago order by status;");
        $stmt->bindValue(":pago" ,ordem::PAGO);
        $stmt->execute();
        return $stmt;
    }

    function selectOrdemIdordem($id_ordem)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('select * from ordem where id_ordem = :id_ordem;');
        $stmt->bindValue(':id_ordem', $id_ordem);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function selectOrdem()
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('select * from ordem ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }

    public function updateOrdem(Ordem $ordem)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('update ordem set id_cliente = :id_cliente , equipamento = :equipamento , descricao = :descricao , status = :status , data_chegada = :data_chegada , data_entrega = :data_entrega , data_pagamento = :data_pagamento , valor = :valor where id_ordem = :id_ordem;');
        $stmt->bindValue(':id_cliente', $ordem->getId_cliente());

        $stmt->bindValue(':equipamento', $ordem->getEquipamento());

        $stmt->bindValue(':descricao', $ordem->getDescricao());

        $stmt->bindValue(':status', $ordem->getStatus());

        $stmt->bindValue(':data_chegada', $ordem->getData_chegada());

        $stmt->bindValue(':data_entrega', $ordem->getData_entrega());

        $stmt->bindValue(':data_pagamento', $ordem->getData_pagamento());

        $stmt->bindValue(':valor', $ordem->getValor());

        $stmt->bindValue(':id_ordem', $ordem->getId_ordem());
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deleteOrdem($definir)
    {
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('delete from ordem where id_ordem = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function deletar()
    {
        //$this->deleteOrdem($_GET['id']);
        header('location: ../Tela/listarOrdem.php');
    }


    /*chave*/
}
