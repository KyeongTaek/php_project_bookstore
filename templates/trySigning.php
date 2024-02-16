<?php
  session_start();

  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "select user_pw from `book_user` WHERE user_name = '".$_POST['user_id']."'"; // search db for typed id
    $result = $pdo->query($sql);
    $user = $result->fetch();
    
    if($user == "") { // no same id exists
      $sql = "insert into `book_user` (`user_name`, `user_pw`, `user_admin`, `user_cash`, `user_addr`) VALUES ('".$_POST['user_id']."', '".$_POST['user_pw']."', 0, 0, '".$_POST['user_addr']."')";
      echo $sql.'<br>';
      
      $statement = $pdo->prepare($sql);
      
      $statement->execute();
      
      echo 'SIGN UP SUCCESSFUL!!';
    }  
    else { // same id exists
      echo 'SIGN UP FAILED!!';
    }
    
  //  echo '<script type="text/javascript">history.go(-2);</script>';
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }  
?>