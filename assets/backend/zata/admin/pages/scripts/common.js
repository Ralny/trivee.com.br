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
		//console.log(ajuste_moeda);
		if (ajuste_moeda == ''){
			return 0;
		}
		else
		{
			var ajuste_moeda = ajuste_moeda.replace("R$","");

			ajuste_moeda = ajuste_moeda.replace(",",".");

			return parseFloat(ajuste_moeda);
		}
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

	/**
	 * Formatando datas 
	 */
	function formatDate(data, formato)
	{
		if (formato == 'pt-br')
		{
		  	return (data.substr(0, 10).split('-').reverse().join('/'));
		}
		else
		{
		  return (data.substr(0, 10).split('/').reverse().join('-'));
		}
	}

	/**
	 * Diferença de dias entre tuas datas
	 */
	function diferenca_entre_datas(data_inicial, data_final)
	{
		
		var data_inicial = formatDate(data_inicial);
		var data_final   = formatDate(data_final);
		
		const now = new Date(data_final); 
		const past = new Date(data_inicial);
		const diff = Math.abs(now.getTime() - past.getTime()); // Subtrai uma data pela outra
		const days = Math.ceil(diff / (1000 * 60 * 60 * 24)); // Divide o total pelo total de milisegundos correspondentes a 1 dia. (1000 milisegundos = 1 segundo).

		return days;

	}
	
	/**
	 * Calcula o valor da diaria pela quantidade de diarias
	 */
	function multiplica_diaria_valor_de_sala(qtd_diarias, $valor_sala)
	{

		var total = qtd_diarias * $valor_sala;

		return total;

	}

	/**
	 * Calcula o intervalo entre duas datas
	 */
	function getDateDiff(date1, date2, interval) {
		var second = 1000,
		    minute = second * 60,
		    hour = minute * 60,
		    day = hour * 24,
		    week = day * 7;
			dateone = new Date(date1).getTime();
			datetwo = (date2) ? new Date().getTime() : new Date(date2).getTime();
		var timediff = datetwo - dateone;
			secdate = new Date(date2);
			firdate = new Date(date1);
			if (isNaN(timediff)) return NaN;
			switch (interval) {
			case "anos":
				return secdate.getFullYear() - firdate.getFullYear();
			case "meses":
		        return ((secdate.getFullYear() * 12 + secdate.getMonth()) - (firdate.getFullYear() * 12 + firdate.getMonth()));
			case "semanas":
				return Math.floor(timediff / week);
			case "dias":
				return Math.floor(timediff / day);
			case "horas":
				return Math.floor(timediff / hour);
			case "minutos":
				return Math.floor(timediff / minute);
			case "segundos":
				return Math.floor(timediff / second);
			default:
				return undefined;
			}
	}

	//dias = getDateDiff('2012-12-25', new Date(), 'dias');
	//total_meses = getDateDiff('2015-05-18', new Date(), 'meses');
	 //anos = getDateDiff('2012-12-25', new Date(), 'anos');
	 
