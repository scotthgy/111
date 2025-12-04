<?php
include("processConnectDB.php");
include("OrderItem.php");
include("lucasLoavesFunctions.php");
session_start();

$isItemAlreadyAddedToOrder = false;

if(isset($_POST['JOIN_CLASS']))
{
  $_SESSION['PRODUCT_NUMBER'] = 5;
  $_SESSION['QUANTITY_ORDERED'] = 1;
}//if(isset($_POST['JOIN_CLASS']))

if(isset($_POST['SHOPPINGCART']))
{
  $_SESSION['QUANTITY_ORDERED'] = $_POST['tbQuantity'];
}//if(isset($_POST['SHOPPINGCART']))

// Initialize ARRAY_ORDERS if not set
if(!isset($_SESSION['ARRAY_ORDERS'])){
  $_SESSION['ARRAY_ORDERS'] = [];
}

// Initialize GRAND_TOTAL if not set
if(!isset($_SESSION['GRAND_TOTAL'])){
  $_SESSION['GRAND_TOTAL'] = 0;
}

//BEGIN: Check if the item has been bought:
foreach($_SESSION['ARRAY_ORDERS'] as $orderItem)
{
  if($orderItem->productNumber==$_SESSION["PRODUCT_NUMBER"])
  {
    //if the item has been bought, add the quantity only.
    $orderItem->quantityOrdered+=$_SESSION['QUANTITY_ORDERED'];
    $orderItem->totalAmount = $orderItem->unitPrice * $orderItem->quantityOrdered;
    $_SESSION['GRAND_TOTAL'] += $_SESSION['UNIT_PRICE'] * $_SESSION['QUANTITY_ORDERED'];
    $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] += $_SESSION['QUANTITY_ORDERED'];
    $isItemAlreadyAddedToOrder = true;
  }
}//foreach($_SESSION['ARRAY_ORDERS'] as $orderItem)

if($isItemAlreadyAddedToOrder==false)
{
  addItemsToOrder($conn);

  $_SESSION['GRAND_TOTAL'] += $_SESSION['TOTAL_AMOUNT'];

  if(isset($_SESSION['NUMBER_OF_ITEMS_BOUGHT']))
  {
    $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] = $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] + $_SESSION['QUANTITY_ORDERED'];
  }
  else {
    //first item to buy
    $_SESSION['NUMBER_OF_ITEMS_BOUGHT'] = $_SESSION['QUANTITY_ORDERED'];
  }

}//if($isItemAlreadyAddedToOrder==false)

//END: Check if the item exist:

header("Location: ".getWorkingFolderURL()."shoppingCart.php"); 
exit();
 ?>
