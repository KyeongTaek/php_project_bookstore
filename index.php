<!DOCTYPE html>
<html lang="ko">
  <head>
    <?php
      session_start();
    ?>
    
    <meta charset="utf-8">
    <title>php_project_bookstore</title>
    <link type="text/css" rel="stylesheet" href="./css/mainLayout.css" />
    
    <script type="text/javascript">
      function dropMenu() {
        
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
      ?>
      
      <table>
        <tbody>
          <tr>
            <td> <input type="button" name="left" value="<"/> </td>
            <td> <img src="images/cosmos.jpg"> </td>
            <td> <img src="images/courage_to_overcome_hatred.jpg"> </td>
            <td> <img src="images/ji_dae_nulb_yat.jpg"> </td>
            <td> <input type="button" name="right" value=">"/> </td>
          </tr>
        </tbody>
      </table>
      
    </div>
    
    
    <?php
      include __DIR__.'/templates/footer.html.php';
    ?>
  </body>
</html>