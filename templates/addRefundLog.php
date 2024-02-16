<?php
  session_start();
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT user_id, book_id FROM book_order WHERE id = ".$_SESSION['id'];
    $result = $pdo->query($sql);
    $orderInfo = $result->fetch();
    
    $sql = "INSERT INTO `book_order` (`user_id`, `user_addr`, `book_id`, `order_amount`, `order_date`, `order_state`, `order_type`, `order_relatedId`) VALUES (".$orderInfo['user_id'].", '".$_SESSION['addr']."', ".$orderInfo['book_id'].", 999, '2022-11-30', 3, ".$_SESSION['type'].", ".$_SESSION['id'].")";
    echo $sql.'<br>';
    
    $statement = $pdo->prepare($sql);
    $statement->execute();
    
    if($_SESSION['type'] < 3) { // buy, lend
      $sql = "SELECT book_count, book_wish FROM book_stock WHERE book_id = ".$orderInfo['book_id'];
      $result = $pdo->query($sql);
      $stockInfo = $result->fetch()['book_wish'];
      
      $isWish = $stockInfo['book_wish'];
      $cnt = $stockInfo['book_count'];
      
      if($isWish != 0) {
        $sql = "UPDATE book_stock SET `book_count`=".++$cnt.", `book_wish`=0 WHERE book_id = ".$orderInfo['book_id'];
      }
      else {
        $sql = "UPDATE book_stock SET `book_count`=".++$cnt." WHERE book_id = ".$orderInfo['book_id'];
      }
      $statement = $pdo->prepare($sql);
      $statement->execute();
      
      $sql = "SELECT id, user_cash FROM book_user WHERE user_name = '".$_SESSION['uid']."'";
      $result = $pdo->query($sql);
      $userInfo = $result->fetch();
      
      $cash = $userInfo['user_cash'] + $_SESSION['cost'];
      $id = $userInfo['id'];
      
      $sql = "UPDATE book_user SET `user_cash`=".$cash." WHERE id = ".$id;
      $statement = $pdo->prepare($sql);
      $statement->execute();
    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                         '<br>오류 발생 파일 : '.$e->getFile().
                         '<br>오류 발생 행 : '.$e->getLine();
  }
  
?>