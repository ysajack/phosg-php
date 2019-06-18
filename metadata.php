<?php
// Start the session
require_once("dbhandler.php");
$dbhandler = new DbHandler();
?>

<!DOCTYPE html>
<html
<head>
<title> Metadata </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script 
src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<script src="jqScript.js"></script>
</head>

<body>

<div class="page-margin">

<div class="navigation">
<?php include 'nav.php' ?>
</div>

<fieldset class="stat">
<legend><strong>Order Status</strong></legend>
<table>
<tr>
<th>
Order Number
</th>
<th>
Status
</th>
</tr>

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
<br>
<button id="closestat">Close</button>
</fieldset>


<div id="enternum">
<form>
Enter order number: <br>
<input type="text" name="ordernum"<br>
<button type="button" onclick="orderLookup(ordernum.value)" >Submit</button>
</form>
</div>


<div class="content">
<h1>Metadata</h1>
<!--end content div-->
</div>

<div id="functions">
<p>
<strong style="font-size: 1.5em;">Functions</strong>{ <br>
       <strong>Check order status and order details info display: PHP, AJAX, SQL, JQuery</strong>{ <br>
		>JQuery slides down the Order Display Grid <br>
		>PHP and SQL query MySQL database and display the status of the latest 5 orders in ascending order <br>
		>When order number is entered, AJAX and POST/GET method send off order info to .php file <br>
		>PHP processes the info, has SQL query the database, and returns the info in a table format back to AJAX <br>
		>AJAX displays the order details info in the Order Display Grid (only) without refreshing the page <br>
	} <br><br>

	<strong>Add items function: PHP</strong>{ <br>
		>POST/GET method sends off items to .php file <br>
		>PHP stores items in $_SESSION[cartArray][itemsArray[attributesArray]] (which means multi-dimensional array) <br>
	} <br><br>

	<strong>Remove items function: PHP</strong>{ <br>
		>POST/GET method sends off items to .php file <br>
		>PHP removes items from $_SESSION[cartArray][itemsArray[attributesArray]] (multi-dimensional array) <br>
	} <br><br>
	
	<strong>Display items in cart: PHP</strong>{ <br>
		>PHP queries $_SESSION["cart"] after items stored and displays them <br>
	} <br><br>

	<strong>Empty cart function: PHP</strong>{ <br>
		>PHP unsets $_SESSION["cart"], which makes cart empty <br>
	}<br><br>

	<strong>Checkout button behaviors: JQuery</strong>{ <br>
		>placeOrderForm slides down  <br>
		>checkout button hides <br>
	} <br><br>

        <strong>Lookup order button behaviors: JQuery</strong>{ <br>
		>table of the latest 5 orders status hides <br>
		>table of the order details being looked up comes from AJAX shows<br>
	} <br><br>

	<strong>Place order: PHP, SQL</strong>{ <br>
		>POST/GET method sends off customer form info to .php file <br>
		>PHP and SQL store customer info in $_SESSION["customers"] <br>
		>PHP and SQL insert customer info into tblCustomers in MySQL database <br>
		>PHP and SQL insert order info into tblOrders in the database such as: tblOrders(item_id, qty, customer_phone, "In Progress") <br>
		>PHP generates order number, which is captured partially from session_id with concatenated incremental <br>
		>Order number is given to customers with info echo'd back from $_SESSION["customers"] <br>
	} <br><br>

	<strong>Fill order: PHP, SQL</strong>{ <br>
		>PHP and SQL querry MySQL database and display "In Progress" orders that need to be filled <br>
		>When "Complete" button is clicked, POST/GET method sends off order info to .php file <br>
		>PHP and SQL update the "Ready" status on the order accordingly into the database <br>
                >When hyperlink order number is clicked, POST/GET method sends off order number info to .php file <br>
                >PHP processes the info, has SQL query the database, and populates/displays the order details info in the Order Details Display Grid <br>
	} <br><br>
        
        <strong>Auto-populate new incoming in progress orders: JavaScript</strong>{ <br>
               >JavaScript setTimeout calls the function to refresh the page every 15 mins (or based on the time set)<br>
               >The page is reloaded, which means repopulating any new incoming in progress orders to be filled<br>
        }<br><br>

        <strong>Input validity: JavaScript, HTML "required"</strong>{ <br>
               >If phone number, which is a required field, is not entered, alert message insists <br>
               >If quantity, which is set to be between 1-5, is not within the range, alert message insists <br>
        }<br><br>

	<strong>Display menu: PHP, SQL, HTML, CSS</strong>{ <br>
		>PHP and SQL query MySQL database and display the items in the menu <br>
		>PHP and HTML provide "Add to cart" option for every item displayed in the menu<br>
	} <br>
}
</p>
</div>


<div id="algorithm">
<p>
<strong style="font-size: 1.5em;">Shopping-cart algorithm</strong>{ <br>
        action will be triggered by the GET/POST method <br>
	case: add <br>

	if there's qty to be added with item_id sent from the GET/POST method <br>
	query database statement by item_id and store results in resultset <br>
	store info in setupArray as: array[itemsArray[item_id][array(name, item_id, qty)] (multi-dimensional array) <br><br>

	if cart not empty (which means there's something in cart) <br>
	if item_id found in cart <br>
	loop through cart <br>
	if item_id == item_id in cart <br>
	update qty as: cart[cart][item_id][qty]=post[qty] (or += post[qty]) <br><br>
	
	if to-be-added item_id not found in cart <br>
	merge cart (which means add new to cart) <br><br>
	
	if cart empty <br>
	update cart by array from setupArray <br><br>

	case: remove <br>
	if cart not empty (most likely not, but just to be safe)<br>
	loop thru cart <br>
	if to-be-removed item_id == item_id in cart <br>
	remove (unset) the item_id in cart <br>
	if cart empty (this scenario shouldn't happen, but just to be safe) <br>
	unset cart <br><br>

	case: empty <br>
	empty (unset) all items in cart <br>
}
</p>
</div>


<div id="tbl">
<p>

<strong style="font-size: 1.5em">Database Tables</strong>( <br>
tblItems(item_id, type, item_name, description, price) <br>
tblCustomers(phone, last, first) <br>
tblOrders(order_num, order_date, status, phone) <br>
tblTransactions(trans_id, item_id, quantity, order_num) <br>
) <br><br>

<strong style="font-size: 1.5em">Theme:</strong> HTML, CSS, Graphics, PHP (from scratch) <br><br><br><br><br>

</p>
</div>

<!--end page margin div-->
</div> 

</body>
</html>						