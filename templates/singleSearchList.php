<?php
  function data_uri($binImage, $mime)
  {
    $base64 = base64_encode($binImage);
    
    return ('data:'.$mime.';base64,'.$base64);
  }

  function singleSearchList($searchImage, $searchTitle, $searchAuthor, $searchPublication, $searchPrice, $searchLeft, $searchId, $searchCount, $ownTot, $cnt) {
    echo '<table style="border: 1px solid">';
    echo '  <tr>';
    echo '    <td rowspan="3"> <img src="'.data_uri($searchImage, 'image/png').'"/> </td>';
//    echo '    <td rowspan="3"> <img src="data:image/jpg;charset=utf8;base64,'.base64_encode($searchImage).'"/> </td>';
    echo '    <td> Title : '.$searchTitle.' </td>';
    echo '    <td> Author : '.$searchAuthor.' </td>';
    echo '    <td> Publication : '.$searchPublication.' </td>';
    echo '    <td> Price : '.$searchPrice.' </td>';
    echo '    <td> Left : '.$searchLeft.' </td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td> <a href="bookInfo.php?id='.$searchId.'"> <input type="button" name="bookInfo" value="bookInfo"> </a></td>';
    echo '    <td> <a href="reviewList.php?id='.$searchId.'"> <input type="button" name="bookReview" value="bookReview"> </a></td>';
    echo '    <td> <a href="addWish.php?id='.$searchId.'"> <input type="button" name="addWish" value="addWish"> </a></td>';
    
    //echo '    <td> <a href="addOrderLog.php?id='.$searchId.'&source=lend&amount='.$amount.'"> <input type="button" name="lend" value="lend" onclick="makeOrderUrl()"> </a></td>';
    echo '    <td> <input type="button" name="lend" value="lend" onclick="makeOrderUrl('.$cnt.', \'lend\')"> </td>';
    
    //echo '    <td> <a href="addOrderLog.php?id='.$searchId.'&source=buy"> <input type="button" name="buy" value="buy"> </a></td>';
    echo '    <td> <input type="button" name="buy" value="buy" onclick="makeOrderUrl('.$cnt.', \'buy\')"> </td>';
    
    echo '  </tr>';
    echo '  <tr>';
    
//    echo '    <td> <a href="addOrderLog.php?id='.$searchId.'&source=own"> <input type="button" name="own" value="own"> </a></td>';
    echo '    <td> <input type="button" name="own" value="own" onclick="makeOrderUrl('.$cnt.', \'own\')"> </td>';
//    echo '    <td> <a href="addOrderLog.php?id='.$searchId.'&source=deposit"> <input type="button" name="deposit" value="deposit"> </a></td>';
    echo '    <td> <input type="button" name="deposit" value="deposit" onclick="makeOrderUrl('.$cnt.', \'deposit\')"> </td>';
    
    echo '    <td> <input type="hidden" name="searchid" value="'.$searchId.'"> amount : <input type="text" name="amount"> </td>';
    
    if($searchCount == 0) {
      echo '<td> You have never read this book </td>';
     }
     else {
      echo '<td> You have read this book '.$searchCount.' times </td>';
    }
    
    if($ownTot == 0) {
      echo '<td> You do not have any copies of this book </td>';
    }
    else {
      echo '<td> You have '.$ownTot.' copies of this book </td>';
    }
    
    echo '  </tr>';
    echo '</table>';
    
    echo 'cnt = '.$cnt.'<br>';
    
    return;
  }
?>