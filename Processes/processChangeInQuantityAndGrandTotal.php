<?php
include_once '../Processes/OrderItem.php';
session_start();

// Initialize session variables if not set
if(!isset($_SESSION['NUMBER_OF_ITEMS_BOUGHT'])){
  $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] = 0;
}
if(!isset($_SESSION['GRAND_TOTAL'])){
  $_SESSION['GRAND_TOTAL'] = 0;
}
if(!isset($_SESSION['ARRAY_ORDERS'])){
  $_SESSION['ARRAY_ORDERS'] = [];
}

$_SESSION['NUMBER_OF_ITEMS_BOUGHT']+=$_REQUEST["diff"];
$_SESSION['GRAND_TOTAL']+=($_REQUEST["unitPrice"]*$_REQUEST["diff"]);


foreach($_SESSION['ARRAY_ORDERS'] as $orderItem){
  if($orderItem->productNumber==$_REQUEST["productNumber"])
  {
    $orderItem->quantityOrdered = $_REQUEST["updatedQty"];
    $orderItem->totalAmount = $_REQUEST["amount"];
  }//if($orderItem->productNumber==$_REQUEST["productNumber"])
}//foreach($_SESSION['ARRAY_ORDERS'] as $orderItem)

$response = array("numItemsBought"=>$_SESSION['NUMBER_OF_ITEMS_BOUGHT'], "updatedGrandTotal"=>$_SESSION['GRAND_TOTAL']);
echo json_encode($response);
 ?>
