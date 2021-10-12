<div class="row"> 
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Produk
            </div>
			
            <div class="panel-body">
			<center>
			<?php echo $pesan; ?>
			</center>
				<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah Produk</a><br><br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dt-produk">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Warna</th>
                                    <th>Ukuran</th>
                                    <th>Dilihat</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								$no = 1;
								foreach($result as $produk){
									echo '<tr>';
                                    echo '<td>' . $no . '</td>';
                                    echo '<td>' . $produk->nama_produk . '</td>';
                                    echo '<td>' . $produk->nama_kategori . '</td>';
                                    echo '<td>' . $produk->harga_produk . '</td>';
                                    echo '<td>' . $produk->warna_produk . '</td>';
                                    echo '<td>' . $produk->ukuran_produk . '</td>';
                                    echo '<td>' . $produk->total_view . '</td>';
                                    echo '<td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" onclick="getdata(' . $produk->id_produk . ')"><i class="fa fa-pencil"></i>&emsp;Edit</a>';
									echo '&emsp;<a href="' . base_url() . 'Produk/hapus/' . $produk->id_produk . '" class="btn btn-danger btn-sm" onClick="return confirm(\'Anda yakin ingin menghapus ' . $produk->nama_produk . '?\')"><i class="fa fa-trash-o"></i>&emsp;Hapus</a></td>';
                                    echo '</tr>';
									$no += 1;
								}
							?>
                            </tbody>
                        </table>
                    </div>
                            
			</div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<!-- modal Add -->
<div id="add" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tambah Produk</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>produk/add/" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" class="form-control" name="nama_produk" maxlength="30" required>
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<select class="form-control" name="kategori" min="1" required>
							<?php
							foreach($kategori as $k){
								echo '<option value="' . $k->id_kategori . '">' . $k->nama_kategori . '</option>';
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Harga Produk</label>
						<input type="text" class="form-control" name="harga_produk" maxlength="11" required>
					</div>
					<div class="form-group">
						<label>Warna Produk</label>
						<input type="text" class="form-control" name="warna_produk" maxlength="20" required>
					</div>
					<div class="form-group">
						<label>Ukuran Produk</label>
						<input type="text" class="form-control" name="ukuran_produk" maxlength="20" required>
					</div>
					<div class="form-group">
						<label>Gambar Produk Depan</label>
						<input type="file" name="img_produk" required>
					</div>
					<div class="form-group">
						<label>Gambar Produk Belakang</label>
						<input type="file" name="img_produk2" required>
					</div>
					<div class="form-group">
						<label>Deskripsi Produk</label>
						<textarea name="desc_produk" class="form-control" required></textarea>
					</div>
					<input type="submit" value="Simpan" class="btn btn-success">&emsp;
					<input type="button" value="Batal" class="btn btn-default" data-dismiss="modal">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END:modal Add -->
<!-- modal Edit -->
<div id="edit" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Produk</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>produk/edit/" enctype="multipart/form-data">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<label>Nama Produk</label>
						<input type="text" class="form-control" name="nama_produk" id="nama_produk" maxlength="30" required>
					</div>
					<div class="form-group">
						<label>Kategori</label>
						<input type="text" class="form-control" name="kategori" id="kategori" disabled>
					</div>
					<div class="form-group">
						<label>Harga Produk</label>
						<input type="text" class="form-control" name="harga_produk" id="harga_produk" maxlength="11" required>
					</div>
					<div class="form-group">
						<label>Warna Produk</label>
						<input type="text" class="form-control" name="warna_produk" id="warna_produk" maxlength="20" required>
					</div>
					<div class="form-group">
						<label>Ukuran Produk</label>
						<input type="text" class="form-control" name="ukuran_produk" id="ukuran_produk" maxlength="20" required>
					</div>
					<div class="form-group">
						<label>Gambar Produk Depan</label>
						<div class="form-group" id="view_img">
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
						</div>
						<input type="file" name="img_produk">
					</div>
					<div class="form-group">
						<label>Gambar Produk Belakang</label>
						<div class="form-group" id="view_img2">
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
							<div class="col-md-12 "></div>
						</div>
						<input type="file" name="img_produk2">
					</div>
					<div class="form-group">
						<label>Deskripsi Produk</label>
						<textarea name="desc_produk" class="form-control" id="desc_produk" required></textarea>
					</div>
					<input type="submit" value="Simpan" class="btn btn-success">&emsp;
					<input type="button" value="Batal" class="btn btn-default" data-dismiss="modal">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END:modal Edit -->
<script>
	function getdata(x){ //fungsi ambil detail data
		var id = document.getElementById("id");
		var nama = document.getElementById("nama_produk");
		var kategori = document.getElementById("kategori");
		var harga = document.getElementById("harga_produk");
		var warna = document.getElementById("warna_produk");
		var ukuran = document.getElementById("ukuran_produk");
		var desc = document.getElementById("desc_produk");
		var view_img = document.getElementById("view_img");
		var view_img2 = document.getElementById("view_img2");
		$.ajax({
			url : "<?php echo base_url().'Produk/getDataByID/'; ?>" + x,
			type: "GET",
			dataType: "JSON",
			success: function(data){ 
				id.value = data[0].id_produk;
				nama.value = data[0].nama_produk;
				kategori.value = data[0].nama_kategori;
				harga.value = data[0].harga_produk;
				warna.value = data[0].warna_produk;
				ukuran.value = data[0].ukuran_produk;
				desc.value = data[0].desc_produk;
				view_img.innerHTML = '<img width="150px" height="100px" src="<?php echo base_url();?>../image_shop/produk/produkDepan' + data[0].id_produk + '.jpg"  alt="">';
				view_img2.innerHTML = '<img width="150px" height="100px" src="<?php echo base_url();?>../image_shop/produk/produkBelakang' + data[0].id_produk + '.jpg"  alt="">';
				//console.log(data);
			},
			error:function(data){
				 alert("gagal");
			}
		});
	}
	
</script>
