<?php
require_once("dbhandler.php");
$dbhandler = new DbHandler();

$orderstat=$dbhandler->runQuery("select status from tblOrder where order_num='".$_GET["ordernum"]."' ");
echo $orderstat[0]["status"];

if (empty($orderstat))
echo "Not Found"

?>