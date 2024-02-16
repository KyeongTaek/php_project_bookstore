<?php
  include_once __DIR__.'singleSearchList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT book_info.book_cover, book_info.book_title, book_info.book_author, book_info.book_publisher, book_info.book_cost, book_stock.book_count, book_info.id FROM book_info INNER JOIN book_stock ON book_info.id = book_stock.book_id WHERE book_info.book_title LIKE '%".$_GET['search_content']."%'"; // get book info
    echo $sql.'<br>';
    
    $result = $pdo->query($sql);

    foreach($result as $row) {
      echo 'row start! <br>';
      
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
      }
      else {
        $sql = "SELECT id FROM book_review WHERE book_id = ".$searchId." AND user_id = ".$_SESSION['uid']." AND review_type = 1"; // get how many times you read this book
        echo $sql.'<br>';
        
        $result2 = $pdo->query($sql);
        $searchCount = $result2->num_rows;
        
        $sql = "SELECT id, order_amount, order_state, order_type, order_relatedId FROM book_order WHERE user_id = ".$_SESSION['uid']." AND book_id = ".$searchId; // get how many copies of this book you have
        echo $sql.'<br>';
        
        $result3 = $pdo->query($sql);
        
        $ownTot = 0;
        foreach($result3 as $row2) {
          $searchOrderId = $row2[0];
          $searchOrderAmount = $row2[1];
          $searchOrderState = $row2[2];
          $searchOrderType = $row2[3];
          $searchOrderRelatedId = $row2[4];
          
          if($searchOrderState != 3) { // valid order
            if($searchOrderType <= 2  || $searchOrderType == 4) { // buy, lend, own
              $orderedArray[] = $searchOrderId;
              $ownTot = $ownTot + $searchOrderAmount;
              
              $idx = $idx + 1;
            }
            else if($searchOrderType == 5) { // deposit
              $orderedArray[] = $searchOrderId;
              $ownTot = $ownTot - $searchOrderAmount;
            }
            else { // order
              
            }
          }
          else { // refunded order
            for($i=0;$i<count($orderArray);$i++) {
              if($orderArray[$i] == $searchOrderRelatedId) {
                if($searchOrderType <= 2 || $searchOrderType == 4) {
                  $ownTot = $ownTot - $searchOrderAmount;
                }
                else if($searchOrderType == 5) {
                  $ownTot = $ownTot + $searchOrderAmount;
                }
                
                break;
              }
            }
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