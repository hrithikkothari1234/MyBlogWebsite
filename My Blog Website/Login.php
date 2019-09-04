<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Login</title>
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
.adminlistnav{
  font-weight: bold;
  font-family: Georgia,Times,serif;
  font-size: 1.2em;
}
body{
  background-color: #ffffff;
}
li{
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
          <li class="active"> <a href="Login.php">Admin Login </a></li>
          <li class=""> <a href="Blog.php">Blog </a></li>
          <li> <a href="Contactus.php">Contact Me </a></li>

        </ul>

      </div>

    </div>
  </nav>                                       <!--navbar end-->
  <div class="navline line2" style="height: 10px;
  background: #27aae1; margin-top: -20px;">
  </div>
    <div class="container-fluid">
      <div class="row">



          <br><br><br><br><br>
       <div class="col-sm-offset-4 col-sm-4">
         <?php echo message(); echo successmessage(); ?>
        <h1 align="center"> Admin Login </h1>
     <div>  <?php       echo message(); echo successmessage();  ?>  </div>

        <div>

          <form action="Login.php" method="post">
            <fieldset>
              <div class="form-group">
                  <label for="Username"> <span class="fieldnfo"> Username: </span></label>
                  <div class="input-group input-group-lg">
                    <span class="input-group-addon">
                       <span class="glyphicon glyphicon-envelope text-primary" > </span>
                    </span>
                  <input class="form-control"type="text" name="Username" id="Username" placeholder="Username">
               </div>
            </div>
            <div class="form-group">
            <label for="Password"> <span class="fieldnfo"> Password: </span></label>
             <div class="input-group input-group-lg">
               <span class="input-group-addon">
                  <span class="glyphicon glyphicon-lock text-primary" > </span>
               </span>
            <input class="form-control"type="Password" name="Password" id="Password" placeholder="Password">
            </div>
          </div>
            <input class="btn btn-info btn-block" type="submit" name="submit" value="Login"><br> <br>
            </fieldset>

         </form>
        </div>


       </div>  <!--Ending of main area -->

     </div>  <!-- Ending of row-->

   </div>  <!-- Ending of Container fluid -->


<?php
if(isset($_POST["submit"]))
{
   $Username=($_POST["Username"]);
   $Password=($_POST["Password"]);

   if(empty($Username)||empty($Password)){
     $_SESSION["ErrorMessage"]="Invalid Username or Password";
     Redirect_to("Login.php");
   }
   else{
       $Found_Account=Login_attempt($Username,$Password);
       $_SESSION["User_Id"]=$Found_Account["id"];
       $_SESSION["Username"]=$Found_Account["username"];
       if($Found_Account){
         $_SESSION["SuccessMessage"]="Login Successful,Welcome {$_SESSION["Username"]}";
         Redirect_to("admindashboard.php");
       }
       else{
         $_SESSION["ErrorMessage"]="Invalid Username or Password";
         Redirect_to("Login.php");
       }
   }

}

 ?>


  </body>
</html>
