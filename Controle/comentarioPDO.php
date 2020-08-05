<?php

    include_once __DIR__ . '/../Controle/conexao.php';
    include_once __DIR__ . '/../Modelo/Comentario.php';
    include_once __DIR__ . '/PDOBase.php';

class ComentarioPDO extends PDOBase{
    /*inserir*/
    function inserirComentario() {
        $comentario = new comentario($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('insert into comentario values(default , :id_ordem , :id_usuario , :comentario , :hora);' );


        $stmt->bindValue(':id_ordem', $comentario->getId_ordem());    
        
        $stmt->bindValue(':id_usuario', $comentario->getId_usuario());    
        
        $stmt->bindValue(':comentario', $comentario->getComentario());    
        
        $stmt->bindValue(':hora', $comentario->getHora());    
        
        if($stmt->execute()){ 
            header('location: ../index.php?msg=comentarioInserido');
        }else{
            header('location: ../index.php?msg=comentarioErroInsert');
        }
    }
    /*inserir*/
    

            

    public function selectComentario(){
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('select * from comentario ;');
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return false;
        }
    }
    
 
    public function updateComentario(Comentario $comentario){        
         $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('update comentario set id_ordem = :id_ordem , id_usuario = :id_usuario , comentario = :comentario , hora = :hora where id_comentario = :id_comentario;');
        $stmt->bindValue(':id_ordem', $comentario->getId_ordem());
        
        $stmt->bindValue(':id_usuario', $comentario->getId_usuario());
        
        $stmt->bindValue(':comentario', $comentario->getComentario());
        
        $stmt->bindValue(':hora', $comentario->getHora());
        
        $stmt->bindValue(':id_comentario', $comentario->getId_comentario());
        $stmt->execute();
        return $stmt->rowCount();
    }            
    
    public function deleteComentario($definir){
         $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('delete from comentario where id_comentario = :definir ;');
        $stmt->bindValue(':definir', $definir);
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function deletar(){
        //$this->deleteComentario($_GET['id']);
        header('location: ../Tela/listarComentario.php');
    }


/*chave*/}
