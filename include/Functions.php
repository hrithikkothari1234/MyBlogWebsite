
<?php require_once("include/sessions.php"); ?>

<?php
function Redirect_to($New_Location){
  header("Location:".$New_Location);
  exit;
}

function Login_attempt($Username,$Password){
  $connection=mysqli_connect('localhost','root','agent viper');
  $connectingdb=mysqli_select_db($connection,'phpcms');
  $query="SELECT * FROM registration Where username='$Username' AND password='$Password'";
  $Execute=mysqli_query($connection,$query);
  //$Result=mysqli_store_result($connection,1);

  /*if($admin=mysqli_fetch_object($Result)){
    return $admin;
  }else{
    return null;
  } */
  if ($Execute)
  {
  if($obj=mysqli_fetch_assoc($Execute))
    {
    return $obj;
  }else{
    return null;
  }
}
}

function Login(){
  if(isset($_SESSION["User_Id"])){
    return false;
  }else{
   return true;
  }
}
function ConfirmLogin(){
  if(Login()==true){
    $_SESSION["ErrorMessage"]="Login Required!";
    Redirect_to("Login.php");
  }
}





 ?>
