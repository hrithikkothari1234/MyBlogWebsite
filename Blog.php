<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Blog Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="favicon.ico">
   <script src="https://kit.fontawesome.com/76a3098157.js"></script>
    <link type="text/css" rel="stylesheet" href="css/blog.css">
  </head>
  <body>
    <div class="navline">
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
          <li > <a href="Login.php">Admin Login </a></li>
          <li class="active"> <a href="Blog.php">Blog </a></li>
          <li> <a href="Contactus.php">Contact Me </a></li>

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
  <div class="navline line2">
  </div>

  <div class="container">            <!-- Container starts -->
    <div class="blog-header">
      <h1>Complete Responsive blog </h1>
      <p class="lead"> Complete Responsive blog using php by Hritik Kothari </p>
    </div>
    <div class="row">                <!-- row -->
      <div class="col-sm-7">      <!-- Main blog area -->
        <?php
        global $connectingdb;
        if(isset($_GET["Searchbutton"])){
           $Search=$_GET["Search"];
           $viewquery="SELECT * FROM admin_panel
           where datetime like '%$Search%'
           OR title Like '%$Search%'
           OR category Like '%$Search%'
           OR post Like '%$Search%' ";
        }else if(isset($_GET["Category"])){       //query for category active on side bar ( in url tab)
           $Category=$_GET["Category"];
           $viewquery="SELECT * FROM admin_panel WHERE category='$Category' ORDER BY datetime DESC";
        }
        else{
         $viewquery="SELECT * FROM admin_panel order by datetime desc"; }
         $Execute=mysqli_query($connection,$viewquery);
         while($Datarows=mysqli_fetch_array($Execute)){
           $Postid=$Datarows["id"];
         $DateTime=$Datarows["datetime"];
            $Title=$Datarows["title"];
         $Category=$Datarows["category"];
            $Admin=$Datarows["author"];
            $Image=$Datarows["image"];
             $Post=$Datarows["post"];

         ?>
         <div class="blog-post thumbnail">
           <img class="img-responsive img-rounded" src="Images/<?php echo $Image; ?>" >
         </div>
         <div class="caption">
            <h1 id="heading"> <?php echo htmlentities($Title); ?> </h1>
            <p class="description">Category: <?php echo htmlentities($Category); ?><br> Published On <?php echo htmlentities($DateTime); ?>
              <?php
            $connectingdb;
            $queryapproved="SELECT Count(*) From comments where admin_panel_id = '$Postid' AND status='ON'";
            $Executeapproved=mysqli_query($connection,$queryapproved);
            $Rowsapproved=mysqli_fetch_array($Executeapproved);
            $Total_approved=array_shift($Rowsapproved);
            ?>
            <span class="badge pull-right">
              Comments:<?php echo $Total_approved;?>
            </span> </p>
            <p class="post"> <?php
            if(strlen($Post)>80){
                $Post=substr($Post,0,80).'...';
            }
            echo ($Post); ?> </p>
         </div>
         <a href="Fullpost.php?id=<?php echo $Postid; ?>"><span class="btn btn-info">Read More &rsaquo; &rsaquo;
         </span> </a> <br><br><br>

       <?php } ?>
        </div>                       <!-- Main blog area ending -->
      <div class="col-sm-offset-1 col-sm-4">               <!--Side area starts-->
        <h2></h2>
        <img class="img-responsive img-circle imageicon" style=" height:120px; max-width: 150px;
          margin: 0 auto;
          display: block;"
           src="https://d17fnq9dkz9hgj.cloudfront.net/uploads/2018/04/Golden-Retriever-puppy_01.jpg">
        <p> <h1> Hritik Kothari </h1> <h2> Mumbai , India. </h2></p>
  <div class="panel panel-danger">              <!--Categories Panel-->
    <div class="panel-heading">
      <h2 class="panel-title">Categories</h2>
   </div>
     <div class="panel-body background">

  <?php
 global $connectingdb;
 $viewquery="SELECT * FROM category order by datetime ASC";
 $Execute=mysqli_query($connection,$viewquery);
 while($Datarows=mysqli_fetch_array($Execute)){
     $Id=$Datarows['id'];
     $Category=$Datarows['name'];
   ?>
   <a href="Blog.php?Category=<?php echo $Category; ?>">
   <span id="heading">
  <?php echo $Category; ?> <br>
   </span>
 </a>
 <?php } ?>
     </div>
     <div class="panel-footer">

     </div>
  </div>


  <div class="panel panel-danger">                   <!--Recent posts panel-->
    <div class="panel-heading">
      <h2 class="panel-title">Recent Posts</h2>
   </div>
     <div class="panel-body background">
<?php
$connectingdb;
$viewquery="SELECT * FROM admin_panel ORDER BY datetime DESC LIMIT 0,5 ";
$Execute=mysqli_query($connection,$viewquery);
while($Datarows=mysqli_fetch_array($Execute)){
  $Id=$Datarows["id"];
  $Title=$Datarows["title"];
  $Datetime=$Datarows["datetime"];
  $Datetime=substr($Datetime,0,11);
  $Image=$Datarows["image"];
 ?>
 <div class="">
   <img class="pull-left"style=" margin-left:10px;" src="Images/<?php echo htmlentities($Image); ?>" width="70px" height="70px">
   <a href="Fullpost.php?id=<?php echo $Id; ?>"> <p id="heading" style="margin-left: 90px;"> <?php echo htmlentities($Title); ?> </p> </a>
   <p class="description" style="margin-left: 90px; "><?php echo htmlentities($Datetime); ?></p>
   <hr>
 </div>
<?php } ?>
     </div>
     <div class="panel-footer">

     </div>
  </div>
      </div>   <!-- side area ending -->
    </div>        <!-- row ending -->
  </div>      <!-- container ending -->

  <br><br><br>  <br><br><br>  <br><br><br>
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
