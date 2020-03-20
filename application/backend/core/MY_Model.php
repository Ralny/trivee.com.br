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

if (!defined('BASEPATH')) exit('Não é permitido acesso direto ao script');

/**
 * Class MY_Model 
 *
 * Camada responsável por fazer a abstração e persistências dos dados da aplicação no banco.
 * Logo é aqui que fazemos todas as interacoes basicas, como por exemplo: métodos de inserção, edição, exclusão e recuperação de dados.
 * Layer responsible for making the abstraction and persistence of the application data in the database.
 * This is where we make all the basic interactions, for example: methods of insertion, editing, deletion and recovery of data.
 *
 * @category    Models
 * @author      Ralny Andrade <ra@trivee.com.br>
 */
class MY_Model extends CI_Model
{
	/**
     * Constructor
     *
     *  @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     *  @return    void
     */
	public function __construct() {
		parent::__construct();

		/**
		 * Identificador da empresa de origem do registro
		 * Company identifier of record source
		 */
    	$this->company = $this->session->userdata('token_company');

	}
	
	/**
     * MakeInfo
     *
     * Retorna as informacoes de um modulo
     * Returns to information about a module
     *
     * @author Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @param  $id - ID do modulo que sera tera as informacoes recuperadas
     * @return $data - Retorna as informações  do modulo
     * @param  $id - ID of the module that will have the information retrieved
     * @return $data - Returns the information of the module
     */
	function makeInfo( $id )
	{
		/** 
         * Buscando informacoes do modulo e retornando os valores das colunas na variavel 
         * Searching for information in the module and returning the values of the columns in the variable
         */ 
		$query =  $this->db->get_where('zata_modulos', array('nome_controller'=> $id));

		/** 
         * Definindo variavel como array 
         * Defining array variable
         */ 
		$data = array();
		
		/** 
         * Resgatar todas as informações do modulo
         * Redeem all information from the module
         */ 
		foreach($query->result() as $r)
		{
			$data['id_modulo']		= $r->id_modulo;
			$data['desc_modulo'] 	= $r->desc_modulo;
			$data['tabela_db'] 		= $r->tabela_db;
			$data['key_tabela_db'] 	= $r->key_tabela_db;
			$data['token_id'] 		= $r->token_id;
			$data['token_company']  = $r->token_company;
			$data['config'] 		= SiteHelpers::GM_decode_json($r->config_modulo);

			$field = array();
			foreach($data['config']['grid'] as $fs)
			{
				foreach($fs as $f)
					$field[] = $fs['field'];

			}

			$data['field'] = $field;

		}

		/** 
         * Libera memoria associado ao resultado
         * Releases memory associated with the result
         */ 
		$query->free_result();

		/** 
         * Retorna as informações 
         * Returns the information
         */ 
		return $data;
	}

	/**
     * GetRow
     *
     * Retorna os dados de um registro numa tabela
     * Returns the data of a record in a table
     *
     * @author Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @param  $id - ID do registro que sera tera as informacoes recuperadas
     * @param  $id - ID of the record that will have the information retrieved
     * @return $query - Retorna as informações
     * @return $query - Returns the information
     */
	public function getRow( $id )
	{
		/**
		 * Definir nome da tabela
		 * Set table name
		 */ 
		$table = $this->model->table;

		/**
		 * Definir chave primaria
		 * Set primary key
		 */ 
		//$key = $this->model->primaryKey;

		/**
		 * SQL
		 */ 
		//$sql = " SELECT * FROM $this->table WHERE $this->primaryKey = $id "; 
		$sql = " SELECT * FROM $this->table WHERE token_id = '$id' and token_company = '$this->company'"; 
  
        /**
         * Executa a SQL
         * Execute SQL
         */
        $query = $this->db->query($sql);

        /**
         * Verificar se o registro existe no banco de dados
         * Verify that the record exists in the database
         */ 
        $row = $query->row();

        /**
         * Se existir algum registro
         * If there is any record
         */
        if(isset($row))
        {
             /**
              * Retorna o resultado para o controller em forma de um array
              * Returns the result to the controller in the form of an array
              */ 
             return $query->row();
        }
        else
        {
             /**
              * Não retorna nada
              * Does not return anything
              */
             return false;
        }
	}

