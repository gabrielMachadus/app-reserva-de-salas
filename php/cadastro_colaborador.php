<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Cadastro de Funcionários</title>

	    <!-- Bootstrap core CSS -->
	  <link href="../css/bootstrap.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript">
      	$("#telefone").mask('(00)00000-0000');
      	function troca_maskara(x){
            var cmp_fone = document.getElementById("telefone");
            
            switch(x){
              case 0:
                $("#telefone").mask('(00)0000-0000');
                cmp_fone.placeholder = "(00)0000-0000";
                break;
              case 1:
                cmp_fone.placeholder = "(00)00000-0000";
                $("#telefone").mask('(00)90000-0000');
                break;
            }
         }
      </script>
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
	    		<h1 class="p-3 text-center">Cadastro de funcionário</h1>
				<div class="form-group">
				  <label for="nome">Nome Completo:</label>
				  <input type="text" class="form-control" name="nome" autofocus required="" placeholder="Digite o nome do funcionario aqui" style="text-transform: uppercase;">
				</div>
				<div class="form-group">
				  <label for="email">E-Mail:</label>
				  <input type="email" class="form-control" name="email" required="" placeholder="funcionario@empresa.com.br" style="text-transform: lowercase;">
				</div>
				<div class="form-group">
				  <label for="pwd">Telefone:
				  	<label for="tel_r"><input type="radio" name="tipo_tel" id="tipo_tel" value=0 onclick="troca_maskara(0)">Residencial/Comercial</label>
          			<label for="tel_c"><input type="radio" name="tipo_tel" id="tipo_tel" value=1 checked onclick="troca_maskara(1)">Celular</label>          			
				  </label>
				  <input type="text" class="form-control phone-ddd-mask" name="tel" value="(00)00000-0000" required="" maxlength="16" id='telefone'>
				</div>
				<?php
					require 'carrega_empresa.php';
				?>
				<?php
					require 'carrega_funcao.php';
				?>
				
			  	<input type="submit" class="btn btn-primary btn-block" value="Cadastrar funcionário"></input>
       			<a class="btn btn-primary btn-block" href="excluir_colaborador.php">Excluir funcionário</a>
       			<a class="btn btn-primary btn-block" href="cadastro_funcao.php">Cadastro de Função</a>   
			</form>
			<?php
        		error_reporting(0);
				$nome = utf8_decode($_POST["nome"]);
				$email = $_POST["email"];
				$tel = $_POST["tel"];
				$id_funcao = $_POST['funcao'];
				$id_empresa = $_POST['empresa'];

				require 'conecta_banco.php';

		        $sql = "INSERT INTO colaborador(nome_completo,email,id_funcao,telefone,id_empresa) VALUES (UPPER('".$nome."'),LOWER('".$email."'),".$id_funcao.",'".$tel."',".$id_empresa.");";

		        $result = mysqli_query($conexao,$sql);        
		        $cont = mysqli_affected_rows($conexao);
		        mysqli_close($conexao);
		        if($cont>0){
		           echo "<div><h1>Cadastrado o novo colaborador!</h1> </div>";
		            echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=">';
		        }
			?>
		</div>	
	</div>	
</body>
</html>