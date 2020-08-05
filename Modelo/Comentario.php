<?php 

class comentario{

private $id_comentario;
private $id_ordem;
private $id_usuario;
private $comentario;
private $hora;


public function __construct() {
    if (func_num_args() != 0) {
        $atributos = func_get_args()[0];
        foreach ($atributos as $atributo => $valor) {
                if (isset($valor)) {
                    $this->$atributo = $valor;
                }
            }
        }
    }

    function atualizar($vetor) {
        foreach ($vetor as $atributo => $valor) {
            if (isset($valor)) {
                $this->$atributo = $valor;
            }
        }
    }

     public function getId_comentario(){
         return $this->id_comentario;
     }

     function setId_comentario($id_comentario){
          $this->id_comentario = $id_comentario;
     }

     public function getId_ordem(){
         return $this->id_ordem;
     }

     function setId_ordem($id_ordem){
          $this->id_ordem = $id_ordem;
     }

     public function getId_usuario(){
         return $this->id_usuario;
     }

     function setId_usuario($id_usuario){
          $this->id_usuario = $id_usuario;
     }

     public function getComentario(){
         return $this->comentario;
     }

     function setComentario($comentario){
          $this->comentario = $comentario;
     }

     public function getHora(){
         return $this->hora;
     }

     function setHora($hora){
          $this->hora = $hora;
     }

}