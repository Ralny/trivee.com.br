<script type="text/javascript">
	jQuery(function($){
	   $("#cep").change(function(){
	      var cep_code = $(this).val();
	      if( cep_code.length <= 0 ) return;
	      $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
	         function(result){
	            if( result.status!=1 ){
	               alert(result.message || "Houve um erro desconhecido");
	               return;
	            }
	            $("input#cep").val( result.code );
	            $("input#cidade").val( result.city );
	            $("input#bairro").val( result.district );
	            $("input#logradouro").val( result.address );
	            $("input#uf").val( result.state ); 
	         });
	   });
	});
</script>

						<div class="form-group">
							<label class="control-label col-md-2">CEP</label>
							<div class="col-md-2">
								<input value="<?=  isset($view->cep) ? $view->cep : null ;?>" name="cep" id="cep" type="text" class="form-control" maxlength="9"/>
							</div>
							<label class="control-label col-md-2">Rua, Avenida, ...</label>
							<div class="col-md-4">
								<input value="<?=  isset($view->logradouro) ? $view->logradouro : null ;?>" name="logradouro" id="logradouro" type="text" class="form-control" maxlength="100"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Número</label>
							<div class="col-md-2">
								<input value="<?=  isset($view->numero) ? $view->numero : null ;?>" name="numero" id="numero" type="text" class="form-control" maxlength="5"/>
							</div>
							<label class="control-label col-md-2">Complemento</label>
							<div class="col-md-4">
								<input value="<?=  isset($view->complemento) ? $view->complemento : null ;?>" name="complemento" name="complemento" type="text" class="form-control" maxlength="50"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Bairro</label>
							<div class="col-md-4">
								<input value="<?=  isset($view->bairro) ? $view->bairro : null ;?>" name="bairro" id="bairro" type="text" class="form-control" maxlength="50"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-2">Cidade</label>
							<div class="col-md-4">
								<input value="<?=  isset($view->cidade) ? $view->cidade : null ;?>" name="cidade" id="cidade" type="text" class="form-control" maxlength="50"/>
							</div>
							<label class="control-label col-md-2">Estado</label>
							<div class="col-md-2">
								<input value="<?=  isset($view->uf) ? $view->uf : null ;?>" name="uf" id="uf" type="text" class="form-control" maxlength="2" style="text-transform: uppercase"/>
							</div>
						</div>