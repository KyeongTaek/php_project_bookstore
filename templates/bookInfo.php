<?php
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT book_date, book_pages, book_summary, book_index FROM book_info WHERE id = ".$_GET['id'];
    echo $sql.'<br>';
    
    $result = $pdo->query($sql)->fetchAll();
    
    echo '<h4>품목정보</h4>';
    echo '<table>';
    echo '  <tr>';
    echo '    <td>발행일</td>';
    echo '    <td>'.$result['book_date'].'</td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td>쪽수</td>';
    echo '    <td>'.$result['book_pages'].'</td>';
    echo '  </tr>';
    echo '</table>';
    echo '<h4>책소개</h4>';
    echo ' <h5>'.$result['book_summary'].'</h5>';
    echo '<h4>목차</h4>';
    echo '<h5>'.$result['book_index'].'</h5>';    
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }  
?>