<?php
require_once("dbmethods.php");
$dbmeth=new DBmethods();

?>
<html>


<body>

<?php
$result=$dbmeth->runQuery("select * from tblOrder where status='In Progress' ");
if (!empty($result)){
foreach ($result as $show){
echo $show["order_num"];
echo $show["status"];

}
}


?>

</body>
</html>