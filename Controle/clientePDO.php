<?php

    include_once __DIR__ . '/../Controle/conexao.php';
    include_once __DIR__ . '/../Modelo/Cliente.php';
    include_once __DIR__ . '/PDOBase.php';

class ClientePDO extends PDOBase{
    /*inserir*/
    function inserirCliente() {
        $cliente = new cliente($_POST);
        $pdo = $conexao::getConexao();
        $stmt = $pdo->prepare('insert into cliente values(:id_cliente , :nome , :tefone , :is_wats , :STATUS);' );

        $stmt->bindValue(':id_cliente', $cliente->getId_cliente());    
        
        $stmt->bindValue(':nome', $cliente->getNome());    
        
        $stmt->bindValue(':tefone', $cliente->getTefone());    
        
        $stmt->bindValue(':is_wats', $cliente->getIs_wats());    
        
        $stmt->bindValue(':STATUS', $cliente->getSTATUS());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=clienteInserido');
        }else{
            header('location: ../index.php?msg=clienteErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectCliente(){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('select * from cliente ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateCliente(Cliente $cliente){        
         $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('update cliente set nome = :nome , tefone = :tefone , is_wats = :is_wats , STATUS = :STATUS where id_cliente = :id_cliente;');
        $stmt->bindValue(':nome', $cliente->getNome());
        
        $stmt->bindValue(':tefone', $cliente->getTefone());
        
        $stmt->bindValue(':is_wats', $cliente->getIs_wats());
        
        $stmt->bindValue(':STATUS', $cliente->getSTATUS());
        
        $stmt->bindValue(':id_cliente', $cliente->getId_cliente());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteCliente($definir){
         $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('delete from cliente where id_cliente = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        //$this->deleteCliente($_GET['id']);
        header('location: ../Tela/listarCliente.php');
    }


/*chave*/}
