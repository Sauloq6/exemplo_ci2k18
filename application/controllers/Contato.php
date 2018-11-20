<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {
	public function index(){
	   $this->load->view('formulario');
	}
	public function receber(){
	    $nome = $this->input->post('nome');
	    $email = $this->input->post('email');
	    $recaptchaResponse = $this->input->post('g-recaptcha-response');
	    $secret = '6LfUpWsUAAAAAPCqNHmD0cAOeWBAfBE3snPrze0o';
	    $url = 'https://www.google.com/recaptcha/api/siteverify';
	    $data1 = array('secret' => $secret, 'response' => $recaptchaResponse);
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    $response = curl_exec($ch);
	    curl_close($ch);
	    $status = json_decode($response, true);
	    if ($status['success']) {
	      echo "Você não é uma máquina, parabéns";
	  }else{
	      echo "Você é uma máquina";
	  }
	 }














}
?>	