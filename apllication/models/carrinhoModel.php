<?php

    class Carrinhomodel extends CI_model{
        
        public function __construct(){
            parent::__construct();
            $this->load->database();
        }

        public function finalizaCompra(){
            $data = array(
                        'id'
                    );
        }
    }
?>