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
 * Class My Controller 
 *
 * Camada responsável por fazer a interface com o controlador do CI 
 * Layer responsible for interfacing with the IC controller
 *
 * @category  Controllers
 * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
 */
class MY_Controller extends CI_Controller
{
	/**
	 * Informações que vão ser inseridas na view
	 * Information to be entered in the view
	 */
	var $data = array();
 	
 	/**
     * Constructor
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @return    void
     */
	function __construct() {
		parent::__construct();
 
	}

	/**
     * Validate Post
     *
     * Funcao responsavel por validar o POST antes de inserir os dados no banco de dados
     * Function responsible for validating the POST before inserting the data into the database 
     *
     * @author    Ralny Andrade | <ra@trivee.com.br> | https://github.com/ralny
     * @return    void
     */
	function validatePost(  $table = '')
	{

		/**
	     * Resgatar configuracoes de formulario do modulo
	     * Restore Module Form Settings
	     */
		$str = $this->info['config']['form'];

		$data = array();

		
		foreach($str as $f)
		{
			
			$field = $f['field'];
			
			if($f['show'] ==1)
			{

				if(!is_null($this->input->get( $field , true )))
				{
				
					$data[$field] = $this->input->get($field,true);
				
				}

				switch ($f['type'])
				{

					case 'textarea_editor':
					case 'textarea':
						$content = $this->input->get_post($field)? $this->input->get_post($field):'';

						$data[$field] =  $content;
 				   
					break;
					
					case 'file' :
						$this->load->library('upload');

						$destinationPath = "./".$f['option']['path_to_upload'];
					
						$config['upload_path'] = $destinationPath;

						$config['allowed_types'] = 'gif|jpg|png';
						
						$this->upload->initialize($config);
						if($this->upload->do_upload($field))
						{
							
							$file_data = $this->upload->data();
							$filename = $file_data['file_name'];
							$extension =$file_data['file_ext']; //if you need extension of the file


							 if($f['option']['resize_width'] != '0' && $f['option']['resize_width'] !='')
							 {
							 	
							 	if( $f['option']['resize_height'] ==0 )
								{
								
									$f['option']['resize_height']	= $f['option']['resize_width'];
								
								}
 
							 	$origFile = $destinationPath.'/'.$filename;
								SiteHelpers::cropImage($f['option']['resize_width'] , $f['option']['resize_height'] , $orgFile ,  $extension,	 $orgFile)	;
							 }

							 $data[$field] = $filename;
						} else {
							unset($data[$field]);
						}
					
 					 break;
					
					case 'checkbox' :
						if(!is_null($this->input->get( $field , true )))
						{
							
							$data[$field] = implode(",",$this->input->get_post( $field , true ));
						
						}
 					 break;
					
					case 'text_datetime' :
						$data[$field] = gravaData($this->input->get_post( $field , true ));
 					 break;

 					case 'date' :
						$data[$field] = gravaData($this->input->get_post( $field , true ));
 					 break; 
					
					case 'select' :
						//if( isset($f['option']['is_multiple']) &&  $f['option']['is_multiple'] ==1 )
						//{
							
						//	$data[$field] = implode(",",$this->input->get_post( $field , true ));
						//}
						//else
						//{
							
							$data[$field] = implode(",",$this->input->get_post( $field , true ));
						
						//}
 					 break;
					
					case 'text' :					
					default:
						$data[$field] = $this->input->get_post( $field , true );
					break;
				}				

			}
		}


		return $data;
	}

	function better_token()
	{
		
		$token = strtoupper(md5(uniqid(rand(), true)));

		return $token;
	}

}




?>