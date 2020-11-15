<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengguna
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengguna</a></li>
        <li class="active">Data Pengguna</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" onclick="pengguna_edit(0)"><span class="fa fa-user-plus"></span> Add Pengguna</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="datatabel" class="table table-striped" style="font-size:13px;">
                <thead>
                <tr>
					<th>No.</th>
					<th>Photo</th>
                    <th>Nama Lengkap</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>JK</th>
                    <th>Kontak</th>
                    <th>Level</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>



    <div class="modal fade" id="modalPengguna" tabindex="-1" role="dialog" aria-labelledby="modalPenggunaLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalPenggunaLabel">Add/Edit Pengguna</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_pengguna">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <input type="hidden" id="cTipe">
                    <div class="form-group">
                        <label for="cNama" class="col-sm-4 control-label">Nama</label>
                        <div class="col-sm-7">
                            <input type="text" name="cNama" class="form-control" id="cNama" placeholder="Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cEmail" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-7">
                            <input type="email" name="cEmail" class="form-control" id="cEmail" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Jenis Kelamin</label>
                        <div class="col-sm-7">
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="optLakiLaki" value="L" name="optJK" checked>
                                <label for="optLakiLaki"> Laki-Laki </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="optPerempuan" value="P" name="optJK">
                                <label for="optPerempuan"> Perempuan </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cUserName" class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" name="cUserName" class="form-control" id="cUserName" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cPassword" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="cPassword" class="form-control" id="cPassword" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cPassword2" class="col-sm-4 control-label">Ulangi Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="cPassword2" class="form-control" id="cPassword2" placeholder="Ulangi Password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cKontak" class="col-sm-4 control-label">Kontak Person</label>
                        <div class="col-sm-7">
                            <input type="text" name="cKontak" class="form-control" id="cKontak" placeholder="Kontak Person" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="optLevel" class="col-sm-4 control-label">Level</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="optLevel" required id="optLevel">
                                <option value="1">Administrator</option>
                                <option value="2">Author</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cFileFoto" class="col-sm-4 control-label">Photo</label>
                        <div class="col-sm-7">
                            <input type="file" name="cFileFoto" id="cFileFoto"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <label for="cDivisi" class="col-sm-4 control-label">Divisi/Bagian</label> -->
                        <div class="col-sm-7">
                            <input type="hidden" name="cDivisi" class="form-control" id="cDivisi" value="-" placeholder="Divisi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label"> </label>
                        <div class="col-sm-7">
                            <input type="checkbox" name="chckTampil" class="form-check-input" id="chckTampil" value="Y">
                            <label class="form-check-label" for="chckTampil">
                                Tampilkan di Homepage
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Hapus Pengguna-->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="ModalHapusLabel">Hapus Pengguna</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_submit_hapus">
                <div class="modal-body">
                        <input type="hidden" id="nIDHapus" name="nIDHapus" value="0"/>
                        <p>Apakah Anda yakin mau menghapus Pengguna <b><span id="cNamaHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>
