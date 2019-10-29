<!-- /.modal Confirmação de Exclusão -->
<div class="modal fade bs-modal-sm" id="confirma-exclusao" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Confirmação de exclusão</h4>
			</div>
			<div class="modal-body">
				 Você tem certeza que deseja excluir esse(s) registro(s) ? 
			</div>
			<div class="modal-footer">
				<input type="hidden" name="idExclusao" id="idExclusao" value="">
				<button type="button" class="btn default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger">Apagar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>


    jQuery(document).ready(function() {

        //Passando ação do button do formulario 
        $("#idRegistro").click(function() {
        	//Recebe o value do button clicado
			var idRegistro = this.value;
			alert(idRegistro);
			//altera o value do hidden que vai no POST do formulario
			$("#idExclusao").attr('value', idRegistro);
		});

    });

</script>    