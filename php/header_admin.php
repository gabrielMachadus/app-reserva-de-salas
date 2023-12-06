<?php
 session_start();

    echo '<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    
         <img class="mb-4" src="../css/img/logo-192x192.png" alt="" width="40" height="40" style="margin-right:10px;">
          <h1 class="my-0 mr-md-auto font-weight-normal">Sistema de Reserva de Salas</h1>
  <div class="btn-group">
    <a class="btn btn-primary" href="alterar_usuario.php">'.'Usuário: '.$_SESSION["usuario"]." - Nível: ".$_SESSION['nivel_acesso'].'</a>
     <a class="btn btn-primary" href="cadastro_reserva.php">Reservar Sala</a>
     <a class="btn btn-primary" href="mostrar_salas_cadastradas.php">Salas por andar</a>
    <div class="btn-group">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Cadastro </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="cadastro_colaborador.php">Colaboradores</a></li>
                <li><a href="cadastro_empresa.php">Empresa</a></li>
                <li><a href="cadastro_usuario.php">Usuário</a></li>       
                <li><a href="cadastro_sala.php">Sala</a></li>
            </ul>
        </div>

        <div class="btn-group">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pesquisa</button>
             <ul class="dropdown-menu" role="menu">
               <li><a  href="pesquisa_total.php">Ordem de Data</a></li>
               <li><a  href="pesquisa_por_sala.php">Numero da Sala</a></li>
               <li><a  href="pesquisa_cancelados.php"> Cancelados</a></li>
               <li><a  href="pesquisa_por_colaborador.php">Por colaborador</a></li>
            </ul>
        </div>
        <a class="btn btn-primary" href="sair.php">Sair</a>
    </div>
  </div>';
 
?>

