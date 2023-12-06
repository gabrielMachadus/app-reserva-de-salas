<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <link rel="icon" href="../css/img/favicon.ico">

    <title>Todas as salas</title>

    <link href="../css/bootstrap.css" rel="stylesheet">

    <link href="../css/pricing.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    
    
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
          echo '<meta HTTP-EQUIV="Refresh" CONTENT="3; URL=../">';
        /*arquivo não existe, de forma proposital 
        para não mostrar o conteudo gerado pela pagina*/
         require 'erro.php';
        }
      ?>

<div class="container flex-column flex-md-row align-items-center p-3 px-md-4 mb-3" style="margin-top:30px;">
      <div class="text-center" style="margin-bottom: 10px; ">
        <h1>Todas Salas</h1>
        <p>Estas são as salas a disposição dos Professores da instituição Senai e terceiros. Classificadas por andar.</p>

      </div>
      <!-- 
        Cada item da lista 
        sera criado dinamicamente 
        buscando os dados de cada sala
        no banco de dados
      -->
     <?php
        // Conexao com o banco de dados
        require 'conecta_banco.php';
        
        $sql = "SELECT s.andar AS 'ANDAR', s.n_sala AS 'SALA', s.computadores AS 'COMPUTADORES', s.lugares AS 'LUGARES',t.nome AS 'TIPO' FROM sala AS s ,tipo_sala AS t WHERE t.id_tipo=s.id_tipo ORDER BY s.n_sala ";

        $result = mysqli_query($conexao,$sql);
        $cont = mysqli_affected_rows($conexao);
        // Verifica se a consulta retornou linhas 
        if ($cont > 0) {
            $return = "<div class='container'>"; 
            $return .= agrupa_por_andar($result);
            $return.="</div>";
            mysqli_close($conexao);
            echo $return;
        } elseif ($cont==0){
            // Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
            mysqli_close($conexao);
            echo "<div class='container'><div class='text-center'><h1>Não foram encontrados registros!</h1></div></div>";
          }

          function agrupa_por_andar($resultado){
            $result = $resultado;
            // Captura os dados da consulta e inseri na tabela HTML
            $tabela = "<table class='table table-hover col-12' style='border:2px solid #C0C0C0; border-radius:5px;'>
                          <thead>
                            <th>Sala</th>
                            <th>Computadores</th>
                            <th>Lugares</th>
                            <th>Categoria</th>
                          </thead>
                          <tbody>
                         ";

            //SELECT andar, COUNT(andar)AS "SALAS POR ANDAR" FROM `sala` GROUP BY andar;
            //CONTA QUANTAS SALAS TEM POR ANDAR
            $andar_zero = "<h1>Andar Subsolo</h1>".$tabela;
            $andar_um = "<h1>1º Andar</h1>".$tabela;
            $andar_dois = "<h1>2º Andar</h1>".$tabela;
            $andar_tres = "<h1>3º Andar</h1>".$tabela;
            $andar_quatro = "<h1>4º Andar</h1>".$tabela;

            while ($linha = mysqli_fetch_array($result)) {
              $tmp="";
              $tmp.= '<tr>';
              $tmp.=    '<td>'.utf8_encode($linha["SALA"]).'</td>';
              $tmp.=    '<td>'.utf8_encode($linha["COMPUTADORES"]) .'</td>';
              $tmp.=    '<td>'.utf8_encode($linha["LUGARES"]).'</td>';
              $tmp.=    '<td>'. utf8_encode($linha["TIPO"]).'</td>';
              $tmp.= '</tr>';

              if($linha["ANDAR"]==0){
                $andar_zero .=$tmp;
              }elseif($linha["ANDAR"]==1){
                $andar_um .=$tmp;
              }elseif($linha["ANDAR"]==2){
                $andar_dois .=$tmp;
              }elseif($linha["ANDAR"]==3){
                $andar_tres .=$tmp;
              }elseif($linha["ANDAR"]==4){
                $andar_quatro.=$tmp;
              }
            }
            $tbl_end =  "</tbody>
                      </table>";
            
            $return = "";
            $return .=$andar_zero.$tbl_end.$andar_um.$tbl_end.$andar_dois.$tbl_end.$andar_tres.$tbl_end.$andar_quatro.$tbl_end;
            $return.="</div>";
            return $return ;
          }
 
  ?>

      <style type="text/css">
        h1{padding-left: 15px;}
      </style>
    </div>
</body>
</html>