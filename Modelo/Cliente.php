<?php 

class cliente{

private $id_cliente;
private $nome;
private $tefone;
private $is_wats;
private $STATUS;


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

     public function getId_cliente(){
         return $this->id_cliente;
     }

     function setId_cliente($id_cliente){
          $this->id_cliente = $id_cliente;
     }

     public function getNome(){
         return $this->nome;
     }

     function setNome($nome){
          $this->nome = $nome;
     }

     public function getTefone(){
         return $this->tefone;
     }

     function setTefone($tefone){
          $this->tefone = $tefone;
     }

     public function getIs_wats(){
         return $this->is_wats;
     }

     function setIs_wats($is_wats){
          $this->is_wats = $is_wats;
     }

     public function getSTATUS(){
         return $this->STATUS;
     }

     function setSTATUS($STATUS){
          $this->STATUS = $STATUS;
     }

}