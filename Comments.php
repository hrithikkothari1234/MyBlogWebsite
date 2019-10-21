<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<?php require_once("include/db.php"); ?>
<?php ConfirmLogin(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Comments</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="favicon.ico">
   <script src="https://kit.fontawesome.com/76a3098157.js"></script>
    <link type="text/css" rel="stylesheet" href="css/adminstyles.css">
    <style>
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
           <li class=""><a href="Admins.php"> <span class="glyphicon glyphicon-user"</span> ManageAdmins  </a></li>
           <li class="active"><a href="Comments.php"> <span class="glyphicon glyphicon-comment"</span> Comments  </a></li>
           <li class=""><a href="Blog.php" target="_blank"> <span class="glyphicon glyphicon-eye-open"</span> LiveBlog  </a></li>
           <li class=""><a href="Logout.php"> <span class="glyphicon glyphicon-off"</span> LogOut  </a></li>

         </ul>




       </div>                <!--div ending of side area -->
       <div class="col-sm-10">    <!-- Main Area -->
<div>  <?php       echo message(); echo successmessage();  ?>  </div>
        <h1>Un-Approved Comments</h1>

       <div class="table-responsive">        <!--Unapproved table -->
         <table class="table table-striped table-hover">
           <tr>
             <th>No.</th>
             <th>Name</th>
             <th>Date</th>
             <th>Comment</th>
             <th>Approve</th>
             <th>Delete Comment</th>
             <th>Details</th>
           </tr>
        <?php
        $connectingdb;
        $query="SELECT * FROM comments WHERE status='OFF' ORDER BY datetime DESC";
        $Execute=mysqli_query($connection,$query);
        $Srno=0;
        while($Datarows=mysqli_fetch_array($Execute)){
              $commentid=$Datarows['id'];
              $datetimeofcomment=$Datarows['datetime'];
              $personname=$Datarows['name'];
              $personcomment=$Datarows['comment'];
              $commentedpostid=$Datarows['admin_panel_id'];
              $Srno++;
            if(strlen($personcomment)>20){
              $personcomment=substr($personcomment,0,20).'..';
            }
            if(strlen($personname)>15){
              $personname=substr($personname,0,15).'..';
            }


         ?>
         <tr>
                <td><?php echo htmlentities($Srno); ?></td>
                <td style="color: #5E5EFF;"><?php echo htmlentities($personname); ?></td>
                <td><?php echo htmlentities($datetimeofcomment); ?></td>
                <td><?php echo htmlentities($personcomment); ?></td>
                <td><a href="ApproveComments.php?id=<?php echo $commentid; ?>"><span class="btn btn-success">Approve</span></a></td>
                <td><a href="Deletecomments.php?id=<?php echo $commentid; ?>"><span class="btn btn-danger">Delete</span></a></td>
                <td><a href="Fullpost.php?id=<?php echo $commentedpostid; ?>">
                  <span class="btn btn-primary">Live Preview</span></a></td>


         </tr>




       <?php } ?>              <!--while loop ends-->
         </table>
       </div>              <!--Unapproved table ends -->


       <h1>Approved Comments</h1>

      <div class="table-responsive">           <!-- Approved table starts-->
        <table class="table table-striped table-hover">
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Date</th>
            <th>Comment</th>

            <th>Dis-approve</th>
            <th>Delete Comment</th>
            <th>Details</th>
          </tr>
       <?php
       $connectingdb;

       $query="SELECT * FROM comments WHERE status='ON' ORDER BY datetime DESC";
       $Execute=mysqli_query($connection,$query);
       $Srno=0;
       while($Datarows=mysqli_fetch_array($Execute)){
             $commentid=$Datarows['id'];
             $datetimeofcomment=$Datarows['datetime'];
             $personname=$Datarows['name'];
             $personcomment=$Datarows['comment'];
             $commentedpostid=$Datarows['admin_panel_id'];
             $Srno++;
             if(strlen($personcomment)>20){
               $personcomment=substr($personcomment,0,20).'..';
             }
             if(strlen($personname)>15){
               $personname=substr($personname,0,15).'..';
             }
        ?>
        <tr>
          <td><?php echo htmlentities($Srno); ?></td>
          <td style="color: #5E5EFF;"><?php echo htmlentities($personname); ?></td>
          <td><?php echo htmlentities($datetimeofcomment); ?></td>
          <td><?php echo htmlentities($personcomment); ?></td>
          <td><a href="Disapprovecomments.php?id=<?php echo $commentid; ?>"><span class="btn btn-warning">Dis-approve</span></a></td>
          <td><a href="Deletecomments.php?id=<?php echo $commentid; ?>"><span class="btn btn-danger">Delete</span></a></td>
          <td><a href="Fullpost.php?id=<?php echo $commentedpostid; ?>">
            <span class="btn btn-primary">Live Preview</span></a></td>


        </tr>




      <?php } ?>              <!--while loop ends-->
        </table>
      </div>




       </div>  <!--Ending of main area -->

     </div>  <!-- Ending of row-->

   </div>  <!-- Ending of Container fluid -->

   <div id="footer">
      <hr> <p> Copyright to Hritik Kothari | All rights reserved.
   </p>
   <a href="https://www.facebook.com/hrithik.kothari.12"><i class="fab fa-facebook-f" style="font-size:20px;"></i></a>
   <a href="https://www.instagram.com/hrithik_121/?hl=en"><i class="fab fa-instagram" style="padding-left: 10px;font-size:20px;"></i></a>
   <a href="https://www.linkedin.com/in/hrithik-kothari-b44aba181"><i class="fab fa-linkedin-in" style="padding-left: 10px;font-size:20px;"></i></a>

   </div>
   <div style="height:10px; background: #27AAE1;"> </div>



  </body>
</html>