   /**
    * Get All
    *
    * Retorna os registros de uma tabela
    * Returns the records of a table
    *
    * @param $sql_select - Declaração SQL que retorna um conjunto de resultados de registros de uma
    * ou mais tabelas. Ela recupera zero ou mais linhas de uma ou mais tabelas-base, tabelas temporárias
    * ou visões em um banco de dados
    * @param $sql_select - SQL statement that returns a result set of records from one or
    * more tables. It retrieves zero or more rows from one or more base tables, temporary tables,
    * or views in a database 
    * @return  array
    */
    public function getAll($sql_select) {
    	
    	/**
		 * Definir nome da tabela
		 * Set table name
		 */ 
		$table = $this->model->table;
		
        //echo $this->id_master;exit;

      	/**
    	 * Verifica se existe alguma declaração, se nao existir vai retornar todos os dados da tabela
    	 * Check if there is any statement, if it does not exist it will return all the data in the table
    	 */
    	if ($sql_select == '')
    	{
    		$sql = " SELECT * FROM $table WHERE token_company = '$this->company'";
    	}
    	else
    	{
    		$sql = $sql_select;
    	}

    	/**
         * Executa a SQL
         * Execute SQL
         */
        $query = $this->db->query($sql);

  		/**
         * Retorna o resultado para o controller em forma de um array
         * Returns the result to the controller in the form of an array
         */ 
        return $query->result();

    }

    /**
     * Insert Row
     *
     * Insere registros em uma tabela
     * Inserts records into a table
     *
     * @param $data - Dados recebidos do formulario
     * @param $id   - ID do registro que vai sofrer as modificações
     * @param $data - Data received from the form
     * @param $data - ID of the record that will undergo the modifications
     * @return  array
     */
	public function insertRow( $data , $id)
	{
		/**
		 * Definir nome da tabela
		 * Set table name
		 */ 
		$table = $this->model->table;

		/**
		 * Definir chave primaria
		 * Set primary key
		 */ 
		//$key = $this->model->primaryKey;
		$key   = 'token_id';

		/**
		 * Formulario em modo de cadastro
		 * Form in registration mode
		 */		
		if($id == NULL )
		{
			/**
			 * Campos de controle do registro. "Quem criou?" Quando foi criado ?   
			 * Log control fields. "Who created?" When was it created?
			 */ 
			$data['token_id'] 		        = $this->better_token();
			$data['token_company'] 		    = $this->session->userdata('token_company');
            $data['dth_criacao'] 	        = date('Y-m-d H:i:s');
            $data['id_usuario_criacao']     = $this->session->userdata('id_usuario');
            $data['dth_atualizacao']        = date('Y-m-d H:i:s');
            $data['id_usuario_atualizacao'] = $this->session->userdata('id_usuario');
           

            /**
			 * Insere os dados na tabela   
			 * Inserts the data into the table
			 */ 
			$this->db->insert( $table, $data);

			/**
			 * Retorna o ID do ultimo registro inserido  
			 * Returns the ID of the last record entered
			 */ 
			$id = $this->db->insert_id();
			$id = $this->model->getRowPrimaryKey($id);
        	$id = $id->token_id;	

		}
		/**
		 * Campos de controle do registro. "Quem alterou?" Quando foi alterado ?   
		 * Log control fields. "Who changed?" When was it changed?
		 */ 
		else 
		{
			 /**
 			  * Campos de controle do registro. "Quem alterou?" Quando foi alterado ?   
		      * Log control fields. "Who changed?" When was it changed?
			  */ 
             $data['dth_atualizacao']       = date('Y-m-d H:i:s');
             $data['id_usuario_atualizacao'] = $this->session->userdata('id_usuario');

             /**
			 * Define qual registro vai sofrer as modificações   
			 * Defines which record is going to undergo the modifications
			 */ 
			 $this->db->where( array( $key => $id ));

			 /**
			 * Altera os dados na tabela   
			 * Change the data in the table
			 */ 
			 $this->db->update( $table , $data );
		}

		/**
		 * Retorna o ID do registro  
		 * Returns the record ID
		 */ 
		return $id;
	}


