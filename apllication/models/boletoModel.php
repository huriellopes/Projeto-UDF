<?php

    class Boletomodel extends CI_model{
        public function GeraBoleto(){
            $this->db->select("*");
            $this->db->from("carrinho c");
            $this->db->join("cliente cl","c.id_cliente = cl.idcliente","INNER");
            $this->db->join("produto p","c.id_produto = p.idProduto","INNER");

            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }
            return $registros;
        }    
    }
?>