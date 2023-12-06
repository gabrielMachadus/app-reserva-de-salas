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
    <script type="text/javascript" src="../js/scripts_page.js"></script>
    <script type="text/javascript">
        function mostra_filtro(){
            $("#filtrar_info").slideToggle("slow");
        }

        function altera_data_filtro(){
            var dt_res_ini = document.getElementById("dt_res_ini");
            var dt_res_fin = document.getElementById("dt_res_fin");
            var temp = new Date;
            var dia= temp.getDate();

            if( dia==1 ||  dia==2 || dia==3|| dia==4 || dia==5 || dia==6 || dia==7 || dia==8 || dia==9 ){
              dia =adiciona_zero(dia);
            }
            var mes = temp.getMonth()+1;
            var ano = temp.getFullYear();
            var hoje = ano+"-"+mes+"-"+dia;

            dt_res_ini.value = hoje;
            dt_res_fin.value = hoje;
         }



        
                     
    </script>
    <style type="text/css">
        input{
            margin-top:10px;
        }
    </style>
    </head>

   
    <body onload="altera_data_filtro();">
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
              <form  method="POST" action="pesquisa_por_sala.php">
                 <label>Pesquisa Historico de Reserva da Salas por numero da sala</label>
                <input class="form-control" type="number" placeholder="Digite o numero da sala"  name="n_sala" value="0"><br>
                <!-- Fazer os filtros funcionarem -->
                <div id="filtro">
                    <input type="checkbox" onchange="mostra_filtro();" id="chbox" name="chbox"> Adicionar o filtro
                    <div id="filtrar_info" style="display: none;">
                        <label> Período da Reserva:
                            <label>Data Inicial:
                                <input class="form-control" type="date" id="dt_res_ini" name="dt_res_ini" value="2018-10-20" min="">
                            </label>
                            <label>Data Final:
                                <input class="form-control" type="date" id="dt_res_fin" name="dt_res_fin" value="2018-10-20" min="">
                            </label>
                        </label>
                        <label>Hora Entrada:
                            <input class="form-control" type="time" name="hr_entrada" value="07:00">
                        </label>

                        <label>Hora Saída :
                            <input class="form-control" type="time" name="hr_saida" value="22:00">
                        </label>
                    </div>
                </div>
                <input class="btn btn-success btn-block" type="submit" value="Pesquisar Informação"></input>
             </form>  
            </div>   
       
        
        
           
        <?php
           
            $dt_res_ini = $_POST["dt_res_ini"];
            $dt_res_fin = $_POST["dt_res_fin"];
            $hr_entrada = $_POST["hr_entrada"];
            $hr_saida = $_POST["hr_saida"];

           
            if (isset($_POST["n_sala"])) {
                $n_sala = $_POST["n_sala"];
                // Conexao com o banco de dados
               require 'conecta_banco.php';
                // Verifica se a variável está vazia
                if (empty(!is_nan($n_sala))) {
                    //echo "<br>Digite o numero da sala.";
                } else { 

                    $filtro = $_POST["chbox"];
                    if($filtro==null){
                        //print_r("nao selecionadao o filtro<br>");
                        
                        //SQL SEM O FILTRO
                        $sql = "";
                        $sql .= "SELECT p.nome_completo AS 'NOME',f.nome AS 'FUNCAO',r.data_hora_registro AS 'REGISTRO',s.n_sala AS 'SALA',r.data_reserva AS 'DATA_RESERVA',r.hora_entrada AS 'ENTRADA',r.hora_saida AS 'SAIDA',t.nome AS 'TURNO_RESERVADO', r.ativo";
                        $sql .= " FROM reserva r, sala s,colaborador p,turno t,funcao f ";
                        $sql .= "WHERE r.id_sala=s.id_sala AND s.n_sala= ".$n_sala." AND p.id_colaborador = r.id_colaborador AND t.id_turno = r.id_turno AND f.id_funcao=p.id_funcao ORDER BY r.data_reserva DESC";
                        //print_r($sql); 
                                  
                    }else{
                        $return = "<div class='twelve collums' style='border: 1px solid red;'>";
                        foreach ($_POST as $key => $value) {
                            $return.="<br>".$key ."=>". $value;
                        }
                        $return .= "</div>";

                        //SQL com O FILTRO
                        $perido_reserva = " AND r.data_reserva BETWEEN '".$dt_res_ini."' AND '".$dt_res_fin."' "; 
                     $horario_reserva = " AND r.hora_entrada BETWEEN '".$hr_entrada."' AND '".$hr_saida."' ";

                        $sql = "";
                        $sql .= "SELECT p.nome_completo AS 'NOME',f.nome AS 'FUNCAO',r.data_hora_registro AS 'REGISTRO',s.n_sala AS 'SALA',r.data_reserva AS 'DATA_RESERVA',r.hora_entrada AS 'ENTRADA',r.hora_saida AS 'SAIDA',t.nome AS 'TURNO_RESERVADO', r.ativo";
                        $sql .= " FROM reserva r, sala s,colaborador p,turno t,funcao f ";
                        $sql .= "WHERE r.id_sala=s.id_sala AND s.n_sala= ".$n_sala." AND p.id_colaborador = r.id_colaborador AND t.id_turno = r.id_turno AND f.id_funcao=p.id_funcao". $perido_reserva." ".$horario_reserva." ORDER BY r.data_reserva DESC";
                    
                    }
                   

                }
                $result = mysqli_query($conexao,$sql);
                $cont = mysqli_affected_rows($conexao);
                // Verifica se a consulta retornou linhas 
                if ($cont > 0) {
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
                    // Captura os dados da consulta e inseri na tabela HTML
                    while ($linha = mysqli_fetch_array($result)) {          
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
                } else {
                    
                    // Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
                    echo "<div class='twelve collums'><h1 class='text-center'>Não foram encontrados registros!</h1></div>";
                }
                echo "<hr>";
            }
        ?>
         </div>
    </div>
  </body>

 
    
   
</html>
