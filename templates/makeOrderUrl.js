function makeOrderUrl(cnt, value) {
	var amountText = document.getElementsByName("amount");
	var searchId = document.getElementsByName("searchid");
	
	var urlStr = "addOrderLog.php?id=" + searchId[cnt].value + "&source=" + value + "&amount=" + amountText[cnt].value;
	location.href=urlStr;
//  document.write("192.168.1.34/php_project_bookstore/templates/" + urlStr);
}