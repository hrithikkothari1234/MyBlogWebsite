<?php require_once("include/db.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/Functions.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Contact Me</title>
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
.navline{
  height: 10px;
  background: #27aae1;
}
li{
  font-weight: bold;
  font-family: Georgia,Times,serif;
  font-size: 1.2em;
}
.line2{
  margin-top: -20px;
}
body{
  background-color: #ffffff;
}
marquee{
  text-align: center;
  font-size: 2rem;
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
          <li class=""> <a href="Blog.php">Blog </a></li>
          <li class="active"> <a href="Contactus.php">Contact Me </a></li>

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
  <img width="100%" height="700" style="position:absolute;" src="https://cdn.wallpapersafari.com/98/21/a0MSj9.jpg">
  <marquee direction="down" width="100%" height="500px"> Contact Me At : kotharhrithik1@gmail.com <br> Phone no : 8655418163 </marquee>

  </body>
</html>
