<section class="content-header">
    <h1>
    Pengaturan Umum
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Pengaturan Umum</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Alamat</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="cAlamat" class="form-control" id="cAlamat" value="<?=$cAlamat?>" placeholder="Alamat" required/>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" onclick="return save_alamat();" class="btn btn-primary btn-flat pull-right"><span class="fa fa-pencil"></span> Update</button>
                            <!-- /.form-group -->
                            </div>
                        <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                <!-- /.box -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">No Telp 1</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="cNoTelp1" class="form-control" id="cNoTelp1" value="<?=$cNoTelp1?>" placeholder="No Telp 1" required/>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" onclick="return save_notelp1();" class="btn btn-primary btn-flat pull-right"><span class="fa fa-pencil"></span> Update</button>
                            <!-- /.form-group -->
                            </div>
                        <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                <!-- /.box -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">No Telp 2</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="cNoTelp2" class="form-control" id="cNoTelp2" value="<?=$cNoTelp2?>" placeholder="No Telp 2" required/>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" onclick="return save_notelp2();" class="btn btn-primary btn-flat pull-right"><span class="fa fa-pencil"></span> Update</button>
                            <!-- /.form-group -->
                            </div>
                        <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                <!-- /.box -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Email</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="cEmail" class="form-control" id="cEmail" value="<?=$cEmail?>" placeholder="Email" required/>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" onclick="return save_email();" class="btn btn-primary btn-flat pull-right"><span class="fa fa-pencil"></span> Update</button>
                            <!-- /.form-group -->
                            </div>
                        <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                <!-- /.box -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>
