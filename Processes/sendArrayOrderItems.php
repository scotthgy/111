<?php
session_start();

if(isset($_SESSION['ARRAY_ORDERS'])){
  echo json_encode($_SESSION['ARRAY_ORDERS']);
}
else{
  echo json_encode([]);
}
?>