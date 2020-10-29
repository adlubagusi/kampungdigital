<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        List Surat Digital
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Download</a></li>
        <li class="active">List Surat Digital</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" onclick="download_edit(0)"><span class="fa fa-user-plus"></span> Tambah Dokumen</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Tgl</th>
                    <th>User Input</th>
                    <th width="20%" style="text-align:center;">File</th>
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

    

    <div class="modal fade" id="modalDownload" tabindex="-1" role="dialog" aria-labelledby="modalDownloadLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalDownloadLabel">Add/Edit Surat Digital</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_download">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <input type="hidden" name="cKode" class="form-control" id="cKode">
                    <div class="form-group">
                        <label for="cJudul" class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="cJudul" class="form-control" id="cJudul" placeholder="Judul" required>
                        </div>
                    </div>
                    <div class="form-group" id="listFile" style="display:none;">
                        <label for="" class="col-sm-2 control-label">File</label>
                        <div class="col-sm-10">
                            <ul class="mailbox-attachments clearfix" id="areaFileDownload">
                                
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
                        <p>Apakah Anda yakin mau menghapus file <b><span id="cLabelKodeHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>