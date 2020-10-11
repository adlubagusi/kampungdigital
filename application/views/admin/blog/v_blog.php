<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>
        Data Postingan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Blog</a></li>
        <li class="active">Data Postingan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header">
              <a class="btn btn-success btn-flat" onclick="blog_edit(0)"><span class="fa fa-user-plus"></span> Tambah Postingan</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table class="table table-striped" id="datatabel" style="font-size:13px;">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
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

    

    <div class="modal fade" id="modalBlog" tabindex="-1" role="dialog" aria-labelledby="modalBlogLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
                    <h4 class="modal-title" id="modalBlogLabel">Add/Edit Postingan</h4>
                </div>
                <form class="form-horizontal" method="post" id="f_blog">
                <div class="modal-body">
                    <input type="hidden" id="nID" name="nID" value="0">
                    <input type="hidden" id="cTipe">
                    <div class="form-group">
                        <label for="cJudul" class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" name="cJudul" class="form-control" id="cJudul" placeholder="Judul" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cEmail" class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea id="cDeskripsi" name="cDeskripsi" required rows="20" cols="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="optKategori" class="col-sm-2 control-label">Kategori</label>
                        <div class="col-sm-10">
                            <select id="optKategori" class="form-control" style="width: 100%;" name="optKategori" required >
                                <option value="">-Pilih-</option>
                                <?php
                                    foreach($vaKategori as $key=>$val){
                                ?>
                                    
                                    <option value="<?=$val['Kode']?>"> <?=$val['Keterangan']?> </option>
                                <?php 
                                    } 
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cFileFoto" class="col-sm-2 control-label">Photo</label>
                        <div class="col-sm-10">
                            <input type="file" name="cFileFoto" id="cFileFoto"/>
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
                        <p>Apakah Anda yakin mau menghapus Blog <b><span id="cJudulHapus"></span></b> ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-flat" id="hapus">Hapus</button>
                </div>
                </form>
            </div>
        </div>
    </div>