<?php
  function singleReviewList($reviewName, $reviewContent, $reviewTime) {    
    echo '<fieldset>';
    
    if($reviewTime == "") {
      $reviewTime = date("Y-m-d");
    }
    echo $reviewName.'('.$reviewTime.')';
    echo '<br>';
    echo $reviewContent;
    echo '</fieldset>';
  }