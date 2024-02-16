<?php
      include_once __DIR__.'/singleSearchList.php';
      
      $searchImage = '<img src="../images/cosmos.jpg">';
      
      echo $searchImage;
      $searchTitle = "cosmos";
      $searchAuthor = "Segan";
      $searchPublication = "ScienceBooks";
      $searchPrice = 30000;
      $searchLeft = 2;
      $searchId = 17;
      $searchCount = 0;
      $ownTot = 0;
      
      singleSearchList($searchImage, $searchTitle, $searchAuthor, $searchPublication, $searchPrice, $searchLeft, $searchId, $searchCount, $ownTot);
?>