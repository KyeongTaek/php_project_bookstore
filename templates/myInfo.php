<?php
  session_start();
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(!isset($_SESSION['uid'])) { // if not logged
      echo "<script type=\"text/javascript\">location.href = location.href + '/../loginFrame.html';</script>";
    }
    
    $sql = "SELECT book_order.id AS id, book_order.book_id AS book_id, book_order.order_state AS order_state, book_order.order_date AS order_date, book_order.order_relatedId AS order_relatedId, book_user.id AS user_id, book_user.user_admin AS user_admin FROM book_order INNER JOIN book_user ON book_user.id = book_order.user_id WHERE book_user.user_name = '".$_SESSION['uid']."' AND order_type = 2";
    echo $sql.'<br>';
    
    $result = $pdo->query($sql);

    for($result as $row) {
      if($row['order_state'] == 1) {
        $group[$row['id']] = $row['order_date'];
      }
      else if($row['order_state'] == 3) {
        unset($group[$row['order_relatedId']]);
      }
    }
        
//    
//    $earliest_date = array_pop(array_reverse($group));
//    if($earliest_date == "") {
//      isLate = false;
//    }
//    else {
//      $today_date = new DateTime();
//      $interval = $earliest_date->diff($today_date);
//    
//      if($interval->days > 7) {
//        $isLate = true;
//      }
//      else {
//        $isLate = false;
//    }
//    
//    $result_row = $result->fetch();
//    $isAdmin = $result_row['user_admin'];

    echo '<h4>ID : '.$_SESSION['uid'].'</h3><br>';
    echo '<h4>New PW</h4><input type="text" name="newPw" value=""/><br>';
    echo '<h4>PW Confirm</h4><input type="text" name="confirmPw" value=""/><br>';
//    echo '<h4>IsAdmin : '.$isAdmin.'</h4><br>';
//    echo '<h4>IsLate : '.$isLate.'</h4><br>';
    echo '<input type="button" name="confirm" value="confirm" onClick="javascript:history.back()">';
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
  
?>









































