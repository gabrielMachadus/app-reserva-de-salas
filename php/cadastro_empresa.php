<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">
	    <title>Cadastro de Empresa</title>
	    <link href="../css/bootstrap.css" rel="stylesheet">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
          echo "<h1>SEM USUÁRIO LOGADO, favor efetuar LOGIN. <br>Você será redirecionado em instantes.</h1>";
          echo '<me    <div class="row">
ta HTTP-EQUIV="Refresh" CONTENT="5; URL=../">';
        /*arquivo não existe, de forma proposital 
        para não mostrar o conteudo gerado pela pagina*/
         require 'erro.php';
        }
    ?>  
<div class="container">  
      <div class="col-xs-12 col-md-12 col-lg-12">
      <form method="POST" action="">
          <h1 class="p-3 text-center">Cadastro de Empresa</h1>
        <div class="form-group">
          <label for="nome">Nome da Empresa:</label>
          <input type="text" class="form-control" name="nome" autofocus required="" placeholder="Ex: Baduchi - Porto Alegre"  style="text-transform: uppercase;">
        </div>
        <div class="form-group">
          <label for="endereco">Endereço da Empresa:</label>
          <input type="text" class="form-control" name="endereco" autofocus required="" placeholder="Ex: Av. Torquarto Servero, 111, Bairro Anchieta, Porto Alegre - RS"  style="text-transform: uppercase;">
        </div>
        <div class="form-group">
          <label for="cnpj">CNPJ:
              <input type="text" class="form-control" name="cnpj" id="cnpj" autofocus required="" placeholder="00.000.000/0000-00" >
          </label>
          
          <label for="tel">Telefone:
          <label for="tel_r"><input type="radio" name="tipo_tel" id="tipo_tel" value=0 onclick="troca_maskara(0)">Residencial/Comercial</label>
          <label for="tel_c"><input type="radio" name="tipo_tel" id="tipo_tel" value=1 checked onclick="troca_maskara(1)">Celular</label>
          <input type="text" class="form-control" name="fone" id="fone" autofocus required="" placeholder="(00)00000-0000" >
          </label>
          
        </div>
        <script type="text/javascript">
          $("#cnpj").mask('00.000.000/0000-00');
          $("#fone").mask('(00)00000-0000');
          function troca_maskara(x){
            var cmp_fone = document.getElementById("fone");
            switch(x){
              case 0:
                $("#fone").mask('(00)0000-0000');
                cmp_fone.placeholder = "(00)0000-0000";
                break;
              case 1:
                cmp_fone.placeholder = "(00)00000-0000";
                $("#fone").mask('(00)00000-0000');
                break;
            }
          }
          
        </script>
       
        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>      
      </form>
    </div>  
    <?php
      
      $nome = $_POST['nome'];
      $cnpj = $_POST['cnpj'];
      $fone = $_POST['fone'];
      $endereco = $_POST['endereco'];
      require 'conecta_banco.php';

      if(isset($nome)){
        $sql = "INSERT INTO empresa (nome,cnpj,fone,endereco) VALUES(UPPER('".$nome."'),'".$cnpj."','".$fone."','".$endereco."');";
        $result = mysqli_query($conexao,$sql);        
        $cont = mysqli_affected_rows($conexao);
        if($cont === 1){
            echo "<div><h1>Cadastro da empresa efetuado com sucesso!</h1></div>";
            echo '<meta HTTP-EQUIV="Refresh" CONTENT="2; URL=cadastro_empresa.php">';
        }
        mysqli_close($conexao);
      }

      
    ?>
  </div>   
</body>
</html>