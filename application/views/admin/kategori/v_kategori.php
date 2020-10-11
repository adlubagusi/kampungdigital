<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Kategori Kategori
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Kategori</a></li>
        <li class="active">Kategori</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" onclick="kategori_edit(0)"><span class="fa fa-user-plus"></span> Tambah Kategori</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th width="60%">Keterangan</th>
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

    

    <div class="modal fade" id="modalKategori" tabindex="-1" role="dialog" aria-labelledby="modalKategoriLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalKategoriLabel">Add/Edit Kategori</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_kategori">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <div class="form-group">
                        <label for="cKode" class="col-sm-2 control-label">Kode</label>
                        <div class="col-sm-10">
                            <input type="text" name="cKode" class="form-control" id="cKode" placeholder="Kode" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cKeterangan" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" name="cKeterangan" class="form-control" id="cKeterangan" placeholder="Keterangan" required>
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
                        <p>Apakah Anda yakin mau menghapus Kategori <b><span id="cKeteranganHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>