<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$conteudo = $this->load->view('welcome/index', false, true);

		$this->template->load('private', $conteudo, null, null, null); // carrega a pagina inicial
	}

}