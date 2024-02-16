<?php
  session_start();
  include_once __DIR__.'/singleReviewList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(isset($_GET['id'])) { // from 'addWish' button
      $sql = 'UPDATE `book_stock` SET `book_wish`=1 WHERE `book_id`='.$_GET['id'];
      echo $sql.'<br>';
      
//      echo '<script type="text/javascript">history.go(-2);</script>';
    }
    else if(isset($_POST['bookAuthor'])) { // new book info
      $sql = "INSERT INTO `book_info`(`book_title`, `book_author`, `book_publisher`) VALUES '".
      $_POST['bookTitle']."', '".$_POST['bookAuthor']."', '".$_POST['bookPublisher']."')";
      echo $sql.'<br>';
      
      $sql = "SELECT id FROM book_info WHERE book_title = '".$_POST['bookTitle']."' AND book_author = '".$_POST['bookAuthor']."'";
      echo $sql.'<br>';
      
      $id = 17;      //example
      
//      echo '<script type="text/javascript">location.href = "addWish.php?id='.$id.'"</script>';
    }
    else { // from 'No results! Add to wish list?' alert
      echo '<form action="" method="post">';
      echo '  <input type="text" name="bookTitle" value="'.$_GET['bookTitle'].'" />';
      echo '  <input type="text" name="bookAuthor" value="" />';
      echo '  <input type="text" name="bookPublisher" value=""/>';
      echo '  <input type="submit" value="submit" />';
      echo '</form>';
    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
  

?>