<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>

<?php
if(isset($_POST["submit"]))
{
   $Name=($_POST["Name"]);
   $Email=($_POST["Email"]);
   $Comment=($_POST["Comment"]);
   date_default_timezone_set("Asia/Kolkata");
   $current=date("M-d-Y H-i-s");
   $Postid=$_GET["id"];
   if(empty($Name)|| empty($Email) || empty($Comment)){
     $_SESSION["ErrorMessage"]="All Fields Are Required";
   }else if(strlen($Comment)>300){
     $_SESSION["ErrorMessage"]="Only 300 Characters are allowed.";
   }
   else{
     global $connectingdb;
     $Postidfromurl=$_GET['id'];
     $query=" INSERT INTO comments (datetime,name,email,comment,status,admin_panel_id)
     VALUES ('$current','$Name','$Email','$Comment','OFF','$Postidfromurl')";
     $Execute=mysqli_query($connection,$query);
     if($Execute){
       $_SESSION["SuccessMessage"]="Comment Submitted Succesfully";
       Redirect_to("Fullpost.php?id={$Postid}");
     }else{
       $_SESSION["ErrorMessage"]="Something Went wrong, please try again later..";
       Redirect_to("Fullpost.php?id={$Postid}");

     }

   }


}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Full Blog Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="css/blog.css">
    <style>
    .fieldnfo{
      color: rgb(251,174,44);
      font-size: 1.2em;
      font-family: Bitter,Georgia,Times,sans-serif;
    }
    .Commentblock{
      background-color: #F6F7F9;
    }
    .Comment-info{
      color: #365899;
      font-size: 1.1em;
      font-family: sans-serif;
      padding-top: 10px;
      font-weight: bold;
    }
    .comment{
      margin-top: -2px;
      padding-bottom: 10px;
      font-size: 1.1em;
    }
    hr{
  border-style: none;
  border-top-style: dotted;
  border-color: grey;
  border-width: 5px;
  width: 5%;
   }
    </style>
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
          <li class="active"> <a href="Blog.php" target="_blank">Blog </a></li>
          <li> <a href="Contactus.php" target="_blank">Contact Me </a></li>
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
      <div class="col-sm-8">      <!-- Main blog area -->

        <?php
        echo message();
        echo successmessage();
         ?>
        <?php
        global $connectingdb;
        if(isset($_GET["Searchbutton"])){
           $Search=$_GET["Search"];
           $viewquery="SELECT * FROM admin_panel
           where datetime like '%$Search%'
           OR title Like '%$Search%'
           OR category Like '%$Search%'
           OR post Like '%$Search%' ";
        }else{

          $postidfromurl=$_GET['id'];
         $viewquery="SELECT * FROM admin_panel where id='$postidfromurl'order by datetime desc"; }
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
            <p class="description">Category: <?php echo htmlentities($Category); ?><br> Published On <?php echo htmlentities($DateTime); ?> </p>
            <p class="post"> <?php echo nl2br($Post); ?> </p>
         </div>
          <br><br><br>

       <?php } ?> <br>
       <span class="fieldnfo"> Share Your Thoughts Here.(Your Comments will only be added if the admin approves them.) </span> <br><br>          <!--Comments STart-->
       <span class="fieldnfo"> Comments: </span>
            <?php
            $connectingdb;
            $Postidforcomments=$_GET["id"];
            $Extractquery="SELECT * FROM comments
            WHERE admin_panel_id='$Postidforcomments' AND status='ON' ";
            $Execute=mysqli_query($connection,$Extractquery);
            while($Datarows=mysqli_fetch_array($Execute)){
                $Commentdate=$Datarows["datetime"];
                $CommentName=$Datarows["name"];
                $Commentbyuser=$Datarows["comment"];


             ?>
             <div class="Commentblock">
             <img style="margin-left:10px;margin-top:10px;"class="pull-left" src="Images/blank.png" width="80px" height="90px">
              <span  style="margin-left: 90px;" class="Comment-info"> <?php echo $CommentName; ?> </span> <br><br>
              <span  style="margin-left: 90px;"class="description"> <?php echo $Commentdate; ?> </span> <br><br>
              <span  style="margin-left: 90px;"class="comment"> <?php echo ($Commentbyuser); ?> </span><br><br>
             </div>

             <hr>
           <?php } ?>



        <br><br>



       <div>                                      <!--Form to get comments -->

         <form action="Fullpost.php?id= <?php echo $Postid; ?>" method="post" enctype="multipart/form-data">
           <fieldset>
             <div class="form-group">
             <label for="Name"> <span class="fieldnfo"> Name: </span></label>
             <input class="form-control"type="text" name="Name" id="Name" placeholder="Name">
           </div>
           <div class="form-group">
           <label for="Email"> <span class="fieldnfo"> Email: </span></label>
           <input class="form-control"type="email" name="Email" id="Email" placeholder="Email">
         </div>

           <div class="form-group">
           <label for="postarea"> <span class="fieldnfo"> Comment: </span></label>
         <textarea class="form-control" name="Comment" id="commentarea"> </textarea>
           </div>


           <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Add Comment"><br> <br>

           </fieldset>

        </form>
       </div>

        </div>                       <!-- Main blog area ending -->
        <div class="col-sm-offset-1 col-sm-3">               <!--Side area starts-->
          <h2></h2>
          <img class="img-responsive img-circle imageicon" style=" height:120px; max-width: 150px;
            margin: 0 auto;
            display: block;"
             src="https://d17fnq9dkz9hgj.cloudfront.net/uploads/2018/04/Golden-Retriever-puppy_01.jpg">
          <p><h1>Hritik Kothari </h1> <h2>Mumbai , India.</h2></p>
    <div class="panel panel-danger">              <!--Categories Panel-->
      <div class="panel-heading">
        <h2 class="panel-title">Categories</h2>
     </div>
       <div class="panel-body">

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
     <br>
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
    <a style="color:white; text-decoration:none; cursor:pointer;font-weight: bold;" href="https://www.facebook.com/hrithik.kothari.12">Facebook Profile</a>


    </div>
    <div style="height:10px; background: #27AAE1;"> </div>





  </body>
  </html>
