<?php

const NUM_REG_PAGINA =  30;

// Topo da Pagina de Impressao
$section = 
'
<section class="sheet padding-10mm">

  <table class="tg" width="100%">
    <tr>
      <th class="tg-titulo" colspan="6">REQUISIÇÃO DE PRODUTOS</th>
    </tr>
    <tr>
      <td class="tg-empresa" colspan="6">GELATO E GRANO INDUSTRIA DE GELATO LTDA ME</td> 
    </tr>
  </table>
  <table class="tg" width="100%">
    <tr>
      <td class="tg-lqy3"><strong>Número</strong></br>
        '. $show->num_requisicao .'
      </td>
      <td class="tg-lqy3"><strong>Tipo de Destino</strong></br> Transferencia</td>
      <td class="tg-lqy3"><strong>Data Emissão</strong></br> 
        '. mostraData($show->data_emissao).'
      </td>
      <td class="tg-lqy3"><strong>Necessidade de Entrega</strong></br>
        '. mostraData($show->data_necessidade_entrega) .'
      </td>
    </tr>
    <tr>
      <td class="tg-lqy3"><strong>Unidade de Origem</strong></br> Joca Vieira</td>
      <td class="tg-lqy3"><strong>Estoque de Origem</strong></br> Estoque Principal</td>
      <td class="tg-lqy3"></td>
      <td class="tg-lqy3"></td>
    </tr>
  </table>
  <br />
  <table class="tg" width="100%">

    <tr>
      <td class="tg-yw4l"><strong>PRODUTO</strong></td>
      <td class="tg-yw4l"><strong>EMB</strong></td>
      <td class="tg-yw4l"><strong>QTD</strong></td>
    </tr>

';
// Fim da pagina
$section_end = 
'
  </table>
</section>

';

//Inicia a pagina
echo $section;

$contador = 0;
$pagina   = 1;
//Enquanto lista os itens da requisicao
foreach ($itens_requisicao as $item):

    // Verifiva se eh pra fazer a quabra de pagina 
    if($contador == NUM_REG_PAGINA)
    {
       //Se quebra a pagina a contagem de registros inicia novamente
       $contador = 0;
       //Finalizando a pagina
       echo 
       '
            <div id="footer">
                2017 © TRIVEE SERVICES IT | ZATA - PAGINA '.$pagina.'
            </div>
       ';
       echo $section_end;
       // Iniciando uma nova pagina 
       echo $section;

      $pagina++;    
     }
     // Listando os itens da requisicao 
     echo
        '
          <tr>
          <td class="tg-lqy6">'.$item->nome_produto .'</td>
          <td class="tg-lqy6">'.$item->unidade_medida .'</td>
          <td class="tg-lqy6">'. $item->qtd  .'</td>
          </tr>
        ';   
     $contador++;
endforeach;
?>
      <div id="footer">
               2017 © TRIVEE SERVICES IT | ZATA - PAGINA <?= $pagina ?>
      </div>
  </table>

</section>


