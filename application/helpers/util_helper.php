<?php
//funcoes EM PHP
//FUN��O PARA EVITAR INSERIR SQL
function anti_injection($sql){
	$sql = preg_replace(sql_regcase("/(http|www|database|wget|from|select|insert|delete|where|.dat|.txt|.gif|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
	$sql = trim($sql);
	$sql = strip_tags($sql);
	$sql = addslashes($sql);
	return $sql;
}

//verifica se o valor � inteiro
 function valida_inteiro($valor){
	$valor = filter_var($valor, FILTER_VALIDATE_INT);
	$valor = (int) $valor;
	return $valor;
}

function gera_chave($t){ 
    $car = "23456789abcdefghijkmnpqrstuvwxyz";
    for ($i = 0; $i < $t; $i++) {
        $key .= $car{rand(0, strlen($car) - 1)};
    } 
    return $key;
};

//CALCULA O INTERVALO DE DIAS, HORAS, MINS ENTRE DUAS DATAS
function intervalo($data_inicio,$data_fim){
	$data_inicio=explode(" ",$data_inicio);
	$data_fim=explode(" ",$data_fim);
	$inicio_data=explode("-",$data_inicio[0]);
	$fim_data=explode("-",$data_fim[0]);
	$inicio_horario=explode(":",trim($data_inicio[1]));
	$fim_horario=explode(":",trim($data_fim[1]));
	//mktime($horai,$mini,$segi,$mesi,$diai,$anoi)
	$dia1 = mktime($fim_horario[0],$fim_horario[1],$fim_horario[2],$fim_data[1],$fim_data[2],$fim_data[0]);
	$dia2 = mktime($inicio_horario[0],$inicio_horario[1],$inicio_horario[2],$inicio_data[1],$inicio_data[2],$inicio_data[0]);  
	$d3 = ($dia1-$dia2);
	#converter o tempo em dias
	$dias = round(($d3/60/60/24));
	#converter o tempo em horas
	$hrs = round(($d3/60/60));
	#converter o tempo em minutos
	$mins = round(($d3/60));
	#converter o tempo em segundo
	$segs = round($d3);
	//$atraso = date("d",strtotime($hoje) - strtotime($data));
	return $segs;
}

//DIFERENCA ENTRE DUAS DATAS - RETORNA A DIFERENCA DE TEMPO ENTRE DUAS DATAS EM HORAS E MINUTOS
function dateDiff($date1, $date2){

	//$data1 = data atual
	//$data2 = data inicial
	    
    $datetime1 = new DateTime($date1);
	$datetime2 = new DateTime($date2);
	$interval = $datetime2->diff($datetime1);

		// Verifica se as horas sao positivas
		if($interval->format('%R') == '+')
		{
			if ($interval->format('%a') < 1)
			{
				//Minutos
				return $interval->format('%R%Hh%I');
			}
			else
			{	
				//Dias
				return $interval->format('%R%a dias, %hh%I%');
			}
		}
		else
		{
			return ;
		}	
}

//VERIFICA SE A SOLICITACAO DE SERVICO PODE SER ABERTA
function dateDiffReaberturaSolicitacaoServico($date1, $date2){

	//$data1 = data atual
	//$data2 = data conclusao
	    
    $datetime1 = new DateTime($date1);
	$datetime2 = new DateTime($date2);
	$interval = $datetime2->diff($datetime1);

	//echo $interval->format('%R%a dias, %hh%I%');exit;

		// Verifica se as horas sao positivas
		if($interval->format('%R') == '+')
		{
			if ($interval->format('%a') < 1)
			{
				// Nao passou 24h da data da conclusao
				return TRUE;
				//echo 'Minutos';
			}
			else
			{	
				// Passou 24h da data da conclusao, nao pode reabrir
				return FALSE;
				//echo 'Dias';
			}
		}
		else
		{
			return ;
		}	
}

#LIMITA TEXTO POR QUANTIDADE PALAVRAS
function limitador($palavras,$texto) {
  $texto = explode(" ", $texto);
  $texto = preg_replace("/<(\/)?p>/i", "", $texto);
  for ($i=0;$i<$palavras;$i++) {
    $texto_ok = $texto_ok." ".$texto[$i];
  }
  $texto_ok = trim($texto_ok);
  $texto_ok = $texto_ok."";
  $texto_ok = trim($texto_ok);
  $texto_ok = strip_tags($texto_ok);
  return "$texto_ok";
}

//FUNCAO PARA AJUSTAR VALOR DE 10.000,00 PARA 10000.00
function moeda_ajuste($valor) {

		if ($valor == '') $valor = '00,00';
		
		$valor = str_replace("R$","",$valor);
		$valor = str_replace(".","",$valor);
		$valor = str_replace(",", ".",$valor);
		$valor = substr($valor, 2);// Estou usando para resolver retirar um espaco em branco --2 caracteres que eu nao identifiquei -- e que nao sai com o str replace
	
	    return $valor;
	}
//FUNCAO PARA AJUSTAR VALOR DE 10.000,00 PARA 10000.00
function moeda_ajuste_2($valor) {

	if ($valor == '') $valor = '00,00';
	
	$valor = str_replace("R$","",$valor);
	$valor = str_replace(".","",$valor);
	$valor = str_replace(",", ".",$valor);
	
	return $valor;
}	
//FIM FUNCAO ............................................
//FUNCAO PARA AJUSTAR VALOR DE 10000.00 PARA 10.000,00
function moeda($valor) {

		if ($valor == null) $valor = '00.00';

		$valor = str_replace(",", "", $valor);
	    $valor = number_format($valor, 2, ',', '.');
	    return 'R$ '.$valor;
	}
//FIM FUNCAO ............................................

//FUNCAO PARA AJUSTAR PESO DE 1,000 PARA 1000					
function peso_ajuste($peso) {

		if ($peso == '') $peso = '0,00';
		
		$peso = str_replace(",", "", $peso);
	    //$peso = number_format($peso, 3, ',', '.');	
		//$peso = str_replace(".", "", $peso);
		//$peso = str_replace(",", ".", $peso);
	    return  $peso;
	}
//FIM FUNCAO ............................................
//FUNCAO PARA AJUSTAR PESO DE 1000 PARA 1,000
function peso($peso) {

		if ($peso == null) $peso = '0';

		if ( $peso > 0 && $peso <= 999)
		{
			$peso = $peso / 1000;
			$peso = str_pad($peso, 5, "0");
			$peso = str_replace(".", ",", $peso);
		}
		if ($peso >= 1000 && $peso <= 99999)
		{
			$peso = $peso / 1000;
			$peso = number_format($peso, 3, ',', '');	
		}

	    return $peso;
	}
//FIM FUNCAO ............................................


//FUNCAO PARA MOSTRAR A DATA NA TELA
function mostraData($data) {
if ($data!='') {
   return (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
}
else { return ''; }
}
//FINAL DA FUNCAO

//FUNCAO PARA MODIFICAR A DATA PARA ELA SER GRAVADA
function gravaData($data) {
if ($data!='') {
   return (substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2));
}
else { return null; }
}
//FINAL DA FUNCAO

function data_hora_mysql($data){
  $aux = explode(" ", $data);
  $data_array = split("/", $aux[0]);
  $data = $data_array[2] ."-".$data_array[1]."-".$data_array[0] .' '.$aux[1];
  return $data;
}

function data_hora($valor){
	
	  if($valor != '0000-00-00 00:00:00'){
	    $data = date("d/m/Y", strtotime($valor));
	    $hora = date("G:i:s", strtotime($valor));
	    return $data . ' ' .$hora;
	  }else{
	    return '';
	  }
}

function data_extenso($data) {
if ($data!='') {
   return (substr($data,8,2).' de '.mostraMes(substr($data,5,2)).' de '.substr($data,0,4));
}
else { return ''; }
}

function data_extenso_abreviado($data) {
if ($data!='') {
   return (substr($data,8,2).' '.mostraMesAbreviado(substr($data,5,2)).' '.substr($data,0,4));
}
else { return ''; }
}

function exibir_hora($data, $soma_hora) {



	if ($soma_hora == '')
	{
		if ($data != '')
		{
		   	return (substr($data,-9,2).'h'.substr($data,-5,2));
		}
		else 
		{
			return ''; 
		}
	}
	else
	{
		return date('Y-m-d H:i:s', strtotime('+'.convert_time_mysql_em_minutos($soma_hora).' minute', strtotime($data)));
	}	
}

function convert_time_mysql_em_minutos($time){

		$quebra_hora = explode(":", $time);


		$horas = $quebra_hora[0] * 3600 ;
		$minutos = $quebra_hora[1] * 60;
		$segundos = $quebra_hora[2]; 
		return  ($horas + $minutos + $segundos)/60;

}

function data_numDoc($data) {
if ($data!='') {
   return (substr($data,8,2).''.substr($data,5,2).''.substr($data,2,2));
}
else { return ''; }
}

function decimal_ajuste($valor) {
		
		$valor = str_replace(".", "", $valor);
		$valor = str_replace(",", ".", $valor);
	    return $valor;
	}
function decimal_ajuste_exibir($valor) {
		
		$valor = str_replace(".", ",", $valor);
	    return $valor;
	}	


//REMOVE OS ACENTOS SEM PROBLEMAS DE ENCODES
//$enc pode ser [iso-8859-1/UTF-8/etc..]
function RemoveAcentos($str, $enc = 'iso-8859-1'){

$acentos = array(
	'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
	'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
	'C' => '/&Ccedil;/',
	'c' => '/&ccedil;/',
	'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
	'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
	'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
	'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
	'N' => '/&Ntilde;/',
	'n' => '/&ntilde;/',
	'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
	'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
	'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
	'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
	'Y' => '/&Yacute;/',
	'y' => '/&yacute;|&yuml;/',
	'a.' => '/&ordf;/',
	'o.' => '/&ordm;/'
);

  return preg_replace($acentos, array_keys($acentos), htmlentities($str,ENT_NOQUOTES, $enc));
}

function RemovePontuacao($string){
$especiais= Array(".",",",";","!","@","#","%","�","*","(",")","+","-","=",
"�","$","|","\\",":","/","<",">","?","{","}","[","]","&","'",'"',"�","`","?","�","�");
$string = str_replace($especiais,"",trim($string));
return $string;
}

//URL AMIGAVEL
function nome_img($titulo){
 $titulo = RemoveAcentos($titulo);
 $titulo = RemovePontuacao($titulo);
 $titulo = strtolower($titulo);
 $titulo = str_replace('  ',' ', $titulo);
 $new_name = str_replace(' ', '-', $titulo);
 return $new_name;
 
}

function trataCPF($cpf) {
	$cpf=trim($cpf);
	if ($cpf<>""){
		$cpf = str_replace('.', '', $cpf);
		$cpf = str_replace('-', '', $cpf);
		$cpf = str_replace(',', '', $cpf);
		$cpf = str_replace(' ', '', $cpf);
		$cpf = substr($cpf,0,3).'.'.substr($cpf,3,3).'.'.substr($cpf,6,3).'-'.substr($cpf,9,2);
	}
	return $cpf;
}

//mostra a escolaridade do membro
function mostraEscolaridade($id){
	switch($id){
		case '0': $desc='N�o Informado';	break;
		case '1': $desc='Sem Instru��o';	break;
		case '2': $desc='Alfabetizado';	break;
		case '3': $desc='Fund. Incompleto';	break;
		case '4': $desc='Fund. Completo';	break;
		case '5': $desc='M�dio Incompleto';	break;
		case '6': $desc='M�dio Completo';	break;
		case '7': $desc='Superior Incompleto';	break;
		case '8': $desc='Superior Completo';	break;
		case '9': $desc='P�s Graduado';	break;
	}
	return $desc;
}



//mostra a descricao da funcao na igreja
function mostraEstadoCivil($id_civil){
	switch($id_civil){
		case '1': $desc_civil='Solteiro(a)';	break;
		case '2': $desc_civil='Casado(a)';		break;
		case '3': $desc_civil='Divorciado(a)';	break;
		case '4': $desc_civil='Vi�vo(a)';		break;
		case '5': $desc_civil='Uni�o Est�vel';	break;
	}
	return $desc_civil;
}



//mostra a sexo
function mostraSexo($id){
	switch($id){
		case 'M': $desc = 'Masculino';	break;
		case 'F': $desc = 'Feminino';	break;
		default:  $desc = 'Indefinido'; break;
	}
	return $desc;
}

//mostra a descricao do status
function status_geral($id_status){
	switch($id_status){
		case '0': $desc_status='Inativo';	break;
		case '1': $desc_status='Ativo';		break;
		default: $desc_status='Indefinido'; break;
	}
	return $desc_status;
}

function somar_mes($data, $meses = 1){
  $data = explode("-", $data);
  $data_mes =  $data[1] + $meses;
  $data = date("Y-m-d", mktime(0, 0, 0, $data_mes,    $data[2]  , $data[0]  ) );
  return $data;  
}

//mostra a descricao do status do membro
function mostraMes($mes){
	switch($mes)
	{     
        case '00': $desc_mes = '';			break;
		case '01': $desc_mes = 'Janeiro';	break;
		case '02': $desc_mes = 'Fevereiro';	break;
		case '03': $desc_mes = 'Março';		break;
		case '04': $desc_mes = 'Abril';		break;
		case '05': $desc_mes = 'Maio';		break;
		case '06': $desc_mes = 'Junho';		break;
		case '07': $desc_mes = 'Julho';		break;
		case '08': $desc_mes = 'Agosto';	break;
		case '09': $desc_mes = 'Setembro';	break;
		case '10': $desc_mes = 'Outubro';	break;
		case '11': $desc_mes = 'Novembro';	break;
		case '12': $desc_mes = 'Dezembro';	break;
	}

	return $desc_mes;

}


//mostra a descricao do status do membro
function mostraMesAbreviado($mes){
	switch($mes)
	{     
        case '00': $desc_mes = '';		break;
		case '02': $desc_mes = 'Fev';	break;
		case '03': $desc_mes = 'Mar';	break;
		case '04': $desc_mes = 'Abr';	break;
		case '05': $desc_mes = 'Mai';	break;
		case '06': $desc_mes = 'Jun';	break;
		case '07': $desc_mes = 'Jul';	break;
		case '08': $desc_mes = 'Ago';	break;
		case '09': $desc_mes = 'Set';	break;
		case '10': $desc_mes = 'Out';	break;
		case '11': $desc_mes = 'Nov';	break;
		case '12': $desc_mes = 'Dez';	break;
	}

	return $desc_mes;

}

//mostra a descricao do status do membro
function mostraMes_mysql($mes){
	switch($mes)
	{ 
		case 'Janeiro'	: $desc_mes = '01';	break;
		case 'Fevereiro': $desc_mes = '02';	break;
		case 'Março'	: $desc_mes = '03';	break;
		case 'Abril'	: $desc_mes = '04';	break;
		case 'Maio'		: $desc_mes = '05';	break;
		case 'Junho'	: $desc_mes = '06';	break;
		case 'Julho'	: $desc_mes = '07';	break;
		case 'Agosto'	: $desc_mes = '08';	break;
		case 'Setembro'	: $desc_mes = '09';	break;
		case 'Outubro'	: $desc_mes = '10';	break;
		case 'Novembro'	: $desc_mes = '11';	break;
		case 'Dezembro'	: $desc_mes = '12';	break;
	}

	return $desc_mes;
	
}




function getOptions($sql, $value, $campo, $selected = ''){
  $res = mysql_query("$sql");
  $res_t = mysql_num_rows($res);
  if($res_t > 0){
    while($row = mysql_fetch_assoc($res)){

      if($selected == $row[$value]){
        $option .= '<option value="'.$row[$value].'" selected="selected">'.$row[$campo].'</option>';
      }else{
        $option .= '<option value="'.$row[$value].'">'.$row[$campo].'</option>';
      }

    }
    return $option;
  }
}


function get_pessoa($id){
	switch($id){
		case 'F': $desc='F�sica';	break;
		case 'J': $desc='Jur�dica';		break;
		default: $desc='Indefinido'; break;
	}
	return $desc;
}

function imprime_dizimo($id_dizimo){

	//carrega o componente pelo GUID (pelo nome n�o funcionou)
	$bema = new COM("{310DBDAC-85FF-4008-82A8-E22A09F9460B}");

	//abre porta
	$init = $bema->IniciaPorta("COM3");
	if ($init <= 0) {}else{

		//consulta o dizimo
		$sql = mysql_query("SELECT * FROM fin_contas_receber WHERE id_receber=$id_dizimo LIMIT 0,1");
		if (mysql_num_rows($sql)>0){
		
			$row = mysql_fetch_array($sql);
			
			$hoje = date('d/m/Y H:m:s');
          
			$bema->FormataTX("    Igreja Assembleia de Deus do Dirceu II \n", 1, 0, 0, 0, 1 );
			$bema->FormataTX("        Rua S�o Jorge, 4021, Dirceu II\n", 1, 0, 0, 0, 1 );
			$bema->FormataTX("                 Teresina/PI \n", 1, 0, 0, 0, 1 );
			$bema->FormataTX("------------------------------------ \n", 2, 0 , 0, 0, 0);
			$bema->FormataTX("     D�zimo do Senhor (Ml 3:10) \n", 2, 0, 0, 0, 1 );
			$bema->FormataTX("------------------------------------ \n", 2, 0 , 0, 0, 0);
			$bema->FormataTX("Congrega��o: ".get_congregacao($row['id_congregacao'])." \n", 2, 0, 0, 0, 1 );
			$bema->FormataTX(mostraFuncao(get_membro($row['id_membro'], 'funcao')).": \n".get_membro($row['id_membro'])." \n \n", 2, 0, 0, 0, 1 );
			$bema->FormataTX("Valor : R$ ".moeda($row['valor'])." \n", 2, 0, 0, 0, 1 );
			$bema->FormataTX("Data  : ".mostraData($row['vencimento'])." \n", 2, 0, 0, 0, 1 );
			$bema->FormataTX("ID    : ".str_pad($id_dizimo, 12, '0', STR_PAD_LEFT)." \n", 2, 0, 0, 0, 1 );
			$bema->FormataTX("NumDoc: ".$row['num_documento']." \n", 2, 0, 0, 0, 1 );
			$bema->FormataTX("------------------------------------ \n", 2, 0 , 0, 0, 0);
			$bema->FormataTX("Usu�rio: ".$_SESSION['usuario_id']." ".limitador(1, $_SESSION['usuario_nome'])." em ".$hoje."\n", 1, 0 , 0, 0, 0);
			
			//da um espa�o
			$bema->FormataTX("\n \n \n \n \n", 1, 0, 0, 0, 1 );
			
			//corta o papel
			$bema->AcionaGuilhotina(1);
		}
		//fecha a porta de impressao
		$bema->FechaPorta();
	}

}

function upload_img($destino_img, $destino_thumb, $x, $y){
	$erro = $config = array();
	if (empty($_FILES['foto']['name'][0])){
		//se esta vazia nao faz nada
	}else{
		// Prepara a vari�vel do arquivo
		$arquivo = isset($_FILES["foto"]) ? $_FILES["foto"] : FALSE;
		// Tamanho m�ximo do arquivo (em bytes)
		$config["tamanho"] = 3145728;
		// Formul�rio postado... executa as a��es
		if($arquivo)
		{
			// Verifica se o mime-type do arquivo � de imagem
			if(!eregi("^image\/(pjpeg|jpeg|png|gif|bmp)$", $arquivo["type"]))
			{
				echo $erro[] = "Arquivo em formato inv�lido! A imagem deve ser jpg, jpeg,
					bmp, gif ou png. Envie outro arquivo<br/>";
				$imagem_nome = 'erro';
			}else{
				// Verifica tamanho do arquivo
				if($arquivo["size"] > $config["tamanho"]){
				
					echo $erro[] = "Arquivo em tamanho muito grande!
					A imagem deve ser de no m�ximo " . $config["tamanho"] . " bytes - +-3MB.
					Envie outro arquivo<br/>";
					$imagem_nome = 'erro';
				}else{
					// Verifica��o de dados OK, nenhum erro ocorrido, executa ent�o o upload...
				
					// Pega extens�o do arquivo
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $arquivo["name"], $ext);

					// Gera um nome �nico para a imagem
					$imagem_nome = md5(uniqid(time())) . "." . $ext[1];

					// Caminho de onde a imagem ficar�
					$imagem_dir = $destino_img.$imagem_nome;
					$imagem_dir_mini = $destino_mini.$imagem_nome;

					// Faz o upload da imagem
					if(move_uploaded_file($arquivo["tmp_name"], $imagem_dir)){

					  include( 'm2brimagem.class.php' );
					  $oImg = new m2brimagem( $destino_img . $imagem_nome );
					  //$oImg_thumb = new m2brimagem( $destino_img . $imagem_nome );
					  // valida via m2brimagem
					  if( $oImg->valida() == 'OK' ){
						// redimensiona mantendo propocao
						$oImg->redimensiona( $x, $y, '' );
						// grava imagem na pasta
						$oImg->grava( $destino_img . $imagem_nome );
					  }
					}
				}

			}
			return $imagem_nome;
		}
	}
}
//final da funcao de upload

function image_size_crop($image, $new_image, $w, $h){
  include_once('m2brimagem.class.php');
  $oImg = new m2brimagem($image);
  $oImg->redimensiona( $w, $h, 'crop');
  $oImg->grava($new_image);
}

function get_background($row){
	//Se o Status for MUDOU, DESVIADO ou FALECIDO o back fica CINZA
	if ($row['status']<>'1'){
		$background_linha = 'style="background:#F5F5F5; color:#828282;"';
		$background_status= "";
	}else{
		if (($row['data_cartao_entregue']<>'0000-00-00') and ($row['data_cartao_entregue']<>'')){
			//verifica se o cart�o j� foi entregue
			$background_status = 'style="background:#32CD32; color:#ffffff;"';
			$background_linha = "";
		}else{
			if (($row['data_catao_print']<>'0000-00-00') and ($row['data_catao_print']<>'')){
				//verifica se o cart�o j� foi impresso
				$background_status = 'style="background:#6495ED; color:#ffffff;"';
				$background_linha = "";
			}else{
				//verifica se falta dados obrigat�rios
				if (($row['nome']=="") or ($row['nascimento']=="0000-00-00") or ((($row['estado_civil']=='2') or ($row['estado_civil']=='5')) and ($row['conjuge']=="")) or ($row['pai']=="") or ($row['mae']=="") or ($row['rg']=="") or ($row['cpf']=="") or ($row['endereco']=="") or ($row['bairro']=="") or ($row['naturalidade']=="") or ($row['nacionalidade']=="") or ($row['escolaridade']=='0') or ($row['profissao']=="") or ($row['data_batismo']=="0000-00-00")){
					$background_status = 'style="background:#FFA54F; color:#ffffff;"';
					$background_linha = "";
				}else{
					//Verifica se tem foto cadastrada
					if ((empty($row['foto']) or ($row['foto']=='erro'))){
						$background_status = 'style="background:#FFD700; color:#000000;"';
						$background_linha = "";
					}else{
						$background_linha = "";
						$background_status= "";
					}
				}
			}
		}
	}
	return array ($background_linha,$background_status);
}


//final das funcoes
?>