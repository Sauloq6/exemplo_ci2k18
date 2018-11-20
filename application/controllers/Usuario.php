<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Usuario_model');
    }

    public function index(){
        $data =  array('info' => $this->session->flashdata('info') );
        $this->load->view('cadastro', $data);
    }

    public function autenticar(){
        $login = $_POST['usuario'];
        $senha = $_POST['senha'];
        $usuario = $this->Usuario_model->recuperarPorloginesenha($login, $senha);
        if ($usuario) {
            $this->session->set_userdata('usuario', $usuario);
            redirect("/");
        }else{
            $this->session->set_flashdata('msg', "Dados incorretos");
        }
        
        if ($usuario == "maria" && $senha=="123"){
            $this->session->set_userdata("usuario", $usuario);
            redirect('/');
        }else{
            $this->session->set_flashdata('msg', "Dados inválidos!");
            redirect('usuario/login');
        }
    }
    
    public function login(){
        $this->load->view('login');
    }
   
    public function logoff(){
        $this->session->unset_userdata('usuario');
        redirect('usuario/login');
    }

    public function restricao(){
        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('acessonegado');
        $this->load->view('template/rodape');
    }

    public function restricao1(){
        $this->load->view('template/cabecalho');
        $this->load->view('template/nav');
        $this->load->view('comandonegado');
        $this->load->view('template/rodape');
    }
    
}
