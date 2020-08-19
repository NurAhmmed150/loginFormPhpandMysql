<?php
    //config db
    require_once "config.php";

    //form value
    $username = $Password = '';

    //chack error
    $errors = [
      'username' => '',
      'Password' =>  '',
      'conform_password' => ''
    ];

    //chack form validation
    if(isset($_POST['submit'])){

        //username validation
        if(empty(trim($_POST['Username']))){
          $errors['username'] =  'Please enter your name';
          } else {
              $usern = $_POST['Username'];
              $sql = "SELECT * FROM user WHERE username ='$usern'";
              $result = mysqli_query($conn, $sql);
                  if(mysqli_num_rows($result) == 0 ) {
                    $username = trim($_POST['Username']);
                 }  else {
                  $errors['username'] = 'this  name is alrady taken';
                 }
               }
      
        //password validation
        if(empty(trim($_POST['password']))){
          $errors['Password'] = 'Please enter your password';
        } else {
            if(strlen(trim($_POST['password'])) < 6){
              $errors['Password'] = 'password must be 6 latter';
            } else {
              $Password = trim($_POST['password']);
            }
        }

        //password_confrim validation
        if(empty(trim($_POST['conform_password']))) {
          $errors['conform_password'] =  'Please enter your conform password'; 
        } else {
            $pass = $_POST['password'];
            $pass_conf = $_POST['conform_password'];
            if($pass == $pass_conf){
                  echo '';
            }  else {
              $errors['conform_password'] =  'The password are not match';
            }
        } 

        //chack register validation
        if(array_filter($errors)){
            echo 'pls fill all requerment';
        } else {
          $username = mysqli_real_escape_string($conn,  $_POST['Username'] );
          $Password = mysqli_real_escape_string($conn,  $_POST['password'] );
          $sql  ="INSERT INTO user(username, Password ) VALUES('$username', '$Password')";
          if(mysqli_query($conn, $sql)){
            header('Location: login.php'); 
          }  else {
             echo 'error';
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

      <input type="password"  placeholder="conform password" name='conform_password' >
          <span class='red'><?php echo $errors['conform_password'] ?? ''; ?></span>

      <input type="submit"  name='submit' value='submit' class='submit'>
      <p class="message">Not registered? <a href="login.php">Login here</a></p>

    </form>
  </div>
</div>
<!--add footer-->
<?php include 'footer.php'; ?>