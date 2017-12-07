<?php defined('BASEPATH') OR exit('No direct script access allowed');

// usando a API do OpenBoleto
use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;

class Boletocontroller extends CI_Controller {

    public function gerarBoleto(){
        $
        $sacado = new Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
        $cedente = new Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');
        
        $prazo_para_pagamento = 10;
        $taxa_boleto = 5.00;
        $data_venc = date("d/m/Y", time() + ($prazo_para_pagamento * 86400));
    
        $boleto = new BancoDoBrasil(array(
            // Parâmetros obrigatórios
            'dataVencimento' => new DateTime($data_venc),
            'valor' => 23.00,
            'sequencial' => 1234567, // Para gerar o nosso número
            'sacado' => $sacado,
            'cedente' => $cedente,
            'agencia' => 1724, // Até 4 dígitos
            'carteira' => 18,
            'conta' => 10403005, // Até 8 dígitos
            'convenio' => 1234, // 4, 6 ou 7 dígitos
        ));
         
            $dados['boleto'] = $boleto->getOutput();		
            $this->load->view('welcome_message', $dados);
        }
    }

}
?>