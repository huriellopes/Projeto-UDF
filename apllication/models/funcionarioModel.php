<?php
    // Define a Data e Hora padrão do servidor!
    date_default_timezone_set('America/Sao_Paulo');
    
    class Funcionariomodel extends CI_model{
        
        function __construct(){
           parent::__construct();
           $this->load->database();
        }

        // Função de atualizar dados
        public function AtuDados($id){
            $this->db->select("*");
            $this->db->from("usuarios");
            $this->db->where("idUsuario",$id);
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $resultado = $query->result_array();
                
            }else{
                $resultado = null;
            }
            return $resultado;
        }

        // Função de atualizar dados
        public function atualizaDados(){
            $data = array('idUsuario'       => $this->input->post('idUsuario'),
                          'nomeUsuario'     => $this->input->post('nomeUsuario'),
                          'rg'              => $this->input->post('rg'),
                          'email'           => $this->input->post('email'));
            $this->db->where('idUsuario',$data['idUsuario']);

            return $this->db->update('usuarios',$data);
        }
        
        // Função de select dinâmico da tabela Nivel de Acesso
        public function dinamicSelect(){
            $this->db->select('*');
            $this->db->order_by('nivel');
            return $this->db->get('nivelacesso')->result();
        }

        // Função para o próprio usuario atualizar a senha!
        public function AtualizaSenha(){
            $id = $this->input->post('idUsuario');
            
            $senha_antiga = md5($this->input->post('senha'));
            $senha_nova = md5($this->input->post('senha_nova'));
           
            $this->db->select('*');
            $this->db->from('usuarios');
            $this->db->where('idUsuario',$id);
            $query = $this->db->get();

            foreach ($query->result_array() as $result){
                $dados['senha'] = $senha_nova;

                if($result['senha']==$senha_antiga){
                    $this->db->where('idUsuario',$id);
                    $this->db->update('usuarios',$dados);
                    return true;
                }else{
                    return false;
                }
            }

        }

        // Função de listar os produtos
        public function listProduto(){
            $this->db->select('*');
            $this->db->select("DATE_FORMAT(validade,'%d/%m/%Y') as validade",false);
            $this->db->join('categoria','id_categoria = idcategoria','inner');
            $this->db->join('fornecedor','id_fornecedor = idfornecedor','inner');
            $this->db->where('produto.ativo','1');
        	return $this->db->get('produto')->result();
        }

        // Função de inserção de produto no banco de dados
        public function insereProduto(){
            $data = array(
                'idProduto' => $this->input->post('idProduto'),
                'cod_produto' => $this->input->post('cod_produto'),
                'nomeProduto' => $this->input->post('nomeProduto'),
                'validade' => implode('-',array_reverse(explode('/',$this->input->post('validade')))),
                'quantidade' => $this->input->post('quantidade'),
                'descricao' => $this->input->post('descricao'),
                'valor' => $this->input->post('valor'),
                'id_categoria' => $this->input->post('id_categoria'),
                'id_fornecedor' => $this->input->post('id_fornecedor')
            );

            return $this->db->insert('produto',$data);
        }

        // Função de Deletar produto do banco de dados (Temporario, vai mudar para um update)
        public function delProduto($id=null){
            $this->db->set('ativo','0');
            $this->db->where('idProduto',$id);
            $this->db->update('produto');

            return $this->db->get('produto')->result();
        }

        // Função que traz os dados dos produtos no formulário para ser atualizado
        public function AtualizaProd($id=null){
            $this->db->where('idProduto',$id);
            return $this->db->get('produto')->result();
        }

        // Função que recebe os dados em um array para serem atualizados na tabela produto
        public function AtualizaProduto(){
            $data = array(  'idProduto'     => $this->input->post('idProduto'),
                            'cod_produto'   => $this->input->post('cod_produto'),
                            'nomeProduto'   => $this->input->post('nomeProduto'),
                            'validade'      => date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('validade')))),
                            'quantidade'    => $this->input->post('quantidade'),
                            'descricao'     => $this->input->post('descricao'),
                            'id_categoria'  => $this->input->post('id_categoria'),
                            'id_fornecedor' => $this->input->post('id_fornecedor')
                        );

            $this->db->where('idProduto',$data['idProduto']);

            return $this->db->update('produto',$data);
        }

        public function getProduto($shor = 'id',$order = 'asc', $limit = null, $offset = null){
            $busca = $this->input->post('busca');

            $this->db->select('*');
            $this->db->join('categoria','id_categoria = idcategoria','inner');
            $this->db->join('fornecedor','id_fornecedor = idfornecedor','inner');
            $this->db->like('nomeProduto',$busca);
            $this->db->order_by($shor,$order);
            $this->db->limit($limit,$offset);

            return $this->db->get('produto')->result();
        }

        public function CountProduto(){
            return $this->db->count_all('produto');
        }

        // Função de Inserir Categoria no banco de dados.
        public function InsereCategoria(){
            $categoria['nomeCategoria']  = $this->input->post('nomeCategoria');
            $categoria['descricao']      = $this->input->post('descricao');
            $categoria['ativo']          = $this->input->post('ativo'); 

            return $this->db->insert('categoria',$categoria);
        }

        // Função que lista as categorias
        public function selectCategoria(){
            $this->db->select('*');
        	return $this->db->get('categoria')->result();
        }

        // Função de um select dinâmico de categoria
        public function dinamicCategoria(){
            $this->db->select('*');
            $this->db->where('ativo','1');
            $this->db->order_by('nomeCategoria');
            return $this->db->get('categoria')->result();
        }

        public function atualCategoria($id=null){
            $this->db->where('idcategoria',$id);
            return $this->db->get('categoria')->result();
        }

        public function atualizaCategoria(){
            $data = array('idcategoria'     => $this->input->post('idcategoria'),
                          'nomeCategoria'   => $this->input->post('nomeCategoria'),
                          'descricao'       => $this->input->post('descricao'),
                          'ativo'           => $this->input->post('ativo'));

            $this->db->where('idcategoria',$data['idcategoria']);
            
            return $this->db->update('categoria',$data);
        }

        public function inativaCategoria($id=null){
            $this->db->set('ativo','0');
            $this->db->where('idcategoria',$id);
            $this->db->update('categoria');

            return $this->db->get('categoria')->result();
        }

        public function ativarCategoria($id=null){
            $this->db->set('ativo','1');
            $this->db->where('idcategoria',$id);
            $this->db->update('categoria');

            return $this->db->get('categoria')->result();
        }

        public function getCategoria($shor = 'id',$order = 'asc', $limit = null, $offset = null){
            $busca = $this->input->post('busca');

            $this->db->select('*');
            $this->db->like('nomeCategoria',$busca);
            $this->db->order_by($shor,$order);
            $this->db->limit($limit,$offset);

            return $this->db->get('categoria')->result();
        }

        public function CountCategoria(){
            return $this->db->count_all('categoria');
        }

        // Função de inserção de clientes no banco de dados
        public function insereCliente(){
            $data = array(  'idcliente'           => $this->input->post('idcliente'),
                            'nomeCliente'         => $this->input->post('nomeCliente'),
                            'rg'                  => $this->input->post('rg'),
                            'Cpf'                 => $this->input->post('Cpf'),
                            'Cnpj'                => $this->input->post('Cnpj'),
                            'id_tipo'             => $this->input->post('id_tipo'),
                            'nascimentoCliente'   => date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('nascimentoCliente')))),
                            'email'               => $this->input->post('email'),
                            'telefone'            => $this->input->post('telefone'),
                            'sexo'                => $this->input->post('sexo'),
                            'endereco'            => $this->input->post('endereco'),
                            'numero'              => $this->input->post('numero'),
                            'complemento'         => $this->input->post('complemento'),
                            'cep'                 => $this->input->post('cep'),
                            'uf'                  => $this->input->post('uf'),
                            'cidade'              => $this->input->post('cidade'),
                            'bairro'              => $this->input->post('bairro'),
                            'ativo'               => $this->input->post('ativo')
                );

            return $this->db->insert('cliente',$data);
        }

        // Função de listagem de clientes
        public function listaClientes(){
            $this->db->select("*");
            $this->db->select("DATE_FORMAT(c.nascimentoCliente,'%d/%m/%Y') as nascimentoCliente",false);
            $this->db->from('cliente c');
            $this->db->join('tipo t','c.id_tipo = t.idtipo','inner');
            
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }
            return $registros;
        }

        // Função para inativar o cliente
        public function inativaCliente($id=null){
            $this->db->set('ativo','0');
            $this->db->where('idcliente',$id);
            $this->db->update('cliente');
            return $this->db->get('cliente')->result();
        }

        // Função para ativar o cliente
        public function atiCliente($id=null){
            $this->db->set('ativo','1');
            $this->db->where('idcliente',$id);
            $this->db->update('cliente');

            return $this->db->get('cliente')->result();
        }

        // Função que traz todos os dados no formulário para ser atualizado
        public function atCliente($id=null){
            $this->db->where('idcliente',$id);
            return $this->db->get('cliente')->result();
        }

        // Função que recebe um array, trazendo os dados para serem atualizados
        public function atualizaCliente(){
            $data = array(  'idcliente'           => $this->input->post('idcliente'),
                            'nomeCliente'         => $this->input->post('nomeCliente'),
                            'rg'                  => $this->input->post('rg'),
                            'Cpf'                 => $this->input->post('Cpf'),
                            'Cnpj'                => $this->input->post('Cnpj'),
                            'id_tipo'             => $this->input->post('id_tipo'),
                            'nascimentoCliente'   => date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('nascimentoCliente')))),
                            'email'               => $this->input->post('email'),
                            'telefone'            => $this->input->post('telefone'),
                            'sexo'                => $this->input->post('sexo'),
                            'endereco'            => $this->input->post('endereco'),
                            'numero'              => $this->input->post('numero'),
                            'complemento'         => $this->input->post('complemento'),
                            'cep'                 => $this->input->post('cep'),
                            'uf'                  => $this->input->post('uf'),
                            'cidade'              => $this->input->post('cidade'),
                            'bairro'              => $this->input->post('bairro'),
                            'ativo'               => $this->input->post('ativo'));
            $this->db->where('idcliente',$data['idcliente']);

            return $this->db->update('cliente',$data);
        }

        public function DinamicTipo(){
            $this->db->select('*');
            $this->db->from('tipo');
            
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }
            return $registros;
        }

        public function CountCliente(){
            return $this->db->count_all('cliente');
        }

        // Função de Inserção de fornecedores no banco de dados
        public function insereFornecedor(){
            $forn['nomeFantasia']           = $this->input->post('nomeFantasia');
            $forn['razaoSocial']            = $this->input->post('razaoSocial');
            $forn['cnpj']                   = $this->input->post('cnpj');
            $forn['dataCriacao']            = implode('-',array_reverse(explode('/',$this->input->post('dataCriacao'))));
            $forn['email']                  = $this->input->post('email');
            $forn['telefone']               = $this->input->post('telefone');
            $forn['endereco']               = $this->input->post('endereco');
            $forn['numero']                 = $this->input->post('numero');
            $forn['complemento']            = $this->input->post('complemento');
            $forn['cep']                    = $this->input->post('cep');
            $forn['uf']                     = $this->input->post('uf');
            $forn['cidade']                 = $this->input->post('cidade');
            $forn['bairro']                 = $this->input->post('bairro');
            $forn['ativo']                  = $this->input->post('ativo');

            return $this->db->insert('fornecedor',$forn);
        }

        // Função de Listagem dos fornecedores
        public function ListaFornecedores(){
            $this->db->select('*');
            $this->db->select("DATE_FORMAT(dataCriacao,'%d/%m/%Y') as dataCriacao",false);
            return $this->db->get('fornecedor')->result();
        }
        
        // Função que traz todos os dados no formulário para ser atualizado
        public function atualizaForn($id=null){
            $this->db->where('idfornecedor',$id);
            return $this->db->get('fornecedor')->result();
        }
        
        // Função que recebe um array, trazendo os dados para serem atualizados
        public function atualizaFornecedor(){
            $data = array('idfornecedor'         => $this->input->post('idfornecedor'),
                          'nomeFantasia'        => $this->input->post('nomeFantasia'),
                          'razaoSocial'         => $this->input->post('razaoSocial'),
                          'cnpj'                => $this->input->post('cnpj'),
                          'dataCriacao'         => date('Y-m-d',strtotime(str_replace('/','-',$this->input->post('dataCriacao')))),
                          'email'               => $this->input->post('email'),
                          'telefone'            => $this->input->post('telefone'),
                          'endereco'            => $this->input->post('endereco'),
                          'numero'              => $this->input->post('numero'),
                          'complemento'         => $this->input->post('complemente'),
                          'cep'                 => $this->input->post('cep'),
                          'uf'                  => $this->input->post('uf'),
                          'cidade'              => $this->input->post('cidade'),
                          'bairro'              => $this->input->post('bairro'),
                          'ativo'               => $this->input->post('ativo'));

            $this->db->where('idfornecedor',$data['idfornecedor']);

            return $this->db->update('fornecedor',$data);
        }

        // Função de ativar o fornecedor!
        public function atForne($id=null){
            $this->db->set('ativo','1');
            $this->db->where('idfornecedor',$id);
            $this->db->update('fornecedor');

            return $this->db->get('fornecedor')->result();
        }

        // Função de inativar o fornecedor!
        public function inatForn($id=null){
            $this->db->set('ativo','0');
            $this->db->where('idfornecedor',$id);
            $this->db->update('fornecedor');
            return $this->db->get('fornecedor')->result();
        }

        // Função select dinâmico pra tela de produtos, trazendo todos os fornecedores!
        public function dinamicFornecedor(){
            $this->db->select('*');
            $this->db->order_by('nomeFantasia');
            $this->db->where('ativo','1');
            return $this->db->get('fornecedor')->result();
        }
        
        public function getFornecedor($shor = 'id',$order = 'asc', $limit = null, $offset = null){
            $termo = $this->input->post('busca');

            $this->db->select('*');
            $this->db->like('nomeFantasia',$termo);
            $this->db->or_like('razaoSocial',$termo);
            $this->db->or_like('cnpj',$termo);
            $this->db->order_by($shor,$order);
            $this->db->limit($limit,$offset);

            return $this->db->get('fornecedor')->result();
        }

        public function CountFornecedor(){
            return $this->db->count_all('fornecedor');
        }

        // Função de Busca de cliente na tela de venda
        public function SearchCliente(){
            $this->db->select('idcliente,nomeCliente');
            $this->db->from("cliente");
            $this->db->order_by('nomeCliente ASC');

            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }
            return $registros;
        }

        // Função dinâmico de produto
        public function ProductDinamic(){
            $this->db->select("*");
            $this->db->from("produto");
            $this->db->where('ativo','1');
            $this->db->order_by('nomeProduto ASC');

            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }

            return $registros;
        }

        // Faz a contagem do valor do produto
        public function CountValor(){
            $this->db->select("valor");
            $this->db->from("produto");
            
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }
            return $registros;
        }

        // Função para inserir venda
        public function insereVenda(){
            // Array Dinâmico para inserir na tabela!
            $data = array(
                'idvendas'          => $this->input->post('idvendas'),
                'id_produto'        => $this->input->post('id_produto'),
                'id_cliente'        => $this->input->post('id_cliente'),
                'qtd_vendida'       => $this->input->post('qtd_vendida'),
                //'valor'             => $this->input->post('valor'),
                'id_forma'          => $this->input->post('id_forma')
            );
            //$this->db->where('idvendas',$data['idvendas']);
            return $this->db->insert('vendas',$data);
        }

        // Listar vendas
        public function Vendas(){
            $this->db->select("*");
            $this->db->from("vendas v");
            $this->db->join("cliente c","v.id_cliente = c.idcliente","innser");
            $this->db->join("produto p","v.id_produto = p.idProduto","inner");
            $this->db->join("formaPagamento f","v.id_forma = f.idforma","inner");
            
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }
            return $registros;
        }

        // Select de Forma de Pagamento
        public function formaPagamento(){
            $this->db->select("*");
            $this->db->from("formapagamento");
            
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }
            return $registros;
        }

        // Função de Listagem dos dados do Carrinho de Compras
        public function listCarrinho(){
            $this->db->select("*");
            $this->db->from("carrinho c");
            $this->db->join("produto p","c.id_produto = p.idProduto","INNER");
            $this->db->join("cliente cl","c.id_cliente = cl.idcliente","INNER");

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