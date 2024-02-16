<?php
  function singleOrderList($orderId, $orderDate, $orderAddr, $orderBookTitle, $orderBookCost, $orderAmount, $orderType, $orderState) {
    echo '<td>'.$orderId.'</td>';
    echo '<td>'.$orderDate.'</td>';
    echo '<td>'.$orderAddr.'</td>';
    echo '<td>'.$orderBookTitle.'</td>';
    echo '<td>'.$orderBookCost.'</td>';
    echo '<td>'.$orderAmount.'</td>';
    echo '<td>'.$orderType.'</td>';
    echo '<td>'.$orderState'</td>';
    echo '<td><input type="button" name="refund" value="refund"/></td>';
  }
?>