<?php
/**
 * ZATA
 * 
 * Uma estrutura baseada na framework codeiginiter para o desenvolvimento
 * de aplicativos que proporciona a criação de soluções de forma rápida
 * e inovadora, reduzindo o tempo de desenvolcimento em 80%.
 * 
 * Este conteudo é publicado sob a Lincença MIT
 *
 * Copyright(c) 2015-2017, TRIVEE SERVICES IT
 * 
 * É concedida permissão a qualquer pessoa que obtenha uma cópia deste 
 * software e arquivos de documentação associados, sem restrições e limitação,
 * incluindo os direitos de copiar, modificar, fundir, publicar, 
 * distribuir, sublicenciar e/ou vender.
 *
 * O aviso de copyright acima a este aviso de permissão devem ser incluidos
 * em todas as cópias ou partes substancias do software.
 *
 * O SOFTWARE É FORNECIDO "COMO ESTÁ", SEM GARANTIA DE QUALQUER TIPO,
 * EXPRESSA OU IMPLÍCITA, INCLUINDO, MAS NÃO SE LIMITANDO AS GARANTIAS
 * DE COMERCIALIZAÇÃO, ADEQUAÇÃO A UMA FINALIZADE ESPECIFICA E NÃO VIOLAÇÃO.
 *
 * EM NENHUMA CIRCUNSTÂNCIA, AUTORES OU TITULARES DE DIREITOS DE AUTOR SERÃO
 * RESPONSÁVEIS POR QUALQUER RECLAMAÇÃO, DANOS OU OUTRAS RESPONSABILIDADES,
 * SEJA EM UMA AÇÃO DE CONTRATO, ATO OU DE OUTRA FORMA DECORRENTE DE FORA, OU
 * EM CONEXÃO COM OUTRO SOFTWARE OU O USO OU OUTROS NEGECIOS
 *
 * ZATA
 *
 * A framework based on the codeiginiter framework for development
 * application that provides the creation of solutions quickly
 * and innovative, reducing the time of development by 80%.
 *
 * This content is published under the MIT Licensing
 *
 * Copyright (c) 2015-2017, TRIVEE SERVICES IT
 *
 * Permission is granted to anyone who obtains a copy of this
 * software and associated documentation files, without restrictions and limitations,
 * including the rights to copy, modify, merge, publish,
 * distribute, sublicense and / or sell.
 *
 * The above copyright notice to this permission notice must be included
 * on all copies or any parts of the software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * OF MERCHANTABILITY, FITNESS FOR A SPECIFIC FINISH AND NON-INFRINGEMENT.
 *
 * IN NO EVENT SHALL AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * RESPONSIBLE FOR ANY CLAIM, DAMAGES OR OTHER RESPONSIBILITIES,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE ARISING OUTSIDE, OR
 * IN CONNECTION WITH OTHER SOFTWARE OR THE USE OR OTHER DEALINGS
 *
 * @package   Zata
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 * @copyright TRIVEE SERVICES IT MEI | Copyright (c) 2015 - 2016
 * @license   MIT <https://opensource.org/licenses/MIT>
 * @link      http://www.trivee.com.br
 * @since     Versão 1.0.0 
 */

defined('BASEPATH') OR exit('Não é permitido acesso direto ao script');

