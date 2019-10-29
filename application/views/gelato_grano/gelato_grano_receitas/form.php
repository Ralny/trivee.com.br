<style>
.ui-helper-hidden-accessible {
    display: none;
}
</style>

<?php 
//Carregando configurações de conteiner
include ('application/views/tpl/config_container.php');

// --------------------------------------------------------
// Aux para desabilidar elementos do formulario que nao podem mais ser editados
if (isset($form_editar))
{
    $disabled = 'disabled';
}
else
{
    $disabled = '';
}
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-custom tabbable-noborder">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1_1" data-toggle="tab">Receita</a></li>
                <?php  if (isset($form_editar)){ ?>
                <li><a href="#tab_1_2" data-toggle="tab">Ingredientes</a></li>
                <li><a href="#tab_1_3" data-toggle="tab">Imagem da Cuba</a></li>
                <?php  } ?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1_1">

                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <?= $title_portlet ?>
                                    </div>
                                </div>

                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="<?= base_url().$url ?>/salvar" method="post" id="form_sample_1" <?= $form_class ?>>
                                        <input type="hidden" name="id" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">
                                        <?php  $this->load->view('tpl/forms-btn-actions-save-top') ?>
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button>
                                                <?= $erro_valid_form ?>
                                            </div>

                                            <?php 
                                                /**
                                                 * Verificar o status do registro e se botão ATIVO ira ficar marcado
                                                 * quando o formulario estiver em modo de edição
                                                 * Check the status of the record and if the ACTIVE button will be marked
                                                 * When the form is in edit mode
                                                 */
                                                if (isset($form_editar)){ 

                                                    /**
                                                     * Se for 'S', este registro está ativo
                                                     * If 'S', this record is active
                                                     */
                                                    if ($show->sit_ativo == 'S')
                                                    {
                                                        $checked = 'checked';
                                                    }
                                                    else
                                                    {
                                                        /**
                                                         * não está ativo
                                                         * Is not active
                                                         */
                                                        $checked = '';
                                                    }
                                                }
                                                else
                                                {
                                                    /**
                                                     * Formulario em modo de Cadastro por padrao ficará ativo
                                                     * Form in Registration mode by default will be active
                                                     */
                                                    $checked = 'checked';
                                                }

                                                /**
                                                 * Verificar o status do registro e se botão ATIVO ira ficar marcado
                                                 * quando o formulario estiver em modo de edição
                                                 * Check the status of the record and if the ACTIVE button will be marked
                                                 * When the form is in edit mode
                                                 */
                                                if (isset($form_editar)){ 

                                                    /**
                                                     * Se for 'S', este registro está ativo
                                                     * If 'S', this record is active
                                                     */
                                                    if ($show->base_receita == 'A')
                                                    {
                                                        $checked_agua = 'checked';
                                                    }
                                                    else
                                                    {
                                                        /**
                                                         * não está ativo
                                                         * Is not active
                                                         */
                                                        $checked_agua = '';
                                                    }

                                                    /**
                                                     * Se for 'S', este registro está ativo
                                                     * If 'S', this record is active
                                                     */
                                                    if ($show->base_receita == 'L')
                                                    {
                                                        $checked_leite = 'checked';
                                                    }
                                                    else
                                                    {
                                                        /**
                                                         * não está ativo
                                                         * Is not active
                                                         */
                                                        $checked_leite = '';
                                                    }
                                                }else{
                                                    $checked_agua  = '';
                                                    $checked_leite = 'checked';
                                                }
                                                
                                                ?>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Ativo?</label>
                                                    <div class="col-md-5">
                                                        <input type="checkbox" name="sit_ativo" class="make-switch" <?= $checked; ?> data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Base da Receita</label>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <div class="icheck-inline">
                                                                <label><input value="L" type="radio" <?= $checked_leite; ?> name="base_receita" class="icheck" data-radio="iradio_square-blue"> Leite</label>
                                                                <label><input value="A" type="radio" <?= $checked_agua; ?> name="base_receita" class="icheck" data-radio="iradio_square-blue"> Agua </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Nome Receita <span class="required"> * </span></label>
                                                    <div class="col-md-5">
                                                        <input value="<?=  isset($show->nome_receita) ? $show->nome_receita : null ;?>" name="nome_receita" data-required="1" type="text" class="form-control" maxlength="300"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Categoria <span class="required"> * </span></label>
                                                    <div class="col-md-5">
                                                        <select name="id_categoria_gelato" class="form-control select2me" data-required="1" data-placeholder="Selecionar...">
                                                            <option></option>
                                                            <?php 

                                                            $select = '';   
                                                            foreach ($categoria_gelato as $row):
                                                                if(isset($form_editar))
                                                                {
                                                                    if($show->id_categoria_gelato == $row->id_categoria_gelato ) 
                                                                    {
                                                                        $select = 'selected="selected"';
                                                                    }
                                                                    else
                                                                    {
                                                                        $select = '';       
                                                                    }
                                                                }
                                                                ?>
                                                                <option value="<?= $row->id_categoria_gelato ?>" <?=  $select ?>><?= $row->desc ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-2">Modo Preparo </label>
                                                    <div class="col-md-5">
                                                        <textarea name="modo_preparo" class="form-control" rows="10"><?=  isset($show->modo_preparo) ? $show->modo_preparo : null ;?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <?php  //$this->load->view('tpl/forms-info-alter-registro') ?>
                                            <?php //$this->load->view('tpl/forms-btn-actions-save') ?>
                                        </form>

                                        <!-- END FORM-->
                                    </div>  
                                </div>
                                <!-- END VALIDATION STATES-->
                            </div>
                        </div>

                    </div>
                    <?php if (isset($form_editar)) { ?>
                    <div class="tab-pane" id="tab_1_2">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    Inserir ingredientes
                                </div>
                            </div>

                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <form action="<?= base_url().$url ?>/adicionarIngrediente" method="post" <?= $form_class ?>>
                                    <input type="hidden" name="id" value="<?=  isset($show->id_receita) ? $show->id_receita : null ;?>">
                                    <input type="hidden" name="receita" value="<?=  isset($show->token_id) ? $show->token_id : null ;?>">

                                    <div class="form-body">

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Ingrediente<span class="required"> * </span></label>

                                            <div class="col-md-5">
                                                <input value="" id="produto" name="produto"  type="text" data-required="1" class="form-control" required/>
                                                <input type="hidden" name="idProduto" id="idProduto" />
                                                <input type="hidden" name="nome_item" id="nome_item" />
                                                <input type="hidden" name="codigo" id="codigo" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2">Peso<span class="required"> * </span></label>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <input name="peso" data-required="1" placeholder="1,000"  type="text" class="form-control" maxlength="6"/>
                                                    <span class="input-group-addon">
                                                        (kg) 
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <?php  //$this->load->view('tpl/forms-info-alter-registro') ?>
                                    <?php $this->load->view('tpl/forms-btn-actions-save') ?>
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-hover" id="divServicos">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Ingrediente 
                                                </th>
                                                <th width="15%">
                                                    Codigo interno
                                                </th>
                                                <th width="15%">
                                                    Quantidade(g)
                                                </th>
                                                <th width="10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

                                    /**
                                     * Listando Ingredientes
                                     * Listing Ingredients                              
                                     */
                                    foreach ($ingredientes_gelato as $item):
                                        ?>  
                                        <tr>
                                            <td>
                                                <?= isset($item->nome_item) ? $item->nome_item : null ;?>
                                            </td>
                                            <td>
                                                <?= isset($item->codigo) ? $item->codigo : null ;?>
                                            </td>
                                            <td>
                                                <?= isset($item->quantidade) ? $item->quantidade : null ;?>
                                            </td>
                                            <td>
                                                <a href=" <?= base_url(). 'gelato_grano/Gelato_grano_receitas/excluirIngrediente/'?><?= isset($item->id_item_receita) ? $item->id_item_receita : null ;?>/<?=  isset($show->token_id) ? $show->token_id : null ;?>" class=" btn btn-default"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php  endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab_1_3">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    Imagem
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <?php $this->load->view('zata/modulos/template/public/upload_imagem')  ?>
                            </div>  
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
            </div>  
            <?php } ?>
        </div>
    </div>
