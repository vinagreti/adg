<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_model extends CI_Model {

    public function getObjects( $params = false, $pagina = false, $por_pagina = false, $retornarTotal = false, $contar = false ){ // retorna um resumo dos usuarios vinculados/reporteres

        if( !empty($params) ){

            if(!empty($params['nome']))
                $this->db->like('LOWER(clientes.nome)', strtolower($params['nome']));

        }

        $this->db->select('clientes.id as id');
        $this->db->select('clientes.nome as nome');
        $this->db->select('grupos.nome as nome_grupo');
        $this->db->join('grupos', 'grupos.id = clientes.id_grupo', 'left');
        $this->db->from('clientes'); // busca na tabela we_usuario

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

                    $res["total"] = $this->getObjects($params, false, false, false, true);

                }

            } else { // se for mal sucedida

                $res = array( // define a resposta
                    "sucesso" => false // define como falha
                    , "msg" => "Erro ao carregar resumo dos clientes. Tente novamente mais tarde." // insre uma mesagem de erro
                );

            }

        }

        return $res; // retorna a resposta

    }

    public function getObject( $id ){ // retorna um resumo dos usuarios vinculados/reporteres

        $this->db->select('clientes.id');
        $this->db->select('clientes.nome');
        $this->db->select('grupos.nome as nome_grupo');
        $this->db->join('grupos', 'grupos.id = clientes.id_grupo', 'left');
        $this->db->where('clientes.id', $id);
        $this->db->from('clientes'); // busca na tabela we_usuario

        $object =  $this->db->get()->row(); // retorna o objeto

        if( $object ){ // se a consulta for bem sucedida

            $res = array( // define a resposta
                "sucesso" => true // define como sucesso
                , "object" => $object // insre o resumo
            );

        } else { // se for mal sucedida

            $res = array( // define a resposta
                "sucesso" => false // define como falha
                , "msg" => "Erro ao carregar cliente. Tente novamente mais tarde." // insre uma mesagem de erro
            );

        }

        return $res; // retorna a resposta

    }

    public function postObject( $data ){

        // Form validation
        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('nome', 'Nome', 'required|is_unique[clientes.nome]');

        $this->form_validation->set_rules('grupo', 'Grupo', 'is_integer');

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
                , 'id_grupo' => (isset($data['grupo']) && !empty($data['grupo'])) ? $data['grupo'] : null
            );

            $this->db->insert('clientes', $data); 

            $id = $this->db->insert_id();

            $res = array( // define a resposta
                "sucesso" => true // define como sucesso
                , "id" => $id // insre o resumo
            );
        }

        return $res;

    }

}