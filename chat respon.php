<head>
    <link rel="stylesheet" href="../css/respon.css">
</head>
<div class="mb">

    <?php 
error_reporting(0);
  $id_petugas = $_SESSION['data']['id_petugas'];
 $id_pengaduan = $_GET['id_pengaduan'];
 $sql="select * from respon inner join pengaduan on pengaduan.id_pengaduan=respon.id_pengaduan where respon.id_pengaduan = '$id_pengaduan'   ";
 $exe= mysqli_query($koneksi,$sql);
 foreach ($exe as $r ) {

   $respon = $r['respon'];
   $id = $r['id_petugas'];
   $nik = $r['nik'];
   $date = $r['date'];


  //nama masyarakat
  $sqlmasyarakat = "select masyarakat.nama from respon inner join masyarakat on masyarakat.nik = respon.nik where respon.nik = '$nik'";
  $exemasyarakat = mysqli_query($koneksi,$sqlmasyarakat);
  $m=mysqli_fetch_array($exemasyarakat);
  $nama_masyarakat = $m['nama'];

  //nama peugas    
  $sqlpetugas = "select petugas.nama_petugas from respon inner join petugas on petugas.id_petugas = respon.id_petugas where respon.id_petugas = '$id'";
  $exepetugas = mysqli_query($koneksi,$sqlpetugas);
  $p=mysqli_fetch_array($exepetugas);
  $nama_petugas = $p['nama_petugas'];

  
  
if ($id == "") {
  echo ' <div class="container">
  <h6>Nama: '.$nama_masyarakat.'</h6>
  <p>' .$respon. '</p>
  <span class="time">' .$date. '</span>
</div>';
}else{
  echo '<div class="container darker">
  <h6 class="right">Nama: '.$nama_petugas.'</h6>
  <br>
  <p>' .$respon. '</p>
  <span class="time-right">' .$date. '</span>
</div>';
  }
}
?>




    <form action="" method="POST">
        <div class="footer">
            <div class="inputchat">
                <input type="hidden" name="id_petugas" value="<?php echo $id_petugas ?>">
                <input type="hidden" name="id_pengaduan" value="<?php echo $id_pengaduan ?>">
                <textarea type="text" id="respon" name="respon"></textarea>
            </div>
            <div class="buttonchat">
                <button type="submit" name="simpan">Kirim</button>
            </div>
        </div>
    </form>
</div>

<?php 

  if(isset($_POST['simpan']))
        {
          $respon = $_POST['respon'];
          $id_pengaduan = $_POST['id_pengaduan'];
          $id_petugas = $_POST['id_petugas'];
          $date = date("Y-m-d H:i:s");

          $sql = "insert into respon (respon,id_pengaduan,id_petugas,date) VALUES ('$respon','$id_pengaduan','$id_petugas','$date')";
          $exe = mysqli_query($koneksi,$sql);
                  ?>
<script>
window.history.back()
</script>

<?php }; ?>
<script>
window.onload =
    loadPage = () => {
        document.getElementById("respon").value = ""
    }
</script>