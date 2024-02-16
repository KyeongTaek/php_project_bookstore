<?php
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo 'MySQL 접속 성공 1';
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                        '<br>오류 발생 파일 : '.$e->getFile().
                        '<br>오류 발생 행 : '.$e->getLine();
  }
?>