<?php
  session_start();

  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }  

  $sql = "select user_pw from `book_user` WHERE user_name = '".$_POST['user_id']."'"; // search db for typed id. get its pw
  $result = $pdo->query($sql);
  $user = $result->fetch();
  
  if($user == "") {
    echo 'LOGIN FAILED!! USER DOES NOT EXIST!!';
  }  
  else if($_POST['user_pw'] == $user['user_pw']) { // typed pw == db pw --> logged in
    $_SESSION['uid'] = $_POST['user_id']; // create id, pw session
    $_SESSION['password'] = $_POST['user_pw'];
    
    echo 'LOGIN SUCCESSFUL!!';
  }
  else { // typed pw != db pw --> not logged in
    echo 'LOGIN FAILED!!';
  }
  
  echo '<script type="text/javascript">history.go(-2);</script>';
?>