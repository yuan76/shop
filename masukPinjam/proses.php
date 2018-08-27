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
$lemari = strtoupper($_POST['lemari']);
$toko = $_SESSION['toko'];

/*
$qryStok = mysqli_query($con, "select * from stok where kode='$kode' and toko='$toko'");
while ($jmlhStok = mysqli_fetch_array($qryStok)){
		$jmlStok=$jmlhStok['jumlah'];		
	}
$stok=mysqli_num_rows($qryStok);
if ($stok > 0) {
	if ($jmlStok > 0){
		if ($jmlStok >= $jumlah){
*/			
			//$jmlStok = $jmlStok-$jumlah;
			$qryBarang = mysqli_query($con, "select * from barang where (kode='$kode' and lemari='$lemari') and toko='$toko'");
			$cek=mysqli_num_rows($qryBarang);
			if ($cek > 0) {
				while ($ambilBrg = mysqli_fetch_array($qryBarang)){
					$jml=$ambilBrg['jumlahBarang'];		
				}
				$jmlTotal=$jml+$jumlah;
				$sql = "update $db.barang set barang.jumlahBarang='$jmlTotal' where (barang.kode='$kode' and barang.lemari='$lemari') and barang.toko='$toko';";
					
			} else {
				$sql = "insert into $db.barang (barang.idBarang,barang.kode,barang.jumlahBarang,barang.toko,barang.lemari)
						values (NULL,'$kode','$jumlah','$toko','$lemari');";
			}
			//$sql = $sql."update $db.stok set stok.jumlah='$jmlStok' where stok.kode='$kode' and stok.toko='$toko';";
			
			$query=mysqli_query($con,$sql);
				if($query){
					echo "<script> alert('Barang Berhasil Ditambahkan');
					window.location='?act=masukPinjam'</script>";
				} else {
					echo "<script> alert('Barang Gagal Ditambahkan');
					window.location='?act=masukPinjam'</script>";
				}
/*			
		} else {
			echo "<script> alert('Persediaan barang tidak cukup');
			window.location='?act=masuk'</script>";
		}
	} else {
		echo "<script> alert('Persediaan barang tidak ada');
		window.location='?act=masuk'</script>";
	}
}	
*/
?>
</body>
</html>
