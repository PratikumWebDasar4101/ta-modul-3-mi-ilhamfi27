<?php
include_once 'koneksi.php';
session_start();
if(!isset($_SESSION['username'])){
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TA3</title>
  </head>
  <body>
    <?php
    echo "Hi, " . $_SESSION['name'];
    ?>
    <br>
    <a href="logout.php">Logout</a>
    <form action="" method="post" enctype="multipart/form-data">
      <input type="text" name="nama" placeholder="Nama" class=""><br>
      <input type="text" name="nim" placeholder="NIM" class=""><br>
      <select class="" name="fakultas" required>
        <option value="">-- Fakultas --</option>
        <option value="FIT">FIT</option>
        <option value="FIK">FIK</option>
        <option value="FKB">FKB</option>
        <option value="FEB">FEB</option>
        <option value="FIF">FIF</option>
        <option value="FRI">FRI</option>
        <option value="FTE">FTE</option>
      </select><br>
      <input type="radio" name="jk" value="laki-laki"><label for="jk">Laki - Laki</label>
      <input type="radio" name="jk" value="perempuan"><label for="jk">Perempuan</label><br>
      <input type="file" name="foto" accept="image/*"><br>
      <input type="submit" name="submit" value="Submit">
    </form>
    <table border style="margin-top: 100px;">
      <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Fakultas</th>
        <th>Foto</th>
      </tr>

      <?php
      $query = mysql_query("SELECT `nim`, `nama`, `fakultas`, `jenis_kelamin`, `foto` FROM `mahasiswa`");
      $count_data = mysql_num_rows($query);
      if ($count_data > 0) {
        while ($data = mysql_fetch_array($query)) {
      ?>
      <tr>
        <td><?php echo $data['nim']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['fakultas']; ?></td>
        <td><?php echo $data['jenis_kelamin']; ?></td>
        <td><img src="../multimedia_storage/images/<?php echo $data['foto']; ?>" width="90"></td>
      </tr>
      <?php
        }
      }
      ?>

    </table>
  </body>
</html>
<?php
if (isset($_POST['submit'])) {
  $nama = isset($_POST['nama']) ? $_POST['nama'] : "";
  $nim = isset($_POST['nim']) ? $_POST['nim'] : "";
  $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : "";
  $jk = isset($_POST['jk']) ? $_POST['jk'] : "";

  // pemrosesan file
  $file_name = $_FILES['foto']['name'];
  $file_tmp_dir = $_FILES['foto']['tmp_name'];
  $upload_dir = "../multimedia_storage/images/";

  $upload_status = move_uploaded_file($file_tmp_dir, $upload_dir.$file_name);
  if($upload_status){
    $query = mysql_query("INSERT INTO `mahasiswa`(`nim`, `nama`, `fakultas`, `jenis_kelamin`, `foto`)
                          VALUES ('$nim','$nama','$fakultas','$jk','$file_name')");
    if($query){
      echo "File Uploaded!";
    } else {
      echo "File Upload Failed";
    }
  } else {
    echo "Failed moving file";
  }
}

?>
