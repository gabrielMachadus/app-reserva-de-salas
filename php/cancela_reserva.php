<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Cancelamento de Reserva</title>

	    <!-- Bootstrap core CSS -->
	    <link href="../css/bootstrap.css" rel="stylesheet">
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style type="text/css">
			input{
				margin-top:10px;
			}
		</style>
  	</head>
  	<body>
	 <?php
    	error_reporting(0);
    	session_start();
     	 if($_SESSION['nivel_acesso']==1){
          	require "header_admin.php";
    	 }elseif($_SESSION['nivel_acesso']==2){
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
		    		<h1 class="p-3 text-center">Cancelamento de Reserva da Sala</h1>
					<div class="form-group">
					  <?php
						require 'carrega_reservas.php';
					  ?>
					  <input type="submit" class="btn btn-primary btn-block" value="Cancelar Reserva"></input>
					</div>
					
				</form>
			</div>
		</div>
			<?php
       			error_reporting(0);
				$id_reserva = $_POST["reserva_id"];
				
				require 'conecta_banco.php';
				if($id_reserva!==0){
					if(isset($id_reserva)){
					$sql = "UPDATE reserva SET ativo=0 WHERE id_reserva = ".$id_reserva;
					
			        $result = mysqli_query($conexao,$sql);        
			        $cont = mysqli_affected_rows($conexao);
			       
			       echo "<div class='alert alert-success alert-dismissible close'><a href='#' aria-label='close' data-dismiss='alert'>&times;</a><strong>Successo!</strong> ao Cancelar a Reserva da Sala! </div>";
			        echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=">';
			    }
				}
				
				
				 mysqli_close($conexao);
				
			?>
	</div>	
</body>
</html>