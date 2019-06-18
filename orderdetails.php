<?php
require_once("dbhandler.php");
$dbhandler = new DbHandler();

$order=$_GET["ordernum"];

$orderstat=$dbhandler->runQuery("select status from tblOrder where order_num='".$order."' ");

if (!empty($orderstat)){

$itemqty=$dbhandler->runQuery("select tblPho.name, tblTransaction.qty from tblPho, tblTransaction, tblOrder " . 
"where tblTransaction.order_num='".$order."' and(tblTransaction.order_num=tblOrder.order_num and tblTransaction.code=tblPho.code)");

$table="<tr><th>Order Number</th><th>Status</th></tr><tr><td>". strtoupper($order) ."</td><td>". $orderstat[0]["status"] ."</td></tr>";
$subtable="<tr><th>Item</th><th>Qty</th></tr>";
foreach($itemqty as $show){
$content.="<tr><td>". $show["name"] ."</td><td>". $show["qty"] ."</td></tr>";
}

echo $table.$subtable.$content;
}

else
echo "<tr><th>Order Number</th><th>Status</th></tr><tr><td>". strtoupper($order) ."</td><td>Not found</td></tr>";

?>
