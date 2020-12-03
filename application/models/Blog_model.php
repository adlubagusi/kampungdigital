<?php
class Blog_model extends CI_Model{
	public function __construct() {
      parent::__construct();
      $this->load->model('FuncDB_model');
      $this->load->model('Newsletter_model');
      $this->dbd = $this->FuncDB_model;
  }

  public function getDataBlog($nStart,$nLength,$cDraw,$cSearch)
  {
      $vaData = [];
      $vaArr  = [];
      $cField = "b.ID, b.Judul, b.Image, b.DateTime, b.SendNotif, k.Keterangan as Kategori";
      $cWhere = "b.Judul like '%".$cSearch['value']."%'
                OR Kategori like '%".$cSearch['value']."%'";
      $cJoin  = "left join tbl_kategori k on k.Kode=b.Kategori";
      $cOrder = "b.DateTime DESC";
      $nLimit = "$nStart,$nLength";

      $dbDataRow = $this->dbd->select("tbl_blog b",$cField,$cWhere,$cJoin);
      $dbData    = $this->dbd->select("tbl_blog b",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
      while($dbRow = $this->dbd->getrow($dbData)){
          $vaArr[] = $dbRow;
      }
      $vaData['row']  = $this->dbd->rows($dbDataRow);
      $vaData['data'] = $vaArr;

      return $vaData;
  }

  function getDataBlogHome(){
    $vaArray = [];
    $cField = "tbl_blog.*";
    $dbData = $this->dbd->select("tbl_blog",$cField);
    while($dbRow = $this->dbd->getrow($dbData)){
      $vaArray[] = $dbRow;
    }
    return $vaArray;
  }

  function getDetailBlog($nID){
    $dbRow  = [];
    $dbData = $this->dbd->select("tbl_blog", "*", "ID='$nID'");
    $dbRow  = $this->dbd->getrow($dbData);
    $dbRow['KeteranganKategori'] = $this->getKeteranganKategori($dbRow['Kategori']);
    return $dbRow;
  }

  public function getDetailBlogBySlug($cSlug)
  {
    $dbRow  = [];
    $dbData = $this->dbd->select("tbl_blog", "*", "Slug='$cSlug'");
    $dbRow  = $this->dbd->getrow($dbData);
    $dbRow['KeteranganKategori'] = $this->getKeteranganKategori($dbRow['Kategori']);
    return $dbRow;
  }

  public function save($cJudul,$cSlug,$cDeskripsi,$optKategori,$cGambar='',$nID=0){
    $vaUpd = array("Judul"=>$cJudul,
            "Slug"=>$cSlug,
            "Deskripsi"=>$cDeskripsi,
            "Kategori"=>$optKategori,
            "DateTime"=>Now());
    $cWhere = "ID='$nID'";
    if($nID == 0) {
      $vaUpd['Image'] = $cGambar;
      $this->dbd->insert("tbl_blog",$vaUpd);
    }else{
      $this->dbd->update("tbl_blog",$vaUpd,$cWhere,"ID");
    }

    if($cGambar <> "" && $nID <> 0){
      $this->saveImage($cGambar,$nID);
    }

  }

	public function saveImage($cGambar,$nID)
	{
    $cWhere = "ID='$nID'";
    $vaUpd = array("Image"=>$cGambar);
    $this->dbd->edit("tbl_blog",$vaUpd,$cWhere);
  }

  public function getAllKategoriBlog()
  {
      $vaData = [];
      $dbData = $this->dbd->select("tbl_kategori","*");
      while($dbRow  = $this->dbd->getrow($dbData)){
          $vaData[] = $dbRow;
      }
      return $vaData;
  }

  function delete($nID){
		$dbd = $this->dbd->delete("tbl_blog","ID='$nID'");
		return $dbd;
  }

  public function getKeteranganKategori($cKode)
  {
    $cKeterangan  = "";
    $dbData = $this->dbd->select("tbl_kategori", "*", "Kode='$cKode'");
    if($dbRow  = $this->dbd->getrow($dbData)){
      $cKeterangan = $dbRow['Keterangan'];
    }
    return $cKeterangan;
	}

	function getCountDataBlog($cKategori=""){
    $cField = "tbl_blog.*";
    $cWhere = ($cKategori <> "") ? "Kategori = '$cKategori' " : "";
		$dbData = $this->dbd->select("tbl_blog",$cField,$cWhere);
		$nCount = $this->dbd->rows($dbData);

		return $nCount;
	}

	function getDataBlogPagination($limit_start, $limit,$cKategori=""){
		$vaArray = [];
    $cField = "tbl_blog.*";
    $cWhere = ($cKategori <> "") ? "Kategori = '$cKategori' " : "";
		$cOrder = "ID";
		$nLimit = "$limit_start, $limit";
		$dbData = $this->dbd->select("tbl_blog",$cField,$cWhere,"","",$cOrder,$nLimit);
		while($dbRow = $this->dbd->getrow($dbData)){
			$vaArray[] = $dbRow;
		}
		return $vaArray;
	}

	public function sendMail($va)
	{
			$cBlogId    = $va['cBlogId'];
			$cNama    = $va['cName'];
      $cEmail   = $va['cEmail'];
			$cMessage = $va['cMessage'];
			$cStatus = "0";
			$cParent = null;
			$cHost    = $_SERVER['HTTP_HOST'];

			$vaInsert = array("Nama"=>$cNama, "Email"=>$cEmail, "Parent"=>$cParent, "Status"=>$cStatus, "Message"=>$cMessage, "BlogId"=>$cBlogId);
			$this->dbd->insert("tbl_komentar",$vaInsert);

			// Send Email
			if($cHost <> "localhost"){
          //ambil detail blog
          $vaBlog = $this->getDetailBlog($cBlogId);

          $cSubject = "Komentar untuk ".$vaBlog['Judul'];
					$cMail   = getCfg("msEmail","");
					//$vaMail  = explode(";",$cMail); //hanya dipakai jika email instansi lebih dari 1
					//foreach($vaMail as $mail){
							$cReceiverEmail = $cMail;
							$subjectMail    = $cSubject ." Dari: ".$cNama;
							$headers        = "MIME-Version: 1.0" . "\r\n";
							$headers        .= "Content-type:text/html;charset=UTF-8" . "\r\n";
							$headers        .= 'From: <'.$cEmail.'>' . "\r\n";
							$message = "
									<html>
											<body>
											".$cMessage."
											</body>
									</html>
							";

							//mail($cReceiverEmail,$subjectMail,$message,$headers);
					//}
			}
	}

	public function getDataKomentarBlog($nIDBlog){
    $vaArray = [];
    $cField = "tbl_komentar.*";
		$cWhere = "BlogID = '$nIDBlog' AND (Status = '1' or Status = '2') AND ISNULL(Parent)";
    $dbData = $this->dbd->select("tbl_komentar",$cField,$cWhere);
    while($dbRow = $this->dbd->getrow($dbData)){
      $vaArray[] = $dbRow;
    }
    return $vaArray;
  }

	public function getDataKomentarBlogReply(){
    $vaArray = [];
    $cField = "tbl_komentar.*";
		$cWhere = "Status = 1 OR Status = 2 OR Status = 4";
    $dbData = $this->dbd->select("tbl_komentar",$cField,$cWhere);
    while($dbRow = $this->dbd->getrow($dbData)){
      $vaArray[] = $dbRow;
    }
    return $vaArray;
  }

	public function saveReply($va)
	{
			$cBlogId    = $va['nIDBlog'];
			$cNama    	= $va['cName'];
			$cEmail   	= $va['cEmail'];
			$cMessage 	= $va['cMessageReply'];
			$cStatus 		= "0";
			$cParent 		= $va['nID'];

			$vaInsert = array("Nama"=>$cNama, "Email"=>$cEmail, "Parent"=>$cParent, "Status"=>$cStatus, "Message"=>$cMessage, "BlogId"=>$cBlogId);
			$this->dbd->insert("tbl_komentar",$vaInsert);
	}

	function getCountDataKomentar($nIDBlog){
    $cField = "tbl_komentar.*";
		$cWhere = "BlogID = '$nIDBlog' AND (Status = 1 OR Status = 2 OR Status = 4)";
    $dbData = $this->dbd->select("tbl_komentar",$cField, $cWhere);
		$nCount = $this->dbd->rows($dbData);

		return $nCount;
  }

  public function sendMailToSubscriber($nIDBlog)
  {
    $cHost    = $_SERVER['HTTP_HOST'];
    $cEmail = getCfg("msEmail");
    // ambil data detail blog/postingan
    $vaBlog = $this->getDetailBlog($nIDBlog);
    // ambil data subscriber yang akan dikirimkan notifikasi postingan baru
    $vaSubscriber = $this->Newsletter_model->getDataAllNewsletter("1");

    if($cHost <> "localhost"){

      //perulangan untuk mengirimkan email ke semua subscriber aktif
      foreach($vaSubscriber as $key=>$value){
        $cReceiverEmail = $value['Email'];
        $subjectMail    = $vaBlog['Judul']." | Postingan terbaru Karang Taruna Sumbersari RW. 03";
        $cLink          = base_url().'p/'.$vaBlog['Slug'];
        $headers        = "MIME-Version: 1.0" . "\r\n";
        $headers        .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers        .= 'From: <'.$cEmail.'>' . "\r\n";
        $message = '
                    <html>
                        <body>
                          <link rel="stylesheet" href="'.base_url().'assets/bootstrap/css/bootstrap.min.css">
                          <div class="container">
                            <div class="row">

                              <div class="col-md-6 col-md-offset-3">
                                <img src="'.base_url().'assets/images/blog/'.$vaBlog['Image'].'" style="width:100%;">
                              </div>

                              <div class="col-md-8 col-md-offset-2">
                                <label style="margin: 0 auto">'.$vaBlog['Judul'].'</label>
                                <p>'.substr($vaBlog['Deskripsi'],0,50).' ...</p>
                              </div>

                              <div class="col-md-8 col-md-offset-2">
                                <a class="btn btn-warning btn-flat" href="'.$cLink.'" target="_blank">
                                  Baca Selengkapnya
                                </a>
                              </div>

                              <div class="col-md-8 col-md-offset-2" style="margin-top:50px">
                                <p>Untuk informasi atau bantuan lebih lanjut, hubungi '.getCfg("msNoTelp1").' atau <a href="'.base_url().'contact" target="_blank">'.$cEmail.'</a></p>
                                <p>Hormat Kami,</p>
                                <img src="'.base_url().'assets/images/logo-karang-taruna.png" style="width:75px;">
                              </div>

                            </div>
                          </div>
                        </body>
                    </html>
                ';
        //mail($cReceiverEmail,$subjectMail,$message,$headers);
      }
    }
  }

  public function updateStatusNotif($nIDBlog,$nStatus="1")
  {
      $vaUpd  = array('SendNotif' => $nStatus);
      $cWhere = "ID='$nIDBlog'";
      $this->dbd->update("tbl_blog",$vaUpd,$cWhere,"ID");
      return 1;
  }
}
