<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lancamentos_model extends CI_Model {

    public function resumo( $params = false, $pagina = false, $por_pagina = false, $retornarTotal = false, $contar = false ){ // retorna um resumo dos usuarios vinculados/reporteres

        $this->db->select('lancamentos.id as codigo');
        $this->db->select('lancamentos.tipo as tipo');
        $this->db->select("DATE_FORMAT(data, '%d-%m-%Y') as data", FALSE);
        $this->db->select('TRUNCATE(lancamentos.valor,2) as valor_cobrado', FALSE);
        $this->db->select('TRUNCATE((produtos.valor*quantidade),2) as valor_estimado', FALSE);
        $this->db->select('lancamentos.desc as descricao');
        $this->db->select("TRUNCATE(lancamentos.desconto,2) as desconto", FALSE);
        //$this->db->select("REPLACE( REPLACE(realizado, '0', 'Não') , '1', 'Sim') as realizado", FALSE);
        $this->db->select('lancamentos.quantidade');
        $this->db->select('lancamentos.nome_cliente as cliente');
        $this->db->select('lancamentos.nome_produto as produto');
        $this->db->select('TRUNCATE(produtos.valor,2) as valor_unidade', FALSE);
        $this->db->select('lancamentos.nome_fornecedor as fornecedor');
        $this->db->join('produtos', 'produtos.nome = lancamentos.nome_produto', 'left');
        $this->db->order_by('lancamentos.id', 'desc');
        $this->db->from('lancamentos'); // busca na tabela we_usuario

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

        // Form validation
        $this->load->helper('form');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('tipo', 'Tipo', 'required');
        $this->form_validation->set_rules('data_entrega', 'Entrega', 'required');
        $this->form_validation->set_rules('data_pagamento', 'Pagamento', 'required');
        $this->form_validation->set_rules('produto', 'Produto', 'required');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'integer|required');
        $this->form_validation->set_rules('valor', 'Valor', 'is_numeric|required');
        $this->form_validation->set_rules('desconto', 'Desconto', 'is_numeric');

        if ($this->form_validation->run() == FALSE)
        {
            $res = array( // define a resposta
                "sucesso" => false // define como sucesso
                , "error" => $this->form_validation->error_array() // insre o resumo
            );
        }
        else
        {
            $data = array(
                'tipo' => $data['tipo']
                , 'data_entrega' => $data['data_entrega']
                , 'data_pagamento' => $data['data_pagamento']
                , 'nome_cliente' => (isset($data['cliente']) && !empty($data['cliente'])) ? $data['cliente'] : null
                , 'nome_fornecedor' => (isset($data['fornecedor']) && !empty($data['fornecedor'])) ? $data['fornecedor'] : null
                , 'nome_produto' => $data['produto']
                , 'quantidade' => $data['quantidade']
                , 'valor' => $data['valor']
                , 'desc' => $data['desc']
                , 'entregue' => isset($data['entregue']) ? $data['entregue'] : 0
                , 'realizado' => isset($data['realizado']) ? $data['realizado'] : 0
            );

            $this->db->insert('lancamentos', $data); 

            $id = $this->db->insert_id();

            $res = array( // define a resposta
                "sucesso" => true // define como sucesso
                , "id" => $id // insre o resumo
            );
        }

        return $res;

    }

}