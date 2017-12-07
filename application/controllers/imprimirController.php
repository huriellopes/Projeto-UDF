<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imprimircontroller extends CI_Controller {
    
    public function GeradoEstoque(){
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/relatorio/imprimir/geradoEstoque');
        $this->load->view('administrador/includes/footer');
    }
}

?>