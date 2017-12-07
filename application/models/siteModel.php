<?php
    class Sitemodel extends CI_model{
        
        const SESSION = "Carrinho";

        function __construct(){
           parent::__construct();
        }

        // Função de inserção de um novo cliente!
        public function novoCliente(){
            $data = array('idcliente'           => $this->input->post('idcliente'),
                'nomeCliente'         => $this->input->post('nomeCliente'),
                'rg'                  => $this->input->post('rg'),
                'Cpf'                 => $this->input->post('Cpf'),
                'Cnpj'                => $this->input->post('Cnpj'),
                'id_tipo'             => $this->input->post('id_tipo'),
                'nascimentoCliente'   => date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('nascimentoCliente')))),
                'email'               => $this->input->post('email'),
                'senha'               => $this->input->post('senha'),
                'telefone'            => $this->input->post('telefone'),
                'sexo'                => $this->input->post('sexo'),
                'endereco'            => $this->input->post('endereco'),
                'numero'              => $this->input->post('numero'),
                'complemento'         => $this->input->post('complemento'),
                'cep'                 => $this->input->post('cep'),
                'uf'                  => $this->input->post('uf'),
                'cidade'              => $this->input->post('cidade'),
                'bairro'              => $this->input->post('bairro')
            );

            return $this->db->insert('cliente',$data);
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

        public function novaSenha(){
            $email = $this->input->post('email');
            $senha_nova = md5($this->input->post('NovaSenha'));

            $this->db->select('email');
            $this->db->where('email',$email);
            $data['email'] = $this->db->get('cliente')->result();
            $dados['senha'] = $senha_nova;

            if($data['email'][0]->email == $email){
                $this->db->where('email',$email);
                $this->db->update('cliente',$dados);
                return true;
            }else{
                return false;
            }
        }

        public function AtualDados($id){
            $this->db->select("*");
            $this->db->from("cliente");
            $this->db->where("idcliente",$id);
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $resultado = $query->result();
                
            }else{
                $resultado = null;
            }
            return $resultado;
        }

        public function AtualizaDados(){
            $data = array(
                'idcliente'             => $this->input->post('idcliente'),
                'nomeCliente'           => $this->input->post('nomeCliente'),
                'rg'                    => $this->input->post('rg'),
                'nascimentoCliente'     => date('Y-m-d',strtotime(str_replace('/', '-', $this->input->post('nascimentoCliente')))),
                'email'                 => $this->input->post('email'),
                'telefone'              => $this->input->post('telefone'),
                'sexo'                  => $this->input->post('sexo'),
                'endereco'              => $this->input->post('endereco'),
                'numero'                => $this->input->post('numero'),
                'complemento'           => $this->input->post('complemente'),
                'cep'                   => $this->input->post('cep'),
                'cidade'                => $this->input->post('cidade'),
                'bairro'                => $this->input->post('bairro')
            );

            $this->db->where('idcliente',$data['idcliente']);

            return $this->db->update('cliente',$data);
        }

        public function AtualizarSenha(){
            $id = $this->input->post('idcliente');
            
            $senha_antiga = md5($this->input->post('senha'));
            $senha_nova = md5($this->input->post('senha_nova'));
           
            $this->db->select('*');
            $this->db->from('cliente');
            $this->db->where('idcliente',$id);
            $query = $this->db->get();

            foreach ($query->result_array() as $result){
                $dados['senha'] = $senha_nova;

                if($result['senha']==$senha_antiga){
                    $this->db->where('idcliente',$id);
                    $this->db->update('cliente',$dados);
                    return true;
                }else{
                    return false;
                }
            }
        }

        public function retorna_produtos($id=null){
            $this->db->select('*');
            $this->db->from("produto");
            $this->db->where('ativo','1');
            $this->db->order_by("idProduto","ASC");
            
            $query = $this->db->get();

            if($query->num_rows() > 0){
                $registros = $query->result_array();
            }else{
                $registros = null;
            }

            return $registros;
        }

        /*public function SalvaCarrinho(){
            $data = array('nomeProduto'     =>  $this->input->post('nomeProduto'),
                          'quantidade'      => ,
                          'preco'           => ,
                          'id_produto'      => ,
                          'id_cliente'      => );
        }

        public function getFromSession(){
            if(isset())
        }*/
    }
?>