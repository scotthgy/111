<?php
  $pageContent = "contentPages/contentProducts.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Products");
  const thisSection = document.querySelector(".container");
  let thisRow="";
  let productDetails = "";

  <?php
    include("Processes/processConnectDB.php");
    include("Processes/lucasLoavesFunctions.php");

    $sql = "SELECT ProductNumber, ProductName, UnitPrice, ProductImage"
         . " FROM PRODUCT"
         . " WHERE ProductNumber <> 5";

    $resultSet = mysqli_query($conn, $sql);
    $itemCount = 0; //Count number of items processed;
    $rowCount = 0; //Number of rows

    while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
    {
        if($itemCount==0)
        {
          echo "thisSection.appendChild(createElementWithAttributes('div', {class:'row row-cols-1 row-cols-md-4 g-4 mt-2'}));";
          echo "thisRow = document.querySelectorAll('.row')[".$rowCount."];";
        }

        createCard($record['ProductNumber']
                 , $record['ProductImage']
                 , $record['ProductName']
                 , $record['UnitPrice']);

        $itemCount++;

        if($itemCount==4){
          $itemCount = 0;//reset the $itemCount
          $rowCount++;
        }
    }//while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
     ?>
</script>
