<?php
include '../koneksi.php';
$act=$_GET['act'];
$id=$_GET['id'];

$sql = "update pinjam set status='ambil' where idPinjam='$id'";
$query=mysqli_query($con,$sql);
if($query){
	echo "<script> alert('Barang Berhasil Diambil');
	window.location='?act=listPinjam';</script>";
} else {
	echo "<script> alert('Barang Berhasil Diambil');
	window.location='?act=listPinjam';</script>";
}
?>
