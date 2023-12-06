        function data_hoje(){
          var now = new Date;
          
          var hr_entrada = document.getElementById("hr_entrada");
          var hr_saida = document.getElementById("hr_saida");
          var data_reserva = document.getElementById("dt_reserva");
          var data_hora_registro = document.getElementById("dt_hr_registro");
           //troca o valor do mes pois vai de 0 a 11
          var mes = troca_vlr_mes(now.getMonth());
          //adicona a hora atual a var hora
          var hora = now.getHours();
          var minutos = now.getMinutes();
          var dia = now.getDate();
         
          
          if(hora==24 || hora<=9  ){
              hora =adiciona_zero(hora);
          }

          if(minutos<=9){
            minutos = adiciona_zero(minutos);
          }else{
            minutos = now.getMinutes();
          }

          
          if( dia==1 ||  dia==2 || dia==3|| dia==4 || dia==5 || dia==6 || dia==7 || dia==8 || dia==9 ){
              dia = adiciona_zero(dia); 
          }
          if( mes==1 ||  mes==2 || mes==3|| mes==4 || mes==5 || mes==6 || mes==7 || mes==8 || mes==9 ){
              mes = adiciona_zero(mes);      
          }

          
          data_reserva.value = now.getFullYear()+"-"+mes+"-"+dia;
          data_hora_registro.value = now.getFullYear()+"-"+mes+"-"+dia+"T"+hora+":"+minutos;
          muda_hora_turno();
           
        }

        
        function muda_hora_turno(){
          //1 - Manhã 07:10 as 12:00
          //2 - Tarde 13:00 as 17:00
          //3 - Noite 19:00 as 22:00 
          
          var hr_entrada = document.getElementById("hr_entrada");
          var hr_saida = document.getElementById("hr_saida");
          var turno = parseInt(document.getElementById("turno_id").value);
         
          //soma um ao dia
          hr_entrada.min = "06:00";
          hr_entrada.max= "23:59";
          hr_saida.min = "06:00";
          hr_saida.max= "23:59";
          

          switch(turno){
            case 1:
              hr_entrada.value = "07:00";
              hr_saida.value = "12:00";
              break;

            case 2:
              hr_entrada.value = "13:00";
              hr_saida.value = "17:50";
              break;

            case 3:
              hr_entrada.value = "19:00";
              hr_saida.value = "22:30";
              break;
          }
        }
        
        //ok
        function adiciona_zero(x){
          var min = x;
          var retorno="00";
          switch(min){
              case 0 && 24:
                retorno = "00";
                break;

              //1 = 2 - Fevereiro  
              case 1:
                 retorno = "01";
                break;

              
              case 2:
                 retorno = "02";
                break;

             
              case 3:
                 retorno = "03";
                break;

              
              case 4:
                retorno = "04";
                break;

              
              case 5:
                 retorno = "05";
                break;

             
              case 6:
                 retorno = "06";
                break;

              
              case 7:
                retorno = "07";
                break;

              
              case 8:
                 retorno = "08";
                break;

              
              case 9:
                retorno = "09";
                break;
            }
          return retorno;
        }
        //ok
        function troca_vlr_mes(x){
            var mes = x;
            switch(mes){
              //0 = 1 - Janeiro
              case 0:
                mes = 1;
                break;

              //1 = 2 - Fevereiro  
              case 1:
                mes = 2;
                break;

              //2 = 3 - Março  
              case 2:
                mes = 3;
                break;

              //3 = 4 - Abril  
              case 3:
                mes = 4;
                break;

              //4 = 5 - Maio  
              case 4:
                mes = 5;
                break;

              //5 = 6 - Junho  
              case 5:
                mes = 6;
                break;

              //6 = 7 - Julho  
              case 6:
                mes = 7;
                break;

              //7 = 8 - Agosto  
              case 7:
                mes = 8;
                break;

              //8 = 9 - Setembro 
              case 8:
                mes = 9;
                break;

              //9 = 10 - Outubro 
              case 9:
                mes = 10;
                break;

              //10 = 11 - Novembro 
              case 10:
                mes = 11;
                break;

              //11 = 12 - Dezembro 
              case 11:
                mes = 12;
                break;
            }

            return mes;
        }