/**
 * Class Model Os 
 *
 * Camada base de abstração e persistências dos dados da aplicação no banco. 
 * As interações CRUD ocorrem na CORE/MY_model.
 * Nessa classe sao adcionadas somente as funcoes especificas referentes ao controller
 * Base layer of abstraction and persistence of application data in the database.
 * CRUD interactions occur in CORE / MY_model.
 * In this class only the specific functions related to the controller
 *
 * @category  Models
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class Os_model extends MY_Model {

   /**
    * Class constructor
    *
    * @return  void
    */
    public function __construct()
    {
        
        parent::__construct();

        /**
         * Definir o nome da tabela
         * Set the table name
         */
        $this->table    = "os_os";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_os";
        
    }

    /**
     * Buscar Cliente Autocomplete 
     *
     * Retorna o nome do cliente buscado
     * @param $q String com fragmento buscado.
     * @return array com os dados encontrados
     */
    public function buscar_cliente_autocomplete($q){

        /**
         * Montando select
         * Obs: ira buscar em duas colunas, razao_social e nome_fantasia
         */
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome_fantasia', $q);
        $this->db->or_like('razao_social', $q);
        $query = $this->db->get('cli_cliente_fornecedor');

        /**
         * Se existir resultados
         */
        if ($query->num_rows() > 0)
        {
            /**
             * Listando resultados 
             */
            foreach ($query->result_array() as $row)
            {
                /**
                 * Se a a coluna razao_social estiver vazia o cliente eh pessoa fisica
                 */
                if ($row['razao_social'] == '')
                {
                    /**
                     * Exibi registro com pessoa fisica
                     */
                    $row_set[] = array('label'=> $row['nome_fantasia'] ,'id'=>$row['id_cf']);   
                }
                else
                {
                    /**
                     * Exibi registro com pessoa juridica
                     */
                    $row_set[] = array('label'=> $row['razao_social'] ,'id'=>$row['id_cf']);
                }    
            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            echo json_encode($row_set);
        }
    }

    /**
     * Buscar Serviço Autocomplete 
     *
     * Retorna o nome do serviço buscado
     * @param $q String com fragmento buscado.
     * @return array com os dados encontrados
     */
    public function buscar_servico_autocomplete($q){

        /**
         * Montando select
         * Obs: ira buscar em duas colunas, razao_social e nome_fantasia
         */
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome', $q);
        $this->db->like('tipo', 'Serviço');
        $query = $this->db->get('proser_produtos_servicos');

        /**
         * Se existir resultados
         */
        if ($query->num_rows() > 0)
        {
            /**
             * Listando resultados 
             */
            foreach ($query->result_array() as $row)
            {
                $row_set[] = array('label'=>$row['nome'],'id'=>$row['id_proser'], 'preco'=>$row['valor_venda'], 'preco_exib'=> moeda($row['valor_venda'])  ); 
            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            echo json_encode($row_set);
        }
    }


    /**
     * Buscar Num OS 
     *
     * Retorna o ultimo numero da ordem de servico
     *
     * @return void
     */
    public function buscar_num_os(){

        $sql    = 'SELECT MAX(numero_os) AS ultima_os FROM os_os';
        
        $query  = $this->db->query($sql);

        $num_os = $query->row();

        return $num_os->ultima_os;  
    
    }
     

    /**
     * Nome cliente 
     *
     * Retorna o nome do cliente
     * @param $id id do cliente.
     * @return nome do cliente
     */
    public function nome_cliente($id){

        /**
         * Montando select
         * Obs: ira buscar em duas colunas, razao_social e nome_fantasia
         */
        $this->db->select('*');
        $this->db->where('id_cf', $id);
        $query = $this->db->get('cli_cliente_fornecedor');

        /**
         * Se existir resultados
         */
        if ($query->num_rows() > 0)
        {
            /**
             * Listando resultados 
             */
            foreach ($query->result_array() as $row)
            {
                /**
                 * Se a a coluna razao_social estiver vazia o cliente eh pessoa fisica
                 */
                if ($row['razao_social'] == '')
                {
                    /**
                     * Exibi registro com pessoa fisica
                     */
                    $row_set = $row['nome_fantasia'];   
                }
                else
                {
                    /**
                     * Exibi registro com pessoa juridica
                     */
                    $row_set = $row['razao_social'];
                }    
            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            return $row_set;
        }
    }

    /**
     * Itens OS Servico
     *
     * Retorna lista de itens de servico
     * @param $id id do cliente.
     * @return nome do cliente
     */
    public function itens_os_servico($id){

        /**
         * Montando select
         */
        $sql = "Select
                  i.id_proser_os,
                  i.qtd,
                  i.valor_unit,
                  i.valor_total,
                  s.nome,
                  i.id_os,
                  i.tipo
                From
                  os_itens_proser i Inner Join
                  proser_produtos_servicos s On i.id_proser = s.id_proser
                Where
                  i.tipo = 'S'
                And  
                  i.id_os = $id";

        $query = $this->db->query($sql);

        return $query->result();
        
    }

    /**
     * Itens OS Produto
     *
     * Retorna lista de itens de servico
     * @param $id id do cliente.
     * @return nome do cliente
     */
    public function itens_os_produto($id){

        /**
         * Montando select
         */
        $sql = "Select
                  i.id_proser_os,
                  i.qtd,
                  i.valor_unit,
                  i.valor_total,
                  s.nome,
                  i.id_os,
                  i.tipo
                From
                  os_itens_proser i Inner Join
                  proser_produtos_servicos s On i.id_proser = s.id_proser
                Where
                  i.tipo = 'P'
                And  
                  i.id_os = $id";

        $query = $this->db->query($sql);

        return $query->result();
        
    }

    /**
     * Buscar Serviço Autocomplete 
     *
     * Retorna o nome do serviço buscado
     * @param $q String com fragmento buscado.
     * @return array com os dados encontrados
     */
    public function buscar_produto_autocomplete($q){

        /**
         * Montando select
         * Obs: ira buscar em duas colunas, razao_social e nome_fantasia
         */
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome', $q);
        $this->db->like('tipo', 'Produto');
        $query = $this->db->get('proser_produtos_servicos');

        /**
         * Se existir resultados
         */
        if ($query->num_rows() > 0)
        {
            /**
             * Listando resultados 
             */
            foreach ($query->result_array() as $row)
            {
                $row_set[] = array('label'=>$row['nome'],'id'=>$row['id_proser'], 'preco'=>$row['valor_venda'], 'preco_exib'=> moeda($row['valor_venda'])  ); 
            }
            
            /**
             * JSON - Retorna a lista de registros encontrados para o controller
             */
            echo json_encode($row_set);
        }
    }

        




    
}//Fim da classe
