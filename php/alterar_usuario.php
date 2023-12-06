<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Alterar de Usuário</title>

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
	    		<h1 class="p-3 text-center">Alterar Usuário</h1>

        <?php
          require 'carrega_colaborador.php';
          carregar_colaborador_filtrado(2);
        ?>  

				<div class="form-group">
				  <label for="nome">Nome de Usuário:</label>
				  <input type="text" class="form-control" name="usuario" autofocus required placeholder="Ex: Marsh.Mellow" maxlength="20" max="20" min="5">
				</div>
				
        <div class="form-group">
          <input type="checkbox" id="checkbox_senha" name="checkbox_senha" checked="true" onclick="campo_senha();" value="QWas12@#">
        	<label for="SENHA" id="lb_senha">Senha Padrão: QWas12@#</label>
          <input class="form-control" name="cmp_senha2" type="password" id="cmp_senha2"   style="display:none;" max="15" maxlength="15">
        </div> 

        <div class="form-group"> 
            <label for="turno">Nivel de acesso</label>  
            <select class="form-control" name="id_acesso" id="id_acesso">
              <option value="1">1 - Administrador do Sistema</option>
              <option value="2" selected>2 - Acesso de Consulta</option>
            </select>
           </div>     
        
			  <button type="submit" class="btn btn-primary btn-block">Alterar</button>
        <a type="button" class="btn btn-primary btn-block" href="cadastro_usuario.php">Voltar ao Cadastro</a>	
      </form>
		</div>	
    <?php
     
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

      $sql = "UPDATE usuario SET nome = '".$usuario."', senha='".$cmp_senha."', nivel_acesso = ".$nv_acesso." WHERE id_usuario=".$colaborador_id;
      $result = mysqli_query($conexao,$sql);  
      $cont = mysqli_affected_rows($conexao);
     

      if($cont == 1){
          echo "<div class='btn-primary'><h2>Alterado o Usuário com sucesso, redirecionando a pagina de cadastro!</h2></div>";
          echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=cadastro_usuario.php">';
                 
      }elseif ($cont === -1) {

       
      }elseif($cont == 0){
           echo "<div><h2>Não foi possivel alterar o Usuário, redirecionando a pagina de cadastro!</h2></div>";
            echo '<meta HTTP-EQUIV="Refresh" CONTENT="5; URL=cadastro_usuario.php">';
      }
      
      mysqli_close($conexao);
    ?>
	</div>	
</body>
</html>