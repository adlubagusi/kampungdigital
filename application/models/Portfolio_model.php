<?php
class Portfolio_model extends CI_Model{
	public function __construct() {
        parent::__construct();
        $this->load->model('FuncDB_model');
        $this->dbd = $this->FuncDB_model;
    }

    public function getDataPortfolio($nStart,$nLength,$cDraw,$cSearch)
    {
        $vaData = [];
        $vaArr  = [];
        $cField = "p.ID, p.Judul, p.Deskripsi, p.Foto, p.DateTime , k.Keterangan as Kategori";
        $cWhere = "p.Judul like '%".$cSearch['value']."%'
                   OR p.Deskripsi like '%".$cSearch['value']."%'
                   OR Kategori like '%".$cSearch['value']."%'";
        $cJoin  = "left join tbl_portfolio_kategori k on k.Kode=p.Kategori";
        $cOrder = "p.DateTime DESC";
        $nLimit = "$nStart,$nLength";

        $dbDataRow = $this->dbd->select("tbl_portfolio p",$cField,$cWhere,$cJoin);
        $dbData    = $this->dbd->select("tbl_portfolio p",$cField,$cWhere,$cJoin,"",$cOrder,$nLimit);
        while($dbRow = $this->dbd->getrow($dbData)){
            $vaArr[] = $dbRow;
        }
        $vaData['row']  = $this->dbd->rows($dbDataRow);
        $vaData['data'] = $vaArr;

        return $vaData;
    }

		function getDataPortfolioHome(){
  		$vaArray = [];
  		$cField = "tbl_portfolio.*";
  		$dbData = $this->dbd->select("tbl_portfolio",$cField);
  		while($dbRow = $this->dbd->getrow($dbData)){
  			$vaArray[] = $dbRow;
  		}
  		return $vaArray;
  	}

    function getDetailPortfolio($nID){
		$dbRow  = [];
		$dbData = $this->dbd->select("tbl_portfolio", "*", "ID='$nID'");
		$dbRow  = $this->dbd->getrow($dbData);
		return $dbRow;
    }

    public function save($cJudul,$cDeskripsi,$optKategori,$cGambar='',$nID=0)
	{
		$vaUpd = array("Judul"=>$cJudul,
					   "Deskripsi"=>$cDeskripsi,
					   "Kategori"=>$optKategori,
					   "DateTime"=>date('Y-m-d h:i:s'));
		$cWhere = "ID='$nID'";
		if($nID == 0) {
            $vaUpd['Foto'] = $cGambar;
			$this->dbd->insert("tbl_portfolio",$vaUpd);
		}else{
			$this->dbd->update("tbl_portfolio",$vaUpd,$cWhere,"ID");
		}

		if($cGambar <> "" && $nID <> 0){
			$this->saveImage($cGambar,$nID);
		}

	}

	public function saveImage($cGambar,$nID)
	{
		$cWhere = "ID='$nID'";
		$vaUpd = array("Foto"=>$cGambar);
		$this->dbd->edit("tbl_portfolio",$vaUpd,$cWhere);
    }

    public function getAllKategoriPortfolio()
    {
        $vaData = [];
        $dbData = $this->dbd->select("tbl_portfolio_kategori","*");
        while($dbRow  = $this->dbd->getrow($dbData)){
            $vaData[] = $dbRow;
        }
        return $vaData;
    }

    function delete($nID){
		$dbd = $this->dbd->delete("tbl_portfolio","ID='$nID'");
		return $dbd;
	}
}
