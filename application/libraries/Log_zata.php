<?php
/**
 * Zata
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
 * @package Zata
 * @author  TRIVEE SERVICES IT - Ralny Andrade | <ra@trivee.com.br>
 * @copyright   Copyright (c) 2015 - 2016, TRIVEE SERVICES IT
 * @license    MIT <https://opensource.org/licenses/MIT>
 * @link    http://www.trivee.com.br
 * @since   Versão 1.0.0 
 * @filesource
 */
defined('BASEPATH') OR exit('Não é permitido acesso direto ao script');

/**
 * Class Log Zata 
 *
 * Biblioteca responsável por registrar Logs do sistema. 
 *
 * @category    Library
 * @author      Ralny Andrade <ra@trivee.com.br>
 */
class Log_zata{

	// ci @param instanciando objeto
	private $_ci;
	
    // constructor
    public function __construct()
    {
        $this->_ci =& get_instance();
    
        // Load database driver
        $this->_ci->load->database();

        $this->_ci->load->library('session');
    }

	/**
	 * Log Error 
	 *
	 * Responsável por registrar os Logs de erro. 
	 * 
	 * @author      Ralny Andrade <ra@trivee.com.br>
	 * @param string $tipo - Referencia ao Tipo de LOG [INFO - DEBUG- DANGER - WANING - ERROR - NOTICE]
	 * @param string $mensagem - Mensagem do LOG
	 */
    public function log_error($tipo, $message)
    {

    	// Mensagem - Se nao existir o paramentro $mensagem, ela ira receber o valor:
    	if ($message == '')
    	{
    		$message = 'Mensagem Vazia';
    	}	

    	// IP do Usuario onde ocorreu o erro  - evitando o proxy e capturando o IP real
  		if(getenv('HTTP_X_FORWARDED_FOR') && getenv('HTTP_X_FORWARTDED_FOR') != '') 
  		{
                $remote_addr = getenv('HTTP_X_FORWARDED_FOR');
      }
      else
      {
               $remote_addr = getenv('REMOTE_ADDR');
      }

  		// Capturando a URL de origem do Erro que gerou o LOG
  		if( getenv('REQUEST_URI') == '') 
  		{
    		$request_uri = "REQUEST_URI_UNKNOWN";
  		}
      else{
        $request_uri = getenv('REQUEST_URI');
      }

  		// Montando dados para inserir na tabela
  		$dados = array(
        	"id_user"               => $this->_ci->session->userdata('id_usuario'), 
        	"log_date"              => date('Y-m-d H:i:s'), 
          "remote_addr"	          => $remote_addr,
          "request_uri"   	      => $request_uri,
          "mensagem"    		      => $message,
          "tipo"    			        => $tipo,
          "indicesServer"         => $this->indicesServer()
      );

  		// Inserindo na tabela
	   	$this->_ci->db->insert("_log_error", $dados);
    }


    /**
	 * Log Activity 
	 *
	 * Responsável por registrar as atividades do usuario no banco 
	 * 
	 * @author      Ralny Andrade <ra@trivee.com.br>
	 * @param string $mensagem - Mensagem do LOG
	 */
    public function log_activity($message, $tipo)
    {

    	// Mensagem - Se nao existir o paramentro $mensagem, ela ira receber o valor:
    	if ($message == '')
    	{
    		$message = 'Mensagem Vazia';
    	}	

    	// IP do Usuario onde ocorreu o erro  - evitando o proxy e capturando o IP real
  		if(getenv('HTTP_X_FORWARDED_FOR') && getenv('HTTP_X_FORWARTDED_FOR') != '') 
  		{
                $remote_addr = getenv('HTTP_X_FORWARDED_FOR');
        }
        else
        {
                $remote_addr = getenv('REMOTE_ADDR');
        }

  		// Capturando a URL de origem do Erro que gerou o LOG
  		$request_uri = getenv('REQUEST_URI');
      if( getenv('REQUEST_URI') == '') 
  		{
    		$request_uri = "REQUEST_URI_UNKNOWN";
  		}

  		// Montando dados para inserir na tabela
  		$dados = array(
          "id_user"               => $this->_ci->session->userdata('id_usuario'), 
          "log_date"              => date('Y-m-d H:i:s'), 
          "remote_addr"           => $remote_addr,
          "request_uri"           => $request_uri,
          "mensagem"              => $message,
          "tipo"                 => $tipo
      );

  		// Inserindo na tabela
	   	$this->_ci->db->insert("_log_usu_atividade", $dados);
    }



