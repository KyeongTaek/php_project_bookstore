<?php
  function singleOrderList($orderId, $orderDate, $orderAddr, $orderBookTitle, $orderBookCost, $orderAmount, $orderType, $orderState) {
    session_start();
    
//    $_SESSION['origin_id'] = $orderId;
//    $_SESSION['date'] = $orderDate;
//    $_SESSION['addr'] = $orderAddr;
//    $_SESSION['title'] = $orderBookTitle;
//    $_SESSION['cost'] = $orderBookCost;
//    $_SESSION['amount'] = $orderAmount;
//    $_SESSION['type'] = $orderType;
//    $_SESSION['state'] = $orderState;
    
    echo '<td>'.$orderId.'</td>';
    echo '<td>'.$orderDate.'</td>';
    echo '<td>'.$orderAddr.'</td>';
    echo '<td>'.$orderBookTitle.'</td>';
    echo '<td>'.$orderBookCost.'</td>';
    echo '<td>'.$orderAmount.'</td>';
    echo '<td>'.$orderType.'</td>';
    echo '<td>'.$orderState.'</td>';
//    echo '<td> <a href="addRefundLog.php?id='.$orderId.'&date='.$orderDate.'&addr='.$orderAddr.'&title='.$orderBookTitle.'&cost='.$orderBookCost.'&amount='.$orderAmount.'&type='.$orderType.'&state='.$orderState.'"'> <input type="button" name="refund" value="refund"/> </a></td>';    
    echo '<td> <a href="addRefundLog.php?orderId='.$orderId.'"> <input type="button" name="refund" value="refund"/> </a></td>';
  }
?>