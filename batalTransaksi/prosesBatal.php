<?php
include '../koneksi.php';
$act=$_GET['act'];
$id=$_GET['id'];

$queryJual = mysqli_query($con,"select * from penjualan where idPenjualan='$id'");	
while ($dataJual = mysqli_fetch_array($queryJual)){
	$kode=$dataJual['kode'];
	$jumlahJual=$dataJual['jumlahJual'];
	$toko=$dataJual['toko'];
	$lemari=$dataJual['lemari'];	
}
$queryBarang = mysqli_query($con,"select * from barang where (kode='$kode' and toko='$toko') and lemari='$lemari';");	
while ($dataBar = mysqli_fetch_array($queryBarang)){
	$jumlah=$dataBar['jumlahBarang'];	
}

$jumlahTotal=$jumlah+$jumlahJual;
$sql = "update barang set jumlahBarang='$jumlahTotal' where (kode='$kode' and toko='$toko') and lemari='$lemari';";
$sql = $sql."delete from penjualan where idPenjualan='$id';";

$query=mysqli_multi_query($con,$sql);
if($query){
	echo "<script> alert('Transaksi Berhasil DiBatalkan');
	window.location='?act=batal';</script>";
} else {
	echo "<script> alert('Transaksi Gagal DiBatalkan');
	window.location='?act=batal';</script>";
}
?>
