<?php
  session_start();
  include_once __DIR__.'/singleOrderList.php';
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(!isset($_SESSION['uid'])) {
      echo 'exit!!<br>';
    }
    $sql = "SELECT id FROM book_user WHERE user_name = '".$_SESSION['uid']."'";
    $result = $pdo->query($sql);
    $id = $result->fetch()['id'];
    
    $sql = "SELECT book_order.id, book_order.order_date, book_order.user_addr, book_info.book_title, book_info.book_cost, book_order.order_amount, book_order.order_type, book_order.order_state from book_order INNER JOIN book_info ON book_order.book_id = book_info.id WHERE book_order.user_id = ".$id;
//    echo $sql.'<br>';
    
    $result = $pdo->query($sql);
    
    echo '<table border="1">';
    echo '<tr>';
    echo '  <th>id</th>';
    echo '  <th>date</th>';
    echo '  <th>addr</th>';
    echo '  <th>title</th>';
    echo '  <th>cost</th>';
    echo '  <th>amount</th>';
    echo '  <th>type</th>';
    echo '  <th>state</th>';
    echo '</tr>';
    
    $cnt = 0;    
    foreach($result as $row) {
      $orderId = $row['id'];
      $orderDate = $row['order_date'];
      $orderAddr = $row['user_addr'];
      $orderBookTitle = $row['book_title'];
      $orderBookCost = $row['book_cost'];
      $orderAmount = $row['order_amount'];
      $orderType = $row['order_type'];
      $orderState = $row['order_state'];
      
      echo '<tr>';  
      singleOrderList($orderId, $orderDate, $orderAddr, $orderBookTitle, $orderBookCost, $orderAmount, $orderType, $orderState, $cnt);
      $cnt++;
      echo '</tr>';
    }
    echo '</table>';
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
  

?>