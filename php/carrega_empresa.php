<?php
	require 'conecta_banco.php';
	$sql = "SELECT empresa.id_empresa AS 'ID',empresa.nome AS 'NOME' FROM empresa ORDER BY empresa.id_empresa";
	$result = mysqli_query($conexao,$sql);
	$cont = mysqli_affected_rows($conexao);
	$return = '<div class="form-group">';
	$return .= '  <label for="sel1">Empresa</label>';
	
	if ($cont > 0) {
		$return .= '  <select class="form-control" name="empresa">';
		while ($linha = mysqli_fetch_array($result)) {   
			$return .= '<option value = '.$linha["ID"].'>'.$linha["ID"].'-'.utf8_encode($linha["NOME"]).'</option>';
		}
		$return .= '  </select> </div>';
		echo $return;
	}else{
	echo "<select class='form-control' name='empresa' required=''><option value = 0>Necessario Cadastrar empresa</option></select></div>";           		 
	}
	mysqli_close($conexao); 
?>	