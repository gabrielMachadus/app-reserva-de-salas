<?php
	function carregar_colaborador_filtrado($x){
		require 'conecta_banco.php';

		if($x == 0){
			//encontra colaboradores sem filtro e ordena por nome
			$sql_no_filter = "SELECT id_colaborador AS 'ID',nome_completo AS 'NOME' FROM colaborador ORDER BY nome_completo";
			$sql = $sql_no_filter;
		}elseif($x == 1){
			//filtra colaboradores que não tem usuario
			$sql_filter = "SELECT id_colaborador AS 'ID',nome_completo AS 'NOME' FROM colaborador WHERE id_colaborador NOT IN (select id_colaborador from usuario) ORDER BY nome_completo";
			$sql = $sql_filter;
		}
		elseif($x == 2){
			//seleciona os usuarios existentes
			$sql_filter = "SELECT id_usuario AS 'ID',nome AS 'NOME' FROM usuario ORDER BY id_usuario";
			$sql = $sql_filter;
		}elseif($x == 3){
			//seleciona os usuarios existentes
			$sql_filter = "SELECT id_colaborador AS 'ID',nome_completo AS 'NOME',id_funcao FROM colaborador WHERE id_funcao != 3 ORDER BY nome_completo";
			$sql = $sql_filter;
		}
		
		$result = mysqli_query($conexao,$sql);
		$cont = mysqli_affected_rows($conexao);
		$return = '<div class="form-group">';
		if($x==2){
			$return .= '  <label for="sel1">Nome do usuario: </label>';
		}else{
			$return .= '  <label for="sel1">Nome do Colaborador: </label>';
		}
		
		
		if ($cont > 0) {
			$return .= '  <select class="form-control" name="colaborador_id">';
			while ($linha = mysqli_fetch_array($result)) {   
				$return .= '<option value = '.$linha["ID"].'>'.utf8_encode($linha["NOME"])." - ID [".$linha["ID"].']</option>';
			}
			$return .= '  </select> </div>';
			echo $return;
		}else{
			echo "<select class='form-control' name='colaborador_id' required=''><option value = 0>Necessario cadastrar colaborador</option></select></div>";  
		}
		mysqli_close($conexao); 
	}	
?>	