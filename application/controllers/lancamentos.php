<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lancamentos extends CI_Controller {

    public function index()
    {

        if (!$this->input->is_ajax_request()) {

            $javascript_files = array('js/lancamentos', 'third-party/bostable/bostable');

            $conteudo = $this->load->view('lancamentos/index', false, true);

            $this->template->load('private', $conteudo, $javascript_files, null, null); // carrega a pagina inicial

        } else {

            $this->json();

        }
    }

    public function json(){

        $this->load->model("lancamentos_model");

        $carregarResumo = $this->lancamentos_model->resumo(false, false, false, true);

        if( $carregarResumo["sucesso"] ){ // se a consulta ao banco for bem sucedida

            $res = $carregarResumo["resumo"]; // insere o resumo na resposta

            header( "X-Total-Count: " . $carregarResumo["total"] );

        } else { // se a consulta ao banco não for bem sucedida

            $res = $carregarResumo["msg"]; // mensagem de erro

            header( "HTTP/1.0 400 ". utf8_decode( $carregarResumo["msg"] ) ); // seta o código e a mensagem de erro no cabeçalho da resposta

        }

        // usleep(rand(1000000,30000000));

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde
    }

    public function createForm(){

        $res = $this->load->view('lancamentos/createForm', false, true);

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }

    public function updateForm(){

        $res = $this->load->view('lancamentos/updateForm', false, true);

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }

    public function readTemplate(){

        $res = $this->load->view('lancamentos/readTemplate', false, true);

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }
}