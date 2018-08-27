<html>
<head>
	<title> Berhasil </title>
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" />
	<script type="text/javascript" src="../vendor/jquery/jquery-3.3.1.min.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<?php
session_start();
include '../koneksi.php';

$kode = $_POST['kode'];
$jumlah = $_POST['jumlah'];
$lemari = $_POST['lemari'];
$toko = $_SESSION['toko'];

$qryBarang = mysqli_query($con, "select * from barang where (kode='$kode' and toko='$toko') and lemari='$lemari';");
$cekBarang=mysqli_num_rows($qryBarang);
if ($cekBarang > 0) {
	while ($ambilBrg = mysqli_fetch_array($qryBarang)){
		$jml=$ambilBrg['jumlahBarang'];		
	}
	if ($jml > 0){
		if ($jml >= $jumlah){
			$jmlTotal = $jml-$jumlah;
			$sql = "update $db.barang set barang.jumlahBarang='$jmlTotal' where (barang.kode='$kode' and barang.lemari='$lemari') and barang.toko='$toko';";
			$query=mysqli_query($con,$sql);
				if($query){
					echo "<script> alert('Berhasil');
					window.location='?act=keluar'</script>";
				} else {
					echo "<script> alert('Gagal');
					window.location='?act=keluar'</script>";
				}					
		} else {
			echo "<script> alert('Persediaan Barang Tidak Mencukupi');
			window.location='?act=keluar'</script>";
		}	
	} else {
		echo "<script> alert('Persediaan Barang Sudah Habis');
		window.location='?act=keluar'</script>";
	}
} else {
	echo "<script> alert('Barang tidak ditemukan');
	window.location='?act=keluar'</script>";
}	

?>
</body>
</html>
