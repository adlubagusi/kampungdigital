<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
         Inbox
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Inbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <!-- <a class="btn btn-success btn-flat" onclick="inbox_edit(0)"><span class="fa fa-user-plus"></span> Tambah Inbox</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th width="40%">Subjek</th>
                    <th>Status</th>
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

    

    <div class="modal fade" id="modalInbox" tabindex="-1" role="dialog" aria-labelledby="modalInboxLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header mailbox-read-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reload_tabel()"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h3 class="modal-title" id="modalInboxLabel"></h3>
                    <h5 class="modal-title" id="modalInboxFromLabel">From: <span id="inboxFromText"></span>  
                        <span class="mailbox-read-time pull-right" id="inboxTimeText"></span>
                    </h5>
                </div>
                <form class="form-horizontal" method="post" id="f_inbox">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <div class="form-group" style="border-bottom:1px solid #f4f4f4;">
                        <div class="mailbox-read-message" id="messageText" style="padding: 5px 10px 30px 10px;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-12 control-label" style="text-align:left;">Balas Pesan</label>
                    </div>
                    <div class="form-group">
                        <label for="cSubjectReply" class="col-sm-1 control-label">Subjek: </label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="cSubjectReply" id="cSubjectReply">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cMessageReply" class="col-sm-1 control-label">Pesan: </label>
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
    
    <div class="modal fade" id="modalInboxShow" tabindex="-1" role="dialog" aria-labelledby="modalInboxLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header mailbox-read-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h3 class="modal-title" id="modalInboxLabelShow"></h3>
                    <h5 class="modal-title" id="modalInboxFromLabelShow">From: <span id="inboxFromTextShow"></span>  
                        <span class="mailbox-read-time pull-right" id="inboxTimeTextShow"></span>
                    </h5>
                </div>
                <form class="form-horizontal" method="post" id="f_inbox">
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
                                <h5>From: <span id="inboxFromReplyTextShow"></span> 
                                    <span class="mailbox-read-time pull-right" id="inboxTimeReplyTextShow"></span><br>
                                    To: <span id="inboxToReplyTextShow"></span> 
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
                        <p>Apakah Anda yakin mau menghapus Inbox <b><span id="cKeteranganHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>