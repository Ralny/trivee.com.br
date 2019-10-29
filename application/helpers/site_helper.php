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
 * Class Site Helpers 
 *
 * Classe composta por funcoes auxiliares utilizadas no ZATA. 
 * Class composed of auxiliary functions used in the ZATA.
 *
 * @category    Helpers
 * @author      Ralny Andrade <ra@trivee.com.br>
 */
class SiteHelpers 
{

   /**
    * GM_encode_json
    *
    * Metodo para codificar strings
    * Method for encoding strings
    */
	public static function GM_encode_json($arr)
	{
	  	$str = json_encode( $arr );
	  	$enc = base64_encode($str );
	  	$enc = strtr( $enc, 'poligamI123456', '123456poligamI');
	  	
	  	return $enc;
	}

   /**
    * GM_decode_json
    *
    * Metodo para decodificar
    * Method to decode
    */	
	public static function GM_decode_json($str)
	{
	  	$dec = strtr( $str , '123456poligamI', 'poligamI123456');
	  	$dec = base64_decode( $dec );
	  	$obj = json_decode( $dec ,true);
	  	
	  	return $obj;
	}	

   /**
    * Column Table
    *
    * Retorna um array com as colunas de uma tabela
    * Returns an array with the columns of a table
    */	
	public static function columnTable( $table )
	{	  
        $columns = array();

	    foreach(DB::select("SHOW COLUMNS FROM $table") as $column)
        {
           
		    $columns[] = $column->Field;
        }
	  
        return $columns;
	}


	public static function toForm($form){

		$show = '';
		$file = 'estatico';
		$f = '';

		foreach($form as $field)
		{
			if ($field['show'] ==1){

				$f .= self::formShow($field['type'], $field['label'], $field['field'], $field['required'], $show, $file);

			}	
		}

		return $f;
	}

	public static function toGrid($grid){
		
		$g = '';
		$tr = '';
		$td = '';

		foreach($grid as $field)
		{
			if ($field['type'] == 'hidden')
			{
				$fk = $field['field'];
			}

			if ($field['show'] == 1)
			{

				$tr .= "\n<th>".$field['label']."</th>"; 
				$td .= "\n<td><?= \$linha->".$field['field']." ?></td>";
			}	
		}

		$table = '
					<table class="table table-striped table-bordered table-hover" id="sample_2">
							<thead>
								'.$tr.'
								<th width="10%">Ações</th>
							</thead>
							<tbody>
							<?php 
								/**
								 * Listando registros da tabela
								 * Listing table records
								 */
								foreach ($lista as $linha):
									/**
									 * Listar registros da tabela
									 * Change Active Label
									 */		            
					        ?>	
								<tr class="odd gradeX">

									'.$td.'
									<td>
										<a class=" btn btn-default" href="<?= base_url() . $url ?>/editar/<?= $linha->'.$fk.' ?>"><i class="fa fa-pencil"></i></a>
	                    				<a class=" btn btn-default" href="<?= base_url() . $url ?>/excluir/<?= $linha->'.$fk.' ?>"><i class="fa fa-trash-o"></i></a>
									</td>

								</tr>
							<?php endforeach ?>	
							</tbody>
						</table>

				';

		return $table;
	}

   /**
    * Form Show
    *
    * Responsavel por criar os campos do formulario de forma dinamica
    * Responsible for creating form fields dynamically
    */	
	public static function formShow( $type , $label, $field , $required, $show, $file = '' /*,$option = array()*/)
	{
		
	    /**
	     * Verifica se existe algum tipo de campo obrigatório para adicionar as tags HTML na criação dos campos do formulário
	     * Checks if there is any kind of field required to add HTML tags in form field creation
	     */	
		if ($required != '0')
		{
			$class_require = '<span class="required"> * </span>';
			$data_require = 'data-required="1"';
		}
		else
		{
			$class_require = '';
			$data_require = '';
		}
		
		/**
	     * Criando os campos de acordo com o type
	     * Creating fields according to type
	     */	
		switch($type)
		{

			case 'text';

				if ($file == 'estatico'){

			    	$value = isset($show->$field) ? $show->$field : '<?=  isset($show->'.$field.') ? $show->'.$field.' : null ;?>';
			    }
			    else
			    {	
			    	 $value = isset($show->$field) ? $show->$field : null;
			    }	


				$form = '
						<div class="form-group">
							<label class="control-label col-md-2">'.$label.' '.$class_require.'</label>
							<div class="col-md-5">
								<input value="'.$value.'" name="'.$field.'" '.$data_require.' type="text" class="form-control" maxlength="300"/>
							</div>
						</div>
						';
				break;
				
			case 'textarea';

				$form = '

						<div class="form-group">
							<label class="control-label col-md-2">Observação</label>
							<div class="col-md-5">
								<textarea name="obsvGrupoBem" class="form-control autosizeme" rows="6"><?=  isset($view->obsvGrupoBem) ? $view->obsvGrupoBem : null ;?></textarea>
							</div>
						</div>	

						';
				break;

			case 'textarea_editor';
				$form = '';
				
				break;				
				

			case 'text_date';
				$form = '
						
				
						
						';
				break;
				
			case 'text_time';
				$form = '';
			
				break;				

			case 'text_datetime';

				$value = isset($show->$field) ? $show->$field : '<?=  data_hora(isset($show->'.$field.') ? $show->'.$field.' : null) ;?>';

				$form = '
						<div class="form-group">
							<label class="control-label col-md-2">'.$label.' '.$class_require.'</label>
							<div class="col-md-3">
									<input value="'.$value.'" name="'.$field.'" id="'.$field.'" class="form-control form-control-inline date-picker" size="16" type="text"/>
							</div>
						</div>

						';
	
				break;				

			case 'select';
				$form = '';
				
				break;	
				
			case 'file'; 
				$form = '';
				
				break;						
				
			case 'radio';
				$form = '';
				
				break;
				
			case 'checkbox';
				$form = '';
				
				break;				
			
		}
		
		return $form;

	}	


   /**
    * Field Required Show
    *
    * Responsavel por criar as regras do Form Validation [.js] para os campos obrigatorios
    * Responsible for creating the Form Validation rules [.js] for the required fields
    */	
	public static function fieldRequiredShow( $field , $required )
	{		
		
		switch($required)
		{
			case 'required';

				$field = '
						 '.$field.': {
                        required: true
                    },

					';
				break;

			case 'alpa';

				$field = '
						 '.$field.': {
                        required: true
                    },

					';
				break;
			
			case 'numeric';

				$field = '
						 '.$field.': {
                        required: true,
                        number: true
                    },

					';
				break;

			case 'alpa_num';

				$field = '
						 '.$field.': {
                        required: true
                    },

					';
				break;

			case 'email';

				$field = '
						 '.$field.': {
                        required: true,
                        email: true
                    },

					';
				break;
				
			case 'url';

				$field = '
						 '.$field.': {
                        required: true,
                        url: true
                    },

					';
				break;
				
			case 'date';

				$field = '
						 '.$field.': {
                        required: true
                    },

					';
				break;					
				
			
		}
		
		return $field;		
	}


	
	
	
		
} // End Class
