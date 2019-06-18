<?php
// Start the session
session_start();
$sid=session_id();
$ordernum=substr($sid, -5);
$_SESSION["increment"]+=1;
$ordernum .= $_SESSION["increment"]; 
require_once("dbhandler.php");
$dbhandler = new DbHandler();

if(!empty($_GET["action"])){
	switch($_GET["action"]){
		case "add":
			$itemByCode = $dbhandler->runQuery("SELECT * FROM tblPho where code='" .$_GET["code"]."'");
			$addedArray=array($itemByCode[0]["code"]=>array("name"=>$itemByCode[0]["name"], "price"=>$itemByCode[0]["price"], "code"=>$itemByCode[0]["code"], "qty"=>$_POST["qty"]));
		if(!empty($_SESSION["cart"])){
			if(in_array($itemByCode[0]["code"], $_SESSION["cart"])){
				foreach($_SESSION["cart"] as $key=>$value){
					if($itemByCode[0]["code"]==$key)

					$_SESSION["cart"][$key]["qty"] = $_POST["qty"];
				}
			}
			else
				$_SESSION["cart"]=array_merge($_SESSION["cart"], $addedArray);
		}
		else
		$_SESSION["cart"]=$addedArray;
		break;
		
		case "remove":
			if(!empty($_SESSION["cart"])){
				foreach($_SESSION["cart"] as $key=>$value){
					if($_GET["code"]==$key)
						unset($_SESSION["cart"][$key]);
				}
			}
		break;
		
		case "empty":
			unset($_SESSION["cart"]);
                        unset($_SESSION["customer"]);
			break;	

               case "placeorder":
                        $custphone=$_POST["phone"];
                        $lname=$_POST["last"];
                        $fname=$_POST["first"];
                        $order_date=date("m/d/Y");
                        $_SESSION["customer"]=array("phone"=>$custphone, "last"=>$_POST["last"], "first"=>$_POST["first"]);
                      
                       
                       $existphone=$dbhandler->runQuery("select * from tblCustomer where cust_phone='".$custphone."' ");
                       if(!empty($existphone)){
                       $dbhandler->updateQuery("update tblCustomer set last = '$lname', first = '$fname' where cust_phone='".$custphone."' ");
                       }
                       else{
                        $dbhandler->insertQuery("insert into tblCustomer (cust_phone, last, first) values ('$custphone', '" .$_SESSION["customer"]["last"]."', '".$_SESSION["customer"]["first"]."')");
                       } 
                      
                       foreach ($_SESSION["cart"] as $item){
                       $dbhandler->insertQuery("insert into tblTransaction (order_num, code, qty ) values ('$ordernum', '".$item["code"]."', ".$item["qty"].")");
                       }

                       $dbhandler->insertQuery("insert into tblOrder (order_num, status, order_date, cust_phone) values('$ordernum', 'In Progress', '".$order_date."','$custphone')");
                       unset($_SESSION["cart"]);
                       break;
	}
}

?>

<!DOCTYPE html>
<html

<head>
<title> Home </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script 
src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<script src="jqScript.js"></script>

</head>


<!--body-->
<body>

<!--***PAGE MARGIN***-->
<div class="page-margin">

<!--banner section-->
<div class="banner">

<div class="logo">
<img src="images/logo.jpg">
</div>
<div class="food">
<img src="images/banner.jpg">
</div>

<!--navigation/comes from php include from another php file-->
<div class="navigation">
<?php include 'nav.php' ?>
</div>

<!--end of banner div-->
</div>


<!--order status section-->
<fieldset class="stat">
<legend><strong>Order Status</strong></legend>

<!--search order details-->
<div id="searchdetails">
<!--contents of table come from AJAX-->
<table id="statdetails">
</table>
</div>


<!--orders list-->
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


<!--shopping cart section-->
<fieldset class="cart-sect">
<legend id="cart"> Shopping Cart </legend>
<div id="empty">
<a href="index.php?action=empty"><strong>Empty Cart</strong></a>
</div>
<table>


<tr>
    <th class="name-h">
    </th>
   <th class="qty-h">
	Qty
   </th>
   <th class="price-h">
    Price
  </th>
</tr>

<?php
if(isset($_SESSION["cart"])){
    $item_total = 0;
		
    foreach ($_SESSION["cart"] as $item){
?>

<tr>
    <th class="name">
    <?php echo $item["name"]; ?>
    </th>
   <th class="qty">
   <?php echo $item["qty"]; ?>
   </th>
   <th class="price">
    <?php echo $item["price"] * $item["qty"]; ?>
  </th>

  <th >
     <a id="remove" href="index.php?action=remove&code=<?php echo $item["code"]; ?>"> Remove Item </a>
  </th>
</tr>

<?php
$item_total += ($item["price"] * $item["qty"]);
}
}
?>

<tr>
   
   <th colspan="3" align=right >
   <?php echo "Total: $ " . $item_total; ?>
   </th>
</tr>

<?php
if(!empty($_SESSION["cart"])){
?>

<?php
}
?>
</table>

<?php
if(!empty($_SESSION["cart"])){
?>
<button id="checkout">Check Out</button>
<?php
}
?>

<!--place order form section-->
<fieldset id="form">
<legend><strong>Please enter the following information:</strong></legend>
<form method="post" action="index.php?action=placeorder">
First Name: <br>
<input type="text" name="first"> <br>
Last Name: <br>
<input type="text" name="last"> <br>
Phone Number: <br>
<input type="text" name="phone" required> <br><br>
<div id="btnplace">
<input type="submit" value="Place Order" id="placeord">
</div>
</form>
</fieldset>

<!--end of shopping cart section fieldset-->
</fieldset>


