<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
  //chack form validation
  if(isset($_POST['logout'])) {
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: login.php");
exit;
  }

$user = $_SESSION["username"];
?>

<!--add header-->

<?php include 'header.php'; ?>
<h1 class='title'>welcome <?php echo $user; ?></h1>
<div class="form1">
    <form class="login-form" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'  method='POST'>
      <input type="submit" name='logout' value='LOG OUT' class='logout'>
    </form>
</div>
<!--add footer-->
<?php include 'footer.php'; ?>