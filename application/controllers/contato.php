<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends CI_Controller {

    public function index()
    {

        $javascript_files = array('js/contato');

        $conteudo = $this->load->view('contato/index', false, true);

        $this->template->load('private', $conteudo, $javascript_files, null, null); // carrega a pagina inicial
    }

    public function enviar(){

        if( empty($_POST['assunto']) ){

            $res['success'] = false;

            $res['msg'] = 'Informe o assunto';

        }
        else if ( empty($_POST['mensagem']) ){

            $res['success'] = false;

            $res['msg'] = 'Informe a mensagem que deseja nos enviar';

        }
        else{

            $this->load->model('contato_model');

            $res = $this->contato_model->enviar($_POST['assunto'], $_POST['mensagem']);

        }

        // define o tipo de conteúdo no cabeçalho da resposta
        header('Content-Type: application/json');

        // responde
        echo json_encode( $res );

    }

}