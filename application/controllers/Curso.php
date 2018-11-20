<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {
   
    public function __construct(){
        parent::__construct();
        if (!$this->session->has_userdata("usuario")) {
            redirect("usuario/login");
        }
    }   

    public function salvar(){
       if ($this->session->userdata('usuario')->tipo != 1){ 
       redirect('usuario/restricao');
       }
       $this->load->model('Curso_model');
       $this->Curso_model->nome = $_POST["nome"];
       $this->Curso_model->descricao = $_POST["descricao"];
       $this->Curso_model->inserir();
       redirect('curso/listar');
   }
   
    public function cadastrar(){
       if ($this->session->userdata('usuario')->tipo != 1){ 
       redirect('usuario/restricao');
       }
       $this->load->view('template/cabecalho');
       $this->load->view('template/nav');
       $this->load->view('formcurso');
       $this->load->view('template/rodape');
   }
   
   public function listar(){
       $this->load->model('Curso_model');
       $dados["cursos"] = $this->Curso_model->recuperar();
       $this->load->view('template/cabecalho');
       $this->load->view('template/nav');
       $this->load->view('listarcursos', $dados);
       $this->load->view('template/rodape');
   }
   
   public function detalhes($id){
       $this->load->model('Curso_model', 'cursos');
       $dados["curso"] = $this->cursos->recuperarUm($id);
       $this->load->view('template/cabecalho');
       $this->load->view('template/nav');
       $this->load->view('detalhescurso', $dados);
       $this->load->view('template/rodape');
   }
   
   
   public function excluir($id){
       if ($this->session->userdata('usuario')->tipo != 1){ 
       redirect('usuario/restricao1');
       }
       $this->load->model('Curso_model');
       $this->Curso_model->remover($id);
       redirect('curso/listar');
   }
   
   public function editar($id){
       if ($this->session->userdata('usuario')->tipo != 1){ 
       redirect('usuario/restricao1');
       }
       $this->load->model('Curso_model');
       $dados["c"] = $this->Curso_model->recuperarUm($id);
       $this->load->view('template/cabecalho');
       $this->load->view('template/nav');
       $this->load->view('editarcurso', $dados);
       $this->load->view('template/rodape');
   }
   
   public function atualizar($id){
        if ($this->session->userdata('usuario')->tipo != 1){ 
        redirect('usuario/restricao1');
        }
        $this->load->model('Curso_model');
        $dados = array("nome"=> $_POST["nome"], "descricao"=>$_POST["descricao"]);
        $this->Curso_model->id = $id;
        $this->Curso_model->update($dados);
        redirect('curso/listar');
   }

   public function email(){
       $this->email->from("sauloq6@gmail.com", 'Meu E-mail');
       $this->email->subject("Assunto do e-mail");
       $this->email->to("jc4695384@gmail.com"); 
       $this->email->message("Se enviar ele é Deus");
       $this->email->send();
       $this->email->print_debugger();
       $this->load->view('template/cabecalho');
       $this->load->view('template/nav');
       $this->load->view('enviaremail');
       $this->load->view('template/rodape');
   }
  public function index(){
    $mpdf = new \Mpdf\Mpdf();
    $html = $this->load->view('html_to_pdf', [], true);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }
}
