<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fornecedores_model extends CI_Model {

    public function resumo( $params = false, $pagina = false, $por_pagina = false, $retornarTotal = false, $contar = false ){ // retorna um resumo dos usuarios vinculados/reporteres

        if( !empty($params) ){

            if(!empty($params['nome']))
                $this->db->like('LOWER(nome)', strtolower($params['nome']));

        }

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
                    , "msg" => "Erro ao carregar resumo dos Lançamentos. Tente novamente mais tarde." // insre uma mesagem de erro
                );

            }

        }

        return $res; // retorna a resposta

    }

    public function create( $data ){

        $id = 32;

        $res = array( // define a resposta
            "sucesso" => true // define como sucesso
            , "id" => $id // insre o resumo
        );

        return $res;

    }

}