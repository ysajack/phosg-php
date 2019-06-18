<?php
// Start the session
require_once("dbhandler.php");
$dbhandler = new DbHandler();

if(!empty($_GET["ordnum"])){
$dbhandler->updateQuery("update tblOrder set status='Ready' where order_num='".$_GET["ordnum"]."' ");
}

if(!empty($_GET["showitemqty"])){
$itemqty=$dbhandler->runQuery("select tblPho.name, tblTransaction.qty from tblPho, tblTransaction, tblOrder " .
"where tblTransaction.order_num='".$_GET["showitemqty"]."' and(tblTransaction.order_num=tblOrder.order_num and tblTransaction.code=tblPho.code)");
}

?>

<!DOCTYPE html>
<html

<head>
<title> Fill Orders </title>
<link rel="stylesheet" type="text/css" href="style.css">

<script 
src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<script src="jqScript.js"></script>

<!--refresh the page every 15mins to auto-repopulate new in progress orders-->
<script>
setTimeout(function(){
   window.location.reload(1);
}, 150000);
</script>

</head>


<!--body-->
<body>

<!--**PAGE MARGIN**-->
<div class="page-margin">

<!--navigation/comes from php include from another php file-->
<div class="navigation">
<?php include 'nav.php' ?>
</div>

<!--order status section-->
<fieldset class="stat">
<legend><strong>Order Status</strong></legend>


<div id="searchdetails">

<!--search order details/contents of table come from AJAX-->
<table id="statdetails">
</table>

</div>


<!--orders list section-->
<div id="orderlist">
<table>
<tr>
<th>
Order Number
</th>
<th>
Status
</th>
</tr>

<!--query shows the last 5 orders (last descending) and in ascending order from the last 5 descending orders-->
<?php
$statArray=$dbhandler->runQuery("(select order_num, status, id from tblOrder order by id desc limit 5) order by id asc");
if(!empty($statArray)){
foreach ($statArray as $key=>$value){

?>

<tr>
<td>
<?php echo strtoupper($statArray[$key]["order_num"]); ?>
</td>
<td>
<?php echo $statArray[$key]["status"]; ?>
</td>
</tr>

<?php
}
}
?>

<tr>
<td id="num">
</td>
<td id="numstat">
</td>
</tr>

</table>

<!--end of orders list div-->
</div>

<br>
<button id="closestat">Close</button>

<!--end of order status section fieldset-->
</fieldset>


<!--enter order number section-->
<div id="enternum">
<form>
Enter order number: <br>
<input type="text" name="ordernum"<br>
<button type="button" onclick="lookDetails(ordernum.value)" id="btnlookup">Submit</button>
</form>
</div>

<!--**CONTENT**-->
<div class="content">
<h1>Backend Order Filling</h1>
<!--end content div-->
</div>

<!--order details section-->
<fieldset id="orderdetails">
<legend style="font-size: 1.2em;"><strong>Order Details<strong></legend>
<table id="showitemqty">
<tr>
<th>
 Order Number 
 </th>
</tr>
<tr>
<td>
<?php echo strtoupper($_GET["showitemqty"]); ?>
</td>
</tr>

<tr>
 <th>
 Item 
 </th>
 <th>
 Qty
 </th>
</tr>
<tr>

<?php

if(!empty($itemqty)){
foreach ($itemqty as $show){
?>
   <td>
    <?php echo $show["name"]; ?>
   </td>
   <td>
    <?php echo $show["qty"]; ?>
   </td>
</tr>
<?php
}
}
?>
</table>

<!--end of order details section fieldset-->
</fieldset>


<!--fill order section-->
<div id="tbldiv">
<table id="fill-table">
<tr>
<th>
Date
</th>
<th>
Order Number
</th>
<th>
First
</th>
<th>
Last
</th>
<th>
Phone
</th>
<th>
Status
</th>
<th>
Fill Order
</th>
</tr>

<?php
$orderArray=$dbhandler->runQuery("SELECT tblOrder.order_date, tblOrder.order_num, tblCustomer.first, tblCustomer.last, tblCustomer.cust_phone, tblOrder.status " .
"from tblOrder, tblCustomer where status='In Progress' and tblCustomer.cust_phone=tblOrder.cust_phone");
if(!empty($orderArray)){
foreach($orderArray as $key=>$value){
?>
<tr>
<td>
<?php echo $orderArray[$key]["order_date"]; ?>
</td>
<td>
<a href="fillorder.php?showitemqty=<?php echo $orderArray[$key]["order_num"];?>"> <?php echo strtoupper($orderArray[$key]["order_num"]);?></a>   
</td>
<td>
<?php echo $orderArray[$key]["first"]; ?>
</td>
<td>
<?php echo $orderArray[$key]["last"]; ?>
</td>
<td>
<?php echo $orderArray[$key]["cust_phone"]; ?>
</td>
<td>
<?php echo $orderArray[$key]["status"]; ?>
</td>
<td>
<form method="post" action="fillorder.php?ordnum=<?php echo $orderArray[$key]["order_num"];?>">
<input type="submit" value="Complete">
</form>
</td>
</tr>

<?php
}
}
?>
</table>

<!--end of fill order section div-->
<div>

<!--end page margin div-->
</div> 

<!--end of body-->
</body>

</html>						