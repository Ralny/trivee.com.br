<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
    <a class="dashboard-stat dashboard-stat-light blue-madison" href="<?= base_url(). 'zata/logs/lista_interacoes_sistema' ?>">
        <div class="visual">
            <i class="fa icon-social-dropbox fa-icon-medium"></i>
        </div>
        <div class="details">
            <div class="number">
              <?= $total_produtos_cadastrados ?>
            </div>
            <div class="desc">
               Produtos cadastrados
            </div>
         </div>
    </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-light green-haze" href="<?= base_url(). 'zata/logs/lista_logins_realizados' ?>">
        <div class="visual">
            <i class="fa icon-basket fa-icon-medium"></i>
        </div>
        <div class="details">
            <div class="number">
                 <?= $total_requisicoes ?>
            </div>
            <div class="desc">
                Requisições Realizadas
            </div>
        </div>
    </a>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-light red-intense" href="<?= base_url(). 'zata/logs/lista_erros_zata' ?>">
        <div class="visual">
            <i class="fa fa icon-drawer"></i>
         </div>
        <div class="details">
            <div class="number">
              <?= $total_gelato_produzido ?>
            </div>
             <div class="desc">
                de Gelato Produzido
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
                <form id="formProduto" action="<?= base_url() ?>gelato_grano/bi_consumo/dashboard" method="post">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Data Inicial</label>
                            <input name="dth_inicial" id="dth_inicial" data-required="1" class="form-control input-medium date-picker" size="16" type="text" value=""/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Data Final</label>
                            <input name="dth_final" id="dth_final" data-required="1" class="form-control input-medium date-picker" size="16" type="text" value=""/>
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

        });

    });
</script>


