<?php
// Define a Data e Hora padrão do servidor!
date_default_timezone_set('America/Sao_Paulo');

defined('BASEPATH') OR exit('No direct script access allowed');

// Classe Gestor, onde vai controlar todo o sistema.

class Gestorcontroller extends CI_Controller {
    
    // Função que verifica a sessão do usuário
    public function Session_funcionario(){
        if($this->session->userdata('logado') == false){
            redirect('siteController/AreaFuncionario');
        }
    }

    // Função que desloga o gestor
    public function LogoutUsuario(){
        $this->load->model('loginModel','usuarios');

        if($this->usuarios->LogoutUsuario()){
            redirect('siteController/AreaFuncionario/2');
        }
    }

    // Carrega a view inicial do Gestor
    public function index(){
        $this->Session_funcionario();
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/gestor');
        $this->load->view('gestor/includes/footer');
    }

    
    public function AtuDados($id=null,$indice=null){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('gestorModel','usuario');
        $this->load->model('gestorModel','dinamic');
        $data['usuario'] = $this->usuario->AtuDados($id);
        $data['nivelAcesso'] = $this->dinamic->dinamicSelect();

        $this->load->view('gestor/configuracao/includes/header');
        $this->load->view('gestor/configuracao/includes/menu');
        if($indice == 's'){
            $msg['msg'] = "Seus dados foram atualizados com sucesso!";
            $this->load->view('gestor/configuracao/msg/msg_sucess',$msg);
        }else if($indice == 'e'){
            $msg['msg'] = "Ops.. algo deu errado, entre em contato com o suporte do sistema!";
            $this->load->view('gestor/configuracao/msg/msg_erro',$msg);
        }
        $this->load->view('gestor/configuracao/atualizaDados',$data);
        $this->load->view('gestor/configuracao/includes/footer');
    }

    public function AtualizarDados(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','atualiza');

        if($this->atualiza->atualizaDados()){
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => true,'redirect' => base_url('gestorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }else{
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => false,'redirect' => base_url('gestorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }
    }

    public function AtualizaSenha($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','usuario');
        
        if($this->usuario->AtualizaSenha($id)){
            //$response['status'] = 'success';
            //$response['mensagem'] = 'Senha Atualizada com Sucesso!';
            //$response['redirect'] = base_url('gestorController/AtuDados/' . $this->session->userdata('idUsuario'));

            //echo json_encode($response);
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => true,'redirect' => base_url('gestorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }else{
           // $response['status'] = 'success',
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => false,'redirect' => base_url('gestorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }
    }

    // Função de chamada da página Usuário
    public function usuario($indice=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','usuario');

        $data['usuario'] = $this->usuario->listaUsuario();

        $this->load->view('gestor/includes/header'); // chamada do topo da página.
        $this->load->view('gestor/includes/menu'); // chamada do menu.
        if($indice == 1){
            $msg['msg'] = "Usuário cadastrado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Usuário não cadastrado. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Usuário inativado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Usuário não inativado. Desculpe, entre em contato com o administrado do sistema!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg']= "Usuário Ativo com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Usuário não ativo. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }
        $this->load->view('gestor/usuarios/usuarios',$data); // chamada da página de Usuários.
        $this->load->view('gestor/includes/footer'); // chamada do rodapé da página.
    
    }

    // Função de chamada da página de Novo Usuário
    public function novoUsuario(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','dinamic');
        $data['nivelAcesso'] = $this->dinamic->dinamicSelect();

        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/usuarios/novoUsuario',$data);
        $this->load->view('gestor/includes/footer');

    }

    // Função que chama a model, para salvar o usuario no banco de dados.
    public function salvaUsuario(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','usuario');

        if($this->usuario->insereUsuario()){
            redirect('gestorController/usuario/1');
        }else{
            redirect('gestorController/usuario/2');
        }
    }

    // Função de inativar o usuário
    public function inatUsuario($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','usuario');

        if($this->usuario->inatUsuario($id)){
            redirect('gestorController/usuario/3');
        }else{
            redirect('gestorController/usuario/4');
        }
    }

    // Função de ativar o usuário
    public function atiUsuario($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','usuario');
        
        if($this->usuario->atiUsuario($id)){
            redirect('gestoController/usuario/5');
        }else{
            redirect('gestoController/usuario/6');
        }
    }

    // Função de chamada da interface(view) de listagem de Clientes
    public function clientes($indice=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','cliente');
        
        $data['cliente'] = $this->cliente->listaClientes();

        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Cliente Cadastrado com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Cliente não Cadastrado, Desculpe!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Cliente desativado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Cliente não desativado!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Cliente ativado com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);    
        }else if($indice == 6){
            $msg['msg'] = "Cliente não ativado, entre em contato com o administrador do sistema!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Cliente atualizado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "Cliente não atualizado, favor tente novamente!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }
        $this->load->view('gestor/clientes/list-clientes',$data);
        $this->load->view('gestor/includes/footer');
    }

    // Função de inativar o cliente
    public function inativaCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','cliente');

        if($this->cliente->inativaCliente($id)){
            redirect('gestorController/clientes/3');
        }else{
            redirect('gestorController/clientes/4');
        }
    }

    // Função de ativar o cliente
    public function atiCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','cliente');

        if($this->cliente->atiCliente($id)){
            redirect('gestorController/clientes/5');
        }else{
            redirect('gestorController/clientes/6');
        }
    }

    // Função de chamada da interface(view) de cadastro de um novo cliente.
    public function novoCliente(){
        $this->Session_funcionario();
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/clientes/novoCliente');
        $this->load->view('gestor/includes/footer');

    }

    // Função que chama o model de inserção do cliente
    public function insereCliente(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','novoCliente');

        if($this->novoCliente->insereCliente()){
            redirect('gestorController/clientes/1');
        }else{
            redirect('gestorController/clientes/2');
        }
    }

    // Função de chamada da view pra tela de atualizar cliente
    public function atualizaCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','atCliente');
        $this->load->model('gestorModel','tipo');
    
        $data['cliente'] = $this->atCliente->atCliente($id);
        $data['tipo'] = $this->tipo->DinamicTipo();

        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/clientes/atualizaCliente',$data);
        $this->load->view('gestor/includes/footer');
    }

    // Função de atualizar o cliente
    public function atCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','atCliente');
        
        if($this->atCliente->atualizaCliente($id)){
            redirect('gestorController/clientes/7');
        }else{
            redirect('gestorController/clientes/8');
        }
    }

