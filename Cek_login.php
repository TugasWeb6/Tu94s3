<?php 
// untuk mengaktifkan session pada php agar keamanan login lebih tinggi
session_start();
// menghubungkan file php dengan koneksi ke database mysqli
include 'koneksi.php';
// menerima data yang disubmit dari form login multi user
$username = $_POST['username'];
$password = $_POST['password']; // seleksi data user dengan username dan password apakah sesuai atau tidak $login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
// hitung jumlah data yang ditemukan dari form login
$cek = mysqli_num_rows($login);
// mengcek apakah username dan password ditemukan pada database yang ada
if($cek > 0){
 $data = mysqli_fetch_assoc($login);
 // fungsi login sebagai admin
 if($data['level']=="admin"){
  // buat session login dan username agar keamanan lebih tinggi
  $_SESSION['username'] = $username;
  $_SESSION['level'] = "admin";
  // pindahkan ke halaman dashboard admin
  header("location:halaman_admin.php");
 // fungsi login sebagai pegawai
 }else if($data['level']=="pegawai"){
  // buat session login dan username agar keamanan lebih tinggi
  $_SESSION['username'] = $username;
  $_SESSION['level'] = "pegawai";
  // pindahkan ke halaman dashboard pegawai
  header("location:halaman_pegawai.php");
 // fungsi login sebagai pengurus
 }else if($data['level']=="pengurus"){
  // buat session login dan username agar keamanan lebih tinggi
  $_SESSION['username'] = $username;
  $_SESSION['level'] = "pengurus";
  // pindahkan ke halaman dashboard pengurus
  header("location:halaman_pengurus.php");
 }else{
  // pindahkan ke halaman login kembali
  header("location:index.php?pesan=gagal");
 }
}else{
 header("location:index.php?pesan=gagal");
}
?>
