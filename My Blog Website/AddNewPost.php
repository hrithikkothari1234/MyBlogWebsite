<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php ConfirmLogin(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="favicon.ico">
   <script src="https://kit.fontawesome.com/76a3098157.js"></script>
    <link type="text/css" rel="stylesheet" href="css/adminstyles.css">
<style>
.fieldnfo{
  color:rgb(251,174,44);
  font-family: Bitter,Georgia,"Times New Roman",serif;
  font-size: 1.2em;
}
.adminlistnav{
  font-weight: bold;
  font-family: Georgia,Times,serif;
  font-size: 1.2em;
}

</style>


  </head>
  <body>
    <div class="navline" style="height: 10px;
    background: #27aae1;">
    </div>
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
              <span class="sr-only">Toggle Navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="Blog.php" > <img style="margin-top:-14px;" src="Images/hk.jpg" width="100" height="50"> </a>
        </div>
        <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav">
          <li class="active adminlistnav"> <a href="Login.php">Admin Login </a></li>
          <li class=" adminlistnav"> <a href="Blog.php" target="_blank">Blog </a></li>
          <li class="adminlistnav"> <a href="Contactus.php" target="_blank">Contact Me </a></li>
        </ul>
        <form action="Blog.php" class="navbar-form navbar-right">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" name="Search">
          </div>
          <button class="btn btn-default" name="Searchbutton">Go </button>
        </form>
      </div>

    </div>
  </nav>
  <div class="navline line2" style="height: 10px;
  background: #27aae1; margin-top: -20px;">
  </div>
    <div class="container-fluid">
      <div class="row">


       <div class="col-sm-2">
         <h1 style="color: #AFEEEE; text-align:center;"> <?php echo $_SESSION["Username"]; ?> </h1>
     <br>
         <ul id="side_menu" class="nav nav-pills nav-stacked">
           <li class=""><a href="admindashboard.php"> <span class="glyphicon glyphicon-th"</span> Dashboard  </a></li>
           <li class="active"><a href="AddNewPost.php"> <span class="glyphicon glyphicon-pencil"</span> AddNewPost  </a></li>
           <li class=""><a href="Categories.php"> <span class="glyphicon glyphicon-list-alt"</span> Categories  </a></li>
           <li class=""><a href="Admins.php"> <span class="glyphicon glyphicon-user"</span> ManageAdmins  </a></li>
           <li class=""><a href="Comments.php"> <span class="glyphicon glyphicon-comment"</span> Comments
             <?php
             $connectingdb;
             $queryuntotal="SELECT Count(*) From comments where status='OFF'";
             $Executeuntotal=mysqli_query($connection,$queryuntotal);
             $Rowsuntotal=mysqli_fetch_array($Executeuntotal);
             $Total_unapproved=array_shift($Rowsuntotal);
             ?>
             <span class="label pull-right label-warning" style="margin-left:60px;">
             <?php echo $Total_unapproved;?>
           </span> </a></li>
           <li class=""><a href="Blog.php" target="_blank"> <span class="glyphicon glyphicon-eye-open"</span> LiveBlog  </a></li>
           <li class=""><a href="Logout.php"> <span class="glyphicon glyphicon-off"</span> LogOut  </a></li>

         </ul>




       </div>                <!--div ending of side area -->
       <div class="col-sm-10">
        <h1>Add New Post</h1>
     <div>  <?php       echo message(); echo successmessage();  ?>  </div>

        <div>

          <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
            <fieldset>
              <div class="form-group">
              <label for="title"> <span class="fieldnfo"> Title: </span></label>
              <input class="form-control"type="text" name="Title" id="title" placeholder="Title">
            </div>
            <div class="form-group">
            <label for="categoryselect"> <span class="fieldnfo"> Category: </span></label>
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
            <label for="imageselect"> <span class="fieldnfo"> Select Image: </span></label>
          <input type="file" class="form-control" name="Image" id="imageselect">
            </div>
            <div class="form-group">
            <label for="postarea"> <span class="fieldnfo"> Post: </span></label>
          <textarea class="form-control" name="Post" id="postarea"> </textarea>
            </div>


            <input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Post"><br> <br>

            </fieldset>

         </form>
        </div>




       </div>  <!--Ending of main area -->

     </div>  <!-- Ending of row-->

   </div>  <!-- Ending of Container fluid -->
<br><br><br><br>
<div id="footer">
   <hr> <p> Copyright to Hritik Kothari | All rights reserved.
</p>
<a href="https://www.facebook.com/hrithik.kothari.12"><i class="fab fa-facebook-f" style="font-size:20px;"></i></a>
<a href="https://www.instagram.com/hrithik_121/?hl=en"><i class="fab fa-instagram" style="padding-left: 10px;font-size:20px;"></i></a>
<a href="https://www.linkedin.com/in/hrithik-kothari-b44aba181"><i class="fab fa-linkedin-in" style="padding-left: 10px;font-size:20px;"></i></a>

</div>
<div style="height:10px; background: #27AAE1;"> </div>

<?php
if(isset($_POST["submit"]))
{
   $Title=($_POST["Title"]);
   $Category=($_POST["Category"]);
   $Post=($_POST["Post"]);
   date_default_timezone_set("Asia/Kolkata");
   $current=date("M-d-Y H-i-s");
   $Admin=$_SESSION["Username"];
   $Image=$_FILES["Image"]["name"];
   $Target="Images/".basename($_FILES["Image"]["name"]);

   if(empty($Title)){
     $_SESSION["ErrorMessage"]="Title cant be empty";
     Redirect_to("AddNewPost.php");
   }else if(strlen($Title)<2){
     $_SESSION["ErrorMessage"]="Title should be atleast 2 characters";
     Redirect_to("AddNewPost.php");
   }
   else{
     global $connectingdb;
     $query="INSERT INTO admin_panel(datetime,title,category,author,image,post)
     VALUES('$current','$Title','$Category','$Admin','$Image','$Post')";
     $Execute=mysqli_query($connection,$query);
     move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
     if($Execute){
       $_SESSION["SuccessMessage"]="Post Added Succesfully";
       Redirect_to("AddNewPost.php");

     }else{
       $_SESSION["ErrorMessage"]="Something Went wrong, please try again later..";
       Redirect_to("AddNewPost.php");

     }

   }


}

 ?>





  </body>
</html>
