<?php

    include_once __DIR__ . '/../Controle/conexao.php';
    include_once __DIR__ . '/../Modelo/Usuario.php';
    include_once __DIR__ . '/PDOBase.php';

class UsuarioPDO extends PDOBase{
    /*inserir*/
    function inserir() {
        $usuario = new usuario($_POST);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('insert into usuario values(default , :nome , :usuario , :senha , :foto);' );


        $stmt->bindValue(':nome', $usuario->getNome());    
        
        $stmt->bindValue(':usuario', $usuario->getUsuario());    

        if($_POST['senha1'] == $_POST['senha2']){
            $stmt->bindValue(':senha', md5($_POST['senha1']));
        }else{
            $this->addToast("Senhas não coincidem!");
            header("location: ../Tela/registroUsuario.php");
        }

        $stmt->bindValue(':foto', '');
        
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

    public function login(){
        $senha = md5($_POST['senha']);
        $pdo = conexao::getConexao();
        $stmt = $pdo->prepare('select * from usuario where usuario = :usuario and senha = :senha');
        $stmt->bindValue(":usuario" , $_POST['usuario']);
        $stmt->bindValue(":senha" , $senha);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $usuario = new usuario($stmt->fetch());
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['logado'] = serialize($usuario);
            header('location: ../index.php');
        }else{
            $this->addToast("Usuário ou senha errados!");
            header("location: ../Tela/login.php");
        }
    }

    function logout(){
        session_destroy();
        header('location: ../Tela/login.php');
    }

/*chave*/}
