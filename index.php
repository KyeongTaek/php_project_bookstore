<!DOCTYPE html>
<html lang="ko">
  <head>
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
    
        echo 'MySQL 접속 성공 1';
      } catch(PDOException $e) {
        echo 'DB 접속 오류 : '.$e->getMessage().
                            '<br>오류 발생 파일 : '.$e->getFile().
                            '<br>오류 발생 행 : '.$e->getLine();
      }
    ?>
    
    
    <header style="background-color:cyan;">
      <nav>
        <ul style="display: inline; list-style-type: none;">
          <li style="display: inline;">
            <a href="index.php">
              <img src="images/logo.png" width="30%" height="30%" alt="LOGO IS MISSING...">
            </a>
          </li>
          <li style="display: inline;"><a href="templates/signupFrame.html">sign up</a></li>
          <li style="display: inline;"><a href="./templates/loginFrame.html">sign in</a></li>
          <li style="display: inline;"><a href="./templates/myInfo.html">myinfo</a></li>
          <li style="display: inline;"><a href="./templates/orderList.html">orderList</a></li>
          <li style="display: inline;"><a href="./templates/readingStatus.html">readingStatus</a></li>
        </ul>
      </nav>
    </header>
    
    
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
    
    
    <footer style="background-color:yellow;">
      <h3><em>Project : BookStore</em>, by LimKyeongtaek</h3>
    </footer>
  </body>
</html>