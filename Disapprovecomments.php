<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/db.php"); ?>

<?php
if(isset($_GET["id"])){
  $idfromurl=$_GET["id"];
  $connectingdb;
  $query="UPDATE comments set status='OFF' WHERE id='$idfromurl' ";
  $Execute=mysqli_query($connection,$query);
  if($Execute){
    $_SESSION["SuccessMessage"]="Comment Dis-Approved Successfully";
    Redirect_to("Comments.php");
  }else{
    $_SESSION["ErrorMessage"]="Something went wrong try again...";
    Redirect_to("Comments.php");
  }

}
 ?>
