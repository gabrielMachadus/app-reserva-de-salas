<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Excluir Colaborador</title>

	    <!-- Bootstrap core CSS -->
	    <link href="../css/bootstrap.css" rel="stylesheet">
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	</head>
  	<body>
	<?php
	    error_reporting(0);
	    session_start();
	    if($_SESSION['nivel_acesso']==1){
	        require "header_admin.php";
	    }
	    elseif($_SESSION['nivel_acesso']==2){
	        require "header_consulta.php";
	    }elseif($_SESSION['nivel_acesso']==""){
          echo "<h1>SEM Usuário LOGADO, favor efetuar LOGIN. <br>Você será redirecionado em instantes.</h1>";
          echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=../">';
        /*arquivo não existe, de forma proposital 
        para não mostrar o conteudo gerado pela pagina*/
         require 'erro.php';
        }
	 ?>
	
	<div class="container">	
		<div class="row ">
			<div class="col-xs-12 col-md-12 col-lg-12">
			<form method="POST" action="">
	    		<h1 class="p-3 text-center">Exclusão de colaborador</h1>
	    		<div style="border: 1px solid black;margin-bottom: 5px;" class="btn-primary">
	    			<h3>Tenha em mente de que ao <strong>excluir o colaborador</strong> você irá <strong>apagar todos os registros,reservas, inclusive o usuario</strong> no sistema do colaborador selecionado.</h3>
	    		</div>
				
				<?php
					require 'carrega_colaborador.php';
					carregar_colaborador_filtrado(0);
				?>
				
			  <input type="submit" class="btn btn-primary btn-block" value="Excluir Colaborador"></input>
			  <a type="button" href="cadastro_colaborador.php" class="btn btn-primary btn-block">Retornar ao cadastro</a>
			</form>
			<?php
       			
				$id_colaborador = $_POST['colaborador_id'];				

				require 'conecta_banco.php';
				if(isset($id_colaborador)){
					$sql = "DELETE FROM usuario WHERE id_colaborador=".$id_colaborador;
					echo $sql;
			        $result = mysqli_query($conexao,$sql);        
			        $cont = mysqli_affected_rows($conexao);
			        if($cont > 0){
			        	 echo "<div class='alert alert-success'><strong>Successo ao excluir usuário do sistema! </strong></div>";
			        }else{
			        	echo "<div class='alert alert-success'><strong>Colaborador não contem usuário para excluir do sistema! </strong></div>";
			        }

			        $sql = "DELETE FROM reserva WHERE id_colaborador=".$id_colaborador;
			        echo $sql;
			        $result = mysqli_query($conexao,$sql);        
			        $cont = mysqli_affected_rows($conexao);
			        if($cont > 0){
			        	echo "<div class='alert alert-success'><strong>Reservas do colaborador excluidas do sistema! </strong></div>";
			        }else{
			        	echo "<div class='alert alert-success'><strong>Colaborador não contem reservas para excluir do sistema! </strong></div>";
			        }
			        

			        $sql = "DELETE FROM colaborador WHERE id_colaborador=".$id_colaborador;
			        echo $sql;
			        $result = mysqli_query($conexao,$sql);        
			        $cont = mysqli_affected_rows($conexao);
					if($cont > 0){
						echo "<div class='alert alert-success'><strong>Colaborador excluido do sistema com sucesso! </strong></div>";
						
					}
					echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=">';
			        mysqli_close($conexao);
			        
			             
			        
				}

		       
			?>
		</div>	
	</div>	
</body>
</html>