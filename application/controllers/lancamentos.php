<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lancamentos extends CI_Controller {

    public function index()
    {

        $javascript_files = array('js/lancamentos', 'third-party/bostable/bostable');

        $conteudo = $this->load->view('lancamentos/index', false, true);

        $this->template->load('private', $conteudo, $javascript_files, null, null); // carrega a pagina inicial
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

        header('Content-Type: application/json'); // define o tipo de conteúdo no cabeçalho da resposta

        echo json_encode( $res ); // responde
    }

}