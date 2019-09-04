<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php ConfirmLogin(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Manage Admins</title>
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
          <li class="adminlistnav active"> <a href="Login.php">Admin Login </a></li>
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
           <li class=""><a href="AddNewPost.php"> <span class="glyphicon glyphicon-pencil"</span> AddNewPost  </a></li>
           <li class=""><a href="Categories.php"> <span class="glyphicon glyphicon-list-alt"</span> Categories  </a></li>
           <li class="active"><a href="Admins.php"> <span class="glyphicon glyphicon-user"</span> ManageAdmins  </a></li>
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
        <h1>Manage Admin Access</h1>
     <div>  <?php       echo message(); echo successmessage();  ?>  </div>

        <div>

          <form action="Admins.php" method="post">
            <fieldset>
              <div class="form-group">
              <label for="Username"> <span class="fieldnfo"> Username: </span></label>
              <input class="form-control"type="text" name="Username" id="Username" placeholder="Username">
            </div>
            <div class="form-group">
            <label for="Password"> <span class="fieldnfo"> Password: </span></label>
            <input class="form-control"type="Password" name="Password" id="Password" placeholder="Password">
          </div>
          <div class="form-group">
          <label for="Confirmpassword"> <span class="fieldnfo"> Confirm Password: </span></label>
          <input class="form-control"type="Password" name="Confirmpassword" id="Confirmpassword" placeholder="Retype Password">
        </div>
            <input class="btn btn-success btn-block" type="submit" name="submit" value="Add New Admin"><br> <br>
            </fieldset>

         </form>
        </div>

      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <tr>
            <th> Sr.No </th>
            <th> Date&Time </th>
            <th> Admin Username </th>
            <th> Added By </th>
            <th> Action</th>
          </tr>
    <?php
    global $connectingdb;
    $viewquery="Select * from registration ORDER BY datetime desc";
    $Execute=mysqli_query($connection,$viewquery);

  $SrNo=0;
    while($Datarows=mysqli_fetch_array($Execute)){
        $Id=$Datarows["id"];
        $Datetime=$Datarows["datetime"];
        $Username=$Datarows["username"];
        $Admin=$Datarows["addedby"];
        $SrNo++;

     ?>
     <tr>
        <td><?php echo "$SrNo"; ?>
        <td><?php echo "$Datetime"; ?>
        <td><?php echo "$Username"; ?>
        <td><?php echo "$Admin"; ?>
        <td> <a href="DeleteAdmin.php?id=<?php echo $Id; ?>">
          <span class="btn btn-danger"> Delete  </span></a></td>
    </tr>


 <?php } ?>
        </table>
      </div>


       </div>  <!--Ending of main area -->

     </div>  <!-- Ending of row-->

   </div>  <!-- Ending of Container fluid -->
<br><br>
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
   $Username=($_POST["Username"]);
   $Password=($_POST["Password"]);
   $Confirmpassword=($_POST["Confirmpassword"]);
   date_default_timezone_set("Asia/Kolkata");
   $current=date("M-d-Y H-i-s");

   $Admin=$_SESSION["Username"];

   if(empty($Username)||empty($Password)||empty($Confirmpassword)){
     $_SESSION["ErrorMessage"]="Username or password cannot be empty.";
     Redirect_to("Admins.php");
   }else if(strlen($Password)<5){
     $_SESSION["ErrorMessage"]="Atleast 5 characters required.";
     Redirect_to("Admins.php");
   }else if($Password!==$Confirmpassword){
     $_SESSION["ErrorMessage"]="Passwords do not match.";
     Redirect_to("Admins.php");
   }
   else{
     global $connectingdb;
     $query="INSERT INTO registration(datetime,username,password,addedby)VALUES('$current','$Username','$Password','$Admin')";
     $Execute=mysqli_query($connection,$query);
     if($Execute){
       $_SESSION["SuccessMessage"]="Admin Added Succesfully.";
       Redirect_to("Admins.php");
     }else{
       $_SESSION["ErrorMessage"]="Something Went wrong, please try again later..";
       Redirect_to("Admins.php");

     }

   }

}

 ?>


  </body>
</html>
