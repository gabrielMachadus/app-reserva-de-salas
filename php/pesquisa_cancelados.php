<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <title>Pesquisa Historico de Reserva das Salas</title>

    <link rel="icon" href="../css/img/favicon.ico">
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/pricing.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style type="text/css">
        input{
            margin-top:10px;
        }

        /* Pagination links */
            .pagination a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
                transition: background-color .3s;
            }

            /* Style the active/current link */
            .pagination a.active {
                background-color: dodgerblue;
                color: white;
            }

            /* Add a grey background color on mouse-over */
            .pagination a:hover:not(.active) {background-color: #ddd;}
    </style>
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
    <div class="container">
        <div class="row flex-row" style="display:block;">
            <div class="twelve collums" style="padding-top:50px;">
            <h1>Historico de Reserva das Salas: <h6>CANCELADOS</h6></h1>
            </div>          
           

		<?php
			$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1; 

			echo'<table width="88%" height="10" cellspacing="0" cellpadding="0"><tr>';
			$conn = new PDO("mysql:host=localhost;dbname=projeto2", "root", "");
			$sql = "SELECT p.nome_completo AS 'NOME',f.nome AS 'FUNCAO',r.data_hora_registro AS 'REGISTRO',s.n_sala AS 'SALA',r.data_reserva AS 'DATA_RESERVA',r.hora_entrada AS 'ENTRADA',r.hora_saida AS 'SAIDA',t.nome AS 'TURNO_RESERVADO', r.ativo FROM reserva r, sala s,colaborador p,turno t,funcao f WHERE r.id_sala=s.id_sala AND p.id_colaborador = r.id_colaborador AND t.id_turno = r.id_turno AND f.id_funcao=p.id_funcao AND ativo=0 ORDER BY r.data_hora_registro DESC";
			$stmt = $conn->prepare($sql);
			$stmt->execute( );
			$cont = $stmt->rowCount();
			if($cont>0){
			
                $return = "<div class='twelve collums' id='tbl_dados' style='padding:0'><hr>";
                $return .= "<table class='table table-hover table-bordered table-responsive'style='padding:0px;margin:0px;'> ";
                $return .= "<thead> ";
                $return .=      "<tr> ";
                $return .=          "<th> Nome Completo</th>";
                $return .=          "<th> Função</th>";
                $return .=          "<th> Data e Hora do registro</th>";
                $return .=          "<th> Sala</th>";
                $return .=          "<th> Data da Reserva</th>";
                $return .=          "<th> Entrada</th>";
                $return .=          "<th> Saída</th>";
                $return .=          "<th> Turno </th>";
                $return .=          "<th> Ativo </th>";
                $return .=      "</tr> ";
                $return .= "</thead> ";
                $return .= "<tbody> ";

   				 //seta a quantidade de itens por página, neste caso, 2 itens 
   				 $registros = 10; 
 
    			//calcula o número de páginas arredondando o resultado para cima 
   				 $numPaginas = ceil($cont/$registros);

   				 //variavel para calcular o início da visualização com base na página atual 
   				 $inicio = ($registros*$pagina)-$registros; 
 
			    //seleciona os itens por página 
			    $cmd = $sql." limit $inicio,$registros"; 
			    $produtos =$conn->prepare($cmd); 
			    $produtos->execute( );
			    $total = $produtos->rowCount(); 
                // Captura os dados da consulta e inseri na tabela HTML
                while ($linha = $produtos->fetch(PDO::FETCH_ASSOC)) {          
                    $return.= '<tr>';
                    $return.= ' <td>'.utf8_encode($linha["NOME"]).'</td>';
                    $return.= ' <td>'.utf8_encode($linha["FUNCAO"]).'</td>';
                    $return.= ' <td>'.date("d/m/Y - H:i",strtotime(utf8_encode($linha["REGISTRO"]))).'</td>';
                    $return.= ' <td>'.utf8_encode($linha["SALA"]).'</td>';
                    $return.= ' <td>'.date("d/m/Y",strtotime(utf8_encode($linha["DATA_RESERVA"]))).'</td>';
                    $return.= ' <td>'.date("H:i",strtotime(utf8_encode($linha["ENTRADA"]))).'</td>';
                    $return.= ' <td>'.date("H:i",strtotime(utf8_encode($linha["SAIDA"]))).'</td>';
                    $return.= ' <td>'.utf8_encode($linha["TURNO_RESERVADO"]).'</td>';
                    if($linha["ativo"]==1){
                       $return.= ' <td>SIM</td>';   
                    }elseif($linha["ativo"]==0){ 
                       $return.= ' <td>'.'NÃO'.'</td>'; 
                    }
                    $return.=  '</tr>';
                        
                }

                
                $return .= "</tbody> ";
                $return .="</table>";
                echo $return.="</div>";

               
                echo '<center><ul class="pagination" ">';
                echo "<li><a class='btn ' href='pesquisa_cancelados.php?pagina=1'><<</a></li>  ";
                //exibe a paginação 
                for($i = 1; $i < $numPaginas + 1; $i++) { 
                    echo "<li><a class='btn  ' href='pesquisa_cancelados.php?pagina=$i'>".$i."</a></li> "; 
                } 
                echo "<li><a class='btn ' href='pesquisa_cancelados.php?pagina=$numPaginas'>>></a></li>  ";
                echo "</ul></center>";


            } else {
                echo "<div class='twelve collums'><h1 class='text-center'>Não foram encontrados registros!</h1></div>";
                }
                echo "<hr>";
				

?>