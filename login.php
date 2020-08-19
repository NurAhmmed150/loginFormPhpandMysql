<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to home page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
   // config db
   require_once "config.php";

   //chack error
   $errors = [
    'username' => '',
    'Password' =>  ''
  ];
   
  //chack form validation
  if(isset($_POST['login'])) {

      //chack username validation
      if(empty(trim($_POST['Username']))) {
        $errors['username'] = 'username is empty';
      } else {
        $username = $_POST['Username'];
      }

      //chack email validation
      if(empty(trim($_POST['password']))) {
        $errors['Password'] = 'password is empty';
        } else {
        $password = $_POST['password'];
       }

       //chack login validation
       if(!array_filter($errors)) {
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
           header('location: index.php');
           session_start();
           $_SESSION["loggedin"] = true;
           $_SESSION["username"] = $username;
         } else {
           $upnm = 'username & password not match' ;
         }
      }   
  }
?>

<!--add header-->
<?php include 'header.php'; ?>

<div class="login-page">
  <div class="form">
    <form class="login-form" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'  method='POST' >

      <p class='red'><?php echo $upnm ?? ''; ?>

      <input type="text" placeholder="username" name='Username'/>
         <span class='red'><?php echo $errors['username'] ?? ''; ?></span>

      <input type="password" placeholder="password" name='password'/>
         <span class='red'><?php echo $errors['Password'] ?? ''; ?></span>

      <input type="submit" name='login' value='login' class='submit'>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>

    </form>
  </div>
</div>
<!--add footer-->
<?php include 'footer.php'; ?>