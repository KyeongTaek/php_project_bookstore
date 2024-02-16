<?php
  function singleSearchList($searchImage, $searchTitle, $searchAuthor, $searchPublication, $searchPrice, $searchLeft, $searchId, $searchCount, $ownTot) {
    echo '<table style="border: 1px solid">';
    echo '  <tr>';
    echo '    <td rowspan="3"> '.$searchImage.' </td>';
    echo '    <td> Title : '.$searchTitle.' </td>';
    echo '    <td> Author : '.$searchAuthor.' </td>';
    echo '    <td> Publication : '.$searchPublication.' </td>';
    echo '    <td> Price : '.$searchPrice.'.</td>';
    echo '    <td> Left : '.$searchLeft.' </td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td> <input type="button" name="bookInfo" value="bookInfo"> </td>';
    echo '    <td> <input type="button" name="bookReview" value="bookReview"> </td>';
    echo '    <td> <input type="button" name="addWish" value="addWish"> </td>';
    echo '    <td> <input type="button" name="lend" value="lend"> </td>';
    echo '    <td> <input type="button" name="buy" value="buy"> </td>';
    echo '  </tr>';
    echo '  <tr>';
    echo '    <td> <input type="button" name="own" value="own"> </td>';
    echo '    <td> <input type="button" name="deposit" value="deposit"> </td>';
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
    
    return;
  }
?>