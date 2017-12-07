<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Classe Login, onde vai controlador todo o sistema.

class Logincontroller extends CI_Controller {
    
    public function Session_funcionario(){
        if($this->session->userdata('logado') == false){
            redirect('siteController/AreaFuncionario');
        }
    }

    // Função pra verificar na sessão o nivel de acesso
    public function verificarNivel(){
        $this->load->model('loginModel','usuarios');

        if($this->usuarios->LogartUsuario()){
            // Verifica se existe a sessão
            if(isset($_SESSION['id_nivel'])){
                
                // Atribui uma variavel para session
                $nivel = $_SESSION['id_nivel'];

                if($nivel == '1'){ // Verifica se o nível é administrador

                    redirect('administradorController'); // Redireciona para a área do administrador
                
                }else if($nivel == '2'){ // Verifica se o nível é gestor
                    redirect('funcionarioController'); // Redireciona para a área do funcionário
                    
                
                }else if($nivel == '3'){ // Verifica se o nível é funcionário
                
                    redirect('gestorController'); // Redireciona para a área do gestor
                
                }
            }
        }else{ // Caso não seja nenhum dos niveis, retorna para tela de login
            redirect('siteController/AreaFuncionario/1'); // Redireciona para tela de login
        }
    }
}
?>