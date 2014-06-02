<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends My_Controller {

    public function index() { $this->rest(); } // inicia o servidor RESTful definido em /application/core/MY_Controller.php

    public function listObjects_html()
    {

        $javascript_files = array('third-party/bostable/bostable', 'third-party/typeahead/typeahead', 'third-party/typeahead/hogan');

        $conteudo = $this->load->view('clientes/index', false, true);

        $this->template->load('private', $conteudo, $javascript_files, null, null); // carrega a pagina inicial

    }

    public function listObjects_json(){

        $this->load->model("clientes_model");

        $carregarResumo = $this->clientes_model->resumo($_GET, false, false, true);

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

}