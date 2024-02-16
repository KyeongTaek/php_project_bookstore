<?php
  session_start();

  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "select id from book_user where user_name = '".$_SESSION['uid']."'";
    echo $sql.'<br>';
    
    $result = $pdo->query($sql);
    $user_id = $result->fetch();
    
    if($_POST['fin']) {
      $checkRst = 1;
    }
    else {
      $checkRst = 0;
    }
    
    $sql = "insert into `book_review` (`book_id`, `user_id`, `review_content`, `review_time`, `review_type`, `review_relatedId`)".
    " VALUES (".$_GET['id'].", ".$user_id['id'].", '".$_POST['reviewContent']."', '".$_POST['reviewTime']."', ".$checkRst.", 0)";
    echo $sql.'<br>';
      
    $statement = $pdo->prepare($sql);
      
    $statement->execute();

//    echo '<script type="text/javascript">history.go(-1);</script>';
    echo '<script type="text/javascript">location.href = "reviewList.php?id='.$_GET['id'].'"</script>';
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }  
?>