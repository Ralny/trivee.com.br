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
 * Class Model Eventos_reserva_evento 
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
class Eventos_reserva_evento_model extends MY_Model {

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
        $this->table    = "eve_reserva_evento";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "id_reserva_evento";
        
    }

    /**
     * Lista todas as reservas de eventos
     */
    public function lista_reservas_de_eventos(){
       
        /**
         * Montando select
         */
        $sql = "
                Select
                    r.*,
                    s.desc_status_reserva_evento,
                    c.razao_social,
                    c.nome_fantasia,
                    Sum(tb_valor_total_sala.valor_total_taxas) As valor_total_sala
                From
                    (Select
                        s.valor_total_taxas,
                        s.id_reserva_evento
                    From
                        eve_reserva_salas s) As tb_valor_total_sala Inner Join
                    eve_reserva_evento r On r.id_reserva_evento = tb_valor_total_sala.id_reserva_evento Inner Join
                    eve_status_reserva_evento s On s.id_status_reserva_evento = r.id_status_reserva_evento Inner Join
                    cli_cliente_fornecedor c On r.id_cf = c.id_cf
                Where
                    r.token_company = '$this->company'
                Group By
                    s.desc_status_reserva_evento,
                    c.razao_social,
                    c.nome_fantasia,
                    r.id_reserva_evento
                ";

        $query = $this->db->query($sql);

        return $query->result();

    }
    
      /**
     * Buscar Ultimo numero de reserva 
     *
     * Retorna o ultimo numero da ordem de servico
     *
     * @return void
     */
    public function buscar_num_ultima_reserva_evento(){

        $sql    = "SELECT MAX(numero_reserva) AS ultima_reserva_evento FROM eve_reserva_evento WHERE token_company = '$this->company'";
        
        $query  = $this->db->query($sql);

        $num_os = $query->row();

        return $num_os->ultima_reserva_evento;  
    
    }



    /**
     * Lista todas as reservas de sala de um determinado evento
     */
    public function lista_reserva_salas($id_reserva_evento){
       
        /**
         * Montando select
         */
        $sql = "
                    SELECT
                    s.nome_sala,
                    f.desc_formato_de_sala,
                    r.dth_inicio,
                    r.hora_inicio,
                    r.dth_fim,
                    r.hora_fim,
                    u.desc_utilizacao_sala,
                    r.pax_garantidas,
                    r.valor_total,
                    r.valor_total_taxas,
                    r.id_reserva_evento_sala
                FROM
                    eve_reserva_salas r
                    INNER JOIN eve_salas s ON s.id_sala = r.id_sala
                    INNER JOIN eve_formato_de_sala f ON f.id_formato_de_sala = r.id_formato_de_sala
                    INNER JOIN eve_utilizacao_sala u ON u.id_utilizacao_sala = r.id_utilizacao_sala
                WHERE
                    r.id_reserva_evento = $id_reserva_evento
                ";


        $query = $this->db->query($sql);

        return $query->result();

    }

    /**
     * Lista todas as reservas de sala de um determinado evento
     */
    public function retorna_reserva_sala($id_reserva_evento_sala){
       
        /**
         * Montando select
         */
        $sql = "
                    SELECT
                        *
                    FROM
                        eve_reserva_salas
                    WHERE
                        id_reserva_evento_sala = $id_reserva_evento_sala
                ";


        $query = $this->db->query($sql);

        return $query->result();

    }
 


        




    
}//Fim da classe
