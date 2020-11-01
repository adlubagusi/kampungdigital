<section class="content-header">
    <h1>
        <?=$title?>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">About</a></li>
        <li class="active"><?=$title?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
                <a class="btn btn-success btn-flat" onclick="struktur_edit(0)"><span class="fa fa-user-plus"></span> Tambah Anggota</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped" id="datatabel" style="font-size:13px;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
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

    <div class="modal fade" id="modalStrukturOrganisasi" tabindex="-1" role="dialog" aria-labelledby="modalStrukturOrganisasiLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalStrukturOrganisasiLabel">Add/Edit Struktur Organisasi</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_struktur">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <div class="form-group">
                        <label for="cUserName" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-10">
                            <select name="cUserName" id="cUserName" class="form-control select2">
                                <option value="">Pilih Anggota</option>
                            </select>
                            <!-- <input type="text" name="cJudul" class="form-control" id="cJudul" placeholder="Judul" required> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cJabatan" class="col-sm-2 control-label">Jabatan</label>
                        <div class="col-sm-10">
                            <input type="text" name="cJabatan" class="form-control" id="cJabatan" placeholder="Jabatan" required>
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
    

    <!--Modal Hapus Surat Masuk-->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="ModalHapusLabel">Hapus Surat Masuk</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_submit_hapus">
                <div class="modal-body">
                        <input type="hidden" id="nIDHapus" name="nIDHapus" value="0"/>
                        <p>Apakah anda yakin akan menghapus user <b><span id="cLabelUserNameHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>