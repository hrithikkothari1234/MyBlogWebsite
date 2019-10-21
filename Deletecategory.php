<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/db.php"); ?>

<?php
if(isset($_GET["id"])){
  $idfromurl=$_GET["id"];
  $connectingdb;
  $query="DELETE FROM category WHERE id='$idfromurl' ";
  $Execute=mysqli_query($connection,$query);
  if($Execute){
    $_SESSION["SuccessMessage"]="Category Deleted Successfully";
    Redirect_to("Categories.php");
  }else{
    $_SESSION["ErrorMessage"]="Something went wrong try again...";
    Redirect_to("Categories.php");
  }

}
 ?>
