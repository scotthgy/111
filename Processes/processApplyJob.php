<?php
include_once "../Processes/processConnectDB.php";
include_once "../Processes/OrderItem.php";
include_once "../Processes/lucasLoavesFunctions.php";
session_start();

if(isset($_POST['APPLY_JOB']))
{
    $postNumber = $_POST['postNumber'];
    $firstName  = $_POST['firstName'];
    $lastName   = $_POST['lastName'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $uploadResume = uploadFile($_FILES['uploadResume']);
    $uploadCoverLetter = uploadFile($_FILES['uploadCoverLetter']);

    $sql = "INSERT INTO APPLICANT(ApplicantFirstname"
         . ", ApplicantLastname"
         . ", ApplicantEmail"
         . ", ApplicantPhone"
         . ")"
         . "VALUES ('$firstName'"
         . ", '$lastName'"
         . ", '$email'"
         . ", '$phone')";
    
    //IF INSERT SUCCESSFUL 
    if($resultSet = mysqli_query($conn, $sql)){
        //Get the latest applicant number
        $applicantNumber = getLastInsertID($conn);
        
        $sql = "INSERT INTO APPLICATIONLINE(PostNumber"
        . ", ApplicantNumber"
        . ", Resume"
        . ", CoverLetter"
        . ")"
        . "VALUES ('$postNumber'"
        . ", '$applicantNumber'"
        . ", '$uploadResume'"
        . ", '$uploadCoverLetter')";

        $resultSet = mysqli_query($conn, $sql);

        //Get the latest reference number
        $_SESSION['REFERENCE_NUMBER'] = getLastInsertID($conn);

    }//IF INSERT SUCCESSFUL if($resultSet = mysqli_query($conn, $sql)){
    
}//if(isset($_POST['APPLY_JOB']))

header("Location: ".getWorkingFolderURL()."messageJobApplicationSent.php");
exit;

 ?>
