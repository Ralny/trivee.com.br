<?php 
//Carregando configurações de conteiner 
include ('application/views/tpl/config_container.php');
?>
<!-- BEGIN PAGE CONTENT INNER -->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN VALIDATION STATES-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase"><?= $title_portlet ?></span>
				</div>
				<?php $this->load->view('tpl/forms-btn-actions-tools') ?>
				<?php $this->load->view('tpl/forms-btn-actions') ?>
			</div>
			<div class="portlet-body form">
				<!-- BEGIN FORM-->
				<form action="<?= base_url() ?>development/insert_release_notes" method="post" id="form_sample_1" <?= $form_class ?>>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							Você tem alguns erros no formulário. Por favor, verifique abaixo.
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Tipo</label>
							<div class="col-md-4">
								<select id="tipoRelease" name="tipoRelease" data-required="true" class="form-control select2me" data-placeholder="Selecionar..." >
									<option value="bug-fix" selected="selected">Bug Fix</option>
									<option value="melhoria">Melhoria</option>
									<!--<option value="Release-Maior">Release Maior</option>-->
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3">Data<span class="required"> * </span></label>
							<div class="col-md-3">
								<input id="dthRelease" name="dthRelease" data-required="1" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""  id="mask_date"/>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">Descrição <span class="required"> * </span></label>
							<div class="col-md-9">
								<textarea id="descRelease" name="descRelease" data-required="1" class="form-control autosizeme" rows="4"></textarea>
							</div>
						</div>

					</div>
					<?php $this->load->view('tpl/forms-btn-actions-save') ?>
				</form>
				<!-- END FORM-->
			</div>
			<br>
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i>
					<span class="caption-subject font-green-sharp bold uppercase">Como funciona?</span>
				</div>
			</div>
			<p>
				Sempre quando fazemos ajustes é interessante mostrar aos usuários quais são esses, seja um novo recurso ou correção de bug.
			</p>
			<table class="table table-hover table-striped table-bordered">
					<tr>
						<td width="200">
							  <strong style="margin-left:10px"><i class="fa fa-bug"></i> Bug Fix</strong>
						</td>
						<td>
						    Para correções de falhas que passaram por desapercebidas, mas logo foram encontradas. 
							Nestas situações, são aplicadas as correções de segurança, que por sua vez são incorporadas ao software recém-lançado.
						</td>
					</tr>
					<tr>
						<td>
							  <strong style="margin-left:10px"><i class="fa fa-lightbulb-o"></i> Melhorias</strong>
						</td>
						<td>
							 Quando tirvermos novas versões que apenas recebeu o uso de alguns simples recursos ou qualquer tipo de melhoria, mas que continua sendo exatamente o mesmo.
						</td>
					</tr>
				</table>
		</div>
		<!-- END VALIDATION STATES-->
	</div>
</div>
<!-- END PAGE CONTENT INNER -->


<!-- VALIDAÇÃO -->
<script>

    jQuery(document).ready(function() {
        //Iniciar Validação
        FormValidation.init();
    });

    var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form_sample_1');
            var error1 = $('.alert-danger', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
              
                rules: {
                    tipoRelease: {
                        required: true
                    },
                    dthRelease: {
                        required: true
                    },
                    descRelease: {
                        required: true
                    }
                },
                messages: {

                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    error1.show();
                    Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

            });
    }
    
    return {
        //main function to initiate the module
        init: function () {

            handleValidation1();

        }

    };

}();

</script>


