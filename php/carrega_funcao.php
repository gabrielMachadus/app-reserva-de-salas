<?php
	require 'conecta_banco.php';
	$sql = "SELECT funcao.id_funcao AS 'ID',funcao.nome AS 'NOME' FROM funcao";
	$result = mysqli_query($conexao,$sql);
	$cont = mysqli_affected_rows($conexao);

	$return = '<div class="form-group">';
	$return .= '  <label for="sel1">Função</label>';
	
	if ($cont > 0) {
		$return .= '  <select class="form-control" name="funcao">';
		while ($linha = mysqli_fetch_array($result)) {   
			$return .= '<option value = '.$linha["ID"].'>'.$linha["ID"].'-'.utf8_encode($linha["NOME"]).'</option>';
		}
		$return .= '  </select> </div>';
		echo $return;
	}else{
	echo "<select class='form-control' name='funcao' required=''><option value = 0>Necessario Cadastrar funcao</option></select></div>";           		 
	}
	mysqli_close($conexao); 
?>	