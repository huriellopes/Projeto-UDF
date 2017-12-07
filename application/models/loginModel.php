<?php
    class Loginmodel extends CI_model{
        
        function __construct(){
           parent::__construct();
        }

        public function Session_cliente(){
            if($this->session->userdata('logado') == false){
                redirect('siteController/LoginCliente');
            }
        }

        public function Session_funcionario(){
            if($this->session->userdata('logado') == false){
                redirect('siteController/LoginCliente');
            }
        }
        
        // Função de Logar na Area do Cliente
        public function LogarCliente(){
            $email = $this->input->post('email');
            $senha = md5($this->input->post('senha'));

            $this->db->where('senha',$senha);
            $this->db->where('email',$email);
            $this->db->where('ativo',1);
            $data['cliente'] = $this->db->get('cliente')->result();

            if(count($data['cliente']) == 1){
                $dados['nomeCliente']   = $data['cliente'][0]->nomeCliente;
                $dados['idcliente']     = $data['cliente'][0]->idcliente;
                $dados['logado']        = true;
                $this->session->set_userdata($dados);
                return true;
            }else{
                return false;
            }
        }

        public function logoutCliente(){
            $this->session->sess_destroy();
            return true;
        }

        public function LogartUsuario(){
            $cpf    = $this->input->post('cpf');
            $senha  = md5($this->input->post('senha'));

            $this->db->where('senha',$senha);
            $this->db->where('cpfUsuario',$cpf);
            $this->db->where('ativo',1);
            $data['usuarios'] = $this->db->get('usuarios')->result();

            if(count($data['usuarios']) == 1){
                $dados['nomeUsuario']   = $data['usuarios'][0]->nomeUsuario;
                $dados['idUsuario']     = $data['usuarios'][0]->idUsuario;
                $dados['id_nivel']      = $data['usuarios'][0]->id_nivel;
                $dados['logado']        = true;
                $this->session->set_userdata($dados);
                return true;
            }else{
                return false;
            }
        }

        public function LogoutUsuario(){
            $this->session->sess_destroy();
            return true;
        }
    }
?>