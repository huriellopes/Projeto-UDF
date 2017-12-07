<?php
// Define a Data e Hora padrão do servidor!
date_default_timezone_set('America/Sao_Paulo');

defined('BASEPATH') OR exit('No direct script access allowed');

class Administradorcontroller extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    // Função que verifica a sessão
    public function Session_funcionario(){
        if($this->session->userdata('logado') == false){
            redirect('siteController/AreaFuncionario/5');
        }
    }

    // Função de chamada da página principal.
    public function index(){
        $this->Session_funcionario();
        $this->load->view('administrador/includes/header'); // chamada do topo da página.
        $this->load->view('administrador/includes/menu'); // chamada do menu.
        $this->load->view('administrador/administrador'); // chamada da página principal.
        $this->load->view('administrador/includes/footer'); // chamada do rodapé da página.
    }

    public function AtuDados($id=null,$indice=null){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('administradorModel','usuario');
        $this->load->model('administradorModel','dinamic');
        $data['usuario'] = $this->usuario->AtuDados($id);
        $data['nivelAcesso'] = $this->dinamic->dinamicSelect();

        $this->load->view('administrador/configuracao/includes/header');
        $this->load->view('administrador/configuracao/includes/menu');
        if($indice == 's'){
            $msg['msg'] = "Seus dados foram atualizados com sucesso!";
            $this->load->view('administrador/configuracao/msg/msg_sucess',$msg);
        }else if($indice == 'e'){
            $msg['msg'] = "Ops.. algo deu errado, entre em contato com o suporte do sistema!";
            $this->load->view('administrador/configuracao/msg/msg_erro',$msg);
        }
        $this->load->view('administrador/configuracao/atualizaDados',$data);
        $this->load->view('administrador/configuracao/includes/footer');
    }

    public function AtualizarDados(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','atualiza');

        if($this->atualiza->AtualizaDados()){
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => true, 'redirect' => base_url('administradorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }else{
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => false, 'redirect' => base_url('administradorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }
    }

    public function AtualizaSenha($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','usuario');
    
        if($this->usuario->AtualizaSenha($id)){
            $this->output->set_content_type("aplication/json")->set_output(json_encode(array('status' => true, 'redirect' => base_url('administradorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }else{
            $this->output->set_content_type("aplication/json")->set_output(json_encode(array('status' => false, 'redirect' => base_url('administradorController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }
    }
    public function usuarios(){
        $this->load->model('administradorModel','usuarios');
        $usuarios = $this->usuarios->listaUsuario();
        $dados['data'] = $usuarios;
        echo json_encode($dados);
    }

    // Função de chamada da página Usuário
    public function usuario($indice=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','usuario');
        $this->load->model('administradorModel','usuario'); 

        $data['usuario'] = $this->usuario->listaUsuario();

        $this->load->view('administrador/includes/header'); // chamada do topo da página.
        $this->load->view('administrador/includes/menu'); // chamada do menu.
        if($indice == 1){
            $msg['msg'] = "Usuário cadastrado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Usuário não cadastrado. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Usuário inativado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Usuário não inativado. Desculpe, entre em contato com o administrado do sistema!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg']= "Usuário Ativo com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Usuário não ativo. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }
        $this->load->view('administrador/usuarios/usuarios',$data); // chamada da página de Usuários.
        $this->load->view('administrador/includes/footer'); // chamada do rodapé da página.
    
    }

    // Função de chamada da página de Novo Usuário
    public function novoUsuario(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','dinamic');
        $data['nivelAcesso'] = $this->dinamic->dinamicSelect();

        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/usuarios/novoUsuario',$data);
        $this->load->view('administrador/includes/footer');

    }

    // Função que chama a model, para salvar o usuario no banco de dados.
    public function salvaUsuario(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','usuario');

        if($this->usuario->insereUsuario()){
            redirect('administradorController/usuario/1');
        }else{
            redirect('administradorController/usuario/2');
        }
    }

    // Função de inativar o usuário
    public function inatUsuario($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','usuario');

        if($this->usuario->inatUsuario($id)){
            redirect('administradorController/usuario/3');
        }else{
            redirect('administradorController/usuario/4');
        }
    }

    // Função de ativar o usuário
    public function atiUsuario($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','usuario');
        
        if($this->usuario->atiUsuario($id)){
            redirect('administradorController/usuario/5');
        }else{
            redirect('administradorController/usuario/6');
        }
    }

    // Função de logout do administrador
    public function LogoutUsuario(){
        $this->load->model('loginModel','usuarios');

        if($this->usuarios->LogoutUsuario()){
            redirect('siteController/AreaFuncionario/4');
        }
    }

    // Função de chamada da interface(view) de listagem de Clientes
    public function clientes($indice=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','cliente');
        $this->load->model('administradorModel','cliente');;
        
        $data['cliente'] = $this->cliente->listaClientes();

        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Cliente Cadastrado com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Cliente não Cadastrado, Desculpe!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Cliente desativado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Cliente não desativado!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Cliente ativado com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);    
        }else if($indice == 6){
            $msg['msg'] = "Cliente não ativado, entre em contato com o administrador do sistema!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Cliente atualizado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "Cliente não atualizado, favor tente novamente!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }
        $this->load->view('administrador/clientes/list-clientes',$data);
        $this->load->view('administrador/includes/footer');
    }

    public function cliente(){
        $this->load->model('administradorModel','clientes');
        $clientes = $this->clientes->listaClientes();
        $dados['data'] = $clientes;
        echo json_encode($dados);
    }

    // Função de inativar o cliente
    public function inativaCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','cliente');

        if($this->cliente->inativaCliente($id)){
            redirect('administradorController/clientes/3');
        }else{
            redirect('administradorController/clientes/4');
        }
    }

    // Função de ativar o cliente
    public function atiCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','cliente');

        if($this->cliente->atiCliente($id)){
            redirect('administradorController/clientes/5');
        }else{
            redirect('administradorController/clientes/6');
        }
    }

    // Função de chamada da interface(view) de cadastro de um novo cliente.
    public function novoCliente(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','tipo');

        $data['tipo'] = $this->tipo->DinamicTipo();

        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/clientes/novoCliente',$data);
        $this->load->view('administrador/includes/footer');

    }

    // Função que chama o model de inserção do cliente
    public function insereCliente(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','novoCliente');

        if($this->novoCliente->insereCliente()){
            redirect('administradorController/clientes/1');
        }else{
            redirect('administradorController/clientes/2');
        }
    }

    // Função de chamada da view pra tela de atualizar cliente
    public function atualizaCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','atCliente');
        $this->load->model('administradorModel','tipo');
    
        $data['cliente'] = $this->atCliente->atCliente($id);
        $data['tipo'] = $this->tipo->DinamicTipo();
        
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/clientes/atualizaCliente',$data);
        $this->load->view('administrador/includes/footer');
    }

    // Função de atualizar o cliente
    public function atCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','atCliente');
        
        if($this->atCliente->atualizaCliente($id)){
            redirect('administradorController/clientes/7');
        }else{
            redirect('administradorController/clientes/8');
        }
    }

    // Função de chamada da página de Fornecedores
    public function fornecedores($indice=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','fornecedor');
        
        $data['fornecedor'] = $this->fornecedor->ListaFornecedores();

        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Fornecedor cadastrado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Fornecedor não cadastrado. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Fornecedor Atualizado com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Fornecedor não atualizado, favor tente novamente!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Fornecedor inativado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Ops.. Fornecedor não inativado!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Fornecedor ativado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "Ops.. Fornecedor não ativado!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }
        $this->load->view('administrador/fornecedores/listfornecedores',$data);
        $this->load->view('administrador/includes/footer');

    }

    // Função de chamada da interface(view) de novos Fornecedores
    public function novoFornecedor(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/fornecedores/novoFornecedor');
        $this->load->view('administrador/includes/footer');

    }

    // Função de chamada da função de inserção
    public function insereFornecedor(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','fornecedor');

        if($this->fornecedor->insereFornecedor()){
            redirect('administradorController/fornecedores/1');
        }else{
            redirect('administradorController/fornecedores/2');
        }
    }

    public function atualizaForn($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','atualForn');
        $forn['fornecedor'] = $this->atualForn->atualizaForn($id);

        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/fornecedores/atualizaFornecedor', $forn);
        $this->load->view('administrador/includes/footer');
    }

    // Função de atualizar o fornecedor
    public function atualizaFornecedor($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','atualForn');

        if($this->atualForn->atualizaFornecedor($id)){
            redirect('administradorController/fornecedores/3');
        }else{
            redirect('administradorController/fornecedores/4');
        }
    }

    public function inatForn($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','inatForn');

        if($this->inatForn->inatForn($id)){
            redirect('administradorController/fornecedores/5');
        }else{
            redirect('administradorController/fornecedores/6');
        }
    }

    public function atForne($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','forn');

        if($this->forn->atForne($id)){
            redirect('administradorController/fornecedores/7');
        }else{
            redirect('administradorController/fornecedores/8');
        }
    }

    // Função de chamada da interface(view) de Venda
    public function Vendas($indice=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','venda');
        $data['venda'] = $this->venda->Vendas();
        
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Venda Cadastrada com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Venda não Cadastrada!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }
        $this->load->view('administrador/venda/vendas',$data);
        $this->load->view('administrador/includes/footer');

    }

    // Função de chamada da interface(view) de Nova Venda
    public function novaVenda(){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('administradorModel','busca');
        $this->load->model('administradorModel','produto');
        $this->load->model('administradorModel','count');
        $this->load->model('administradorModel','forma');
        $data['busca'] = $this->busca->SearchCliente();
        $data['produto'] = $this->produto->ProductDinamic();
        $data['count'] = $this->count->CountValor();
        $data['forma'] = $this->forma->formaPagamento();
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/venda/novaVenda',$data);
        $this->load->view('administrador/includes/footer');
    }

    // Função de Inserir Vendas
    public function insereVenda(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','vendas');
        
        if($this->vendas->insereVenda()){
            redirect("administradorController/vendas/1");
        }else{
            redirect("administradorController/vendas/2");
        }
    }

    public function Carrinho(){
        $this->Session_funcionario();
        $this->load->model("administradorModel","carrinho");
        $data['carrinho'] = $this->carrinho->listCarrinho();

        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/carrinho/carrinho',$data);
        $this->load->view('administrador/includes/footer');
    }

    // Função de chamada da página de listagem de Produtos
    public function produtos($indice=null){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('administradorModel','produtos');
        $this->load->model('administradorModel','produtos');    
     
        $data['produtos'] = $this->produtos->listProduto();

        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Produto Cadastrado com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Produto não Cadastrado, Desculpe!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Produto Excluido com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Produto não excluido, desculpe!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Produto atualizado com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Produto não atualizado, tente novamente!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }
        
        $this->load->view('administrador/produtos/list-produto',$data); // chamada da página de listagem!
        $this->load->view('administrador/includes/footer'); // Chamada do rodapé da página!
    
    }

    // Função de chamada que carrega a interface(view) de cadastro de um novo produto
    public function novoProduto(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','dinamic');
        $this->load->model('administradorModel','fornecedor');
        $data['categoria'] = $this->dinamic->dinamicCategoria();
        $data['fornecedor'] = $this->fornecedor->dinamicFornecedor();

        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/produtos/novoProduto',$data);
        $this->load->view('administrador/includes/footer');
    
    }

    // Carrega a função, chamando a model de inserção, para inserir o produto no banco.
    public function insereProduto(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','produto');

        if($this->produto->InsereProduto()){
            redirect('administradorController/produtos/1');
        }else{
            redirect('administradorController/produtos/2');
        }
    }

    // Carrega a função, chamando a model, para executar a exclusão do produto.
    public function delProduto($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','exproduto');

        if($this->exproduto->delProduto($id)){
            redirect('administradorController/produtos/3');
        }else{
            redirect('administradorController/produtos/4');
        }
    }
    
    // Função que recebe os dados no formulário para atualizar
    public function AtualizaProduto($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','uproduto');
        $this->load->model('administradorModel','dinamic');
        $this->load->model('administradorModel','fornecedor');
        $data['categoria'] = $this->dinamic->dinamicCategoria();
        $data['fornecedor'] = $this->fornecedor->dinamicFornecedor();
        $data['produto'] = $this->uproduto->AtualizaProd($id);

        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/produtos/atualizaProduto',$data);
        $this->load->view('administrador/includes/footer');
    }

    // Função de atualização dos produtos
    public function AtualizaProd($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','atualiza');

        if($this->atualiza->AtualizaProduto($id)){
            redirect('administradorController/produtos/5');
        }else{
            redirect('administradorController/produtos/6');
        }
    }

    // carrega a view de categorias
    public function categorias($indice=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','categorias');

        $data['categorias'] = $this->categorias->selectCategoria();

        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Categoria Cadastrado com Sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Categoria não cadastrada. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Categoria atualizada com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Ops.. Categoria não atualizada!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Categoria inativada com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Ops.. Categoria não inativada!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Categoria ativada com sucesso!";
            $this->load->view('administrador/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "ops.. Categoria não ativada!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }
        $this->load->view('administrador/categoria/categorias', $data);
        $this->load->view('administrador/includes/footer');
    }

    // Carrega a view de nova categoria
    public function novaCategoria(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/categoria/NovaCategoria');
        $this->load->view('administrador/includes/footer');
    }

    // Função que insere a categoria no banco de dados
    public function InsereCategoria(){
        $this->Session_funcionario();
        $this->load->model('administradorModel','categoria');

        if($this->categoria->InsereCategoria()){
            redirect('administradorController/categorias/1');
        }else{
            redirect('administradorController/categorias/2');
        }
    }

    // Função que chama a view de atualizar categoria
    public function atualizaCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','categoria');
        $data['categoria'] = $this->categoria->atualCategoria($id);

        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/categoria/atualizaCategoria', $data);
        $this->load->view('administrador/includes/footer');
    }

    // Função de que verifica se foi ou não atualizado a categoria
    public function atualCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','categoria');

        if($this->categoria->atualizaCategoria($id)){
            redirect('administradorController/categorias/3');
        }else{     
            redirect('administradorController/categorias/4');
        }
    }

    public function inativaCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','categoria');

        if($this->categoria->inativaCategoria($id)){
            redirect('administradorController/categorias/5');
        }else{
            redirect('administradorController/categorias/6');
        }
    }

    public function ativarCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('administradorModel','categoria');

        if($this->categoria->ativarCategoria($id)){
            redirect('administradorController/categorias/7');
        }else{
            redirect('administradorController/categorias/8');
        }
    }

    // Carrega a função, chamando a view(interface) de relatório de Clientes
    public function relatorioCliente($indice=null){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Nenhum registro encontrado!";
            $this->load->view('administrador/msg/msg_erro',$msg);
        }
        $this->load->view('administrador/relatorios/relatorioCliente');
        $this->load->view('administrador/includes/footer');
    }

    // Função de gerar relatório de clientes
    public function geraCliente($periodo=null,$ate=null){
        $this->Session_funcionario();
        $this->load->helper('mask_helper');
        $mpdf = new mPDF('utf-8','A4-L');
        $this->load->model('administradorModel','cliente');
        $mpdf->allow_charset_conversion=TRUE;
        $mpdf->charset_in='UTF-8';
        $mpdf->setHeader('Relatório de Clientes');
        $mpdf->setAuthor("Equipe XI");
        $mpdf->setTitle("Relatório de Clientes " . date('d/m/Y'));
        $mpdf->setFooter('{DATE d/m/Y H:i} | PÁGINA {PAGENO}/{nb} | Seu Négocio Sob Controle');
        $data['cliente'] = $this->cliente->relCliente($periodo,$ate);
        $html = $this->load->view('administrador/relatorios/imprimir/geradoCliente',$data,TRUE);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        $mpdf->Output('relatorio-de-clientes ' . date('d/m/Y') . '.pdf','D');
    }

    // Carrega a função, chamando a view(interface) de relatório de vendas
    public function relatorioVendas(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/relatorios/relatorioVendas');
        $this->load->view('administrador/includes/footer');
    }

    public function geraVendas($periodo=null,$ate=null){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $mpdf = new mPDF('pt','A4-L');
        $this->load->model('administradorModel','venda');
        $mpdf->allow_charset_conversion=TRUE;
        $mpdf->charset_in='UTF-8';
        $mpdf->setHeader("Relatório de Vendas");
        $mpdf->setAuthor("Equipe XI");
        $mpdf->setTitle("Relatório de Vendas " . date('d/m/Y'));
        $mpdf->setFooter('{DATE d/m/Y H:i} | PÁGINA {PAGENO}/{nb} | Seu Négocio Sob Controle');
        $data['venda'] = $this->venda->relVendas($periodo,$ate);
        $html = $this->load->view('administrador/relatorios/imprimir/geradoVendas',$data,TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output('relatorio-de-vendas ' . date('d/m/Y') . '.pdf','D');
    }

    // Carrega a função, chamando a interface(view) de relatório de Estoque
    public function relatorioEstoque(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('administrador/includes/header');
        $this->load->view('administrador/includes/menu');
        $this->load->view('administrador/relatorios/relatorioEstoque');
        $this->load->view('administrador/includes/footer');
    }

    // Funçao responsavel por montar o conteúdo do relatório no pdf
    public function geraEstoque($periodo=null,$ate=null){
        $this->Session_funcionario();
        $this->load->helper("funcoes");
        $mpdf = new mPDF('pt','A4');
        $this->load->model('administradorModel','estoque');
        $mpdf->allow_charset_conversion=TRUE;
        $mpdf->charset_in='UTF-8';
        $mpdf->setHeader("Relatório de Estoque/Produtos");
        $mpdf->setAuthor("Equipe XI");
        $mpdf->setTitle("Relatório de Estoque/Produtos " . date('d/m/Y'));
        $mpdf->setFooter('{DATE d/m/Y H:i} | Página {PAGENO}/{nb} | Seu Négocio Sob Controle');
        $data['estoque'] = $this->estoque->relProdutos($periodo,$ate);
        $html = $this->load->view('administrador/relatorios/imprimir/geradoEstoque',$data,TRUE);
        $mpdf->WriteHTML($html);
        $mpdf->Output('relatorio-estoque '.date('Y-m-d').'.pdf','D');
    }
}
?>