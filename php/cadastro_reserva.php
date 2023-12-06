<html lang="pt-BR">
  	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta HTTP-EQUIV="Refresh" CONTENT="120; URL=cadastro_reserva.php";>
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../css/img/favicon.ico">

	    <title>Cadastro de Reserva</title>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="../css/bootstrap.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script type="text/javascript" src="../js/scripts_page.js"></script>
    </head>
    <body onload="data_hoje()">
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
            <h1 class="text-center">Criar Reserva</h1>
            <?php
              require 'carrega_colaborador.php';
              carregar_colaborador_filtrado(3);
            ?>
            <?php
              require 'carrega_disponiveis.php';
            ?>

           <div class="form-group"> 
            <label for="turno">Turno</label>  
            <select class="form-control" name="turno_id" id="turno_id" onchange="muda_hora_turno();">
              <option value="1" >1-Manhã</option>
              <option value="2">2-Tarde</option>
              <option value="3" selected="true">3-Noite</option>
            </select>
           </div>              
           <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <label>Data e Hora do Registro:
                  <input class="form-control" type="datetime-local" id="dt_hr_registro"  name="dt_hr_registro" readonly="true" required>
                </label>
                <label> Data da Reserva:
                    <input class="form-control" type="date" id="dt_reserva" name="dt_reserva" required>
                </label>
                <label>Hora da Entrada:
                    <input class="form-control" type="time" id="hr_entrada" name="hr_entrada" value="19:00" required>
                </label>
                <label>Hora da Saída :
                  <input class="form-control" type="time" id="hr_saida" name="hr_saida" value="22:30" required >
                </label>
            </div>
          <button type="submit" class="btn btn-primary btn-block" id="btn_cadastrar">Cadastrar</button> 
          <a href="cancela_reserva.php" class="btn btn-primary btn-block" id="btn_cancelar">Cancelar Reserva</a>     
        </form>
    </div>  
    <?php
      error_reporting(0);
      
      $colaborador_id = $_POST['colaborador_id'];
      $sala_id = $_POST['sala_id'];
      $turno_id = $_POST['turno_id'];
      $data_hora_registro = $_POST['dt_hr_registro'];
      $data_reserva = $_POST['dt_reserva'];
      $hora_saida = $_POST['hr_saida'];
      $hora_entrada = $_POST['hr_entrada'];

      
      require 'conecta_banco.php';

      
      //FAZ VERIFICAÇÃO SE A PESSOA JÁ TEM RESERVA ATIVA NA DATA ESPECIFICADA E HORA QUE SELECIONOU
      //HORARIO ENTRE HORA INICIAL E HORA FINAL NA DATA DA RESERVA PARA A PESSOA X
      $sql1 =  "SELECT p.nome_completo AS 'Nome',s.n_sala AS 'Sala',t.nome AS 'Turno',r.hora_entrada,r.hora_saida,r.data_reserva AS 'DT_RESERVA',r.data_hora_registro AS 'Registro' FROM colaborador AS p, sala AS s,turno AS t,reserva as r WHERE p.id_colaborador = r.id_colaborador AND s.id_sala = r.id_sala AND t.id_turno = r.id_turno AND r.hora_entrada BETWEEN '".$hora_entrada."' AND '".$hora_saida."' AND r.hora_saida BETWEEN '".$hora_entrada."' AND '".$hora_saida."' AND r.data_reserva LIKE '".$data_reserva."' AND ativo =  1 AND r.id_sala = ".$sala_id;
      //print($sql1);
      $result = mysqli_query($conexao,$sql1);
      
      $cont = mysqli_affected_rows($conexao);
      //print_r("<br>Cont:".$cont);
      if($cont>0)
      {
        // ja tem reserva efetuada para a sala nesta data e hora
      echo "<div><h1>Existe colaborador(a) que contém  registro de reserva cadastrada nesta data e horário!</h1><meta HTTP-EQUIV='Refresh' CONTENT='8; URL=cadastro_reserva.php'>";
        
        $tabela = " <br><table class='table table-bordered table-hover '>
                    <thead>
                      <th>Data e Hora do registro</th>
                      <th>Sala</th>
                      <th>Turno</th>
                      <th>Data da Reserva</th>
                      <th>Hora de entrada</th>
                      <th>Hora de saída</th>
                      <th>Colaborador</th>
                    </thead>
                    <tbody>";
        while ($linha = mysqli_fetch_array($result))
        {   
          
          $tabela.="<tr>
                  <td>".date("d/m/Y H:i",strtotime($linha["Registro"]))."</td>
                  <td>".$linha["Sala"]."</td>
                  <td>".utf8_encode($linha["Turno"])."</td>
                  <td>".date("d/m/Y",strtotime($linha["DT_RESERVA"]))."</td>
                  <td>".$linha["hora_entrada"]."</td>
                  <td>".$linha["hora_saida"]."</td>
                  <td>".utf8_encode($linha["Nome"])."</td>
                </tr>";
             
        }
        $tabela .="</tbody>
            </table></div>";
        echo $tabela;
       
        
      }else{
        
        
        //caso não tenha, faz verificação dos campos e ai faz o cadastro
        
        if(isset($colaborador_id) && isset($sala_id) && isset($turno_id) && isset($data_hora_registro) && isset($hora_entrada) && isset($hora_saida))
        {

          $hora_entrada = date("H:i",strtotime($hora_entrada));
          $hora_saida = date("H:i",strtotime($hora_saida));
          $data_reserva = date("Y-m-d",strtotime($data_reserva));
          $data_hora_registro = date("Y-m-d H:i",strtotime($data_hora_registro));
          //faz o registro na tabela de reserva temporaria
          //fazer trigger nesta tabela para cancelamentos automaticos e para que o registro seja desativado automaticamente depois do periodo da reserva passar. criar campo ativo tinyint(0,1) para fazer isso
          $sql = "INSERT INTO reserva (id_colaborador,id_sala,id_turno,data_hora_registro,hora_saida,hora_entrada,data_reserva,ativo) VALUES(".$colaborador_id.",".$sala_id.",".$turno_id.",'".$data_hora_registro."','".$hora_saida."','".$hora_entrada."','".$data_reserva."',1);";
          //print_r("SQL RESERVA: <br>".$sql."<br>");
          $result = mysqli_query($conexao,$sql);        
          $cont = mysqli_affected_rows($conexao);

          if($cont === 1)
          {
            echo "<div><h1>Cadastro da reserva efetuado com sucesso!</h1></div>";
            echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=cadastro_reserva.php">';
          }elseif ($cont === -1) {
          	echo "<div><h1>Ocorreu algum erro, recarregando página.</h1></div>";
			      echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=cadastro_reserva.php">';
          }
          mysqli_close($conexao);

        }
        
      }
    ?>
  </div>   
</body>
</html>