	/**
     * Destroy
     *
     * Definir qual registro vai ser excluido
     * Define which record is going to be deleted
     *
     * @param $id - ID do registro 
     * @param $id - Registry ID
     */
	function destroy( $id ) 
	{
		//$where = array( $this->model->primaryKey => $id );
		$where = array( 'token_id' => $id );
		/**
		 * Deleta o registro
		 * Delete record
		 */
		return $this->delete( $where );
	  
	}


	/**
     * Delete
     *
     * Deletar um registro
     * Delete a record
     *
     * @param $where - Define qual registro vai sofrer as modificações   
     * @param $where - 
     * @return  array
     */
	function delete( $where = array() ) {
		
		/**
		 * Se estiver vazio, nao faz nada
		 * if empty, nothing to do
		 */
		if( empty( $where )){
			return FALSE;
		}
		
		$_where = array();

		/**
		 * Validar $where 
		 * validate $where
		 */
		foreach( $where as $fld => $val )
		{
			/**
			 * Deletar varios registros 
			 * Delete multiple records
			 */
			if( is_array( $val ))
			{
				if( is_numeric( $val ))
				{
					$_where[] = " `{$fld}` in ( ". implode(",", $val )." ) ";
				}
				else
				{
					$_where[] = " `{$fld}` in ( '". implode("','", $val )."' ) ";
				}
			} 
			else
			{	
				/**
			 	 * Deletar um unico registros 
			 	 * Delete a single records
			 	 */
				if( is_numeric( $val ))
				{
					$_where[] = " `{$fld}` = {$val} ";
				}
				else
				{
					$_where[] = " `{$fld}` = '{$val}' ";
				}
			}
		}

		/**
		 * Montando SQL
		 * Mounting SQL
		 */
		$sql = " DELETE FROM ".$this->model->table." WHERE ( ". implode(' ) AND ( ', $_where )." ) ";
		
		/**
         * Executa a SQL
         * Execute SQL
         */
		$query = $this->db->query($sql);

		if ($this->db->affected_rows() == 0){

			return FALSE;
		}
		else
		{
			return $query;
		}
			
	}

	/**
     * Valid Access
     *
     * Verificar as permissoes de acesso do usuario aos modulos do sistemas
     * Verify user access permissions to system modules
     *
     * @param $id - ID do modulo   
     * @param $id - Module ID
     */
	function validAccess( $id )
	{

		$query = $this->db->get_where( 'usu_usuario_access', array(
		  	'id_modulo'   => $id ,
			'id_usuario'  => $this->session->userdata("id_usuario"),
		));
		
		$row = $query->result();



		$query->free_result();

		if(count($row) >= 1)
		{
			$row = $row[0]; 

			if($row->access_data != '')
			{

				$data = json_decode($row->access_data,true);

			} 
			else
			{

				$data = array();

			}

			return $data;

		}
		else
		{

			return false;

		}

	}

	function better_token()
	{
		
		$token = strtoupper(md5(uniqid(rand(), true)));

		return $token;
	}


	/**
     * GetRowPrimaryKey
     *
     * Retorna os dados de um registro numa tabela
     * Returns the data of a record in a table
     *
     * @author Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @param  $id - ID do registro que sera tera as informacoes recuperadas
     * @param  $id - ID of the record that will have the information retrieved
     * @return $query - Retorna as informações
     * @return $query - Returns the information
     */
	public function getRowPrimaryKey( $id )
	{
		/**
		 * Definir nome da tabela
		 * Set table name
		 */ 
		$table = $this->model->table;

		/**
		 * Definir chave primaria
		 * Set primary key
		 */ 
		//$key = $this->model->primaryKey;

		/**
		 * SQL
		 */ 
		$sql = " SELECT * FROM $this->table WHERE $this->primaryKey = $id "; 
  
        /**
         * Executa a SQL
         * Execute SQL
         */
        $query = $this->db->query($sql);

        /**
         * Verificar se o registro existe no banco de dados
         * Verify that the record exists in the database
         */ 
        $row = $query->row();

        /**
         * Se existir algum registro
         * If there is any record
         */
        if(isset($row))
        {
             /**
              * Retorna o resultado para o controller em forma de um array
              * Returns the result to the controller in the form of an array
              */ 
             return $query->row();
        }
        else
        {
             /**
              * Não retorna nada
              * Does not return anything
              */
             return false;
        }
	}


	

	


}

?>