<?php

require_once("dbcontroller.php");
$db_handle = new DBController();



$user=$_POST['user_name'];
$product=$_POST['product'];
$quantity=$_POST['quantity'];
$orderid=$_POST['id'];

$query="SELECT price from tbl_product WHERE product_name='$product'";
$result=$db_handle->runSelectQuery($query);
$price=$result[0]["price"];


$pricebeforediscount=$quantity*$price;
if($product=="Pepsi Cola" && $quantity>=3)
{
	//discount of 20% will be applied of total price
	$discounted=($pricebeforediscount*20)/100;	
	$total=$pricebeforediscount-$discounted;

}
else
{
	$total=$pricebeforediscount;
}


// $query="INSERT INTO tbl_orders(product_name,product_price,quantity,date_of_order,user_name,total_price)
// 	VALUES('$product','$price','$quantity',now(),'$user','$total')";
$query="UPDATE tbl_orders SET product_name='$product',product_price='$price',quantity='$quantity',
		date_of_order=now(),user_name='$user',total_price='$total' WHERE order_id='$orderid'";

$order_id=$db_handle->executeUpdate($query);


if (!empty($order_id))
{
	$msg="order Updated Successfully";
	echo json_encode(['code'=>200,'msg'=>$msg]);
	
}
else
{
	$msg="Failed to Update order";
	echo json_encode(['code'=>404,'msg'=>$msg]);

}


 




?>