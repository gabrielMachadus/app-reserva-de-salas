<?php
	require 'conecta_banco.php';
	$sql .= "SELECT  id_tipo AS 'ID' , nome AS 'NOME' FROM tipo_sala ;";
	$result = mysqli_query($conexao,$sql);
	$cont = mysqli_affected_rows($conexao);
	$return = '<div class="form-group">';
	$return .= '  <label for="turno">Tipo da Sala</label>';
	
	if ($cont > 0) {
		$return .= '  <select class="form-control" name="tipo_sala_id">';
		while ($linha = mysqli_fetch_array($result)) {   
			$return .= '<option value = '.$linha["ID"].'>['.$linha["ID"].'] - '.utf8_encode($linha["NOME"]).'</option>';
		}
		$return .= '  </select> </div>';
		echo $return;
	}else{
	echo "<select class='form-control' name='tipo_sala_id' required=''><option value = 0>Sem Tipos de Sala Cadastrados</option></select></div>";           		 
	}
	mysqli_close($conexao); 
?>	