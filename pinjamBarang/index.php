<?php 
session_start();
include '../koneksi.php'; 
//include '../cek.php';
include 'lib/lib.php'; 
$tokopinjam=$_SESSION['toko'];
?>
<html>
<head>
	<script type="text/javascript" src="pinjamBarang/js/jquery-3.3.1.min.js"></script>
	<script src="pinjamBarang/assets/js/bootstrap.min.js"></script>	
	
    <title>Umi Collections</title>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">

	<style type="text/css">
	.no-js #loader { display: none;  }
	.js #loader { display: block; position: absolute; left: 100px; top: 0; }
	.pageLoader {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(pinjamBarang/assets/images/loading.gif) center no-repeat #fff;
		opacity: 0.7;
	}
	</style>

	<body>
	<div id="page-wrapper">
	  <div class="row">
		<div class="col-lg-12">
		  <h1 class="page-header">Pinjam Barang</h1>
		</div>
		<!-- /.col-lg-12 -->
	  </div>
		<div class="pageLoader"></div>
		<br />

			<div class="card">
				<div class="card-body">
					<form method="post" action="?act=prosesPinjam">
							<div class="form-group row">
								<label for="kode" class="col-sm-2 col-form-label">Kode Barang</label>
								<div class="col-sm-5">
								<select onchange="tokocb(this.value);" class="form-control" id="kode" name="kode">
										<option value="" selected>- Pilih Kode -</option>
										<?php
											$sql  = "SELECT DISTINCT(kode) as kode FROM stok order by kode asc";
											$exe  = mysqli_query($con,$sql);
											while ($res=mysqli_fetch_row($exe)){
												echo '<option value="'.$res[0].'">'.$res[0].'</option>';
											}
										?>
									</select>	
								</div>
							</div>							
						<div class="form-group row">
							<label for="toko" class="col-sm-2 col-form-label">Asal Toko</label>
							<div class="col-sm-5">
							<select required class="form-control" id="toko" name="toko">
								<option value="" selected>- Pilih Asal Toko -</option>									
							</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="jumlah" class="col-sm-2 col-form-label">Jumlah Pinjam</label>
							<div class="col-sm-5">
								<input type="text" class="form-control" name="jumlah" placeholder="Masukkan Jumlah Barang yang akan di pinjam"/>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-5">
								<input type="hidden" class="form-control" name="tokoPinjam" value="<?php echo $tokopinjam;?>"/>
							</div>
						</div>
						<div class="form-group row">
	    	        		<div class="offset-sm-2 col-sm-10">
            					<input type="submit" id="submit" value="Pinjam" class="btn btn-info" />            					
            				</div>
	            		</div>
					</form>
				</div>
			</div>
	</div>
	</body>

	<script>
		$(document).ready(function(){
			//debugger;
			setTimeout(function(){
				$('.pageLoader').attr('style','display:none');
			}, 700);
		});
		
		function tokocb(kode) {
			$.ajax({
				//debugger;
				url:'pinjamBarang/action.php',
				data:{
					'mode':'combotoko',
					'kode':kode
				},type:'post',
				dataType:'json',
				beforeSend:function () {
					$('.pageLoader').removeAttr('style');
				},success:function(ret){
					setTimeout(function(){
						$('.pageLoader').attr('style','display:none');

						var opt='';
						if(ret.total==0) opt+='<option>-data kosong-</option>';
						else{
							opt+='<option value="">- Pilih toko -</option>';
							$.each(ret.returns.data, function  (id,val) {
								opt+='<option value="'+val.id+'">'+val.nama+'</option>';
							});
						}$('#toko').html(opt);
					}, 700);
				}, error : function (xhr, status, errorThrown) {
					$('.pageLoader').attr('style','display:none');
			        alert('error : ['+xhr.status+'] '+errorThrown);
			    }
			});
		}
		
		
	</script>
	
</html>