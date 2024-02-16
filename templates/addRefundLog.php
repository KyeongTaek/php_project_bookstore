<?php
  session_start();
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM book_order WHERE id = ".$_GET['id'];
    $result = $pdo->query($sql);
    $orderInfo = $result->fetch();
    
    $sql = "INSERT INTO `book_order` (`user_id`, `user_addr`, `book_id`, `order_amount`, `order_date`, `order_state`, `order_type`, `order_relatedId`) VALUES (".$orderInfo['user_id'].", '".$orderInfo['user_addr']."', ".$orderInfo['book_id'].", ".$orderInfo['order_amount'].", '".date("Y-m-d")."', 3, ".$orderInfo['order_type'].", ".$_GET['id'].")";
    echo $sql.'<br>';
    
    $statement = $pdo->prepare($sql);
    $statement->execute();
    
    
    $type = (int)$orderInfo['order_type'];
    echo 'before `if`<br>';
    echo $type.'<br>';
    echo gettype($type).'<br>';
    
    if($type < 3) { // buy, lend
      echo $type.'<br>';
      echo gettype($type).'<br>';
    
      $sql = "SELECT book_count, book_wish FROM book_stock WHERE book_id = ".$orderInfo['book_id'];
      echo $sql.'<br>';
      $result = $pdo->query($sql);
      $stockInfo = $result->fetch();
      
      $isWish = $stockInfo['book_wish'];
      $cnt = $stockInfo['book_count'] + 1;
      
      if($isWish != 0) {
        $sql = "UPDATE book_stock SET `book_count`=".$cnt.", `book_wish`=0 WHERE book_id = ".$orderInfo['book_id'];
      }
      else {
        $sql = "UPDATE book_stock SET `book_count`=".$cnt." WHERE book_id = ".$orderInfo['book_id'];
      }
      $statement = $pdo->prepare($sql);
      $statement->execute();
      echo $sql.'<br>';
      
      $sql = "SELECT id, user_cash FROM book_user WHERE user_name = '".$_SESSION['uid']."'";
      $result = $pdo->query($sql);
      $userInfo = $result->fetch();
      echo $sql.'<br>';
      
      $sql = "SELECT book_cost FROM book_info WHERE id = ".$orderInfo['book_id'];
      $result = $pdo->query($sql);
      $book_cost = $result->fetch()['book_cost'];
      
      $order_cost = $book_cost;
      $cash = $userInfo['user_cash'] + $order_cost;
      $id = $userInfo['id'];
      
      $sql = "UPDATE book_user SET `user_cash`=".$cash." WHERE id = ".$id;
      $statement = $pdo->prepare($sql);
      $statement->execute();
      echo $sql.'<br>';
    }
    else if($type == 3) {
      echo 'type is 3<br>';
      echo $type.'<br>';
      echo gettype($type).'<br>';
    }
    else {
      echo 'type is bigger than 3<br>';
      echo $type.'<br>';
      echo gettype($type).'<br>';
    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                         '<br>오류 발생 파일 : '.$e->getFile().
                         '<br>오류 발생 행 : '.$e->getLine();
  }
  
?>