<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato_Model extends CI_Model {

    function __construct()
    {
        //$this->load->library("mongo_db");
    }

    public function enviar($assunto = null, $mensagem = null, $email = null, $fone = null){

        $message = "Olá,"; // define a mensagem do e-mail de nov usuario criado
        $message .= "\r\n<p> Recebemos seu contato e em breve te responderemos.</p>";
        $message .= "\r\n<p><strong>".$assunto."</strong></p>";
        $message .= "\r\n<p>".$mensagem."</p>";
        $message .= "\r\n<p></p>";
        $message .= "\r\n<p> Atenciosamente,</p>";
        $message .= "\r\n<p> <strong>Arte del Gusto</strong></p>";

        $this->load->library('email'); // carrega a biblioteca email
        $this->email->from('no-reply@artedelgusto.com.br', "Arte del Gusto" ); // define o(s) remetente(S)
        $this->email->to( 'denisefaccin@gmail.com, bruno@tzadi.com, bruno.joao@ostec.com.br' );  // define o(s) destinatário(s)
        $this->email->subject('Contato recebido'); // define o assunto
        $this->email->message( $message );  // insere a mensagem
        $this->email->send(); // envia o email

        return array('success' => true);

    }

}