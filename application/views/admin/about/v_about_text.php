<section class="content-header">
      <h1>
        Teks About Us
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">About Us</a></li>
        <li class="active">Text</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Update About Us</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" name="cJudul" class="form-control" id="cJudul" value="<?=$cAbout_Judul?>" placeholder="Judul" required/>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-2">
                    <div class="form-group">
                        <button type="submit" onclick="return save_about();" class="btn btn-primary btn-flat pull-right"><span class="fa fa-pencil"></span> Update</button>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-md-8">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Deskripsi</h3>
            </div>
            <div class="box-body">

                <textarea id="cDeskripsi" name="cDeskripsi" required><?=$cAbout_Deskripsi?></textarea>

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        </div>
    </div>
    </section>
