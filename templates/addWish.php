<?php
  session_start();
  include_once __DIR__.'/singleReviewList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_GET['id'])) { // from 'addWish' button
      $sql = 'UPDATE `book_stock` SET `book_wish`=1 WHERE `book_id`='.$_GET['id'];
      echo $sql.'<br>';
      
      $statement = $pdo->prepare($sql);
      
      $statement->execute();
      
//      echo '<script type="text/javascript">history.go(-2);</script>';
      echo '<script type="text/javascript">location.href = "../index.php"</script>';
    }
    else if(isset($_POST['bookAuthor'])) { // new book info
      $sql = "INSERT INTO `book_info` (`book_title`, `book_author`, `book_publisher`) VALUES ('".
      $_POST['bookTitle']."', '".$_POST['bookAuthor']."', '".$_POST['bookPublisher']."')";
      echo $sql.'<br>';
      
      $statement = $pdo->prepare($sql);
      $statement->execute();
      
      $sql = "SELECT id FROM book_info WHERE book_title = '".$_POST['bookTitle']."' AND book_author = '".$_POST['bookAuthor']."'";
      echo $sql.'<br>';
      
      $result = $pdo->query($sql);
      
//      $id = 17;      //example
      $id = $result->fetchColumn();
      
      $sql = "INSERT INTO `book_stock` (`book_id`, `book_count`) VALUES (".$id.", 0)";
      echo $sql.'<br>';
      
      $statement = $pdo->prepare($sql);
      $statement->execute();
      
      echo '<script type="text/javascript">location.href = "addWish.php?id='.$id.'"</script>';
    }
    else { // from 'No results! Add to wish list?' alert
      echo '<form action="" method="post">';
      echo '  <h3> bookTitle : <input type="text" name="bookTitle" value="'.$_GET['bookTitle'].'" /> </h3><br>';
      echo '  <h3> bookAuthor : <input type="text" name="bookAuthor" value="" /> </h3><br>';
      echo '  <h3> bookPublisher : <input type="text" name="bookPublisher" value=""/> </h3><br>';
      echo '  <input type="submit" value="submit" />';
      echo '</form>';
    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
  

?>