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
$tawar = $_POST['tawar'];
$toko = $_SESSION['toko'];

$cekBarang = mysqli_query($con, "select * from barang where (kode='$kode' and lemari='$lemari') and toko='$toko'");
$cekStok = mysqli_query($con, "select * from stok where kode='$kode' and toko='$toko'");

$cek=mysqli_num_rows($cekBarang);
if ($cek > 0) {
	while ($ambilBrg = mysqli_fetch_array($cekBarang)){
		$jml=$ambilBrg['jumlahBarang'];		
	}
	while ($ambilStok = mysqli_fetch_array($cekStok)){
		$hargaLama=$ambilStok['harga'];		
	}
	if ($jml > 0){
		if ($jumlah <= $jml){
			$jmlBaru=$jml-$jumlah;
			if ((!isset($tawar)) || ($tawar == "")){
				$total=$jumlah*$hargaLama;
				$tawar=0;
			} else {
				$total=$jumlah*$tawar;
				$tawar=$tawar;
			}		
			$kode=strtoupper($kode);		
			$sql = "update $db.barang set barang.jumlahBarang='$jmlBaru' where (kode='$kode' and lemari='$lemari') and toko='$toko';";
			$sql = $sql."insert into $db.penjualan (penjualan.idPenjualan,penjualan.kode,penjualan.toko,penjualan.harga,penjualan.tawar,penjualan.jumlahJual,penjualan.total,penjualan.tglTransaksi,penjualan.lemari)
				values (NULL,'$kode','$toko','$hargaLama','$tawar','$jumlah','$total',NOW(),'$lemari');";
				
			$query=mysqli_multi_query($con,$sql);
			if($query){
				echo "<script> alert('Transaksi Berhasil');
				window.location='?act=jualBarang'</script>";
			} else {
				echo "<script> alert('Transaksi Gagal');
				window.location='?act=jualBarang'</script>";
			}
		} else {
			echo "<script> alert('Persedian Barang Tidak Mencukupi');
			window.location='?act=jualBarang'</script>";
		} 
	} else {
		echo "<script> alert('Persediaan Barang Sudah Habis');
		window.location='?act=jualBarang'</script>";
	}		
	
} else {
	echo "<script> alert('Barang Tidak Ditemukan');
	window.location='?act=jualBarang'</script>";
}

?>
</body>
</html>
