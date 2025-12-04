<?php
  $pageContent = "contentPages/contentJobDetails.php";
  include("templates/template.php");
?>
<script type="text/javascript">
  setPageTitle("Job Details");

  window.addEventListener("load", function(){
    const thisHiddenPostNumberTextbox = document.querySelector("#hiddenPostNumber");
    const thisJobName = document.querySelector(".jobName");
    const thisJobDescription = document.querySelector(".jobDescription");
    const postNumberFromURL = getPostNumberFromURL(location.search);
    const  serverFileSendJobDetails = "Processes/sendJobDetails.php?postNumber=".concat(postNumberFromURL);
    
    ajaxGetDataFromServer(serverFileSendJobDetails, function(parJobDetails){
      thisHiddenPostNumberTextbox.value = postNumberFromURL;
      thisJobName.textContent = parJobDetails.JobName;
      thisJobDescription.textContent = parJobDetails.JobDescription;
      
    });//ajaxGetDataFromServer(serverFileSendJobDetails, function(){
    

  });//window.addEventListener("load", function(){

  document.querySelector(".btnTestData").addEventListener("click", function(){
    document.querySelector("input[name='firstName']").value="Chris";
    document.querySelector("input[name='lastName']").value="Lee";
    document.querySelector("input[name='phone']").value="0411111111";
    document.querySelector("input[name='email']").value="chrisLee@email.com";

  });

</script>
