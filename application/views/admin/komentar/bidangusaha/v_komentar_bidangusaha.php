<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
         Komentar Bidang Usaha
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="">Bidang Usaha</li>
        <li class="active">Komentar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <!-- <a class="btn btn-success btn-flat" onclick="komentar_edit(0)"><span class="fa fa-user-plus"></span> Tambah Komentar</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggapan Untuk</th>
                    <th>Dikirimkan Pada</th>
                    <th>Status</th>
                    <th style="text-align:center;" width="15%">Aksi</th>
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

    

    <div class="modal fade" id="modalKomentar" tabindex="-1" role="dialog" aria-labelledby="modalKomentarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header mailbox-read-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reload_tabel()"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h3 class="modal-title" id="modalKomentarLabel"></h3>
                    <h5 class="modal-title" id="modalKomentarFromLabel">Email &nbsp;: <span id="komentarFromText"></span>  
                        <span class="mailbox-read-time pull-right" id="komentarTimeText"></span><br>
                        Nama : <span id="komentarNamaReplyText"></span> 
                    </h5>
                </div>
                <form class="form-horizontal" method="post" id="f_komentar">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <input type="hidden" id="nIDBidangUsaha" name="nIDBidangUsaha" value="0">
                    <div class="form-group" style="border-bottom:1px solid #f4f4f4;">
                        <div class="mailbox-read-message" id="messageText" style="padding: 5px 10px 30px 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-12 control-label" style="text-align:left;">Balas Komentar</label>
                    </div>
                    <div class="form-group">
                        <label for="cMessageReply" class="col-sm-1 control-label">Komentar: </label>
                        <div class="col-sm-12">
                            <textarea name="cMessageReply" id="cMessageReply" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" onclick="reload_tabel()" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="send">Kirim</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalKomentarShow" tabindex="-1" role="dialog" aria-labelledby="modalKomentarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header mailbox-read-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h3 class="modal-title" id="modalKomentarLabelShow"></h3>
                    <h5 class="modal-title" id="modalKomentarFromLabelShow">Email &nbsp;: <span id="komentarFromTextShow"></span>  
                        <span class="mailbox-read-time pull-right" id="komentarTimeTextShow"></span><br>
                        Nama : <span id="komentarNamaReplyTextShow"></span> 
                    </h5>
                </div>
                <form class="form-horizontal" method="post" id="f_komentar_show">
                <div class="modal-body">
                    <input type="hidden" id="nIDShow" name="nIDShow" value="0">
                    <div class="form-group" style="border-bottom:1px solid #f4f4f4;">
                        <div class="mailbox-read-message" id="messageTextShow" style="padding: 5px 10px 30px 10px;">
                        </div>
                    </div>
                    <div class="form-group" style="border-bottom:1px solid #f4f4f4;background: #00a65a;color: #fff;padding: 10px 5px;">
                        <label for="" class="col-sm-12" style="text-align:left;margin:0">Sudah dibalas <i class="fa fa-check"></i></label>
                    </div>
                    <div class="form-group">
                        <label for="cSubjectReply" class="col-sm-1 control-label">Subjek: </label>
                        <div class="col-sm-12">
                            <div class="mailbox-read-info" style="padding: 10px 0;">
                                <h3 id="cSubjectReplyShow"></h3>
                                <h5>From: <span id="komentarFromReplyTextShow"></span> 
                                    <span class="mailbox-read-time pull-right" id="komentarTimeReplyTextShow"></span><br>
                                    To: <span id="komentarToReplyTextShow"></span> 
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cMessageReply" class="col-sm-1 control-label">Pesan: </label>
                        <div class="col-sm-12">
                            <div class="mailbox-read-message" id="cMessageReplyShow" style="padding: 5px 10px 30px 10px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Hapus Komentar-->
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
                        <p>Komentar akan dihapus. Apakah anda yakin<b><span id="cKeteranganHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Modal Publish Komentar-->
    <div class="modal fade" id="modalPublish" tabindex="-1" role="dialog" aria-labelledby="modalPublishLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reload_tabel()"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <!-- <h3 class="modal-title" id="modalPublishLabel"></h3> -->
                    <h5 class="modal-title" id="modalPublishFromLabeltPublish">Email &nbsp;: <span id="komentarFromTextPublish"></span>  
                        <span class="mailbox-read-time pull-right" id="komentarTimeTextPublish"></span><br>
                        Nama : <span id="komentarNamaReplyTextPublish"></span> 
                    </h5>
                </div>
                <form class="form-horizontal" method="post" id="f_submit_publish">
                <div class="modal-body">
                    <div class="form-group" style="border-bottom:1px solid #f4f4f4;">
                        <label for="messageTextPublish" class="col-sm-1 control-label">Komentar: </label>
                        <div class="mailbox-read-message col-sm-12" id="messageTextPublish" style="padding: 5px 10px 30px 15px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="hidden" id="nIDPublish" name="nIDPublish" value="0"/>
                            <p>Komentar ini akan di publish. Apakah anda yakin ?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="publish">Ya, Saya yakin</button>
                </div>
                </form>
            </div>
        </div>
    </div>