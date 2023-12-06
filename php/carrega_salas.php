<?php
	require 'conecta_banco.php';
	$sql = "SELECT * FROM sala ORDER BY n_sala";
	$result = mysqli_query($conexao,$sql);
	$cont = mysqli_affected_rows($conexao);
	$return = '<div class="form-group">';
	$return .= '  <label for="sel1">Escolha uma sala para excluir:</label>';
	
	if ($cont > 0) {

		$return .= '  <select class="form-control" name="sala_id">';
		while ($linha = mysqli_fetch_array($result)) {   
			$return .= '<option value = '.$linha["id_sala"].'>'.$linha["n_sala"].'</option>';
		}

		$return .= '  </select> </div>';
		echo $return;
	}else{
	echo "<select class='form-control' name='sala_id' required=''><option value = 0>Necessario Cadastrar sala</option></select></div>";           		 
	}
	mysqli_close($conexao); 
?>	