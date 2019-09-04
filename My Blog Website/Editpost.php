<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php ConfirmLogin(); ?>

<?php
if(isset($_POST["submit"]))
{
   $Title=($_POST["Title"]);
   $Category=($_POST["Category"]);
   $Post=($_POST["Post"]);
   date_default_timezone_set("Asia/Kolkata");
   $current=date("M-d-Y H-i-s");
   $Admin="Hritik Kothari";
   $Image=$_FILES["Image"]["name"];
   $Target="Images/".basename($_FILES["Image"]["name"]);


   if(empty($Title)){
     $_SESSION["ErrorMessage"]="Title cant be empty";
     Redirect_to("Editpost.php");
   }else if(strlen($Title)<2){
     $_SESSION["ErrorMessage"]="Title should be atleast 2 characters";
     Redirect_to("Edistpost.php");
   }
   else{
     global $connectingdb;
     $Editfromurl=$_GET['Edit'];
     $query="UPDATE admin_panel SET datetime='$current',title='$Title',
     category='$Category',author='$Admin',image='$Image',post='$Post'
     where id='$Editfromurl'";
     $Execute=mysqli_query($connection,$query);
     move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
     if($Execute){
       $_SESSION["SuccessMessage"]="Post Updated Succesfully";
       Redirect_to("admindashboard.php");
     }else{
       $_SESSION["ErrorMessage"]="Something Went wrong, please try again later..";
       Redirect_to("admindashboard.php");

     }

   }


}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/adminstyles.css">
<style>
.fieldnfo{
  color:rgb(251,174,44);
  font-family: Bitter,Georgia,"Times New Roman",serif;
  font-size: 1.2em;
}

</style>


  </head>
  <body>
    <div class="container-fluid">
      <div class="row">


       <div class="col-sm-2">
     <br><br><br>
         <ul id="side_menu" class="nav nav-pills nav-stacked">
           <li class=""><a href="admindashboard.php"> <span class="glyphicon glyphicon-th"</span> Dashboard  </a></li>
           <li class="active"><a href="AddNewPost.php"> <span class="glyphicon glyphicon-pencil"</span> AddNewPost  </a></li>
           <li class=""><a href="Categories.php"> <span class="glyphicon glyphicon-list-alt"</span> Categories  </a></li>
           <li class=""><a href="#"> <span class="glyphicon glyphicon-user"</span> ManageAdmins  </a></li>
           <li class=""><a href="#"> <span class="glyphicon glyphicon-comment"</span> Comments  </a></li>
           <li class=""><a href="#"> <span class="glyphicon glyphicon-eye-open"</span> LiveBlog  </a></li>
           <li class=""><a href="#"> <span class="glyphicon glyphicon-off"</span> LogOut  </a></li>

         </ul>




       </div>                <!--div ending of side area -->
       <div class="col-sm-10">
        <h1>Update Post</h1>
     <div>  <?php       echo message(); echo successmessage();  ?>  </div>

        <div>
          <?php
          $Searchparameter=$_GET['Edit'];
          $connectingdb;
          $query="SELECT * FROM admin_panel where id ='$Searchparameter'";
          $Execute=mysqli_query($connection,$query);
          while($Datarows=mysqli_fetch_array($Execute)){
               $UpdateTitle=$Datarows['title'];
               $UpdateCategory=$Datarows['category'];
               $UpdateImage=$Datarows['image'];
               $UpdatePost=$Datarows['post'];
          }
           ?>

          <form action="Editpost.php?Edit=<?php echo $Searchparameter; ?>" method="post" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
              <label for="title"> <span class="fieldnfo"> Title: </span></label>
              <input value="<?php echo $UpdateTitle; ?>"class="form-control"type="text" name="Title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
              <span class="fieldnfo"> Existing Category: </span>
              <?php echo $UpdateCategory; ?>
              <br>
            <label for="categoryselect"> <span class="fieldnfo">Category: </span></label>
            <select class="form-control" id="categoryselect" name="Category">

              <?php
              global $connectingdb;
              $viewquery="Select * from category ORDER BY datetime desc";
              $Execute=mysqli_query($connection,$viewquery);

              while($Datarows=mysqli_fetch_array($Execute)){
                  $Id=$Datarows["id"];
                  $Categoryname=$Datarows["name"];

               ?>
               <option><?php echo $Categoryname; ?> </option>
             <?php } ?>


            </select>
            </div>
            <div class="form-group">
              <span class="fieldnfo"> Existing Image: </span>
            <img src="Images/<?php echo $UpdateImage; ?>" width="120" height="80">
            <br>
            <label for="imageselect"> <span class="fieldnfo"> Select Image: </span></label>
          <input type="file" class="form-control" name="Image" id="imageselect">
            </div>
            <div class="form-group">
            <label for="postarea"> <span class="fieldnfo"> Post: </span></label>
          <textarea class="form-control" name="Post" id="postarea">
            <?php echo $UpdatePost; ?>
           </textarea>
            </div>


            <input class="btn btn-success btn-block" type="submit" name="submit" value="Update Post"><br> <br>

            </fieldset>

         </form>
        </div>




       </div>  <!--Ending of main area -->

     </div>  <!-- Ending of row-->

   </div>  <!-- Ending of Container fluid -->
<br><br><br><br><br><br><br><br><br><br><br><br>
<div id="footer">
   <hr> <p> Copyright to Hritik Kothari | All rights reserved.
</p>
<a style="color:white; text-decoration:none; cursor:pointer;font-weight: bold;" href="https://www.facebook.com/hrithik.kothari.12">Facebook Profile</a>


</div>
<div style="height:10px; background: #2f4050;"> </div>







  </body>
</html>
