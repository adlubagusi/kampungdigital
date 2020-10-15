<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        List Surat Masuk
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Surat Masuk</a></li>
        <li class="active">List Surat Masuk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" onclick="surat_masuk_edit(0)"><span class="fa fa-user-plus"></span> Tambah Surat Masuk</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Perihal</th>
                    <th>No. Surat</th>
                    <th>Tgl Masuk</th>
                    <th>Dari</th>
                    <th>User Input</th>
                    <th width="15%" style="text-align:center;">Aksi</th>
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

    

    <div class="modal fade" id="modalSuratMasuk" tabindex="-1" role="dialog" aria-labelledby="modalSuratMasukLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalSuratMasukLabel">Add/Edit Surat Masuk</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_surat_masuk">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <input type="hidden" id="cTipe">
                    <input type="hidden" name="cKode" class="form-control" id="cKode">
                    <div class="form-group">
                        <label for="cNoSurat" class="col-sm-2 control-label">No Surat</label>
                        <div class="col-sm-10">
                            <input type="text" name="cNoSurat" class="form-control" id="cNoSurat" placeholder="Nomor Surat" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cDari" class="col-sm-2 control-label">Dari</label>
                        <div class="col-sm-10">
                            <input type="text" name="cDari" class="form-control" id="cDari" placeholder="Dari" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cPerihal" class="col-sm-2 control-label">Perihal</label>
                        <div class="col-sm-10">
                            <input type="text" name="cPerihal" class="form-control" id="cPerihal" placeholder="Perihal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dTgl" class="col-sm-2 control-label">Tgl Masuk</label>
                        <div class="col-sm-10">
                            <input type="date" name="dTgl" class="form-control" id="dTgl" placeholder="TglMasuk" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cDeskripsi" class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea id="cDeskripsi" name="cDeskripsi" required rows="20" cols="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group" id="listFile" style="display:none;">
                        <label for="" class="col-sm-2 control-label">Daftar File</label>
                        <div class="col-sm-10">
                            <ul class="mailbox-attachments clearfix" id="areaFileSuratMasuk">
                                
                            </ul>
                        </div>                        
                    </div>    
                    <div class="form-group">
                        <label for="vaFile" class="col-sm-2 control-label">File Surat</label>
                        <div class="col-sm-6">
                            <input type="file" name="vaFile[]" id="vaFile" multiple class="form-control"/>
                        </div>
                        <label for="" class="col-sm-2 control-label">* Upload File Disini</label>
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
                        <input type="hidden" id="cKodeHapus" name="cKodeHapus" value="0"/>
                        <p>Apakah Anda yakin mau menghapus surat <b><span id="cLabelKodeHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>