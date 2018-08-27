<?php
	session_start();
	include "../koneksi.php";
	include "../cek.php";
	$toko=$_SESSION['toko'];
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Umi Collection | List Batal Penjualan</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>
<body>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="page-header">List Batal Penjualan</h2>
    </div>
  </div>
 
<div class="row">		
	<?php	
	include '../koneksi.php';

	$kode = $_POST['kode'];
	$toko = $_POST['toko'];
		$qryTampil = mysqli_query($con,"select * from penjualan where kode='$kode' and toko='$toko';");
		/*				
		$qryTampil = mysqli_query($con,"
					select p.tglPinjam as tglPinjam,p.kode as kode,p.jumlahPinjam as jumlahPinjam,t.nama as tokoAsal,p.idPinjam as idPinjam 
						from pinjam as p join toko as t on p.toko1=t.idToko
						where p.toko2='$toko' and p.status='menunggu';
					");
		*/			
	?>      
      <table class="table table-hover table-responsive">
        <thead>
          <tr>
			<th>Tanggal Transaksi</th>
            <th>Kode</th>
            <th>Jumlah Barang</th>
			<th>Total</th>
			<th>Lemari</th>
			<th>Action</th>			
          </tr>
        </thead>
        <tbody>
        <?php        
          while ($dta = mysqli_fetch_array($qryTampil)) {
            echo '<tr>
			<td>'.date("j F Y, g:i a",strtotime($dta['tglTransaksi'])).'</td>
			  <td>'.$dta['kode'].'</td>
              <td>'.$dta['jumlahJual'].'</td>
			  <td>Rp. '.number_format($dta['total']).'</td>
			  <td>'.$dta['lemari'].'</td>
			  <td> <button class="btn btn-warning" data-toggle="modal" data-target="#konfirmasi_batal" data-href="index.php?act=prosesBatal&id='.$dta['idPenjualan'].'">Batalkan</button> </a> </td>
            </tr>';
          }		  
		  
        ?>
        </tbody>
      </table>
</div>
</div>
<div class="modal fade" id="konfirmasi_batal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <b>Anda yakin ingin membatalkan transaksi ini ?</b><br><br>
                    <a class="btn btn-primary btn-ok">Ya, Batalkan</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
  <script type="text/javascript">
    //Hapus Data
    $(document).ready(function() {
        $('#konfirmasi_batal').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    });
  </script>
</body>
</html>