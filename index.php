<?php session_start();
include 'koneksi.php';
include 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Umi Collection</title>
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="./dist/css/style.css" rel="stylesheet">
    <link href="./vendor/morrisjs/morris.css" rel="stylesheet">
    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

 <script src="./vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>
<!-- DataTables CSS -->
    <link href="./vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="./vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">   
    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>
	
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">			
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:;">Umi Collection</a>
				<a class="navbar-brand pull-right" href="javascript:;">
					<?php
					$nama=$_SESSION['nama'];
					$akses=$_SESSION['akses'];
					$toko=$_SESSION['toko'];
					if ($akses=="penjaga"){
						$akses="Kasir";
					}
					$qry = mysqli_query($con,"select * from toko where idToko='$toko';");
					$data = mysqli_fetch_array($qry);
					 echo $akses.''.(!is_null($toko)?' toko '.$data['nama']:'').' : '.$nama;
					 
					 // echo 'Nama : '.$nama.'('.$akses.''.(!is_null($toko)?' toko '.$toko:'').')';
					?>
				</a>
            </div>
            <!-- /.navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
				       <ul class="nav" id="side-menu">                       
					   <?php if($_SESSION["akses"] == "supervisor"){
							echo '
												<li>
													<a href="?act=dashboardS"><i class="fa fa-cubes fa-fw"></i> Lihat Stok </a>
												</li>
												<li>
													<a href="?act=luarLemari"><i class="fa fa-exclamation-circle fa-fw"></i> Barang Terdampar </a>
												</li>
												<li>
													<a href="?act=listBarang"><i class="fa fa-list-alt fa-fw"></i> List Barang </a>
												</li>
												';
						}
						?>
						<?php if($_SESSION["akses"] == "owner"){
							echo '
												<li>
													<a href="?act=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
												</li>
												<li>
													<a href="?act=tambah"><i class="fa fa-edit fa-fw"></i> Tambah Barang</a>
												</li>
												<li>
													<a href="?act=admin"><i class="fa fa-users fa-fw"></i> Tambah Admin</a>
												</li>												
												<li>
													<a href="?act=batal"><i class="fa fa-eraser fa-fw"></i> Batal Penjualan</a>
												</li>
												';
						}
						?>						
						<?php if($_SESSION["akses"] == "penjaga"){
							echo '
												<li>
													<a href="?act=dashboardP"><i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
												</li>
												<li>
													<a href="?act=listBarang"><i class="fa fa-list-alt fa-fw"></i> List Barang </a>
												</li>
												<li class="treeview">
													<a href="javascript:;">
														<i class="fa fa-cubes"></i> <span>Kelola Barang</span>
														<span class="pull-right-container">
															<i class="fa fa-caret-left pull-right"></i>
														</span>
													</a>													
														<ul class="nav treeview-menu">
															<li><a href="?act=masuk"><i class="fa fa-download"></i> Barang Masuk Baru</a></li>
															<li><a href="?act=keluar"><i class="fa fa-upload"></i> Barang Keluar</a></li>		
															<li><a href="?act=masukPinjam"><i class="fa fa-download"></i> Barang Masuk Pinjam</a></li>																
														</ul>
												</li>												
												<li>
													<a href="?act=jualBarang"><i class="fa fa-edit"></i> Jual barang </a>
												</li>
												<li>																
													<a href="?act=pinjamBarang"><i class="fa fa-share-alt fa-fw"></i> Pinjam barang </a>
												</li>
												<li>																
													<a href="?act=listPinjam"><i class="fa fa-calendar-check-o fa-fw"></i> List Pinjam barang </a>
												</li>
												<li>
													<a href="?act=riwayatPinjam"><i class="fa fa-history fa-fw"></i> Riwayat Pinjam barang </a>
												</li>
												';
						}
						?>

						<li>
                            <a href="?act=logout"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
                        </li>
						
                    </ul>
                
		</div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
