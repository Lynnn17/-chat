<head>
    <link rel="stylesheet" href="../css/respon.css">
</head>

<div class="mb">


    <?php 
error_reporting(0);
  $nik = $_SESSION['data']['nik'];

 $id_pengaduan = $_GET['id_pengaduan'];


 //looping data
 $sql="select * from respon inner join pengaduan on pengaduan.id_pengaduan=respon.id_pengaduan  where respon.id_pengaduan = '$id_pengaduan' ";
 $exe= mysqli_query($koneksi,$sql);
 foreach ($exe as $r ) {
  //  $sqlpetugas = "SELECT nama_petugas FROM petugas WHERE id_petugas = $id";
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
     
      
  echo ' <div class="container darker">
  <h6 class="right">Nama: '.$nama_masyarakat.'</h6>
  <br>
  <p`>' .$respon. '</p>
  <span class="time-right">' .$date. '</span>
</div>';
   
}else{
    
  echo '<div class="container">
  <h6>Nama: '.$nama_petugas.'</h6>
  <p>' .$respon. '</p>
  <span class="time">11:00</span>
</div>
';
  }
}
?>

    <form action="" method="POST">
        <div class="footer">
            <div class="inputchat">
                <input type="hidden" name="nik" value="<?php echo $nik ?>">
                <input type="hidden" name="id_pengaduan" value="<?php echo $id_pengaduan ?>">
                <textarea type="text" id="respon" name="respon"></textarea>
            </div>
            <div class="buttonchat">
                <button type="" name="simpan">Kirim</button>
            </div>
        </div>
    </form>

</div>
<?php 

  if(isset($_POST['simpan']))
        {
          $respon = $_POST['respon'];
          $id_pengaduan = $_POST['id_pengaduan'];
          $nik = $_POST['nik'];
          $date = date("Y-m-d H:i:s");

          $sql = "insert into respon (respon,id_pengaduan,nik,date) VALUES ('$respon','$id_pengaduan','$nik','$date')";
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