    // Função de chamada da página de Fornecedores
    public function fornecedores($indice=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','fornecedor');

        $data['fornecedor'] = $this->fornecedor->ListaFornecedores();

        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Fornecedor cadastrado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Fornecedor não cadastrado. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Fornecedor Atualizado com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Fornecedor não atualizado, favor tente novamente!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Fornecedor inativado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Ops.. Fornecedor não inativado!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Fornecedor ativado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "Ops.. Fornecedor não ativado!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }
        $this->load->view('gestor/fornecedores/listfornecedores',$data);
        $this->load->view('gestor/includes/footer');

    }

    // Função de chamada da interface(view) de novos Fornecedores
    public function novoFornecedor(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/fornecedores/novoFornecedor');
        $this->load->view('gestor/includes/footer');

    }

    // Função de chamada da função de inserção
    public function insereFornecedor(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','fornecedor');

        if($this->fornecedor->insereFornecedor()){
            redirect('gestorController/fornecedores/1');
        }else{
            redirect('gestorController/fornecedores/2');
        }
    }

    public function atualizaForn($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','atualForn');
        $forn['fornecedor'] = $this->atualForn->atualizaForn($id);

        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/fornecedores/atualizaFornecedor', $forn);
        $this->load->view('gestor/includes/footer');
    }

    // Função de atualizar o fornecedor
    public function atualizaFornecedor($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','atualForn');

        if($this->atualForn->atualizaFornecedor($id)){
            redirect('gestorController/fornecedores/3');
        }else{
            redirect('gestorController/fornecedores/4');
        }
    }

    public function inatForn($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','inatForn');

        if($this->inatForn->inatForn($id)){
            redirect('gestorController/fornecedores/5');
        }else{
            redirect('gestorController/fornecedores/6');
        }
    }

    public function atForne($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','forn');

        if($this->forn->atForne($id)){
            redirect('gestorController/fornecedores/7');
        }else{
            redirect('gestorController/fornecedores/8');
        }
    }

