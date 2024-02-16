<?php
  session_start();
//  include_once __DIR__.'/singleReviewList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $orderAble = true;
    
    $sql = "SELECT book_count, book_wish FROM book_stock WHERE book_id = ".$_GET['id']; // is book amount enough
    echo $sql.'<br>';
    
    $result = $sql->query();
    $bookStock = $result->fetch();
//    
//    if($bookStock['book_count'] == 0) {
//      $orderAble = false;
//      if($bookStock['book_wish'] != 1) {
//        $sql = "UPDATE `book_stock` SET `book_wish`=1 WHERE `book_id`=".$_GET['id'];
//        echo $sql.'<br>';
//      
////        $statement = $pdo->prepare($sql);
////        $statement->execute();
//      }
//    }
//    
//    $sql = "SELECT user_cash FROM book_user WHERE user_name = ".$_SESSION['uid']; // is cash enough
//    echo $sql.'<br>';
//    
//    $result = $sql->query();
//    $yourMoney = $result->fetch();
//    
//    if($_GET['source'] = 'lend') {
//      $yourMoney = $yourMoney / 2;
//    }
//    
//    $sql = "SELECT book_cost FROM book_info WHERE id = ".$_GET['id'];
//    echo $sql.'<br>'
//    
//    $result = $sql->query();
//    $bookCost = $result->fetch();
//    
//    $left = $yourMoney - $bookCost;
//    if($left < 0) {
//      $orderAble = false;
//    }
//    
////    if($orderAble) {
////      if($_GET['source'] == 'lend') {
////        $sql = "UPDATE `book_user` SET `user_cash`=".$left." WHERE `user_name` = ".$_SESSION['uid'];
////        echo $sql.'<br>';
////        
//////        $statement = $pdo->prepare($sql);
//////        $statement->execute();
////        
////        $sql = "UPDATE `book_stock` SET `book_count` = ".$bookStock['book_count']-1." WHERE `book_id` = ".$_GET['id'];
////        echo $sql.'<br>';
////        
//////        $statement = $pdo->prepare($sql);
//////        $statement->execute();
////        
////        $order_type = 2;
////      }
////      else if($_GET['source'] == 'buy') {
////        $sql = "UPDATE `book_user` SET `user_cash`=".$left." WHERE `user_name` = ".$_SESSION['uid'];
////        echo $sql.'<br>';
////        
//////        $statement = $pdo->prepare($sql);
//////        $statement->execute();
////        
////        $sql = "UPDATE `book_stock` SET `book_count` = ".$bookStock['book_count']-1." WHERE `book_id` = ".$_GET['id'];
////        echo $sql.'<br>';
////        
//////        $statement = $pdo->prepare($sql);
//////        $statement->execute();
////        
////        $order_type = 1;
////      }
////      else if($_GET['source'] == 'own') {
////        $order_type = 4;
////      }
////      else if($_GET['source'] == 'deposit') {
////        $order_type = 5;
////      }
////      else { // wrong
////        
////      }
////      
////      $sql = "SELECT user_id, user_addr FROM book_user WHERE user_name = ".$_SESSION['uid'];
////      echo $sql.'<br>';
////      
////      $result = $sql->query();
////      $userInfo = $result->fetch();
////      
////      $sql = "INSERT INTO `book_order` (`user_id`, `user_addr`, `book_id`, `order_amount`, `order_date`, `order_state`, `order_type`) VALUES (".$userInfo['user_id'].", '".$userInfo['user_addr']."', ".$_GET['id'].", 999, '2022-11-28', 1, ".$order_type.")";
////      echo $sql.'<br>';
////      
//////      $statement = $pdo->prepare($sql);
//////      $statement->execute();
////    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
  

?>