<?php
  session_start();
//  include_once __DIR__.'/singleReviewList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $orderAble = true;
    
    $sql = "SELECT book_count, book_wish FROM book_stock WHERE book_id = ".$_GET['id']; // is book amount enough
    echo $sql.'<br>';
    
    $result = $pdo->query($sql);
    $bookStock = $result->fetch();
    
    if($bookStock['book_count'] == 0) {
      $orderAble = false;
      echo 'false(count == 0)<br>';
      
      if($bookStock['book_wish'] != 1) {
        $sql = "UPDATE `book_stock` SET `book_wish`=1 WHERE `book_id`=".$_GET['id'];
        echo $sql.'<br>';
      
        $statement = $pdo->prepare($sql);
        $statement->execute();
      }
    }
    
    $sql = "SELECT user_cash FROM book_user WHERE user_name = '".$_SESSION['uid']."'"; // is cash enough
    echo $sql.'<br>';
    
    $result = $pdo->query($sql);
    $yourMoney = $result->fetch();
    
    
    $sql = "SELECT book_cost FROM book_info WHERE id = ".$_GET['id'];
    echo $sql.'<br>';
    
    $result = $pdo->query($sql);
    $bookCost = $result->fetch();
    
    if($_GET['source'] == 'lend') { // price is half when 'lend'
      $bookCost['book_cost'] = $bookCost['book_cost'] / 2;
      echo 'lend<br>';
    }
    
    $left = $yourMoney['user_cash'] - $bookCost['book_cost'];
    echo 'myMoney = '.$yourMoney['user_cash'].', bookCost = '.$bookCost['book_cost'].'<br>';
    if($left < 0) { // out of money
      $orderAble = false;
      echo 'false($left < 0)<br>';
    }
    
    if($orderAble) {
      if($_GET['source'] == 'lend') {
        $sql = "UPDATE `book_user` SET `user_cash`=".$left." WHERE `user_name` = '".$_SESSION['uid']."'";
        echo $sql.'<br>';
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        
        $sql = "UPDATE `book_stock` SET `book_count` = ".--$bookStock['book_count']." WHERE `book_id` = ".$_GET['id'];
        echo $sql.'<br>';
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        
        $order_type = 2;
      }
      else if($_GET['source'] == 'buy') {
        $sql = "UPDATE `book_user` SET `user_cash`=".$left." WHERE `user_name` = '".$_SESSION['uid']."'";
        echo $sql.'<br>';
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        
        $sql = "UPDATE `book_stock` SET `book_count` = ".--$bookStock['book_count']." WHERE `book_id` = ".$_GET['id'];
        echo $sql.'<br>';
        
        $statement = $pdo->prepare($sql);
        $statement->execute();
        
        $order_type = 1;
      }
      else if($_GET['source'] == 'own') {
        $order_type = 4;
      }
      else if($_GET['source'] == 'deposit') {
        $order_type = 5;
      }
      else { // wrong
        echo 'wrong';
      }
      
      $sql = "SELECT id, user_addr FROM book_user WHERE user_name = '".$_SESSION['uid']."'";
      echo $sql.'<br>';
      
      $result = $pdo->query($sql);
      $userInfo = $result->fetch();
      
      $sql = "INSERT INTO `book_order` (`user_id`, `user_addr`, `book_id`, `order_amount`, `order_date`, `order_state`, `order_type`) VALUES (".$userInfo['id'].", '".$userInfo['user_addr']."', ".$_GET['id'].", 999, '2022-11-28', 1, ".$order_type.")";
      echo $sql.'<br>';
      
      $statement = $pdo->prepare($sql);
      $statement->execute();
    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                         '<br>오류 발생 파일 : '.$e->getFile().
                         '<br>오류 발생 행 : '.$e->getLine();
  }
  
?>