<?php 
	if(isset($_GET['act'])){
		if ($_GET['act'] == "dashboard"){
			include 'dashboardPenjualan/input.php';
		}else if($_GET['act'] == "tambah"){
			include 'inputBarang/input.php';	
		}else if($_GET['act'] == "jualDetail"){
			include 'dashboardPenjualan/jualDetail.php';	
		}else if($_GET['act'] == "prosesTambah"){
			include 'inputBarang/proses.php';
		}else if($_GET['act'] == "admin"){
			include 'registrasi/index.php';
		}else if($_GET['act'] == "prosesAdmin"){
			include 'registrasi/proses.php';
		/*	
		}else if($_GET['act'] == "dashboardS"){
			include 'dashboardSupervisor/input.php';
		*/
		}else if($_GET['act'] == "dashboardS"){
			include 'dashboardStok/input.php';	
		}else if($_GET['act'] == "stokToko"){
			include 'dashboardStok/stokDetail.php';	
		}else if($_GET['act'] == "lemariDetail"){
			include 'dashboardStok/lemariDetail.php';		
		}else if($_GET['act'] == "lihatStok"){
			include 'LihatStok/input.php';			
		}else if($_GET['act'] == "stokDetail"){
			include 'LihatStok/stokDetail.php';		
		}else if($_GET['act'] == "riwayatTambahBarang"){
			include 'RiwayatTambahBarang/input.php';		
		}else if($_GET['act'] == "riwayatDetail"){
			include 'RiwayatTambahBarang/riwayatDetail.php';
		}else if($_GET['act'] == "dashboardP"){
			include 'dashboardPenjaga/input.php';		
		}else if($_GET['act'] == "jualBarang"){
			include 'jualBarang/input.php';			
		}else if($_GET['act'] == "prosesJual"){
			include 'jualBarang/proses.php';	
		}else if($_GET['act'] == "pinjamBarang"){
			include 'pinjamBarang/index.php';	
		}else if($_GET['act'] == "prosesPinjam"){
			include 'pinjamBarang/proses.php';				
		}else if($_GET['act'] == "riwayatPinjam"){
			include 'riwayatPinjam/listRiwayat.php';	
		}else if($_GET['act'] == "masuk"){
			include 'masukBarang/input.php';	
		}else if($_GET['act'] == "prosesMasuk"){
			include 'masukBarang/proses.php';	
		}else if($_GET['act'] == "keluar"){
			include 'keluarBarang/input.php';	
		}else if($_GET['act'] == "prosesKeluar"){
			include 'keluarBarang/proses.php';	
		}else if($_GET['act'] == "listPinjam"){
			include 'listPinjamBarang/listPinjamBarang.php';	
		}else if($_GET['act'] == "ambil"){
			include 'listPinjamBarang/sudahAmbil.php';	
		}else if($_GET['act'] == "listBarang"){
			include 'listBarang/listBarang.php';	
		}else if($_GET['act'] == "masukPinjam"){
			include 'masukPinjam/input.php';
		}else if($_GET['act'] == "prosesMasukPinjam"){
			include 'masukPinjam/proses.php';
		}else if($_GET['act'] == "batal"){
			include 'batalTransaksi/input.php';		
		}else if($_GET['act'] == "listBatal"){
			include 'batalTransaksi/listBatal.php';		
		}else if($_GET['act'] == "prosesBatal"){
			include 'batalTransaksi/prosesBatal.php';		
		}else if($_GET['act'] == "luarLemari"){
			include 'luarLemari/input.php';	
		}else if($_GET['act'] == "luarDetail"){
			include 'luarLemari/luarDetail.php';			
					
		}else{
			
		}
	} else {
		if($_SESSION["akses"] == "owner"){
			include 'dashboardPenjualan/input.php';			
		} else if ($_SESSION["akses"] == "supervisor"){
			include 'dashboardStok/input.php';	
		} else if ($_SESSION["akses"] == "penjaga"){
			include 'dashboardPenjaga/input.php';
		} 
					
		
		
	}
	
?>   

    </div>
	<footer class="navbar-brand pull-right">
      <div>Copyright <?php echo date("Y") ?> &copy; timDTS</div>
	</footer>
    <!-- DataTables JavaScript -->
    <script src="./vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="./vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="./vendor/datatables-responsive/dataTables.responsive.js"></script>
   <script>
    $(document).ready(function() {
        $('#dataTables-example1').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>