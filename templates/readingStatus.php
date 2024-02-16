<?php
  session_start();
  
  try {
    $pdo = new PDO('mysql:host=192.168.1.34; dbname=kt_php_bookstore; charset=utf8', 'root', 'sj4321');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo '<select name="year">';
    $year_idx = 2020;
    while($year_idx<2024) {
      echo '<option value="'.$year_idx.'">'.$year_idx.'</option>';
      $year_idx++;
    }
    echo '</select>';
    echo '<select name="month">';
    $month_idx = 1;
    while($month_idx<=12) {
      echo '<option value="'.$month_idx.'">'.$month_idx.'</option>';
      $month_idx++;
    }
    echo '</select>';
    
    $selectedMonth = setDate(2023, 12, 1);
    $time = $selectedMonth->format('U');
    $date = getDate($time);
    
    $days = $date['mday']; // 28 30 31
    $wday = $date['wday']; // sun ~ sat, 0 ~ 6
    
    echo '<table border="1">';
    echo '  <tr>';
    echo '    <th>Mon</th> <th>Tue</th> <th>Wed</th> <th>Thu</th> <th>Fri</th> <th> Sat </th> <th> Sun </th>';
    echo '  </tr>';
    echo '  <tr>';
    
    $cnt = 1;
    while($cnt<=$days) {
      if($cnt/7 == 1
    }
    
  } catch(PDOException $e) {
    echo 'DB 접속 오류 : '.$e->getMessage().
                          '<br>오류 발생 파일 : '.$e->getFile().
                          '<br>오류 발생 행 : '.$e->getLine();
  }
?>


You have read XX books in total this month

<table border="1">
    <tr>
      <th>Mon</th> <th>Tue</th> <th>Wed</th> <th>Thu</th> <th>Fri</th> <th> Sat </th> <th> Sun </th>
    </tr>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
    <tr>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
    </tr>
    <tr>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
      <td>1</td>
    </tr>
</table>