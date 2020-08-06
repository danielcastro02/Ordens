<?php 

class ordem{

private $id_ordem;
private $id_cliente;
private $equipamento;
private $descricao;
private $status;
private $data_chegada;
private $data_entrega;
private $data_pagamento;
private $valor;
const PENDENTE = 1; //Preto #00000
const ORCADO = 2; //Azul #4169E1
const REALIZANDO = 3; //Amarelo #FFD700
const IMPEDIDO = 4; //Roxo #5e35b1
const PRONTO = 5; //Verde mt claro #39FF14
const ENTREGUE = 6; //vermelho #E53935
const PAGO = 7; //Verde forte #008000



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

    function getDataChegadaFormated(){
        $newDate = explode("-" , $this->getData_chegada());
        return $newDate[2] . "/" . $newDate[1] . "/" . $newDate[0];
    }

    function getEntregaFormated(){
        $newDate = explode("-" , $this->getData_entrega());
        return $newDate[2] . "/" . $newDate[1] . "/" . $newDate[0];
    }
    function getPagoFormated(){
        $newDate = explode("-" , $this->getData_pagamento());
        return $newDate[2] . "/" . $newDate[1] . "/" . $newDate[0];
    }

     public function getId_ordem(){
         return $this->id_ordem;
     }

     function setId_ordem($id_ordem){
          $this->id_ordem = $id_ordem;
     }

     public function getId_cliente(){
         return $this->id_cliente;
     }

     function setId_cliente($id_cliente){
          $this->id_cliente = $id_cliente;
     }

     public function getEquipamento(){
         return $this->equipamento;
     }

     function setEquipamento($equipamento){
          $this->equipamento = $equipamento;
     }

     public function getDescricao(){
         return $this->descricao;
     }

     function setDescricao($descricao){
          $this->descricao = $descricao;
     }

     public function getStatus(){
         return $this->status;
     }

     function setStatus($status){
          $this->status = $status;
     }

     public function getData_chegada(){
         return $this->data_chegada;
     }

     function setData_chegada($data_chegada){
          $this->data_chegada = $data_chegada;
     }

     public function getData_entrega(){
         return $this->data_entrega;
     }

     function setData_entrega($data_entrega){
          $this->data_entrega = $data_entrega;
     }

     public function getData_pagamento(){
         return $this->data_pagamento;
     }

     function setData_pagamento($data_pagamento){
          $this->data_pagamento = $data_pagamento;
     }

     public function getValor(){
         return $this->valor;
     }

     function setValor($valor){
          $this->valor = $valor;
     }

}