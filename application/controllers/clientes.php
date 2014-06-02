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

    public function createTemplate(){

        $this->load->view('clientes/createTemplate', false);

    }

    public function createObject( $data ){

        $this->load->model("clientes_model");

        $createObject = $this->clientes_model->create( $data );

        if( $createObject['sucesso'] )
            redirect(base_url().'clientes/?id='.$createObject['id']);

        else{

            header( "HTTP/1.0 400"); // seta o código e a mensagem de erro no cabeçalho da resposta

            header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

            echo json_encode( $createObject['error'] ); // responde

        }

    }

    public function readObject_json(){

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo '{"codigo":"1","tipo":"C","data":"12-05-2014","valor_cobrado":"35.00","valor_estimado":"35.00","descricao":"Encomenda para a OSTEC","realizado":"Sim","quantidade":"10","cliente":"Cassio Brodbeck","produto":"Sanduiche de Frango","valor_unidade":"3.50","fornecedor":null}';

    }
}