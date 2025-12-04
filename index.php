<?php
  $pageContent = "contentPages/contentHome.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Home");
  const thisMainSection = document.querySelector("main");
  const thisSection = document.querySelector(".container");
  let thisRow="";
  let productDetails = "";

  <?php
    include("Processes/processConnectDB.php");
    include("Processes/lucasLoavesFunctions.php");

    $sql = "SELECT ProductNumber, ProductName, UnitPrice, ProductImage"
         . " FROM PRODUCT "
         . " WHERE ProductNumber <> 5 LIMIT 4";

     $resultSet = mysqli_query($conn, $sql);
     $itemCount = 0; //Count number of items processed;

    while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))
    {
        if($itemCount==0)
        {
          echo "thisSection.appendChild(createElementWithAttributes('div', {class:'row row-cols-1 row-cols-md-4 g-4 mt-2'}));";
          echo "thisRow = document.querySelector('.row');";
        }

        createCard($record['ProductNumber']
                 , $record['ProductImage']
                 , $record['ProductName']
                 , $record['UnitPrice']);

        $itemCount++;
    }//while($record = mysqli_fetch_array($resultSet, MYSQLI_ASSOC))

    ?>

  //create container for bread making class
  let  imageContainer  = createContainerImage("images/breadMakingClass.jpg")
      ,textContainer = createContainerText({
                         h3:"Bread Making Class"
                        ,p:"Learn to make your own bread $350 plus GST."
                        ,linkButton:{hyperlink:"breadMakingClass.php"
                                    ,buttonClass:"btn btn-lg btn-outline-primary"
                                    ,buttonText:"Go to Page"}
                       })
      ,container = createContainerWithTwoColumns(imageContainer, textContainer);

  thisMainSection.appendChild(container);//bread making class container

  //create container for about Luca's Loaves
  imageContainer  = createContainerImage("images/aboutUs/aboutLuca.jpg");
  textContainer = createContainerText({
                     h3:"About Luca's Loaves"
                    ,ul:["No Store/Commercial yeast"
                        ,"Hand kneaded and shaped in-house"
                        ,"Prepared over 14 - 17 hours"
                        ,"Organic flour"
                        ,"Easy to digest"]
                        ,linkButton:{hyperlink:"aboutUs.php"
                                    ,buttonClass:"btn btn-lg btn-outline-primary"
                                    ,buttonText:"Go to Page"}
                   });
  container = createContainerWithTwoColumns(textContainer, imageContainer);
  thisMainSection.appendChild(container);//about us class container

</script>