    // Função de chamada da interface(view) de Venda
    public function Vendas($indice=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','venda');
        $data['venda'] = $this->venda->Vendas();
        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Venda Cadastrada com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Venda não Cadastrada!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }
        $this->load->view('gestor/venda/vendas',$data);
        $this->load->view('gestor/includes/footer');

    }

    // Função de chamada da interface(view) de Nova Venda
    public function novaVenda(){
        $this->Session_funcionario();
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('gestorModel','busca');
        $this->load->model('gestorModel','produto');
        $this->load->model('gestorModel','count');
        $this->load->model('gestorModel','forma');
        $data['busca'] = $this->busca->SearchCliente();
        $data['produto'] = $this->produto->ProductDinamic();
        $data['count'] = $this->count->CountValor();
        $data['forma'] = $this->forma->formaPagamento();
        // Carrega as views
        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/venda/novaVenda',$data);
        $this->load->view('gestor/includes/footer');
    }

    // Função de Inserir Vendas
    public function insereVenda(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','vendas');
        
        if($this->vendas->insereVenda()){
            redirect("gestorController/vendas/1");
        }else{
            redirect("gestorController/vendas/2");
        }
    }

    public function Carrinho(){
        $this->Session_funcionario();
        $this->load->model("gestorModel","carrinho");
        $data['carrinho'] = $this->carrinho->listCarrinho();

        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/carrinho/carrinho',$data);
        $this->load->view('gestor/includes/footer');
    }

    // Função de chamada da página de listagem de Produtos
    public function produtos($indice=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','produtos');

        $data['produtos'] = $this->produtos->listProduto();

        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Produto Cadastrado com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Produto não Cadastrado, Desculpe!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Produto Excluido com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Produto não excluido, desculpe!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Produto atualizado com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Produto não atualizado, tente novamente!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }
        
        $this->load->view('gestor/produtos/list-produto',$data); // chamada da página de listagem!
        $this->load->view('gestor/includes/footer'); // Chamada do rodapé da página!
    }

    // Função de chamada que carrega a interface(view) de cadastro de um novo produto
    public function novoProduto(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','dinamic');
        $this->load->model('gestorModel','fornecedor');
        $data['categoria'] = $this->dinamic->dinamicCategoria();
        $data['fornecedor'] = $this->fornecedor->dinamicFornecedor();

        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/produtos/novoProduto',$data);
        $this->load->view('gestor/includes/footer');
    
    }

    // Carrega a função, chamando a model de inserção, para inserir o produto no banco.
    public function insereProduto(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','produto');

        if($this->produto->InsereProduto()){
            redirect('gestorController/produtos/1');
        }else{
            redirect('gestorController/produtos/2');
        }
    }

    // Carrega a função, chamando a model, para executar a exclusão do produto.
    public function delProduto($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','exproduto');

        if($this->exproduto->delProduto($id)){
            redirect('gestorController/produtos/3');
        }else{
            redirect('gestorController/produtos/4');
        }
    }
    
    // Função que recebe os dados no formulário para atualizar
    public function AtualizaProduto($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','uproduto');
        $this->load->model('gestorModel','dinamic');
        $this->load->model('gestorModel','fornecedor');
        $data['categoria'] = $this->dinamic->dinamicCategoria();
        $data['fornecedor'] = $this->fornecedor->dinamicFornecedor();
        $data['produto'] = $this->uproduto->AtualizaProd($id);

        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/produtos/atualizaProduto',$data);
        $this->load->view('gestor/includes/footer');
    }

    // Função de atualização dos produtos
    public function AtualizaProd($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','atualiza');

        if($this->atualiza->AtualizaProduto($id)){
            redirect('gestorController/produtos/5');
        }else{
            redirect('gestorController/produtos/6');
        }
    }

    // carrega a view de categorias
    public function categorias($indice=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','categorias');

        $data['categorias'] = $this->categorias->selectCategoria();

        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Categoria Cadastrado com Sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Categoria não cadastrada. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Categoria atualizada com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Ops.. Categoria não atualizada!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Categoria inativada com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Ops.. Categoria não inativada!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Categoria ativada com sucesso!";
            $this->load->view('gestor/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "ops.. Categoria não ativada!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }
        $this->load->view('gestor/categoria/categorias', $data);
        $this->load->view('gestor/includes/footer');
    }

    // Carrega a view de nova categoria
    public function novaCategoria(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/categoria/NovaCategoria');
        $this->load->view('gestor/includes/footer');
    }

    // Função que insere a categoria no banco de dados
    public function InsereCategoria(){
        $this->Session_funcionario();
        $this->load->model('gestorModel','categoria');

        if($this->categoria->InsereCategoria()){
            redirect('gestorController/categorias/1');
        }else{
            redirect('gestorController/categorias/2');
        }
    }

    public function atualizaCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','categoria');
        $data['categoria'] = $this->categoria->atualCategoria($id);

        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/categoria/atualizaCategoria', $data);
        $this->load->view('gestor/includes/footer');
    }

    public function atualCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','categoria');

        if($this->categoria->atualizaCategoria($id)){
            redirect('gestorController/categorias/3');
        }else{     
            redirect('gestorController/categorias/4');
        }
    }

    public function inativaCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','categoria');

        if($this->categoria->inativaCategoria($id)){
            redirect('gestorController/categorias/5');
        }else{
            redirect('gestorController/categorias/6');
        }
    }

    public function ativarCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('gestorModel','categoria');

        if($this->categoria->ativarCategoria($id)){
            redirect('gestorController/categorias/7');
        }else{
            redirect('gestorController/categorias/8');
        }
    }

    // Carrega a função, chamando a view(interface) de relatório de Clientes
    public function relatorioCliente($indice=null){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Nenhum registro encontrado!";
            $this->load->view('gestor/msg/msg_erro',$msg);
        }
        $this->load->view('gestor/relatorios/relatorioCliente');
        $this->load->view('gestor/includes/footer');
    }

    // Função de gerar relatório de clientes
    public function geraCliente($periodo=null,$ate=null){
        $this->Session_funcionario();
        $this->load->helper('mask_helper');
        $mpdf = new mPDF('utf-8','A4-L');
        $this->load->model('gestorModel','cliente');
        $mpdf->allow_charset_conversion=TRUE;
        $mpdf->charset_in='UTF-8';
        $mpdf->setHeader('Relatório de Clientes');
        $mpdf->setAuthor("Equipe XI");
        $mpdf->setTitle("Relatório de Clientes " . date('d/m/Y'));
        $mpdf->setFooter('{DATE d/m/Y H:i} | PÁGINA {PAGENO}/{nb} | Seu Négocio Sob Controle');
        $data['cliente'] = $this->cliente->relCliente($periodo,$ate);
        $html = $this->load->view('gestor/relatorios/imprimir/geradoCliente',$data,TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output('relatorio-de-clientes ' . date('d/m/Y') . '.pdf','D');
    }

    // Carrega a função, chamando a view(interface) de relatório de vendas
    public function relatorioVendas(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/relatorios/relatorioVendas');
        $this->load->view('gestor/includes/footer');
    }

    public function geraVendas($periodo=null,$ate=null){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $mpdf = new mPDF('pt','A4-L');
        $this->load->model('gestorModel','venda');
        $mpdf->allow_charset_conversion=TRUE;
        $mpdf->charset_in='UTF-8';
        $mpdf->setHeader("Relatório de Vendas");
        $mpdf->setAuthor("Equipe XI");
        $mpdf->setTitle("Relatório de Vendas " . date('d/m/Y'));
        $mpdf->setFooter('{DATE d/m/Y H:i} | PÁGINA {PAGENO}/{nb} | Seu Négocio Sob Controle');
        $data['venda'] = $this->venda->relVendas($periodo,$ate);
        $html = $this->load->view('gestor/relatorios/imprimir/geradoVendas',$data,TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output('relatorio-de-vendas ' . date('d/m/Y') . '.pdf','D');
    }

    // Carrega a função, chamando a interface(view) de relatório de Estoque
    public function relatorioEstoque(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('gestor/includes/header');
        $this->load->view('gestor/includes/menu');
        $this->load->view('gestor/relatorios/relatorioEstoque');
        $this->load->view('gestor/includes/footer');
    }

    // Funçao responsavel por montar o conteúdo do relatório no pdf
    public function geraEstoque($periodo=null,$ate=null){
        $this->Session_funcionario();
        $this->load->helper("funcoes");
        $mpdf = new mPDF('pt','A4');
        $this->load->model('gestorModel','estoque');
        $mpdf->allow_charset_conversion=TRUE;
        $mpdf->charset_in='UTF-8';
        $mpdf->setHeader("Relatório de Estoque/Produtos");
        $mpdf->setAuthor("Equipe XI");
        $mpdf->setTitle("Relatório de Estoque/Produtos " . date('d/m/Y'));
        $mpdf->setFooter('{DATE d/m/Y H:i} | Página {PAGENO}/{nb} | Seu Négocio Sob Controle');
        $data['estoque'] = $this->estoque->relProdutos($periodo,$ate);
        $html = $this->load->view('gestor/relatorios/imprimir/geradoEstoque',$data,TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output('relatorio-estoque '.date('Y-m-d').'.pdf','D');
    }
}
?>