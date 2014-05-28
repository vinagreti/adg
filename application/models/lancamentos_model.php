<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lancamentos_model extends CI_Model {

    public function resumo( $params = false, $pagina = false, $por_pagina = false, $retornarTotal = false, $contar = false ){ // retorna um resumo dos usuarios vinculados/reporteres

        $this->db->select('lancamentos.id as codigo');
        $this->db->select('lancamentos.tipo as tipo');
        $this->db->select("DATE_FORMAT(data, '%d-%m-%Y') as data", FALSE);
        $this->db->select('TRUNCATE(lancamentos.valor,2) as valor_cobrado', FALSE);
        $this->db->select('TRUNCATE((produtos.valor*quantidade),2) as valor_estimado', FALSE);
        $this->db->select('lancamentos.desc as descricao');
        //$this->db->select("REPLACE( REPLACE(realizado, '0', 'Não') , '1', 'Sim') as realizado", FALSE);
        $this->db->select('lancamentos.quantidade');
        $this->db->select('lancamentos.nome_cliente as cliente');
        $this->db->select('lancamentos.nome_produto as produto');
        $this->db->select('TRUNCATE(produtos.valor,2) as valor_unidade', FALSE);
        $this->db->select('lancamentos.nome_fornecedor as fornecedor');
        $this->db->join('produtos', 'produtos.nome = lancamentos.nome_produto', 'left');
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

        $data = array(
            'tipo' => isset($data['tipo']) ? $data['tipo'] : 0
            , 'data_entrega' => isset($data['data_entrega']) ? $data['data_entrega'] : 0
            , 'data_pagamento' => isset($data['data_pagamento']) ? $data['data_pagamento'] : 0
            , 'nome_cliente' => isset($data['cliente']) ? $data['cliente'] : 0
            , 'nome_fornecedor' => isset($data['fornecedor']) ? $data['fornecedor'] : null
            , 'nome_produto' => isset($data['produto']) ? $data['produto'] : null
            , 'quantidade' => isset($data['quantidade']) ? $data['quantidade'] : null
            , 'valor' => isset($data['valor']) ? $data['valor'] : 0
            , 'desc' => isset($data['desc']) ? $data['desc'] : 0
            , 'entregue' => isset($data['entregue']) ? $data['entregue'] : 0
            , 'realizado' => isset($data['realizado']) ? $data['realizado'] : 0
        );

        $this->db->insert('lancamentos', $data); 

        $id = $this->db->insert_id();

        $res = array( // define a resposta
            "sucesso" => true // define como sucesso
            , "id" => $id // insre o resumo
        );

        return $res;

    }

}