<div class="row"> 
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Pengaturan About
            </div>
			
            <div class="panel-body">
			<center>
			<?php echo $pesan; ?>
			</center>
			<form method="post" action="<?php echo base_url(); ?>about/save/" enctype="multipart/form-data">
				<div class="form-group">
					<label>Text About</label>
					<textarea name="txt_about" class="form-control" required><?php echo $result[0]->text_about; ?></textarea>
				</div> 
                <div class="form-group">
					<label>Background</label>
					<input type="file" name="img_about">
				</div>
				<input type="submit" value="Simpan" class="btn btn-primary">
            </form>          
			</div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
