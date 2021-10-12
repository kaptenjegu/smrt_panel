<div class="row"> 
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Pengaturan Story
            </div>
			
            <div class="panel-body">
			<center>
			<?php echo $pesan; ?>
			</center>
				<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i> Tambah Story</a><br><br>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dt-story">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Keterangan</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								$no = 1;
								foreach($result as $story){
									echo '<tr>';
                                    echo '<td>' . $no . '</td>';
                                    echo '<td><a href="#" data-toggle="modal" data-target="#view" onclick="getimg(' . $story->id_story . ')">Klik untuk lihat</td>';
                                    echo '<td>' . htmlentities($story->keterangan) .'</td>';
                                    echo '<td><a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit" onclick="getdata(' . $story->id_story . ')"><i class="fa fa-pencil"></i>&emsp;Edit</a>';
									echo '&emsp;<a href="' . base_url() . 'SettingStory/hapus/' . $story->id_story . '" class="btn btn-danger btn-sm" onClick="return confirm(\'Anda yakin ingin menghapus story dengan ID ' . $story->id_story . '?\')"><i class="fa fa-trash-o"></i>&emsp;Hapus</a></td>';
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
				<h4 class="modal-title">Tambah Story</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>story/add/" enctype="multipart/form-data">
					<div class="form-group">
						<label>Gambar</label>
						<input type="file" name="img_story" required>
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" class="form-control" required></textarea>
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
				<h4 class="modal-title">Edit Username</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>story/edit/" enctype="multipart/form-data">
				<input type="hidden" name="id" id="edit_id">
					<div class="form-group">
						<label>Gambar</label>
						<input type="file" name="img_story">
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" class="form-control" id="edit_keterangan" required></textarea>
					</div>
					<input type="submit" value="Simpan" class="btn btn-success">&emsp;
					<input type="button" value="Batal" class="btn btn-default" data-dismiss="modal">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END:modal Edit -->
<!-- modal View Image -->
<div id="view" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Gambar Story</h4>
			</div>
			<div class="modal-body">
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
			</div>
		</div>
	</div>
</div>
<!-- END:modal View Image -->
<script>
	function getdata(x){ //fungsi ambil detail data
		var id = document.getElementById("edit_id");
		var keterangan = document.getElementById("edit_keterangan");
		$.ajax({
			url : "<?php echo base_url().'SettingStory/getDataByID/'; ?>" + x,
			type: "GET",
			dataType: "JSON",
			success: function(data){ 
				id.value = data[0].id_story;
				keterangan.value = data[0].keterangan;
			},
			error:function(data){
				 alert("gagal");
			}
		});
	}
	function getimg(x){ //fungsi ambil gambar
		var view_img = document.getElementById("view_img");
		$.ajax({
			url : "<?php echo base_url().'SettingStory/getDataByID/'; ?>" + x,
			type: "GET",
			dataType: "JSON",
			success: function(data){ 
				view_img.innerHTML = '<img width="200px" height="100px" src="<?php echo base_url();?>../image_utama/story/story' + data[0].id_story + '.jpg"  alt="Tidak ada gambar">';
			},
			error:function(data){
				 alert("gagal");
			}
		});
	}
	
</script>
