<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Cadastro de Função</title>

	     <link href="../css/bootstrap.css" rel="stylesheet">
      
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
          <h1 class="p-3 text-center">Cadastro de Função</h1>
        <div class="form-group">
          <label for="nome">Nome da Função</label>
          <input type="text" class="form-control" name="funcao" autofocus required="" placeholder="Digite o nome da função aqui"  style="text-transform: uppercase;">
        </div>
       
        <button type="submit" class="btn btn-primary btn-block">Cadastrar Função</button> 
        <a class="btn btn-primary btn-block" href="cadastro_colaborador.php">Voltar ao Cadastro de Colaborador</a>     
      </form>
    </div>  
    <?php
      error_reporting(0);
      $funcao = $_POST['funcao'];
      
      require 'conecta_banco.php';

      if(isset($funcao)){
        $sql = "INSERT INTO funcao (nome) VALUES(UPPER('".$funcao."'));";
        $result = mysqli_query($conexao,$sql);        
        $cont = mysqli_affected_rows($conexao);
        if($cont === 1){
            echo "<div><h1>Cadastro da função efetuado com sucesso!</h1></div>";
            echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=cadastro_funcao.php">';
        }
        mysqli_close($conexao);
      }

      
    ?>
  </div>    
</body>
</html>