<?php 
if ($_GET["action"]=="placeorder"){ 
if(isset($_SESSION["customer"])){
?>
<fieldset class="orderinfo">
<legend><strong>Your order info:</strong></legend>
    <?php echo "Order number: "; ?>
    <strong> <?php echo strtoupper($ordernum) .nl2br("\n"); ?> </strong>
<?php
    echo "Name: ";	
    echo $_SESSION["customer"]["first"] ." ";
    echo $_SESSION["customer"]["last"] .nl2br("\n");
    echo "Phone: ";
    echo $_SESSION["customer"]["phone"] .nl2br("\n\n");
    echo "Thanks for ordering!";
?>
<br><br>
<button id="close">Close</button>
</fieldset>

<?php
}
}
?>


<!--***CONTENT/MAIN/MENU***-->
<div class="content">

<!--Khai vi section-->

<div class="section-heading">
<strong class="heading">Khai Vi </strong>
<img src="images/chagio.jpg" class="image-display" >
<div class="heading-desc"> Appetizers</div>
</div>

<div class="section-margin">

<table >

	<tr>
		<th class="name-h">
		</th>
		<th class="price-h">
		Price
		</th>
		<th class="qty-h">
		 Qty 
		</th>
	</tr>

<?php
$item_array = $dbhandler->runQuery("SELECT * FROM tblPho where type='khaivi'");
	if (!empty($item_array)) { 
		foreach($item_array as $key=>$value){
?> 

	<tr >
	<ol>
		<td class="name">
			<li><strong> <?php echo $item_array[$key]["name"]; ?> </strong></li>  
		</td>
		
		<td class="price" > 
			<strong> <?php echo $item_array[$key]["price"]; ?> </strong>
		</td>
<form method="post" action="index.php?action=add&code=<?php echo $item_array[$key]["code"]; ?>" >

		<td class="qty">
			<input id="inputqty" type="number" name="qty" min="1" max="5" value="1" />
                        <p id="validateqty"></p>
		</td>
		<td >
			<input type="submit" value="Add to cart" onclick="validateQty()" class="add-btn" />
		</td>
</form>
	</ol>	
	</tr>	

<tr>
	<td>
	<div class="item-desc"> <?php echo $item_array[$key]["description"]; ?> </div>
	</td>
</tr>
		
<?php
}
}
?>

</table>

<!--end content of khai vi section div-->
</div>


<!--Pho section-->

<div class="section-heading">
<strong class="heading">  Pho </strong>
<img src="images/phochin.jpg" class="image-display" >
<div class="heading-desc"> Beef noodle soup</div>
</div>

<div class="section-margin">

<table >

	<tr>
		<th class="name-h">
		</th>
		<th class="price-h">
		Price
		</th>
		<th class="qty-h">
		 Qty 
		</th>
	</tr>

<?php
$item_array = $dbhandler->runQuery("SELECT * FROM tblPho where type='pho'");
	if (!empty($item_array)) { 
		foreach($item_array as $key=>$value){
?> 

	<tr >
	<ol>
		<td class="name">
			<li><strong> <?php echo $item_array[$key]["name"]; ?> </strong></li>  
		</td>
		
		<td class="price" > 
			<strong> <?php echo $item_array[$key]["price"]; ?> </strong>
		</td>
<form method="post" action="index.php?action=add&code=<?php echo $item_array[$key]["code"]; ?>" >

		<td class="qty">
			<input id="inputqty" type="number" name="qty" min="1" max="5" value="1" />
                        <p id="validateqty"></p>
		</td>
		<td >
			<input type="submit" value="Add to cart" onclick="validateQty()" class="add-btn" />
		</td>
</form>
	</ol>	
	</tr>	

<tr>
	<td>
	<div class="item-desc"> <?php echo $item_array[$key]["description"]; ?> </div>
	</td>
</tr>
	
	
<?php
}
}
?>
</table>

<!--end of pho section div-->
</div>


<!--com section-->

<div class="section-heading">
<strong class="heading">Com</strong>
<img src="images/luclac.jpg" class="image-display" >
<div class="heading-desc">Rice dishes</div>
</div>

<div class="section-margin">

<table >

	<tr>
		<th class="name-h">
		</th>
		<th class="price-h">
		Price
		</th>
		<th class="qty-h">
		 Qty 
		</th>
	</tr>

<?php
$item_array = $dbhandler->runQuery("SELECT * FROM tblPho where type='com'");
	if (!empty($item_array)) { 
		foreach($item_array as $key=>$value){
?> 

	<tr >
	<ol>
		<td class="name">
			<li><strong> <?php echo $item_array[$key]["name"]; ?> </strong></li>  
		</td>
		
		<td class="price" > 
			<strong> <?php echo $item_array[$key]["price"]; ?> </strong>
		</td>
<form method="post" action="index.php?action=add&code=<?php echo $item_array[$key]["code"]; ?>" >

		<td class="qty">
			<input id="inputqty" type="number" name="qty" min="1" max="5" value="1" />
                        <p id="validateqty"></p>
		</td>
		<td >
			<input type="submit" value="Add to cart" onclick="validateQty()" class="add-btn" />
		</td>
</form>
	</ol>	
	</tr>	

<tr>
	<td>
	<div class="item-desc"> <?php echo $item_array[$key]["description"]; ?> </div>
	</td>
</tr>
		
<?php
}
}
?>

</table>

<!--end of com section div-->
</div>

<!--end of content section div-->
</div>


<!--footer-->
<footer>
This site is built on PHP, MySQLServer, SQL, AJAX, JQuery, JavaScript, HTML, and CSS. Pls see <a href="metadata.php">Metadata</a> for more info!
</footer>

<!--end of page margin div-->
</div> 

<!--end of body-->
</body>
</html>							