<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends My_Controller {

    public function index() { $this->rest(); } // inicia o servidor RESTful definido em /application/core/MY_Controller.php

    public function getObjects_json(){

        $this->load->model("clientes_model");

        $carregarResumo = $this->clientes_model->getObjects($_GET, false, false, true);

        if( $carregarResumo["sucesso"] ){ // se a consulta ao banco for bem sucedida

            $res = $carregarResumo["resumo"]; // insere o resumo na resposta

            header( "X-Total-Count: " . $carregarResumo["total"] );

        } else { // se a consulta ao banco não for bem sucedida

            $res = $carregarResumo["msg"]; // mensagem de erro

            header( "HTTP/1.0 400 ". utf8_decode( $carregarResumo["msg"] ) ); // seta o código e a mensagem de erro no cabeçalho da resposta

        }

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde
    }

    public function getObject_json( $id ){

        $this->load->model("clientes_model");

        $carregarObjecto = $this->clientes_model->getObject($id);

        if( $carregarObjecto["sucesso"] ){ // se a consulta ao banco for bem sucedida

            $res = $carregarObjecto["object"]; // insere o objeto na resposta

        } else { // se a consulta ao banco não for bem sucedida

            $res = $carregarObjecto["msg"]; // mensagem de erro

            header( "HTTP/1.0 400 ". utf8_decode( $carregarObjecto["msg"] ) ); // seta o código e a mensagem de erro no cabeçalho da resposta

        }

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }

    public function postObject( $data ){

        $this->load->model("clientes_model");

        $createObject = $this->clientes_model->postObject( $data );

        if( $createObject['sucesso'] )
            redirect(base_url().'clientes/?id='.$createObject['id']);

        else{

            header( "HTTP/1.0 400"); // seta o código e a mensagem de erro no cabeçalho da resposta

            header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

            echo json_encode( $createObject['error'] ); // responde

        }

    }

    public function getObjects_html()
    {

        $javascript_files = array('third-party/bostable/bostable', 'third-party/typeahead/typeahead', 'third-party/typeahead/hogan');

        $conteudo = $this->load->view('clientes/index', false, true);

        $this->template->load('private', $conteudo, $javascript_files, null, null); // carrega a pagina inicial

    }

    public function getObject_html( $id ){

        $this->getObject_json( $id );

    }

    public function createTemplate(){

        $this->load->view('clientes/createTemplate', false);

    }
}