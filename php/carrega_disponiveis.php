<?php
	require 'conecta_banco.php';
	 $sql .= "SELECT  s.id_sala AS 'ID',s.n_sala AS 'SALA', s.computadores AS 'COMPUTADORES', s.lugares AS 'LUGARES',t.nome AS 'TIPO'";
        $sql .= " FROM sala AS s ,tipo_sala AS t WHERE t.id_tipo=s.id_tipo ORDER BY s.n_sala ASC";
	$result = mysqli_query($conexao,$sql);
	$cont = mysqli_affected_rows($conexao);
	$return = '<div class="form-group">';
	$return .= '  <label for="sel1">Salas Disponiveis</label>';
	
	if ($cont > 0) {
		$return .= '  <select class="form-control" name="sala_id">';
		while ($linha = mysqli_fetch_array($result)) {   
			$return .= '<option value = '.$linha["ID"].'>['.$linha["ID"].'] - '.$linha["SALA"].' - '.utf8_encode($linha["TIPO"]).' - PCS: '.$linha["COMPUTADORES"].' - LUGARES: '.$linha["LUGARES"].'</option>';
		}
		$return .= '  </select> </div>';
		echo $return;
	}else{
		$return .=  "<script>
						document.getElementById('btn_cadastrar').disabled = true;
						document.getElementById('btn_cancelar').disabled = true;
					</script>" ; 
	$return .=  "<select class='form-control' name='sala_id' required=''><option value = 0>Não existem mais salas disponiveis</option></select></div>"; 
	echo $return;          		 
	}
	mysqli_close($conexao); 
?>	