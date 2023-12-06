<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">
		<title>Validando Login</title>
	  </head>
  	<body>
	  	<div class="container">
	  		<div class="row">
			<?php
				session_start();
				$nome_usuario = $_POST['usuario'];
				$senha_usuario = $_POST['senha'];
				//echo '<br>'.$nome_usuario.'->'.$senha_usuario;
				require 'conecta_banco.php';
			    $sql = "SELECT nome,senha,nivel_acesso FROM usuario WHERE nome = '".$nome_usuario."' AND senha = '".$senha_usuario."';";
			    //echo '<br>'.$sql;
			    $result = mysqli_query($conexao,$sql);
			    $cont = mysqli_affected_rows($conexao);
			    //echo '<br>'.$cont;
			    // Verifica se a consulta retornou linhas 
			    if ($cont > 0) {
			        // Captura os dados da consulta e inseri na tabela HTML
			        while ($linha = mysqli_fetch_array($result)) {
			        	/*
			        		echo "<br>".$nome_usuario ."=>". $linha["nome"];
			        		echo "<br>".$senha_usuario ."=>". $linha["senha"];
			        		echo "<br>". strcmp($nome_usuario, $linha["nome"]);
			        		echo "<br>". strcmp($senha_usuario,$linha["senha"]);
			        	*/
			        	if(strcmp($nome_usuario, $linha["nome"]) == 0 ){
			        		if(strcmp($senha_usuario,$linha["senha"])==0){
			        			$_SESSION['usuario'] = $linha["nome"];
								$_SESSION['senha'] = $linha["senha"];
								$_SESSION['nivel_acesso'] = $linha["nivel_acesso"];
								echo '<div style="margin-top:5%;text-align:center;">
									
									<img src="../css/gif/loading.gif" class="img-responsive">
									<h1>Carregando Sistema...</h1>
									<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=mostrar_salas_cadastradas.php">
							 	  </div>';
								break;
			        		}else{
			        			echo '  <div style="margin-top:5%;text-align:center;">
							  <h1>Não foi possivel fazer login. <br>Redirecionando... </h1>
							  <br>
							   <img src="../css/gif/loading.gif" class="img-responsive" >	
							   <h1>Erro: Dados de login incorretos!</h1>
							  <meta HTTP-EQUIV="Refresh" CONTENT="5; URL=../">
							 
							</div>';
							break;
			        		}
						}else{		
							 echo '  <div style="margin-top:5%;text-align:center;">
							  <h1>Não foi possivel fazer login. <br>Redirecionando... </h1>
							  <br>
							   <img src="../css/gif/loading.gif" class="img-responsive" >	
							   <h1>Erro: Dados de login incorretos!</h1>
							  <meta HTTP-EQUIV="Refresh" CONTENT="5; URL=../">
							 
							</div>';
							break;
						}
			        }        
			    } else {
			    	mysqli_close($conexao);
			        // Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
			        echo '  <div style="margin-top:5%;text-align:center;">
							  <h1>Não foi possivel entrar no Sistema. <br>Redirecionando para Tela de Login. </h1>
							   <img src="../css/gif/loading.gif" class="img-responsive" >
							  <br><h1>Erro: Dados de login incorretos, usuario ou senha não existem!</h1>
							  <meta HTTP-EQUIV="Refresh" CONTENT="5; URL=../">
							  	
							</div>';
			    }
			?>	
			</div>				
		</div>
	</body>
</html>