<?php
  function singleReviewList($reviewName, $reviewContent, $reviewTime) {    
    echo '<fieldset>';
    
    $forUser = false;
    if($reviewTime == "") {
      $reviewTime = date("Y-m-d");
      if($reviewContent == "") {
        $forUser = true;
      }
    }
    
    if($forUser) { // checkbox meaning 'finished reading'
      echo $reviewName.'('.$reviewTime.')<span>FIN<input type="checkbox" name="fin" value="FIN" /></span>';
    }
    else { // no checkbox
      echo $reviewName.'('.$reviewTime.')';
    }
    echo '<br>';
    
    if($forUser) {
      echo '<textarea name="reviewContent">'.$reviewContent.'</textarea>';
//      echo '<input type="text" name="reviewContent" value="'.$reviewContent.'" />';
      echo '<input type="button" name="write" value="write" />';
    }
    else {
      echo '<textarea name="reviewContent" readonly>'.$reviewContent.'</textarea>';
//      echo '<input type="text" name="reviewContent" value="'.$reviewContent.'" readonly />';
    }
    
    echo '</fieldset>';
  }
?>