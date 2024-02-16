<?php
  $title = '제목';
  
  ob_start();
  
  include __DIR__.'/searchBar.html';
  
  $outString = ob_get_clean();
  
  include __DIR__.'/test3.php';
?>