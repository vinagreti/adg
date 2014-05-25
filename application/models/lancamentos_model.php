<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lancamentos_model extends CI_Model {

    public function resumo( $params = false, $pagina = false, $por_pagina = false, $retornarTotal = false, $contar = false ){ // retorna um resumo dos usuarios vinculados/reporteres

        $this->db->select('id_lancamento as codigo');
        $this->db->select('tipo_lancamento as tipo');
        $this->db->select("DATE_FORMAT(data_lancamento, '%d-%m-%Y') as data", FALSE);
        $this->db->select('TRUNCATE(valor_lancamento,2) as valor_cobrado', FALSE);
        $this->db->select('TRUNCATE((produtos.valor_produto*qtd_produto_lancamento),2) as valor_estimado', FALSE);
        $this->db->select('desc_lancamento as descricao');
        $this->db->select("REPLACE( REPLACE(realizado_lancamento, '0', 'Não') , '1', 'Sim') as realizado", FALSE);
        $this->db->select('qtd_produto_lancamento as quantidade');
        $this->db->select('clientes.nome_cliente as cliente');
        $this->db->select('produtos.nome_produto as produto');
        $this->db->select('TRUNCATE(produtos.valor_produto,2) as valor_unidade', FALSE);
        $this->db->select('fornecedores.nome_fornecedor as fornecedor');
        $this->db->join('clientes', 'clientes.id_cliente = lancamentos.id_cliente_lancamento', 'left');
        $this->db->join('produtos', 'produtos.id_produto = lancamentos.id_produto_lancamento', 'left');
        $this->db->join('fornecedores', 'fornecedores.id_fornecedor = lancamentos.id_fornecedor_lancamento', 'left');
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

}