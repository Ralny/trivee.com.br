	/**
	 * Limpando mascara (String) para poder usar somente numeros nos calculos
	 */
	function moeda2float(ajuste_moeda){

		var ajuste_moeda = ajuste_moeda.replace("R$","");

		ajuste_moeda = ajuste_moeda.replace(".","");

		ajuste_moeda = ajuste_moeda.replace(",",".");

		return parseFloat(ajuste_moeda);
	}

	function moeda2float2(ajuste_moeda){

		var ajuste_moeda = ajuste_moeda.replace("R$","");

		ajuste_moeda = ajuste_moeda.replace(",",".");

		return parseFloat(ajuste_moeda);

	}

	/**
	 * Preparando para exibir
	 * Obs. Não estou utilizando essa função, eu utilizo a função nativa [.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })]
	 */	
	function float2moeda(num) {

		x = 0;

		if(num<0) {
			num = Math.abs(num);
			x = 1;
		}

		if(isNaN(num)) num = "0";
		cents = Math.floor((num*100+0.5)%100);

		num = Math.floor((num*100+0.5)/100).toString();

		if(cents < 10) cents = "0" + cents;
        
        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
			num = num.substring(0,num.length-(4*i+3))+'.'
		    +num.substring(num.length-(4*i+3));

		ret = num + ',' + cents;    

		if (x == 1) ret = ' - ' + ret;

		return ret;
	}

	
	/**
	 * Resetando Combo (Toda vez que muda a filtragem, elimina a consuta anterior)
	 */
	function resetaCombo( el) {
		
		/**
		 * Setaando o campo que ira ser limpo
		 */
		
		$("select[name='"+ el +"']").empty();

		var option = document.createElement('option');                                  
		$("#s2id_" + el + " span[class='select2-chosen']").text('Selecionar...');
		$( option ).attr( {value : ''} );
		$( option ).append( '' );
		$("select[name='"+el+"']").append( option );
	}
