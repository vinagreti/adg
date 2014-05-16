<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Geleias extends CI_Controller {

    public function index()
    {
        $conteudo = $this->load->view('geleias/index', false, true);

        $this->template->load('private', $conteudo, null, null, null); // carrega a pagina inicial
    }

}