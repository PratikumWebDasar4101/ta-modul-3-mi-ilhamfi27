<?php
session_start();
if(isset($_SESSION['username'])){
  header('location: index.php');
}
include_once 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h2>User Signup</h2>
    <form action="signup.php" method="post">
      <input type="text" name="name" placeholder="Name" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <input type="submit" name="submit" value="Signup">
    </form>
  </body>
</html>
<?php
if (isset($_POST['submit'])) {
  $name = isset($_POST['name']) ? $_POST['name'] : "";
  $username = isset($_POST['username']) ? $_POST['username'] : "";
  $password = isset($_POST['password']) ? md5($_POST['password']) : "";
  $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";
  if($password == md5($confirm_password)){
    $is_query_success = mysql_query("INSERT INTO `user`(`username`, `password`, `name`) VALUES ('$username','$password','$name')") or die(mysql_error());
    if ($is_query_success) {
      $_SESSION['username'] = $username;
      $_SESSION['name'] = $name;
      header('location: index.php');
    } else {
      mysql_error();
    }
  } else {
    echo "Konfirmasi Password Salah";
  }
}
?>
