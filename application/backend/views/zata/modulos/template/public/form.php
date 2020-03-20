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
				<form action="javascript:;" id="form_sample_1"  <?= $form_class ?>>
					<div class="form-body">
						<div class="alert alert-danger display-hide">
							<button class="close" data-close="alert"></button>
							Você tem alguns erros no formulário. Por favor, verifique abaixo.
						</div>
						<div class="alert alert-success display-hide">
							<button class="close" data-close="alert"></button>
							Your form validation is successful!
						</div> 

						<!-- INPUT VALIDATE -->
						<div class="form-group">
							<label class="control-label col-md-3">Validação <span class="required"> * </span>
							</label>
							<div class="col-md-4">
								<input type="text" name="name" data-required="1" class="form-control"/>
							</div>
						</div>
						<!-- INPUT NORMAL -->
						<div class="form-group">
							<label class="control-label col-md-3">Input Normal</label>
							<div class="col-md-4">
								<input id="name" name="name" type="text" class="form-control" maxlength="25"/>
							</div>
						</div>
						<!-- DROPDOWN NORMAL -->
						<div class="form-group">
							<label class="control-label col-md-3">Dropdown</label>
							<div class="col-md-4">
								<select class="form-control select2me" data-placeholder="Selecionar...">
									<option value="AL">Alabama</option>
									<option value="WY">Wyoming</option>
								</select>
							</div>
						</div>
						<!-- CHECKBOX-->
						<div class="form-group">
							<label class="col-md-3 control-label">Checkbox</label>
							<div class="col-md-9">
								<div class="input-group">
									<div class="icheck-inline">
										<label><input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Checkbox 1 </label>
										<label><input type="checkbox" class="icheck" data-checkbox="icheckbox_square-blue"> Checkbox 2 </label>
									</div>
								</div>
							</div>
						</div>
						<!-- RADIOS -->
						<div class="form-group">
							<label class="col-md-3 control-label">Radios</label>
							<div class="col-md-9">
								<div class="input-group">
									<div class="icheck-inline">
										<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Radio Button 1 </label>
										<label><input type="radio" name="radio2" class="icheck" data-radio="iradio_square-blue"> Radio Button 2 </label>
									</div>
								</div>
							</div>
						</div>
						<!-- DATEPICKER -->
						<div class="form-group">
							<label class="control-label col-md-3">Datepicker</label>
							<div class="col-md-3">
								<input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""  id="mask_date"/>
							</div>
						</div>
						<!-- DATETIMEPICKER -->
						<div class="form-group">
							<label class="control-label col-md-3">Datetimepicker</label>
							<div class="col-md-4">
								<div class="input-group date form_datetime" data-date="2012-12-21T15:25:00Z">
									<input type="text" size="16" readonly class="form-control">
									<span class="input-group-btn">
									<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
									<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								<!-- /input-group -->
							</div>
						</div>
						<!-- SWITCH -->
						<div class="form-group">
							<label class="control-label col-md-3">Switch</label>
							<div class="col-md-9">
								<input type="checkbox" class="make-switch" checked data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"> 
							</div>
						</div>
						<!-- TEXTAREA -->
						<div class="form-group">
							<label class="col-md-3 control-label">Text Area</label>
							<div class="col-md-9">
								<textarea class="form-control autosizeme" rows="4"></textarea>
							</div>
						</div>
						<!-- UPLOAD FILES -->
						<div class="form-group">
							<label class="control-label col-md-3">Upload File</label>
							<div class="col-md-9">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="input-group input-large">
										<div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
											<i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
											</span>
										</div>
										<span class="input-group-addon btn default btn-file">
										<span class="fileinput-new">Selecione o arquivo</span>
										<span class="fileinput-exists">Trocar</span>
										<input type="file" name="..."></span>
										<a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput">Remover</a>
									</div>
								</div>
							</div>
						</div>
						<!-- UPLOAD IMG -->
						<div class="form-group">
								<label class="control-label col-md-3">Upload Image</label>
								<div class="col-md-9">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
											<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
										</div>
										<div>
											<span class="btn default btn-file">
											<span class="fileinput-new">Selecionar imagem</span>
											<span class="fileinput-exists">Trocar </span>
											<input type="file" name="...">
											</span>
											<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remover </a>
										</div>
									</div>
								</div>
						</div>
						<!-- EDITOR -->
						<!-- EDITOR -->
						<!--
								<div class="form-group">
									<label class="control-label col-md-3">Editor</label>
									<div class="col-md-9">
										<div name="summernote" id="summernote_1">
										</div>
									</div>
								</div>
						-->								
					
					</div>
					<?php $this->load->view('tpl/forms-btn-actions-save') ?>
				</form>
				<!-- END FORM-->
			</div>
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
                    name: {
                        minlength: 2,
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

                submitHandler: function (form) {
                    error1.hide();
                }
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


