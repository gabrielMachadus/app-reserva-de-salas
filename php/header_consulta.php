<?php
 session_start();

    echo '
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

      <div class="topnav" id="myTopnav">
        <a class="active"><img src="../css/img/logo-192x192.png" alt="" width="30" height="auto" style="margin-left:20px;"><h4>Sistema de Reserva de Salas</h4><h6>Usuário: '.$_SESSION["usuario"]." - Nível: ".$_SESSION['nivel_acesso'].'</h6></a>
        
        <a class="btn col-12" href="mostrar_salas_cadastradas.php">Salas classificadas por andar</a>
        <a class="btn col-12" href="pesquisa_total.php">Reservas por Ordem de Data</a>
        <a class="btn col-12" href="pesquisa_por_sala.php">Pesquisa por Numero da Sala</a>
        <a  class="btn col-12" href="pesquisa_cancelados.php">Pesquisa Cancelados</a>
        <a class="btn col-12" href="pesquisa_por_colaborador.php">Pesquisa por colaborador</a>
        <a class="btn col-12" href="sair.php">Sair</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
          <i class="fa fa-bars"></i>
        </a>
      </div>

      <style>
        /* Add a black background color to the top navigation */
          .topnav {
              background-color: black;
              overflow: hidden;
              margin-bottom:5px;
          }

          .btn{
            border:1px solid gray;
            padding: 16px 32px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            transition: 0.3s;
          }

          /* Style the links inside the navigation bar */
          .topnav a {
              float: left;
              display: block;
              color: #f2f2f2;
              text-align: left;
              padding: 14px 16px;
              text-decoration: none;
              font-size: 17px;
          }

          /* Change the color of links on hover */
          .topnav a:hover {
              background-color: #ddd;
              color: black;
          }

          /* Add an active class to highlight the current page */
          .active {
             background-color: #ddd;
             color: black
          }

          /* Hide the link that should open and close the topnav on small screens */
          .topnav .icon {
              display: none;
          }

          /* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
          @media screen and (max-width: 2800px) {
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
              float: right;
              display: block;
            }
          }

          /* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
          @media screen and (max-width: 2000px) {
            .topnav.responsive {position: relative;}
            .topnav.responsive a.icon {
              position: absolute;
              right: 0;
              top: 0;
            }
            .topnav.responsive a {
              float: none;
              display: block;
              text-align: left;
            }
          }
      </style>

      <script>
          /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
          function myFunction() {
              var x = document.getElementById("myTopnav");
              if (x.className === "topnav") {
                  x.className += " responsive";
              } else {
                  x.className = "topnav";
              }
          }
      </script>

    ';
  
?>