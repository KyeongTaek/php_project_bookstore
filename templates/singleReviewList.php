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
      echo '<form action="tryReviewing.php?id='.$_GET['id'].'" method="post">';
      echo $reviewName.'('.$reviewTime.')<span>FIN<input type="checkbox" name="fin" value="fin" /></span>';
      
      echo '<input type="hidden" name="reviewTime" value="'.$reviewTime.'" />';
    }
    else { // no checkbox
      echo $reviewName.'('.$reviewTime.')';
    }
    echo '<br>';
    
    if($forUser) {
      echo '<textarea name="reviewContent">'.$reviewContent.'</textarea>';
//      echo '<input type="text" name="reviewContent" value="'.$reviewContent.'" />';

//      echo '<input type="button" name="write" value="write" />';
      echo '<input type="submit" value="write" />';
      echo '</form>';
    }
    else {
      echo '<textarea name="reviewContent" readonly>'.$reviewContent.'</textarea>';
//      echo '<input type="text" name="reviewContent" value="'.$reviewContent.'" readonly />';
    }
    
    echo '</fieldset>';
  }
?>