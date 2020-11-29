<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Subscriber
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Subscriber</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" onclick="newsletter_edit(0)"><span class="fa fa-user-plus"></span> Tambah Subscriber</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Tanggal Subscribe</th>
                    <th style="text-align:center;" width="20%">Aksi</th>
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

    

    <div class="modal fade" id="modalNewsletter" tabindex="-1" role="dialog" aria-labelledby="modalNewsletterLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalNewsletterLabel">Add/Edit Newsletter</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_newsletter">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <input type="hidden" id="cStatus" name="cStatus" value="0">
                    <div class="form-group">
                        <label for="cEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="cEmail" class="form-control" id="cEmail" placeholder="Keterangan" required>
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
    

    <!--Modal Hapus Subsriber-->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="ModalHapusLabel">Hapus Subsriber</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_submit_hapus">
                <div class="modal-body">
                        <input type="hidden" id="nIDHapus" name="nIDHapus" value="0"/>
                        <p>Anda akan menonaktifkan subscriber <b><span id="cEmailHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Aktifkan Subsriber-->
    <div class="modal fade" id="modalAktif" tabindex="-1" role="dialog" aria-labelledby="modalAktifLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="ModalAktifLabel">Aktifkan Subsriber</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_submit_aktif">
                <div class="modal-body">
                        <input type="hidden" id="nIDAktif" name="nIDAktif" value="0"/>
                        <p>Anda akan mengaktifkan subscriber <b><span id="cEmailAktif"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="aktif">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>