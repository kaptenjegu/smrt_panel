<div class="row"> 
    <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Pengingat Email
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dt-email">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Subjek</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$no = 1;
										foreach($result as $mail){
											echo '<tr>';
											echo '<td>' . $no . '</td>';
											echo '<td>' . $mail->nama . '</td>';
											echo '<td>' . $mail->email . '</td>';
											echo '<td>' . $mail->subjek . '</td>';
											echo '<td><a href="' . base_url() . 'Home/baca/' . $mail->id_mailing . '" class="btn btn-info btn-sm" onClick="return confirm(\'Apakah email ini sudah dibaca ?\')">Tandai Sudah Dibaca</a></td>';
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