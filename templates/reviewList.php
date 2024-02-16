<?php
  session_start();
  include_once __DIR__.'/singleReviewList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT user_id, review_content, review_time FROM book_review WHERE book_id = ".
//    echo $sql.'<br>';
    
    $result = $pdo->query($sql);

    foreach($result as $row) {
//      echo 'row start! <br>';
      
      $searchImage = $row['book_cover'];
      $searchTitle = $row['book_title'];
      $searchAuthor = $row['book_author'];
      $searchPublication = $row['book_publisher'];
      $searchPrice = $row['book_cost'];
      $searchLeft = $row['book_count'];
      $searchId = $row['id'];
      
      if(!isset($_SESSION['uid'])) {
        $searchCount = 0;
        $ownTot = 0;
        
        echo 'blahblahblah<br>';
      }
      else {
        $sql = "SELECT COUNT(*) FROM book_review JOIN book_user WHERE book_review.book_id = ".$searchId." AND book_user.user_name = '".$_SESSION['uid']."' AND book_review.review_type = 1"; // get how many times you read this book
//        echo $sql.'<br>';
        
        $result2 = $pdo->query($sql);
        $searchCount = $result2->fetchColumn();
        
        $sql = "SELECT book_order.id, book_order.order_amount, book_order.order_state, book_order.order_type, book_order.order_relatedId FROM book_order INNER JOIN book_user ON book_user.id = book_order.user_id WHERE book_user.user_name = '".$_SESSION['uid']."' AND book_order.book_id = ".$searchId; // get how many copies of this book you have
//        echo $sql.'<br>';
        
        $result3 = $pdo->query($sql);
        
        $ownTot = 0;
        foreach($result3 as $row2) {
          $searchOrderId = $row2[0];
          $searchOrderAmount = $row2[1];
          $searchOrderState = $row2[2];
          $searchOrderType = $row2[3];
          $searchOrderRelatedId = $row2[4];
          
          if($searchOrderState == 3) {
            $searchOrderAmount = $searchOrderAmount*-1;
          }
          
          if($searchOrderType <= 2 || $searchOrderType == 4) { // buy, lend, own
            $ownTot = $ownTot + $searchOrderAmount;
          }
          else if($searchOrderType == 5) { // deposit
            $ownTot = $ownTot - $searchOrderAmount;
          }
          else { // order
          
          }
        }
      }
      singleSearchList($searchImage, $searchTitle, $searchAuthor, $searchPublication, $searchPrice, $searchLeft, $searchId, $searchCount, $ownTot);
    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
  

?>