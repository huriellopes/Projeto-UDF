<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    // Define a Data e Hora padrão do servidor!
    date_default_timezone_set('America/Sao_Paulo');

    // usando a API do OpenBoleto
    use OpenBoleto\Banco\BancoDoBrasil;
    use OpenBoleto\Agente;

    class Carrinhocontroller extends CI_Controller{
        
        public function Session_cliente(){
            if($this->session->userdata('logado') == false){
                redirect('siteController/LoginCliente/8');
            }
        }

        public function listar(){
            $this->Session_cliente();
            
            $this->load->view('site/AreaCliente/restrito/includes/header');
            $this->load->view('site/AreaCliente/restrito/includes/menu');
            $this->load->view('site/AreaCliente/restrito/carrinho/carrinho');
            $this->load->view('site/AreaCliente/restrito/includes/footer');
        }

        public function atualizar(){
			$this->Session_cliente();
			//recebo todo o conteúdo postado do formulário e no loop abaixo recupero o que preciso
			$conteudo_postado = $this->input->post();
			
			foreach($conteudo_postado as $conteudo) {
				
				$dados[] = array(
				
					"rowid" => $conteudo['rowid'],
					"qty" => $conteudo['qty']
				
				);
                
                $this->cart->update($dados);
            }
            
            //com os dados já preparados, basta dar um update no carrinho
			
			redirect('carrinhoController/listar');
			
		}

        public function inserirProduto(){
            $this->Session_cliente();
            $data = array(
                'id_produto'    => $this->input->post('idProduto'),
                'nomeProduto'   => $this->input->post('nomeProduto'),
                'quantidade'    => $this->input->post('quantidade'),
                'valor'         => $this->input->post('valor')
            );

            if(empty($data['quantidade'])){
                $data['quantidade'] = 1;
            }

            //A biblioteca do carrinho de compras já está carregada lá pelo autoload, então não preciso chamá-la aqui novamente.
            
            // Esta linha serve para permitir que produtos com acetuação no nome sejam aceitos.
            $this->cart->product_name_rules = "'\d\D'";

            $data = array(
                'id'      => $data['id_produto'],
                'qty'     => $data['quantidade'],
                'price'   => $data['valor'],
                'name'    => $data['nomeProduto']
            );

            if($this->cart->insert($data)){
                redirect('carrinhoController/listar');
            }else{
                echo "Erro. Não foi possível inserir! <pre>";
                print_r($data);
                echo "</pre>";
            }
        }

        public function inserirCarrinho(){
            $this->Session_cliente();
            $data = array(
                'id_produto'    => $this->input->post('idProduto'),
                'nomeProduto'   => $this->input->post('nomeProduto'),
                'quantidade'    => $this->input->post('quantidade'),
                'valor'         => $this->input->post('valor')
            );

            if(empty($data['quantidade'])){
                $data['quantidade'] = 1;
            }

            //A biblioteca do carrinho de compras já está carregada lá pelo autoload, então não preciso chamá-la aqui novamente.
            
            // Esta linha serve para permitir que produtos com acetuação no nome sejam aceitos.
            $this->cart->product_name_rules = "'\d\D'";

            $data = array(
                'id'      => $data['id_produto'],
                'qty'     => $data['quantidade'],
                'price'   => $data['valor'],
                'name'    => $data['nomeProduto']
            );

            if($this->db->insert("carrinho",$data)){
                var_dump($data);
                //redirect("carrinhoController/finalizar");
            }else{
                echo "Erro. Não foi possível inserir! <pre>";
                print_r($data);
                echo "</pre>";
            }
        }

        // Função que gera o boleto de pagamento
        public function finalizar(){
            $this->Session_cliente();
            $this->load->model('boletoModel','boleto');
            $dados['pag'] = $this->boleto->GeraBoleto();

            $sacado = new Agente($this->session->userdata('nomeCliente'), $this->session->userdata('Cpf'), $dados['pag'][0]['endereco'], $dados['pag'][0]['cep'],$dados['pag'][0]['cidade'],$dados['pag'][0]['uf']);
            $cedente = new Agente('Seu Negocio Sob Controle', '49.383.075/0001-98', 'Qn 05 Conjunto 10', '71.805-410', 'Brasília', 'DF');
            
            $prazo_para_pagamento = 15;
            $valor_cobrado = $this->cart->total();
            $taxa_boleto = 10.00;
            $valor_boleto = $valor_cobrado+$taxa_boleto;
            $data_venc = date("Y-m-d", time() + ($prazo_para_pagamento * 86400));
        
            $boleto = new BancoDoBrasil(array(
               // Parâmetros obrigatórios
			    'nosso_numero' => $this->session->userdata('idcarrinho'),
			    'numero_documento' => $this->session->userdata('idcarrinho'),
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

            $this->load->view('site/AreaCliente/restrito/includes/header');
            $this->load->view('site/AreaCliente/restrito/includes/menu');
            $this->load->view('site/AreaCliente/restrito/boleto/boleto',$dados);
            $this->load->view('site/AreaCliente/restrito/includes/footer');
        }

        public function limpar(){
            $this->Session_cliente();
            $this->cart->destroy();
            redirect('carrinhoController/listar');
        }

    }
?>