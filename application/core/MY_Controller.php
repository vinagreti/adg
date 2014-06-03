<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_Controller{

    public function __construct() {

        parent::__construct(); // executa o construturo da classe pai

    }

    public function rest(){ // rest server

        switch ($this->input->server('REQUEST_METHOD')) { // verifica o tipo de requisição HTTP

            case 'GET': // no caso de uma requisição de tipo GET

                $object_id = $this->input->get("id"); // salva o id da uri

                if( $this->input->is_ajax_request() ) // se for uma reuisição AJAX
                    // se houver id executa o método getObject_json($id) e se não houver executa o método getObjects_json()
                    $object_id ? $this->getObject_json( $object_id ) : $this->getObjects_json( $this->input->get() );

                else // se não for uma requisição AJAX
                    // se houver id executa o método getObject_html($id) e se não houver executa o método getObjects_html()
                    $object_id ? $this->getObject_html( $object_id ) : $this->getObjects_html( $this->input->get() );

            break;

            case 'POST': // no caso de uma requisição de tipo POST

                $this->postObject( $_POST ); // executa o método postObject($params);

            break;

            case 'PUT': // no caso de uma requisição de tipo PUT

                parse_str(file_get_contents("php://input"),$post_vars);

                $_POST = $post_vars; // hack para poder utilizar o form validation

                $this->putObject( $post_vars ); // executa o método putObject($params);

            break;

            case 'PATCH': // no caso de uma requisição de tipo PATCH

                parse_str(file_get_contents("php://input"),$post_vars);

                $_POST = $post_vars; // hack para poder utilizar o form validation

                $this->patchObject( $post_vars ); // executa o método patchObject($params);

            break;

            case 'DELETE': // no caso de uma requisição de tipo DELETE

                $this->deleteObject( $this->input->get() ); // executa o método deleteObject($params);

            break;

            default: // no caso de uma requisição de outros tipos

                show_error(htmlentities("Requisição inválida")); // retorna um erro

            break;

        }

    }
}