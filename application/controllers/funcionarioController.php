<?php
// Define a Data e Hora padrão do servidor!
date_default_timezone_set('America/Sao_Paulo');

defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionariocontroller extends CI_Controller {

    // Função que verifica a sessão
    public function Session_funcionario(){
        if($this->session->userdata('logado') == false){
            redirect('siteController/AreaFuncionario/5');
        }
    }

    // Função de chamada da página principal.
    public function index(){
        $this->Session_funcionario();
        $this->load->view('funcionario/includes/header'); // chamada do topo da página.
        $this->load->view('funcionario/includes/menu'); // chamada do menu.
        $this->load->view('funcionario/funcionario'); // chamada da página principal.
        $this->load->view('funcionario/includes/footer'); // chamada do rodapé da página.

    }

    public function AtuDados($id=null,$indice=null){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('funcionarioModel','usuario');
        $this->load->model('funcionarioModel','dinamic');
        $data['usuario'] = $this->usuario->AtuDados($id);
        $data['nivelAcesso'] = $this->dinamic->dinamicSelect();

        $this->load->view('funcionario/configuracao/includes/header');
        $this->load->view('funcionario/configuracao/includes/menu');
        if($indice == 's'){
            $msg['msg'] = "Seus dados foram atualizados com sucesso!";
            $this->load->view('funcionario/configuracao/msg/msg_sucess',$msg);
        }else if($indice == 'e'){
            $msg['msg'] = "Ops.. algo deu errado, entre em contato com o suporte do sistema!";
            $this->load->view('funcionario/configuracao/msg/msg_erro',$msg);
        }
        $this->load->view('funcionario/configuracao/atualizaDados',$data);
        $this->load->view('funcionario/configuracao/includes/footer');
    }

    public function AtualizarDados(){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','atualiza');

        if($this->atualiza->atualizaDados()){
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => true,'redirect' => base_url('funcionarioController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }else{
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => false,'redirect' => base_url('funcionarioController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }
    }

    public function AtualizaSenha($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','usuario');
        
        if($this->usuario->AtualizaSenha($id)){
            //$response['status'] = 'success';
            //$response['mensagem'] = 'Senha Atualizada com Sucesso!';
            //$response['redirect'] = base_url('funcionarioController/AtuDados/' . $this->session->userdata('idUsuario'));

            //echo json_encode($response);
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => true,'redirect' => base_url('funcionarioController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }else{
           // $response['status'] = 'success',
            $this->output->set_content_type("application/json")->set_output(json_encode(array('status' => false,'redirect' => base_url('funcionarioController/AtuDados/' . $this->session->userdata('idUsuario') ) )));
        }
    }

    // Função de logout do funcionario
    public function LogoutUsuario(){
        $this->load->model('loginModel','usuarios');

        if($this->usuarios->LogoutUsuario()){
            redirect('siteController/AreaFuncionario/3');
        }
    }

    // Função de chamada da interface(view) de listagem de Clientes
    public function clientes($indice=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','cliente');
        $this->load->model('funcionarioModel','cliente');;
        
        $data['cliente'] = $this->cliente->listaClientes();

        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Cliente Cadastrado com Sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Cliente não Cadastrado, Desculpe!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Cliente desativado com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Cliente não desativado!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Cliente ativado com Sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);    
        }else if($indice == 6){
            $msg['msg'] = "Cliente não ativado, entre em contato com o administrador do sistema!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Cliente atualizado com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "Cliente não atualizado, favor tente novamente!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }
        $this->load->view('funcionario/clientes/list-clientes',$data);
        $this->load->view('funcionario/includes/footer');
    }

    // Função de inativar o cliente
    public function inativaCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','cliente');

        if($this->cliente->inativaCliente($id)){
            redirect('funcionarioController/clientes/3');
        }else{
            redirect('funcionarioController/clientes/4');
        }
    }

    // Função de ativar o cliente
    public function atiCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','cliente');

        if($this->cliente->atiCliente($id)){
            redirect('funcionarioController/clientes/5');
        }else{
            redirect('funcionarioController/clientes/6');
        }
    }

    // Função de chamada da interface(view) de cadastro de um novo cliente.
    public function novoCliente(){
        $this->Session_funcionario();
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/clientes/novoCliente');
        $this->load->view('funcionario/includes/footer');

    }

    // Função que chama o model de inserção do cliente
    public function insereCliente(){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','novoCliente');

        if($this->novoCliente->insereCliente()){
            redirect('funcionarioController/clientes/1');
        }else{
            redirect('funcionarioController/clientes/2');
        }
    }

    // Função de chamada da view pra tela de atualizar cliente
    public function atualizaCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','atCliente');
        $this->load->model('funcionarioModel','tipo');
    
        $data['cliente'] = $this->atCliente->atCliente($id);
        $data['tipo'] = $this->tipo->DinamicTipo();;

        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/clientes/atualizaCliente',$data);
        $this->load->view('funcionario/includes/footer');
    }

    // Função de atualizar o cliente
    public function atCliente($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','atCliente');
        
        if($this->atCliente->atualizaCliente($id)){
            redirect('funcionarioController/clientes/7');
        }else{
            redirect('funcionarioController/clientes/8');
        }
    }

    // Função de chamada da página de Fornecedores
    public function fornecedores($indice=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','fornecedor');
        
        $data['fornecedor'] = $this->fornecedor->ListaFornecedores();

        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Fornecedor cadastrado com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Fornecedor não cadastrado. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Fornecedor Atualizado com Sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Fornecedor não atualizado, favor tente novamente!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Fornecedor inativado com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Ops.. Fornecedor não inativado!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Fornecedor ativado com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "Ops.. Fornecedor não ativado!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }
        $this->load->view('funcionario/fornecedores/listfornecedores',$data);
        $this->load->view('funcionario/includes/footer');

    }

    // Função de chamada da interface(view) de novos Fornecedores
    public function novoFornecedor(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/fornecedores/novoFornecedor');
        $this->load->view('funcionario/includes/footer');

    }

    // Função de chamada da função de inserção
    public function insereFornecedor(){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','fornecedor');

        if($this->fornecedor->insereFornecedor()){
            redirect('funcionarioController/fornecedores/1');
        }else{
            redirect('funcionarioController/fornecedores/2');
        }
    }

    public function atualizaForn($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','atualForn');
        $forn['fornecedor'] = $this->atualForn->atualizaForn($id);

        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/fornecedores/atualizaFornecedor', $forn);
        $this->load->view('funcionario/includes/footer');
    }

    // Função de atualizar o fornecedor
    public function atualizaFornecedor($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','atualForn');

        if($this->atualForn->atualizaFornecedor($id)){
            redirect('funcionarioController/fornecedores/3');
        }else{
            redirect('funcionarioController/fornecedores/4');
        }
    }

    public function inatForn($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','inatForn');

        if($this->inatForn->inatForn($id)){
            redirect('funcionarioController/fornecedores/5');
        }else{
            redirect('funcionarioController/fornecedores/6');
        }
    }

    public function atForne($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','forn');

        if($this->forn->atForne($id)){
            redirect('funcionarioController/fornecedores/7');
        }else{
            redirect('funcionarioController/fornecedores/8');
        }
    }

    // Função de chamada da interface(view) de Venda
    public function Vendas($indice=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','venda');
        $data['venda'] = $this->venda->Vendas();
        
        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Venda Cadastrada com Sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Venda não Cadastrada!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }
        $this->load->view('funcionario/venda/vendas',$data);
        $this->load->view('funcionario/includes/footer');

    }

    // Função de chamada da interface(view) de Nova Venda
    public function novaVenda(){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('funcionarioModel','busca');
        $this->load->model('funcionarioModel','produto');
        $this->load->model('funcionarioModel','count');
        $this->load->model('funcionarioModel','forma');
        $data['busca'] = $this->busca->SearchCliente();
        $data['produto'] = $this->produto->ProductDinamic();
        $data['count'] = $this->count->CountValor();
        $data['forma'] = $this->forma->formaPagamento();
        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/venda/novaVenda',$data);
        $this->load->view('funcionario/includes/footer');
    }

    // Função de Inserir Vendas
    public function insereVenda(){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','vendas');
        
        if($this->vendas->insereVenda()){
            redirect("funcionarioController/vendas/1");
        }else{
            redirect("funcionarioController/vendas/2");
        }
    }

    public function Carrinho(){
        $this->Session_funcionario();
        $this->load->model("funcionarioModel","carrinho");
        $data['carrinho'] = $this->carrinho->listCarrinho();

        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/carrinho/carrinho',$data);
        $this->load->view('funcionario/includes/footer');
    }

    // Função de chamada da página de listagem de Produtos
    public function produtos($indice=null){
        $this->Session_funcionario();
        $this->load->helper('funcoes_helper');
        $this->load->model('funcionarioModel','produtos');
        $this->load->model('funcionarioModel','produtos');    
     
        $data['produtos'] = $this->produtos->listProduto();

        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Produto Cadastrado com Sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Produto não Cadastrado, Desculpe!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Produto Excluido com Sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Produto não excluido, desculpe!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Produto atualizado com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Produto não atualizado, tente novamente!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }
        
        $this->load->view('funcionario/produtos/list-produto',$data); // chamada da página de listagem!
        $this->load->view('funcionario/includes/footer'); // Chamada do rodapé da página!
    
    }

    // Função de chamada que carrega a interface(view) de cadastro de um novo produto
    public function novoProduto(){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','dinamic');
        $this->load->model('funcionarioModel','fornecedor');
        $data['categoria'] = $this->dinamic->dinamicCategoria();
        $data['fornecedor'] = $this->fornecedor->dinamicFornecedor();

        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/produtos/novoProduto',$data);
        $this->load->view('funcionario/includes/footer');
    
    }

    // Carrega a função, chamando a model de inserção, para inserir o produto no banco.
    public function insereProduto(){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','produto');

        if($this->produto->InsereProduto()){
            redirect('funcionarioController/produtos/1');
        }else{
            redirect('funcionarioController/produtos/2');
        }
    }

    // Carrega a função, chamando a model, para executar a exclusão do produto.
    public function delProduto($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','exproduto');

        if($this->exproduto->delProduto($id)){
            redirect('funcionarioController/produtos/3');
        }else{
            redirect('funcionarioController/produtos/4');
        }
    }
    
    // Função que recebe os dados no formulário para atualizar
    public function AtualizaProduto($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','uproduto');
        $this->load->model('funcionarioModel','dinamic');
        $this->load->model('funcionarioModel','fornecedor');
        $data['categoria'] = $this->dinamic->dinamicCategoria();
        $data['fornecedor'] = $this->fornecedor->dinamicFornecedor();
        $data['produto'] = $this->uproduto->AtualizaProd($id);

        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/produtos/atualizaProduto',$data);
        $this->load->view('funcionario/includes/footer');
    }

    // Função de atualização dos produtos
    public function AtualizaProd($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','atualiza');

        if($this->atualiza->AtualizaProduto($id)){
            redirect('funcionarioController/produtos/5');
        }else{
            redirect('funcionarioController/produtos/6');
        }
    }

    // carrega a view de categorias
    public function categorias($indice=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','categorias');

        $data['categorias'] = $this->categorias->selectCategoria();

        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        if($indice == 1){
            $msg['msg'] = "Categoria Cadastrado com Sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 2){
            $msg['msg'] = "Categoria não cadastrada. Desculpe, entre em contato com o administrador do sistema!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 3){
            $msg['msg'] = "Categoria atualizada com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 4){
            $msg['msg'] = "Ops.. Categoria não atualizada!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 5){
            $msg['msg'] = "Categoria inativada com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 6){
            $msg['msg'] = "Ops.. Categoria não inativada!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }else if($indice == 7){
            $msg['msg'] = "Categoria ativada com sucesso!";
            $this->load->view('funcionario/msg/msg_success',$msg);
        }else if($indice == 8){
            $msg['msg'] = "ops.. Categoria não ativada!";
            $this->load->view('funcionario/msg/msg_erro',$msg);
        }
        $this->load->view('funcionario/categoria/categorias', $data);
        $this->load->view('funcionario/includes/footer');
    }

    // Carrega a view de nova categoria
    public function novaCategoria(){
        $this->Session_funcionario();
        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/categoria/NovaCategoria');
        $this->load->view('funcionario/includes/footer');
    }

    // Função que insere a categoria no banco de dados
    public function InsereCategoria(){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','categoria');

        if($this->categoria->InsereCategoria()){
            redirect('funcionarioController/categorias/1');
        }else{
            redirect('funcionarioController/categorias/2');
        }
    }

    // Função que chama a view de atualizar categoria
    public function atualizaCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','categoria');
        $data['categoria'] = $this->categoria->atualCategoria($id);

        // Carrega as views
        $this->load->view('funcionario/includes/header');
        $this->load->view('funcionario/includes/menu');
        $this->load->view('funcionario/categoria/atualizaCategoria', $data);
        $this->load->view('funcionario/includes/footer');
    }

    // Função de que verifica se foi ou não atualizado a categoria
    public function atualCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','categoria');

        if($this->categoria->atualizaCategoria($id)){
            redirect('funcionarioController/categorias/3');
        }else{     
            redirect('funcionarioController/categorias/4');
        }
    }

    public function inativaCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','categoria');

        if($this->categoria->inativaCategoria($id)){
            redirect('funcionarioController/categorias/5');
        }else{
            redirect('funcionarioController/categorias/6');
        }
    }

    public function ativarCategoria($id=null){
        $this->Session_funcionario();
        $this->load->model('funcionarioModel','categoria');

        if($this->categoria->ativarCategoria($id)){
            redirect('funcionarioController/categorias/7');
        }else{
            redirect('funcionarioController/categorias/8');
        }
    }
}
?>