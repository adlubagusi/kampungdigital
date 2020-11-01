<section class="content-header">
    <h1>
    Pengaturan SEO (Search Engine Optimization)
    <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengaturan</a></li>
        <li class="active">Pengaturan SEO</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Meta Name: Description</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="cDeskripsiSEO" class="form-control" id="cDeskripsiSEO" value="<?=$cDeskripsiSEO?>" placeholder="contoh: TK Taman Indria adalah Taman Kanak-kanak yang berada di Kecamatan Turen, Kab. Malang" required/>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" onclick="return save_deskripsi_seo();" class="btn btn-primary btn-flat pull-right"><span class="fa fa-pencil"></span> Update</button>
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
                    <h3 class="box-title">Meta Name: Keywords</h3><br>
                    <small>contoh: kampung, digital, malang, dll. (pisahkan dengan tanda , )</small>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" name="cKeywordsSEO" class="form-control" id="cKeywordsSEO" value="<?=$cKeywordsSEO?>" placeholder="Keywords" required/>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="submit" onclick="return save_keywords_seo();" class="btn btn-primary btn-flat pull-right"><span class="fa fa-pencil"></span> Update</button>
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