</div>
</div>
<!-- END PAGE CONTENT INNER -->

<!-- VALIDAÇÃO -->
<script>

    jQuery(document).ready(function() {

        $("#produto").autocomplete({
            source: "<?= base_url(); ?>produtos/produtos/auto_complete_produto",
            minLength: 1,
            select: function( event, ui ) {
                $("#idProduto").val(ui.item.id);
                $("#nome_item").val(ui.item.label); 
                $("#codigo").val(ui.item.codigo);
            }
        });

        $('input[name="peso"]').keyup(function(){
            this.value = formatWeight(this.value);
        });

        <?php
        /**
         * Botao fechar do formulario 
         * Close form button
         */
        ?>
        $('#fechar').click(function() {

            <?php
            /**
             * Retorna para listagem
             * Return to listing
             */
            ?>
            $(location).attr('href', '<?= base_url().$url."/listar"?>');
        });

        <?php
        /**
         * Iniciar Validação do formulario
         * Start Form Validation
         */
        ?>
        FormValidation.init();

        <?php
        /**
         * Passando ação do button do formulario 
         * Passing form button action
         */
        ?>
        $("button").click(function() {

            <?php
            /**
             * Recebe o value do button clicado 
             * Receive value of button clicked
             */
            ?>
            var acao = this.value;

            <?php
            /**
             * Altera o value do hidden que vai no POST do formulario
             * Change the value of hidden that goes in the POST of the form
             */
            ?>
            $("#acao").attr('value', acao);
        });

    });

    var FormValidation = function () {

        <?php
    /**
     * Validação Basica
     * Basic Validation
     */
    ?>  
    var handleValidation1 = function() {

        var form1  = $('#form_sample_1');
        var error1 = $('.alert-danger', form1);

        form1.validate({
                errorElement: 'span', //container default de input error
                errorClass: 'help-block help-block-error', // classe de mensagem default input error
                focusInvalid: false, // Não focar no ultimo input da validação
                ignore: "",  // Validar todos os campos inclusos no form

                rules: {

                    <?php foreach ($tableForm as $k => $field) : ?>

                    <?php if($field['required'] != '0'): ?>

                    <?php echo SiteHelpers::fieldRequiredShow($field['field'], $field['required'])   ?>

                    <?php endif; ?>

                    <?php endforeach; ?>                       

                },
                messages: {

                },

                invalidHandler: function (event, validator) { //display error submit              
                    error1.show();
                    Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class
                    },

                unhighlight: function (element) { // revert a mudança do hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class
                    },

                });
    }

    return {

        init: function () {

            handleValidation1();

        }

    };

}();

</script>






