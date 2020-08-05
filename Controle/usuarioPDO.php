<?php

    include_once __DIR__ . '/../Controle/conexao.php';
    include_once __DIR__ . '/../Modelo/Usuario.php';
    include_once __DIR__ . '/PDOBase.php';

class UsuarioPDO extends PDOBase{
    /*inserir*/
    function inserirUsuario() {
        $usuario = new usuario($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('insert into usuario values(default , :nome , :usuario , :senha , :foto);' );


        $stmt->bindValue(':nome', $usuario->getNome());    
        
        $stmt->bindValue(':usuario', $usuario->getUsuario());    
        
        $stmt->bindValue(':senha', $usuario->getSenha());    
        
        $stmt->bindValue(':foto', $usuario->getFoto());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=usuarioInserido');
        }else{
            header('location: ../index.php?msg=usuarioErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectUsuario(){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('select * from usuario ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateUsuario(Usuario $usuario){        
         $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('update usuario set nome = :nome , usuario = :usuario , senha = :senha , foto = :foto where id_usuario = :id_usuario;');
        $stmt->bindValue(':nome', $usuario->getNome());
        
        $stmt->bindValue(':usuario', $usuario->getUsuario());
        
        $stmt->bindValue(':senha', $usuario->getSenha());
        
        $stmt->bindValue(':foto', $usuario->getFoto());
        
        $stmt->bindValue(':id_usuario', $usuario->getId_usuario());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteUsuario($definir){
         $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('delete from usuario where id_usuario = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        //$this->deleteUsuario($_GET['id']);
        header('location: ../Tela/listarUsuario.php');
    }


/*chave*/}
