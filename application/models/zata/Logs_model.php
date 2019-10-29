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
 * Class Model Logs 
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
class Logs_model extends MY_Model {

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
        $this->table    = "_log_login_usuario";
        
        /**
         * Definir o nome da chave primaria
         * Define the primary key name
         */
        $this->primaryKey = "idLoginUsuario";
        
    }


    /**
     * Num Interacoes Zata
     *
     * Retorna o número de Interações dos usuários com o sistema
     * Returns the number of user interactions with the system
     */   
    public function num_interacoes_zata() {

        $sql = " SELECT * FROM _log_usu_step_by_step ";

        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    /**
     * Num Logins Realizados Zata
     *
     * Retorna o numero de logins realizados no zata
     * Returns the number of logins performed in the zata
     */   
    public function num_login_realizados_zata() {

        $sql = " SELECT * FROM _log_login_usuario ";

        $query = $this->db->query($sql);

        return $query->num_rows();

    }

    
    /**
     * Num Erros Zata
     *
     * Retorna o numero de erros ocorridos no zata
     * Returns the number of errors occurred in the zata
     * 
     */   
    public function num_erros_zata() {

        $sql = " SELECT * FROM _log_error ";

        $query = $this->db->query($sql);

        return $query->num_rows();

    }


    /**
     * Num interacaoes Usuario
     *
     * Retorna o número de interações por usuário
     * Returns the number of interactions per user
     */   
    public function num_interacoes_usuario($id = 0) {
        
        /**
         * Listando os usuarios
         * Listing users
         */
        $this->db->select('*');
        
        $this->db->from('usu_usuario');
        
        if ($id != 0)
        {
           $this->db->where('id_usuario', $id);
        }

        $usuarios = $this->db->get();


        $j= 0; #var aux
        
        foreach ($usuarios->result() as $row) {

            /**
             * Consutando as atividades realizadas pelo usuario
             * Consulting the activities carried out by the user
             */

            $sql = " SELECT * FROM _log_usu_atividade WHERE id_user = $row->id_usuario";

            $query = $this->db->query($sql);

            $ativ = $query->result();             
            
            $interacoes = array();
            
            /**
             * Contatores
             * Counters
             */
            $cad  = 0;
            $edit = 0;
            $del  = 0;

            $i = 0;            
            foreach ($ativ as $value) {

               unset($interacoes[$i]);

                $interacoes[$i]['nome']        = $row->nome;
                $interacoes[$i]['id_usuario']  = $row->id_usuario;
                $interacoes[$i]['email']       = $row->email;

                switch ($value->tipo) {
                    case 'cadastro':
                        $cad++;
                         break;

                    case 'alteracao':
                        $edit++;
                         break;

                    case 'Exclusao':
                        $del++;
                         break;         
                 };

                 
                 $interacoes[$i]['cad']  =  $cad;
                 $interacoes[$i]['edit'] =  $edit;
                 $interacoes[$i]['del']  =  $del;
  
            }

            $interacoes_usu[$j] = $interacoes;
            $j++; 

        }

        return $interacoes_usu;

    }



    /**
     * Lista Erros Zata Top 7
     * 
     * Lista os ultimos 7 erros ocorridos no zata para exibir no dashboard
     * Lists the last 7 errors in the zata to display on the dashboard
     */   
    public function lista_erros_zata_top_7() {

        $sql = " SELECT * FROM _log_error ORDER BY id_log DESC LIMIT 0, 7 ";

        $query = $this->db->query($sql);

        return $query->result();

    }

    /**
     * Lista Logins zata Top 7 
     *
     * Lista os ultimos 7 logins realizados no sata para exibir no dashboard
     * Lists the last 7 logins made in sata to display in the dashboard
     */   
    public function lista_logins_zata_top_7() {

        $sql = " SELECT * FROM _log_login_usuario ORDER BY idLoginUsuario DESC LIMIT 0, 7 ";

        $query = $this->db->query($sql);

        return $query->result();

    }

    /**
    * Get Error
    *
    * Retorna os detalhes de um erro
    * Returns the details of an error
    */   
    public function get_error($id) {

        // Montando Sql
        $sql = "
                    Select
                        e.id_log,
                        e.log_date,
                        e.remote_addr,
                        e.request_uri,
                        e.mensagem,
                        e.indicesServer,
                        e.tipo,
                        u.id_usuario,
                        u.nome,
                        u.email
                    From
                        _log_error e Inner Join
                        usu_usuario u On u.id_usuario = e.id_user
                    Where  
                        e.id_log = $id
                "; 
  
        // Executando a SQL
        $query = $this->db->query($sql);

        // Verifica se o registro existe no banco de dados
        $row = $query->row();

        // Se existir algum registro
        if(isset($row))
        {
             // Retorna o resultado para o controller
             return $query->row();
        }
        else
        {
             // Não retorna nada
             return false;
        }

    }



    /**
    * Get Row
    *
    * Retorna um unico registro - Usando principalmente para edição ou 
    * visualização de registro
    *
    * @internal int $id - IDENTIFICADOR UNICO do registro que sera resgatado 
    * @internal sitExclusao = 'N' => garante que sera resgatado somente os registro NAO deletados pelos usuarios  
    * @return  array 
    */   
    public function get_login($id) {

        /**
         * sql
         */
        $sql = "
                   Select
                      idLoginUsuario,
                      dthLoginUsuario,
                      login,
                      ip_address,
                      sit_status,
                      dispositivo,
                      about_browser
                    From
                      _log_login_usuario 
                    Where
                      idLoginUsuario = $id
                "; 
  
        $query = $this->db->query($sql);

        /**
         * Verifica se existe resultados
         * Check for results
         */  
        $row = $query->row();

        if(isset($row))
        {
             return $query->row();
        }
        else
        {
             return false;
        }

    }

    /**
    * Get Interacoes Usuario
    *
    * Retorna as interacoes de um usuario
    * Returns the interactions of a user
    */   
    public function get_interacoes_usuario($id) {

        /**
         *sql
         */
        $sql = "  
                SELECT 
                    id_activity, 
                    id_user, 
                    log_date, 
                    remote_addr, 
                    request_uri, 
                    mensagem, 
                    tipo     
                FROM 
                    _log_usu_atividade 
                WHERE 
                    id_user = $id
                ORDER BY
                    id_activity DESC
                "; 
  
        $query = $this->db->query($sql);

        return $query->result();

    }

    
}//Fim da classe
