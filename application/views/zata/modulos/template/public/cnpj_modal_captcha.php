<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="width:250px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">***  RECEITA FEDERAL ***</h4>
			</div>
			<form id="processaCNPJ" method="post">
				<!--<form id="processaCNPJ" method="post">-->
			<div class="modal-body">
				  <img src="<?= base_url() ?>zata/cnpjgetcaptcha" style="height: 100%; width: 180px; display: block;">
				 	
					  <div class="form-group">
							<label class="control-label">Digite os caracteres acima:</label>
							<input type="hidden" id="CNPJ"  name="CNPJ" maxlength="19"/> 
							<input type="text" id="CAPTCHA" name="CAPTCHA" maxlength="6" required class="form-control" style="width: 200px; display: block;">
					  </div>
				   	  
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn yellow"><i class="fa fa-search"></i> Buscar</button>
				<button type="button" class="btn default" data-dismiss="modal">Fechar</button>
			</div>
			</form> 
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<script>
    jQuery(document).ready(function() {
        //Botao Buscar pelo CNPJ do formulario 
        $('#buscarCNPJ').click(function() {
            //Passando o numero do cnpj para a requisição
            var cnpj = $("#numCNPJ").attr('value');

            $("#CNPJ").val(cnpj.replace("." , "").replace("/" , "").replace("-" , "").replace("." , ""));

        });



		// Variavel de pedido
			var request;

			xhr = function(text){
				console.log(request);
			}


			    // Submit do Formulario
			$("#processaCNPJ").submit(function(){

			    // Abortar qualquer solicitação pendente
			    if (request) {
			        request.abort();
			    }
			    // configuração de algumas variáveis locais
			    var $form = $(this);

			    // Vamos selecionar e armazenar em cache todos os campos
			    var $inputs = $form.find("input, select, button, textarea");

			    // Serializar os dados no formulário
			    var serializedData = $form.serialize();

			    // Vamos desativar as entradas para a duração da solicitação do Ajax..
			    // Nota: nós desativar elementos APÓS os dados do formulário tem sido serializado
			    // Elementos de formulário com deficiência não serão serializados
			    $inputs.prop("disabled", true);

			    // Disparar pedido
			    request = $.ajax({
			        url: "<?= base_url() ?>zata/cnpjgetcaptcha/buscar",
			        type: "post", data: serializedData,
			        success: resposta
			    });

			    // Manipulador de retorno de chamada que será chamada em caso de sucesso
			    request.done(function (response, textStatus, jqXHR){
			        // Registrar uma mensagem para o consolee
			        console.log("funcionou!");
			        
			    });

			    // Manipulador de retorno de chamada que será chamada em caso de falha
			    request.fail(function (jqXHR, textStatus, errorThrown){
			        // O log de erro para o console
			        console.error(
			            "Ocorreu o seguinte erro: "+
			            textStatus, errorThrown
			        );
			    });

			    // Manipulador de retorno de chamada que será chamada, independentemente
			    // se o pedido falhou ou teve sucesso
			   request.always(function () {
			        // Reativá as entradas
			        $inputs.prop("disabled", false);
			    });

			    //Impedirá a publicação padrão de formulário
			    event.preventDefault();

			});

    });

function resposta(dados){

	var obj = JSON.parse(dados);
	
	document.getElementById('nome_fantasia').value = obj[2];

	//alert (obj);

	//fecharModal();
	//$("#basic").dialog("close");
	console.log(obj);
}

	
</script>