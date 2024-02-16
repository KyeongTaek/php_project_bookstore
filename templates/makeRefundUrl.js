function makeRefundUrl(id) {
	var urlStr = "addRefundLog.php?id=" + id;
	location.href=urlStr;
//  document.write("192.168.1.34/php_project_bookstore/templates/" + urlStr);
}