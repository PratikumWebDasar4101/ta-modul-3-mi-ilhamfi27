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
    <form action="login.php" method="post">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="submit" name="submit" value="Login">
    </form>
    <a href="Signup.php">Signup!</a>
  </body>
</html>
<?php
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $query = mysql_query("SELECT `username`, `password`, `name` FROM `user`
                WHERE `username` = '$username' AND `password` = '$password';") or die (mysql_error());
  $num_rows = mysql_num_rows($query);
  if($num_rows > 0){
    while ($data = mysql_fetch_array($query)) {
      $_SESSION['username'] = $data['username'];
      $_SESSION['name'] = $data['name'];
    }
    header('location: index.php');
  } else {
    echo "<script>alert(\"Username Atau Password Salah!\")</script>";
  }
}
?>
