<!DOCTYPE html>
<html lang="ko">
  <head>
    <?php
      session_start();
      $idx_num = 10;
    ?>
    
    <meta charset="utf-8">
    <title>php_project_bookstore</title>
    <link type="text/css" rel="stylesheet" href="./css/mainLayout.css" />
    
   
    
    <script type="text/javascript">
      function dropMenu() {
        
      }
      
      function coverShifter() {
        var elem = document.getElementById("myId");
        if(elem.outerHTML == "<") { // --
          
        }
        else if(elem.outerHTML == ">") { // ++
          
        }
        else { // ??
          
        }
      }
          
    </script>
  </head>
  
  <body>

    <?php
      try {
        $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'DB 접속 오류 : '.$e->getMessage().
                            '<br>오류 발생 파일 : '.$e->getFile().
                            '<br>오류 발생 행 : '.$e->getLine();
      }
    ?>
    
    
    <?php
      ob_start();
      include __DIR__.'/templates/mainMenu.html.php';
      $headerOutput = ob_get_clean();
      echo $headerOutput;
    ?>
    
    
    <div id = "content" style="background-color:magenta;">
      
      <?php
        include __DIR__.'/templates/searchBar.html';
        
          function data_uri($binImage, $mime)
          {
            $base64 = base64_encode($binImage);
            
            return ('data:'.$mime.';base64,'.$base64);
          }
      ?>
      
      <table>
        <tbody>
          <tr>
          
            <?php
              $sql = "SELECT id, book_cover FROM book_info";
              
              $result = $pdo->query($sql);
              
              $idx = 0;
              foreach($result as $row) { // ex) $id_list[10] = 17, $img_list[10] = cosmos.jpg
                $id_list[$idx] = $row['id'];
                $img_list[$idx] = $row['book_cover'];
                $idx = $idx + 1;
              }
            ?>
            
            
            
            <?php
              echo '  <form method="post">';
              echo '    <td> <input type="submit" name="left" value="<"/> </td>';
              
              echo '    <td> <a href="templates/bookInfo.php?id='.$id_list[$idx_num].'"> <img src="'.data_uri($img_list[$idx_num], 'image/png').'"/> </a> </td>';
              echo '    <td> <a href="templates/bookInfo.php?id='.$id_list[$idx_num+1].'"> <img src="'.data_uri($img_list[$idx_num+1], 'image/png').'"/> </a> </td>'; 
              echo '    <td> <a href="templates/bookInfo.php?id='.$id_list[$idx_num+2].'"> <img src="'.data_uri($img_list[$idx_num+2], 'image/png').'"/> </a> </td>';                           
              
              echo '    <td> <input type="submit" name="right" value=">"/> </td>';
              echo '  </form>';
              
              if(array_key_exists('left', $_POST)) {
                $idx_num = $idx_num - 1;
              }
              else if(array_key_exists('right', $_POST)) {
                $idx_num = $idx_num + 1;
              }
                  
            ?>
          </tr>
        </tbody>
      </table>
      
    </div>
    
    
    <?php
      include __DIR__.'/templates/footer.html.php';
    ?>
  </body>
</html>