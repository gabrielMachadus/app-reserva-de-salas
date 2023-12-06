<?php
	require 'conecta_banco.php';
	$sql = "SELECT r.id_reserva AS 'ID_RESERVA',r.id_sala, s.n_sala AS 'N_SALA',r.id_colaborador,p.nome_completo AS 'NOME_COLABORADOR',r.data_reserva AS 'DATA_RESERVA', r.data_hora_registro AS 'DATA_HORA_REGISTRO', r.hora_entrada AS 'ENTRADA', r.hora_saida AS 'SAIDA'
	FROM reserva AS r,sala AS s,colaborador AS p WHERE r.id_colaborador = p.id_colaborador AND r.id_sala = s.id_sala AND r.ativo = 1 ORDER BY r.data_reserva DESC";
	
	$result = mysqli_query($conexao,$sql);
	$cont = mysqli_affected_rows($conexao);
	
	if ($cont > 0) {
		$return = '<div class="form-group">';
		$return .= '  <label for="sel1">Seleciona a Reserva:[ID RESERVA] [NOME] [SALA] [REGISTRO] [RESERVA] [ENTRADA] [SAIDA]</label>';
		$return .= '  <select class="form-control" name="reserva_id">';
		while ($linha = mysqli_fetch_array($result)) {   
			$dt_h_entrada = date('H:i',strtotime($linha["ENTRADA"]));
			$dt_h_saida = date('H:i',strtotime($linha["SAIDA"]));
			$dt_reserva = date('d/m/Y',strtotime($linha["DATA_RESERVA"]));
			$dt_registro = date('d/m/Y - H:i',strtotime($linha["DATA_HORA_REGISTRO"]));
			$return .= '<option value = '.$linha["ID_RESERVA"].'>['.$linha["ID_RESERVA"].'] ['.utf8_encode($linha["NOME_COLABORADOR"]).']  ['.$linha["N_SALA"].'] ['.$dt_registro.']  ['.$dt_reserva.']  ['.$dt_h_entrada.']  ['.$dt_h_saida.']'.'</option>';
		}
		$return .= '  </select> </div>';
		echo $return;
	}else{
		echo "<div ><select class='form-control' name='reserva_id' required=''><option value = 0>Não há reservas a cancelar.</option></select></div>";           		 
	}
	mysqli_close($conexao); 
?>	