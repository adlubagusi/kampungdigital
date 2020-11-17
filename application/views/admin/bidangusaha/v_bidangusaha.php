<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Data Bidang Usaha
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Bidang Usaha</a></li>
        <li class="active">Data Bidang Usaha</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" onclick="bidangusaha_edit(0)"><span class="fa fa-user-plus"></span> Tambah Bidang Usaha</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Cover</th>
                    <th>Nama Owner</th>
                    <th>Nama Usaha</th>
                    <th>No. HP</th>
                    <th>Jenis Usaha</th>
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

    

    <div class="modal fade" id="modalBidangUsaha" tabindex="-1" role="dialog" aria-labelledby="modalBidangUsahaLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalBidangUsahaLabel">Add/Edit Bidang Usaha</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_bidangusaha">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <input type="hidden" id="cTipe">
                    <input type="hidden" name="cKode" class="form-control" id="cKode">
                    <div class="form-group">
                        <label for="cNamaOwner" class="col-sm-2 control-label">Nama Owner</label>
                        <div class="col-sm-10">
                            <input type="text" name="cNamaOwner" class="form-control" id="cNamaOwner" placeholder="Nama Owner" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cNamaUsaha" class="col-sm-2 control-label">Nama Usaha</label>
                        <div class="col-sm-10">
                            <input type="text" name="cNamaUsaha" class="form-control" id="cNamaUsaha" placeholder="Nama Usaha" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cSlug" class="col-sm-2 control-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="cSlug" class="form-control" id="cSlug" placeholder="Link" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cFileFoto" class="col-sm-2 control-label">Foto</label>
                        <div class="col-sm-10">
                            <input type="file" name="cFileFoto" id="cFileFoto"  class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cAlamatUsaha" class="col-sm-2 control-label">Alamat Usaha</label>
                        <div class="col-sm-10">
                            <input type="text" name="cAlamatUsaha" class="form-control" id="cAlamatUsaha" placeholder="Alamat Usaha" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cHP" class="col-sm-2 control-label">No. HP</label>
                        <div class="col-sm-10">
                            <input type="text" name="cHP" class="form-control" id="cHP" placeholder="No. HP" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cDeskripsi" class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea id="cDeskripsi" name="cDeskripsi" required rows="20" cols="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="optJenisUsaha" class="col-sm-2 control-label">Jenis Usaha</label>
                        <div class="col-sm-10">
                            <select id="optJenisUsaha" class="form-control" style="width: 100%;" name="optJenisUsaha" required >
                                <option value="">-Pilih-</option>
                                <?php
                                    foreach($vaJenisUsaha as $key=>$val){
                                ?>
                                    
                                    <option value="<?=$val['Kode']?>"> <?=$val['Keterangan']?> </option>
                                <?php 
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="listFile" style="display:none;">
                        <label for="" class="col-sm-2 control-label">Daftar File</label>
                        <div class="col-sm-10">
                            <ul class="mailbox-attachments clearfix" id="areaFileBidangUsaha">
                                
                            </ul>
                        </div>                        
                    </div>    
                    <div class="form-group">
                        <label for="vaFile" class="col-sm-2 control-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" name="vaFile[]" id="vaFile" multiple class="form-control"/>
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
    
    <!--Modal Hapus Bidang Usaha-->
    <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="ModalHapusLabel">Hapus Pengguna</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_submit_hapus">
                <div class="modal-body">
                        <input type="hidden" id="cKodeHapus" name="cKodeHapus" value="0"/>
                        <p>Apakah Anda yakin mau menghapus Bidang Usaha milik <b><span id="cNamaOwnerHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>