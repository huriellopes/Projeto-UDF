<?php defined('BASEPATH') OR exit('No direct script access allowed');

use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;

class Welcome extends CI_Controller {

	public function index(){
		$this->load->model('boletoModel','boleto');
		$dados['pag'] = $this->boleto->GeraBoleto();
		//$this->load->helper('funcoes_helper');
		//$mpdf = new mPDF('pt','A4');
		
		$sacado = new Agente($dados['pag'][0]['nomeCliente'],$dados['pag'][0]['Cpf'],$dados['pag'][0]['endereco'],$dados['pag'][0]['cep'],$dados['pag'][0]['cidade'],$dados['pag'][0]['uf']);
		$cedente = new Agente('Seu Negocio Sob Controle', '016.909.561-43', 'Qn 05 Conjunto 10', '71.805-410', 'Brasília', 'DF');
		
		$prazo_para_pagamento = 15;
		$valor_cobrado = $dados['pag'][0]['valor_total'];
		$taxa_boleto = 5.00;
		$valor_boleto = $valor_cobrado+$taxa_boleto;
		$data_venc = date("d/m/Y", time() + ($prazo_para_pagamento * -86400));

		$boleto = new BancoDoBrasil(array(
			// Parâmetros obrigatórios
			'nosso_numero' => $dados['pag'][0]['idcarrinho'],
			'numero_documento' => $dados['pag'][0]['idcarrinho'],
			'dataVencimento' => new DateTime($data_venc),
			'data_documento' => new DateTime(),
			'data_processamento' => new DateTime(),
			'valor' => $valor_boleto,
			'sequencial' => 1234567, // Para gerar o nosso número
			'sacado' => $sacado,
			'cedente' => $cedente,
			'agencia' => 3602, // Até 4 dígitos
			'carteira' => 18,
			'conta' => 9030620, // Até 8 dígitos
			'convenio' => 1234, // 4, 6 ou 7 dígitos
			'demonstrativo' => array("Pagamento de Compra no Seu Negócio Sob Controle","Taxa Bancária - R$ 5,00"),
			'instrucoes' => array('Sr. Caixa, cobrar multa de 2% após o vencimento,','Receber até 10 dias após o vencimento,','Em caso de dúvidas entre em contato conosco: suporte@gmail.com, ','Emitido pelo sistema Seu Negócio Sob Controle!'),
			'especie_doc' => "R$",
		));
		
		$dados['boleto'] = $boleto->getOutput();
		//$mpdf->allow_charset_conversion=TRUE;
        //$mpdf->charset_in='UTF-8';
        //$mpdf->setHeader("Boleto Bancário");
		$this->load->view('welcome_message', $dados);
		//$mpdf->WriteHTML($html);
        //$mpdf->Output('Boleto Bancário ' . date('d/m/Y') . '.pdf','D');
	}
}