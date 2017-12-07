<?php
// Define a Data e Hora padrão do servidor!
date_default_timezone_set('America/Sao_Paulo');

defined('BASEPATH') OR exit('No direct script access allowed');

// usando a API do OpenBoleto
use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;

class Sitecontroller extends CI_Controller {

    public function Session_cliente(){
        if($this->session->userdata('logado') == false){
            redirect('siteController/LoginCliente/8');
        }
    }

    // Carrega a página incial do site!
    public function index(){
        $this->load->view('site/includes/header');
        $this->load->view('site/includes/menu');
        $this->load->view('site/inicial');
        $this->load->view('site/includes/footer');
    }

    // Carrega a incial do cliente
    public function Cliente(){
        $this->load->view('site/AreaCliente/includes/header');
        $this->load->view('site/AreaCliente/includes/menu');
        $this->load->view('site/AreaCliente/cliente');
        $this->load->view('site/AreaCliente/includes/footer');
    }

    // Carrega o Login do Cliente
    public function LoginCliente($indice=null){
        $this->load->view('site/AreaCliente/includes/header');
        $this->load->view('site/AreaCliente/includes/menu');
        $this->load->view('site/AreaCliente/login/LoginCliente');
        if($indice == 1){
            $msg['msg'] = "Usuário cadastrado com sucesso!";
            $this->load->view('site/AreaCliente/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Ops.. Não Cadastrado, por favor entre em contato com o Administrador do Sistema!";
            $this->load->view('site/AreaCliente/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Nova senha cadastrada com sucesso!";
            $this->load->view('site/AreaCliente/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Ops.. Tente novamente, caso contrario, entre em contato com o Administrador do Sistema!";
            $this->load->view('site/AreaCliente/msg/msg_erro',$msg);
        }if($indice == 6){
            $msg['msg'] = "Login/Senha erradas, tente novamente!";
            $this->load->view('site/AreaCliente/restrito/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Deslogado com Sucesso!";
            $this->load->view('site/AreaCliente/restrito/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "Área Restrita, por favor use login e senha para acessar!";
            $this->load->view('site/AreaCliente/restrito/msg/msg_erro',$msg);
        }
        $this->load->view('site/AreaCliente/includes/footer');
    }
    // Area Restrita do Cliente
    public function AreaCliente(){
        $this->Session_cliente();
        $this->load->view('site/AreaCliente/restrito/includes/header');
        $this->load->view('site/AreaCliente/restrito/includes/menu');
        $this->load->view('site/AreaCliente/restrito/restrito');
        $this->load->view('site/AreaCliente/restrito/includes/footer');
    }

    // Função que Carrega a model de Logar
    public function LogarCliente(){
        $this->load->model('loginModel','cliente');

        if($this->cliente->LogarCliente()){
            redirect('siteController/AreaCliente');
        }else{
            redirect('siteController/LoginCliente/6');
        }
    }

    // Função que carrega a model de logout
    public function logoutCliente(){
        $this->load->model('loginModel','cliente');

        if($this->cliente->logoutCliente()){
            redirect('siteController/LoginCliente/7');
        }
    }

    // Carrega o novo Usuario(Cliente)
    public function NovoUsuario(){
        $this->load->model('siteModel','tipo');

        $data['tipo'] = $this->tipo->DinamicTipo();

        $this->load->view('site/AreaCliente/includes/header');
        $this->load->view('site/AreaCliente/includes/menu');
        $this->load->view('site/AreaCliente/novoCliente/novoUsuario',$data);
        $this->load->view('site/AreaCliente/includes/footer');
    }

    // Função que carrega a model de salvar o cliente!
    public function salvaCliente(){
        $this->load->model('siteModel','cliente');

        if($this->cliente->novoCliente()){
            redirect('LoginCliente/1');
        }else{
            redirect('LoginCliente/2');
        }
    }

    // Função que atualiza a senha do cliente.
    public function novaSenha(){
        $this->load->model('siteModel','novaSenha');

        if($this->novaSenha->novaSenha()){
            redirect('LoginCliente/3');
        }else{
            redirect('LoginCliente/4');
        }
    }

    public function atualizarDados($id=null){
        $this->Session_cliente();
        $this->load->helper('mask_helper');
        $this->load->model('siteModel','atualiza');
        $data['cliente'] = $this->atualiza->AtualDados($id);

        $this->load->view('site/AreaCliente/restrito/includes/header');
        $this->load->view('site/AreaCliente/restrito/includes/menu');
        $this->load->view('site/AreaCliente/restrito/atualizaDados/AtualizarDados',$data);
        $this->load->view('site/AreaCliente/restrito/includes/footer');
    }

    public function AtualDados(){
        $this->Session_cliente();
        $this->load->model('siteModel','atualiza');
        
        if($this->atualiza->AtualizaDados()){
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => TRUE, 'redirect' => base_url('siteController/atualizarDados/' . $this->session->userdata('idcliente') ) )));
        }else{
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => FALSE, 'redirect' => base_url('siteController/atualizarDados/' . $this->session->userdata('idcliente') ) )));
        }
    }

    public function AtualizaSenha($id=null){
        $this->Session_cliente();
        $this->load->model('siteModel','senha');

        if($this->senha->AtualizarSenha($id)){
            $this->output->set_content_type("aplication/json")->set_output(json_encode(array('status' => TRUE, 'redirect' => base_url('siteController/atualizarDados/' . $this->session->userdata('idcliente') ) )));
        }else{
            $this->output->set_content_type("aplication/json")->set_output(json_encode(array('status' => FALSE, 'redirect' => base_url('siteController/atualizarDados/' . $this->session->userdata('idcliente') ) )));
        }
    }

    // Carrega a Área do Funcionário
    public function AreaFuncionario($indice=null){
        $this->load->view('site/AreaFuncionario/includes/header');
        $this->load->view('site/AreaFuncionario/includes/menu');
        $this->load->view('site/AreaFuncionario/login/LoginFuncionario');
        if($indice == 1){
            $msg['msg'] = "Login/Senha incorretas, por favor tente novamente!";
            $this->load->view('site/AreaFuncionario/msg/msg_erro',$msg);
        }else if($indice == 2){ // Desloga o gestor
            $msg['msg'] = "Gestor Deslogado com Sucesso!";
            $this->load->view('site/AreaFuncionario/msg/msg_success',$msg);
        }else if($indice == 3){ // Desloga o Funcionário
            $msg['msg'] = "Funcionário Deslogado com Sucesso!";
            $this->load->view('site/AreaFuncionario/msg/msg_success',$msg);
        }else if($indice == 4){ // Desloga o Administrador
            $msg['msg'] = "Administrador Deslogado com Sucesso!";
            $this->load->view('site/AreaFuncionario/msg/msg_success',$msg);
        }else if($indice == 5){ // Informa Área Restrita, se houver tentativa de acesso pela URL
            $msg['msg'] = "Área restrita, por favor utilize seu Login e senha para acessar!";
            $this->load->view('site/AreaFuncionario/msg/msg_erro',$msg);
        }
        $this->load->view('site/AreaFuncionario/includes/footer');
    }

    public function Produtos(){
        $this->load->model('siteModel','produto');
        $this->load->helper("funcoes");
        $data['produtos'] = $this->produto->retorna_produtos();

        $this->load->view('site/AreaCliente/restrito/includes/header');
        $this->load->view('site/AreaCliente/restrito/includes/menu');
        $this->load->view('site/AreaCliente/restrito/produtos/produtos',$data);
        $this->load->view('site/AreaCliente/restrito/includes/footer');
    }

    public function gerarBoleto(){
        $this->Session_cliente();
        $this->load->model('boletoModel','boleto');

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
?>