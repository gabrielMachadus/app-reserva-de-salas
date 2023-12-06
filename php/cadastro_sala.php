<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Cadastro de Sala</title>

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
	    		<h1 class="p-3 text-center">Cadastro de Sala</h1>
				<div class="form-group">
				  <label for="numero">Numero da Sala:</label>
				  <input type="number" class="form-control" name="n_sala" autofocus required="" value="10" min="10">
				</div>
				<div class="form-group">
				  <label for="andar">Andar:</label>
				  <input type="number" class="form-control" name="andar" required="" min=0 max=6 value="0">
				</div> 

				<div class="form-group">
				  <label for="computadores">Computadores:</label>
				  <input type="number" class="form-control" name="n_computadores" required="" min="0" value="0">
				</div>

				<div class="form-group">
				  <label for="lugares">Lugares:</label>
				  <input type="number" class="form-control" name="n_lugares" required="" min=5 max=500 value="5">
				</div>
				
				<?php
					require 'carrega_tipo_sala.php';
				?>
				
			  <input type="submit" class="btn btn-primary btn-block" value="Cadastrar Sala"></input>
			  <a type="button" href="excluir_sala.php" class="btn btn-primary btn-block">Excluir Sala</a>
			</form>
			<?php
       			error_reporting(0);
       			require 'conecta_banco.php';
				$n_sala = $_POST["n_sala"];
				$andar = $_POST["andar"];
				$n_computadores = $_POST["n_computadores"];
				$n_lugares = $_POST['n_lugares'];
				$id_tipo_sala = $_POST['tipo_sala_id'];

				//VERIFICAÇÃO PARA CASO A SALA JÁ EXISTA
				$sql = "SELECT n_sala FROM sala WHERE n_sala = ".$n_sala." ";
				
			    $result = mysqli_query($conexao,$sql);        
			    $cont = mysqli_affected_rows($conexao);
			    //echo "Registros encontrados ->".$cont;
			    
				if($cont > 0){
					 echo "<div class='alert alert-success'>Não pode cadastrar, a sala já existe! </div>";
					 echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=">';
				}else{
					if(isset($n_sala) && isset($andar) && isset($n_computadores) && isset($n_lugares) && isset($id_tipo_sala)){
					$sql = "INSERT INTO sala (n_sala, andar, id_tipo, computadores, lugares) VALUES (".$n_sala.",".$andar.",".$id_tipo_sala.",".$n_computadores.",".$n_lugares.");";
			        $result = mysqli_query($conexao,$sql);        
			        $cont = mysqli_affected_rows($conexao);
			      
				        if($cont>0){
				                echo "<div class='alert alert-success'><strong>Successo</strong> ao Cadastrar a Sala! </div>";
				                echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=">';
				        }
					}
					mysqli_close($conexao);
				}

			?>
		</div>	
	</div>	
</body>
</html>