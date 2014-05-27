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
                    // se houver id executa o método readObject_json($id) e se não houver executa o método listObjects_json()
                    $object_id ? $this->readObject_json( $object_id ) : $this->listObjects_json( $this->input->get() );

                else // se não for uma requisição AJAX
                    // se houver id executa o método readObject_html($id) e se não houver executa o método listObjects_html()
                    $object_id ? $this->readObject_html( $object_id ) : $this->listObjects_html( $this->input->get() );

            break;

            case 'POST': // no caso de uma requisição de tipo POST

                $this->createObject( $_POST ); // executa o método createObject($params);

            break;

            case 'PUT': // no caso de uma requisição de tipo PUT

                parse_str(file_get_contents("php://input"),$post_vars);

                $this->updateObject( $post_vars ); // executa o método updateObject($params);

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