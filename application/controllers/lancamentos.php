<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lancamentos extends My_Controller {

    public function index() { $this->rest(); } // inicia o servidor RESTful definido em /application/core/MY_Controller.php

    public function getObjects_json(){

        $this->load->model("lancamentos_model");

        $carregarResumo = $this->lancamentos_model->getObjects($_GET, false, false, true);

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

        $this->load->model("lancamentos_model");

        $carregarObjeto = $this->lancamentos_model->getObject($id);

        if( $carregarObjeto["sucesso"] ){ // se a consulta ao banco for bem sucedida

            $res = $carregarObjeto["object"]; // insere o objeto na resposta

        } else { // se a consulta ao banco não for bem sucedida

            $res = $carregarObjeto["msg"]; // mensagem de erro

            header( "HTTP/1.0 400 ". utf8_decode( $carregarObjeto["msg"] ) ); // seta o código e a mensagem de erro no cabeçalho da resposta

        }

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }

    public function postObject( $data ){

        $this->load->model("lancamentos_model");

        $createObject = $this->lancamentos_model->postObject( $data );

        if( $createObject['sucesso'] )
            redirect(base_url().'lancamentos/?id='.$createObject['id']);

        else{

            header( "HTTP/1.0 400"); // seta o código e a mensagem de erro no cabeçalho da resposta

            header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

            echo json_encode( $createObject['error'] ); // responde

        }

    }

    public function deleteObject( $id ){

        $this->load->model("lancamentos_model");

        $deletarObjeto = $this->lancamentos_model->deleteObject($id);

        if( $deletarObjeto["sucesso"] ){ // se a remoção for bem sucedida

            $res = $deletarObjeto["msg"]; // mensagem de sucesso

        } else { // se a remoção não for bem sucedida

            $res = $deletarObjeto["msg"]; // mensagem de erro

            header( "HTTP/1.0 400 ". utf8_decode( $deletarObjeto["msg"] ) ); // seta o código e a mensagem de erro no cabeçalho da resposta

        }

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }

    public function getObjects_html()
    {

        $javascript_files = array('js/lancamentos', 'third-party/bostable/bostable', 'third-party/datepicker/js/bootstrap-datepicker', 'third-party/typeahead/typeahead', 'third-party/typeahead/hogan');

        $css_files = array('third-party/datepicker/css/datepicker');

        $conteudo = $this->load->view('lancamentos/index', false, true);

        $this->template->load('private', $conteudo, $javascript_files, $css_files, null); // carrega a pagina inicial

    }

    public function getObject_html( $id ){

        $this->getObject_json( $id );

    }

    public function createTemplate(){

        $this->load->view('lancamentos/createTemplate', false);

    }

    public function updateTemplate(){

        $res = $this->load->view('lancamentos/updateTemplate', false, true);

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }

    public function readTemplate(){

        $res = $this->load->view('lancamentos/readTemplate', false, true);

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }

    public function dropTemplate(){

        $res = $this->load->view('lancamentos/dropTemplate', false, true);

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde

    }
}