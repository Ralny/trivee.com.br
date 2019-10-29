<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
    <a class="dashboard-stat dashboard-stat-light blue-madison" href="<?= base_url(). 'zata/logs/lista_interacoes_sistema' ?>">
        <div class="visual">
            <i class="fa fa-keyboard-o fa-icon-medium"></i>
        </div>
        <div class="details">
            <div class="number">
              168  <?php //= $num_interacoes_zata ?>
            </div>
            <div class="desc">
               Produtos no Estoque
            </div>
         </div>
    </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-light green-haze" href="<?= base_url(). 'zata/logs/lista_logins_realizados' ?>">
        <div class="visual">
            <i class="fa fa-group fa-icon-medium"></i>
        </div>
        <div class="details">
            <div class="number">
                 30<?php //== $num_login_realizados_zata ?>
            </div>
            <div class="desc">
                Numero de Requisições
            </div>
        </div>
    </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-light red-intense" href="<?= base_url(). 'zata/logs/lista_erros_zata' ?>">
        <div class="visual">
            <i class="fa fa-bug"></i>
         </div>
        <div class="details">
            <div class="number">
               42 KG <?php //== $num_erros_zata ?>
            </div>
             <div class="desc">
                Gelatos Produzido
             </div>
        </div>
    </a>
    </div>
</div>
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
             Requisição x Produção 
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <form id="formProduto" action="" method="post">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Data Inicial</label>
                            <input name="dth_inicial" data-required="1" class="form-control input-medium date-picker" size="16" type="text" value=""/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Data Final</label>
                            <input name="dth_final" data-required="1" class="form-control input-medium date-picker" size="16" type="text" value=""/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <button value="" type="submit" class="btn green-haze"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </form> 
            </div>
        <div class="table-scrollable table-scrollable-borderless">
            <table class="table table-bordered table-striped table-condensed flip-content">
                <thead>
                    <tr class="uppercase">
                        <th>Produto</th>
                        <th width="8%">Unid.</th>
                        <th width="8%">Qtde.</th>
                        <th width="15%">Peso Liquido</th>
                        <th width="15%">Consumo</th>
                        <th width="15%">Discrepancia</th>
                    </tr>
                </thead>
               <tbody>
                <?php 
                /**
                 * Listando registros da tabela
                 * Listing table records
                 */
                foreach ($produtos as $linha):

                     ?> 
                    <tr>
                        <td><?= $linha['nome'] ?></td>
                        <td><?= $linha['unidade_medida'] ?> </td>
                        <td><?= $linha['requisitado'] ?> </td>
                        <td><?= $linha['peso_liquido'] ?> </td>
                        <td><?= $linha['produzido'] ?> </td>
                        <td><?= $linha['discrepancia'] ?></td>
                    </tr>
                <?php endforeach ?> 
                </tbody>
            </table>
        </div>  
    </div>
    </div>
</div>


<script>

    jQuery(document).ready(function() {

        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            orientation: "left",
            autoclose: true,
            format: 'dd/mm/yyyy'
        });

        $("#produto").autocomplete({
            source: "<?= base_url(); ?>produtos/produtos/auto_complete_produto",
            minLength: 1,
            select: function( event, ui ) {
                $("#idProduto").val(ui.item.id);
            }
        });


        $("#formProduto").validate({
            rules:{
                dth_inicial: {
                    required:true
                },
                dth_final: {
                    required:true
                },

            },
            messages:{
                dth_inicial: {
                    required: 'Defina uma Data Inicial'
                },
                dth_final: {
                    required: 'Defina uma Data Final'
                },
            },
            submitHandler: function( form ){       
                /*
                $("#divProdutos").html("<div class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuenow='10' aria-valuemin='0' aria-valuemax='100' style='width: 80%'><span class='sr-only'>80% Complete (success) </span></div></div>");
                */

                var dados = $( form ).serialize();

                console.log(dados);

                $.ajax({
                    type: "POST",
                    url: "<?= base_url() ?>produtos/produtos/adicionarProdutoRequisicao",
                    data: dados,
                    dataType: 'json',
                    success: function(data)
                    {
                        if(data.result == true){
                            $("#divProdutos").load("<?php echo current_url();?> #divProdutos" );
                            $("#produto").val('').focus();
                            $("#qtdProduto").val('') ;
                            $("#precoProduto_exib").val('');
                            $("#valor_total_produto_exib").val(''); 
                        }
                        else{
                            alert('Ocorreu um erro ao tentar adicionar produto.');
                        }
                    }
                });

                return false;
            }

        });



    });
</script>


