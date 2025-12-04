<?php
session_start();
if(isset($_SESSION['GRAND_TOTAL'])){
  echo $_SESSION['GRAND_TOTAL'];
}
else{
  echo 0;
}
?>