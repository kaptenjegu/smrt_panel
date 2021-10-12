<div class="row"> 
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Kategori
            </div>
			
            <div class="panel-body">
			<center>
			<?php echo $pesan; ?>
			</center>
				<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah Kategori</a><br><br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dt-kategori">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								$no = 1;
								foreach($result as $kategori){
									echo '<tr>';
                                    echo '<td>' . $no . '</td>';
                                    echo '<td>' . $kategori->nama_kategori .'</td>';
                                    echo '<td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" onclick="getdata(' . $kategori->id_kategori . ')"><i class="fa fa-pencil"></i>&emsp;Edit</a>';
									echo '&emsp;<a href="' . base_url() . 'kategori/hapus/' . $kategori->id_kategori . '" class="btn btn-danger btn-sm" onClick="return confirm(\'Anda yakin ingin menghapus kategori ' . $kategori->nama_kategori . '?\')"><i class="fa fa-trash-o"></i>&emsp;Hapus</a></td>';
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
				<h4 class="modal-title">Tambah Kategori</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>kategori/add/" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" name="nama" maxlength="20" class="form-control" required>
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
				<h4 class="modal-title">Edit Kategori</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>kategori/edit/" enctype="multipart/form-data">
				<input type="hidden" name="id" id="edit_id">
					<div class="form-group">
						<label>Nama Kategori</label>
						<input type="text" name="nama" maxlength="20" class="form-control" id="edit_nama" required>
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
		var id = document.getElementById("edit_id");
		var nama = document.getElementById("edit_nama");
		$.ajax({
			url : "<?php echo base_url().'kategori/getDataByID/'; ?>" + x,
			type: "GET",
			dataType: "JSON",
			success: function(data){ 
				id.value = data[0].id_kategori;
				nama.value = data[0].nama_kategori;
			},
			error:function(data){
				 alert("gagal");
			}
		});
	}
</script>
