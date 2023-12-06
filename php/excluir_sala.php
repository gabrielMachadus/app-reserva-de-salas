<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Excluisão de Sala</title>

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
	    		<h1 class="p-3 text-center">Exclusão de Sala</h1>
	    		<div style="border: 1px solid black;margin-bottom: 5px;" class="btn-primary">
	    			<h3>OBS: Tenha em mente de que ao <strong>excluir a sala</strong> você irá <strong>apagar todos os registros </strong> da mesma no sistema.</h3>
	    		</div>
				
				<?php
					require 'carrega_salas.php';
				?>
				
			  <input type="submit" class="btn btn-primary btn-block" value="Excluir Sala"></input>
			  <a type="button" href="cadastro_sala.php" class="btn btn-primary btn-block">Retornar ao cadastro</a>
			</form>
			<?php
       			
				$id_sala = $_POST['sala_id'];				

				require 'conecta_banco.php';
				if(isset($id_sala)){
					$sql = "DELETE FROM reserva WHERE id_sala=".$id_sala;
			        $result = mysqli_query($conexao,$sql);        
			        $cont = mysqli_affected_rows($conexao);

					$sql = "DELETE FROM sala WHERE id_sala=".$id_sala;
			        $result = mysqli_query($conexao,$sql);        
			        $cont = mysqli_affected_rows($conexao);
			        mysqli_close($conexao);
			        if($cont>0){
			                echo "<div class='alert alert-success'><strong>Successo</strong> ao Excluir a Sala e seus registros! </div>";
			                echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=">';
			        }
				}

		       
			?>
		</div>	
	</div>	
</body>
</html>