   /**
	  * Log Step by Step 
	  *
	  * Responsável por registrar o acesso dos usuarios ao controllers 
	  * 
	  * @author      Ralny Andrade <ra@trivee.com.br>
	  */
    public function log_step_by_step()
    { 

    	// IP do Usuario onde ocorreu o erro  - evitando o proxy e capturando o IP real
  		if(getenv('HTTP_X_FORWARDED_FOR') && getenv('HTTP_X_FORWARTDED_FOR') != '') 
  		{
          $remote_addr = getenv('HTTP_X_FORWARDED_FOR');
      }
      else
      {
          $remote_addr = getenv('REMOTE_ADDR');
      }


  		// Capturando a URL de origem do Erro que gerou o LOG
      $request_uri = getenv('REQUEST_URI');
  		if(getenv('REQUEST_URI') == '') 
  		{
    		  $request_uri = "REQUEST_URI_UNKNOWN";
  		}

  		// Montando dados para inserir na tabela
  		$dados = array(
                    	"id_user"               => $this->_ci->session->userdata('id_usuario'), 
                    	"log_date"              => date('Y-m-d H:i:s'), 
                      "remote_addr"	          => $remote_addr,
                      "request_uri"   	      => $request_uri
            );

  		// Inserindo na tabela
	   	$this->_ci->db->insert("_log_usu_step_by_step", $dados);
    }

    /**
    * IndicesServer 
    *
    * 
    * 
    * @author      Ralny Andrade <ra@trivee.com.br>
    */
    public function indicesServer()
    {

        $indicesServer = array('PHP_SELF', 
          'argv', 
          'argc', 
          'GATEWAY_INTERFACE', 
          'SERVER_ADDR', 
          'SERVER_NAME', 
          'SERVER_SOFTWARE', 
          'SERVER_PROTOCOL', 
          'REQUEST_METHOD', 
          'REQUEST_TIME', 
          'REQUEST_TIME_FLOAT', 
          'QUERY_STRING', 
          'DOCUMENT_ROOT', 
          'HTTP_ACCEPT', 
          'HTTP_ACCEPT_CHARSET', 
          'HTTP_ACCEPT_ENCODING', 
          'HTTP_ACCEPT_LANGUAGE', 
          'HTTP_CONNECTION', 
          'HTTP_HOST', 
          'HTTP_REFERER', 
          'HTTP_USER_AGENT', 
          'HTTPS', 
          'REMOTE_ADDR', 
          'REMOTE_HOST', 
          'REMOTE_PORT', 
          'REMOTE_USER', 
          'REDIRECT_REMOTE_USER', 
          'SCRIPT_FILENAME', 
          'SERVER_ADMIN', 
          'SERVER_PORT', 
          'SERVER_SIGNATURE', 
          'PATH_TRANSLATED', 
          'SCRIPT_NAME', 
          'REQUEST_URI', 
          'PHP_AUTH_DIGEST', 
          'PHP_AUTH_USER', 
          'PHP_AUTH_PW', 
          'AUTH_TYPE', 
          'PATH_INFO', 
          'ORIG_PATH_INFO') ; 

          $indeces = '<table cellpadding="10">' ; 
          foreach ($indicesServer as $arg) { 
              if (isset($_SERVER[$arg])) { 
                 $indeces .= '<tr><td width="20%"><strong>'.$arg.'</td><td>' . $_SERVER[$arg] . '</strong></td></tr>' ; 
              } 
              else { 
                  $indeces.= '<tr><td>'.$arg.'</td><td>-</td></tr>' ; 
              } 
          } 
          $indeces .= '</table>' ;

          return $indeces;
     

    }







}




