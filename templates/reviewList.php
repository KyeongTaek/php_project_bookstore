<?php
  session_start();
  include_once __DIR__.'/singleReviewList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT book_user.user_name, book_review.review_content, book_review.review_time FROM book_review INNER JOIN book_user ON book_review.user_id = book_user.id WHERE book_id = ".$_GET['id'];    
//    echo $sql.'<br>';
    
    $result = $pdo->query($sql);

    foreach($result as $row) {
//      echo 'row start! <br>';
      
      $reviewName = $row['user_name'];
      $reviewContent = $row['review_content'];
      $reviewTime = $row['review_time'];

      singleReviewList($reviewName, $reviewContent, $reviewTime);
    }
    
    if(isset($_SESSION['uid'])) { // if logged
      singleReviewList($_SESSION['uid'], "", ""); // put one extra form(for the user to write)
    }
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
  

?>