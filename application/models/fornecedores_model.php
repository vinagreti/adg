<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fornecedores_model extends CI_Model {

    public function resumo( $params = false, $pagina = false, $por_pagina = false, $retornarTotal = false, $contar = false ){ // retorna um resumo dos usuarios vinculados/reporteres

        if( !empty($params) ){

            if(!empty($params['nome']))
                $this->db->like('LOWER(nome)', strtolower($params['nome']));

        }

        $this->db->select('id');
        $this->db->select('nome');
        $this->db->from('fornecedores'); // busca na tabela we_usuario

        if( $por_pagina ) {

            $this->db->limit( $por_pagina );

            if( $pagina )
                $this->db->offset( ($pagina * $por_pagina) - $por_pagina );

        }

        if( $contar ){

            $res = $this->db->count_all_results();

        } else {

            $resumo =  $this->db->get()->result(); // insere o resultado na variavel resumo

            if( count($resumo) >= 0 ){ // se a consulta for bem sucedida

                $res = array( // define a resposta
                    "sucesso" => true // define como sucesso
                    , "resumo" => $resumo // insre o resumo
                );

                if( $retornarTotal ){

                    $res["total"] = $this->resumo($params, false, false, false, true);

                }

            } else { // se for mal sucedida

                $res = array( // define a resposta
                    "sucesso" => false // define como falha
                    , "msg" => "Erro ao carregar resumo dos fornecedores. Tente novamente mais tarde." // insre uma mesagem de erro
                );

            }

        }

        return $res; // retorna a resposta

    }

    public function readObject( $id ){ // retorna um resumo dos usuarios vinculados/reporteres

        $this->db->select('id');
        $this->db->select('nome');
        $this->db->where('fornecedores.id', $id);
        $this->db->from('fornecedores'); // busca na tabela we_usuario

        $object =  $this->db->get()->row(); // retorna o objeto

        if( $object ){ // se a consulta for bem sucedida

            $res = array( // define a resposta
                "sucesso" => true // define como sucesso
                , "object" => $object // insre o resumo
            );

        } else { // se for mal sucedida

            $res = array( // define a resposta
                "sucesso" => false // define como falha
                , "msg" => "Erro ao carregar fornecedor. Tente novamente mais tarde." // insre uma mesagem de erro
            );

        }

        return $res; // retorna a resposta

    }

    public function create( $data ){

        // Form validation
        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $res = array( // define a resposta
                "sucesso" => false // define como sucesso
                , "error" => $this->form_validation->error_array() // insere o erro
            );
        }
        else
        {
            $data = array(
                'nome' => $data['nome']
            );

            $this->db->insert('fornecedores', $data); 

            $id = $this->db->insert_id();

            $res = array( // define a resposta
                "sucesso" => true // define como sucesso
                , "id" => $id // insre o resumo
            );
        }

        return $res;

    }

}