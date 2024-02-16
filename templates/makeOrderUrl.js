function makeOrderUrl(this.value) {
	var amountText = document.getElementByName("amount");
	var searchId = document.getElementByName("searchid");
	var urlStr = "addOrderLog.php?id=" + searchId.value + "&source=" + this.value + "&amount=" + amountText.value;
	location.href="https://192.168.1.34/php_project_bookstore/templates/" + urlStr;
}