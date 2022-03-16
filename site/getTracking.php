<!DOCTYPE html>
<html>
   <head>
      <!-- jquery -->
      <script src="js\jquery-1.11.3.min.js"></script>
      <!-- bootstrap -->
      <script type="text/javascript" src="js\bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
      <!-- The Modal -->
      <div id="myModal" class="modal">
         <!-- Modal content -->
         <div class="modal-content">
            <div class="modal-header">
               <span class="close" onclick="Fechar()">&times;</span>
               <p></p>
               <br>
            </div>
            <div class="modal-body">
               <table class="table" style="text-align: center; margin:auto">
                  <tr>
                     <th style="text-align: center">DATA</th>
                     <th style="text-align: center;">RASTREIO</th>
                     <th style="text-align: center;">STATUS</th>
                  </tr>
                  <tr>
                     <?php
                        include_once('conexao.php');
                        $rastreio = $_GET['cte'];
                        $sql_select = "SELECT `id`, `numero_rastreio`, `status`, `data_criacao` FROM `rastreios` WHERE `numero_rastreio` = '$rastreio'";
                        $consulta = mysqli_query($conn, $sql_select) or die(mysqli_error($conn));
                        $linhas = mysqli_num_rows($consulta);
                        
                        if ($linhas > 0) {
                          while ($dados = mysqli_fetch_array($consulta)) {
                        
                            $id = $dados['id'];
                            $nmr_rastreio = $dados['numero_rastreio'];
                            $status = $dados['status'];
                            $data = $dados['data_criacao'];
                        
                            echo "<tr>";
                            echo "<td align=\"center\" style=\"width: 523px ;padding-right: 5px;padding-left: 5px;\">$data</td>";
                            echo "<td align=\"center\" style=\"width: 523px ;padding-right: 5px;padding-left: 5px;\">$nmr_rastreio</td>";
                            echo "<td align=\"center\" style=\"width: 523px ;padding-right: 5px;padding-left: 5px;\">$status</td>";
                            echo "</tr>";
                          }
                        } else {
                          echo "<tr>";
                          echo "<td align=\"center\" style=\"width: 523px ;padding-right: 5px;padding-left: 5px;\"></td>";
                          echo "<td align=\"center\" style=\"width: 523px ;padding-right: 5px;padding-left: 5px;\"><b><u>Rastreio não encontrado</u></b></td>";
                          echo "<td align=\"center\" style=\"width: 523px ;padding-right: 5px;padding-left: 5px;\"></td>";
                          echo "</tr>";
                        }
                        ?>
                  </tr>
               </table>
            </div>
            <div class="modal-footer">
               <p></p>
               <br>
            </div>
         </div>
      </div>
      <!-- chamada da função -->
      <script type="text/javascript">
         $(window).load(function() {
           $('#myModal').modal('show');
         });
      </script>
      <script type="text/javascript">
         $(document).ready(function() {
           $('#myModal').modal('show');
         })
      </script>
      <script>
         function Fechar() {
           window.opener = window;
           window.close();
         }
      </script>
      <script>
         // Get the modal
         var modal = document.getElementById("myModal");
         
         // Get the button that opens the modal
         var btn = document.getElementById("myBtn");
         
         // Get the <span> element that closes the modal
         var span = document.getElementsByClassName("close")[0];
         
         // When the user clicks the button, open the modal 
         btn.onclick = function() {
           modal.style.display = "block";
         }
         
         // When the user clicks on <span> (x), close the modal
         span.onclick = function() {
           modal.style.display = "none";
         }
         
         // When the user clicks anywhere outside of the modal, close it
         window.onclick = function(event) {
           if (event.target == modal) {
             modal.style.display = "none";
           }
         }
      </script>
   </body>
</html>