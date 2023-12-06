<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Cadastro de Usuários</title>

	      <link href="../css/bootstrap.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
          function campo_senha(){

            var checkBox = document.getElementById("checkbox_senha");
            // Get the output text
            var cmp_senha2 = document.getElementById("cmp_senha2");

            if (checkBox.checked === false){
              cmp_senha2.style.display = "block";

              cmp_senha2.placeholder = "Digite a Senha para o Usúario.";
              
            } else {
              cmp_senha2.style.display = "none";
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
	    		<h1 class="p-3 text-center">Cadastro de Usuário</h1>
				<div class="form-group">
				  <label for="nome">Nome de Usuário:</label>
				  <input type="text" class="form-control" name="usuario" autofocus required="" placeholder="Digite o nome do usuario aqui" style="text-transform: uppercase;" maxlength="20" max="20" min="5">
				</div>
				<?php
			    require 'carrega_colaborador.php';
          carregar_colaborador_filtrado(1);
		    ?>  
        <div class="form-group">
          <input type="checkbox" id="checkbox_senha" name="checkbox_senha" checked="true" onclick="campo_senha();" value="QWas12@#">
        	<label for="SENHA" id="lb_senha">Senha Padrão: QWas12@#</label>
          <input class="form-control" name="cmp_senha2" type="password" id="cmp_senha2"   style="display:none;" max="10" maxlength="10" =>
        </div> 

        <div class="form-group"> 
            <label for="turno">Nivel de acesso</label>  
            <select class="form-control" name="id_acesso" id="id_acesso">
              <option value="1">1 - Administrador do Sistema</option>
              <option value="2" selected>2 - Acesso de Consulta</option>
            </select>
           </div>     
        
			  <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>	
        <a type="button" class="btn btn-primary btn-block" href="alterar_usuario.php">Alterar Usuario</a>  
         <a type="button" class="btn btn-primary btn-block" href="excluir_usuario.php">Excluir Usuario</a>  
      </form>
		</div>	
    <?php
      error_reporting(0);
      $usuario = $_POST['usuario'];
      $colaborador_id = $_POST['colaborador_id'];
      $checkbox_senha = $_POST['checkbox_senha'];
      $nv_acesso = $_POST['id_acesso'];
     
      
     if(isset($_POST['checkbox_senha'])){
        $cmp_senha = $_POST['checkbox_senha'];
      }
      else{
      $cmp_senha = $_POST['cmp_senha2'];
      }
      
      
      require 'conecta_banco.php';

      $sql = "INSERT INTO usuario (nome,senha,id_colaborador,nivel_acesso) VALUES(UPPER('".$usuario."'),'".$cmp_senha."',".$colaborador_id.",".$nv_acesso.");";
      
      $result = mysqli_query($conexao,$sql);  
          
      $cont = mysqli_affected_rows($conexao);
     

      if($cont === 1){
          echo "<div><h1>Cadastrado o Usuário com sucesso!</h1></div>";
          echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=cadastro_usuario.php">';
          
      }
      mysqli_close($conexao);
    ?>
	</div>	
</body>
</html>