<?php
class FuncDB_model extends CI_Model{
	public function __construct(){
        parent::__construct();
		//$this->load->database() ;
		$this->db = $this->load->database('default', true);
	
	}

	public function escape($str){
		return $this->db->escape($str) ;
	}

	public function escape_like_str($str){
		return $this->db->escape_like_str($str) ;
	}

	public function sql_exec($query, $save_log=TRUE, $simple=TRUE){
		// if($this->db->save_log === TRUE && $save_log === TRUE){//save to log

		// }

		if($simple){
			if(!$this->db->simple_query($query)){
				if(ENVIRONMENT <> 'live'){
					print_r($this->db->error()) ;
					print_r($query) ;
				}
			}
		}else{
			if($return = $this->db->query($query)){
				return $return ;
			}else{
				if(ENVIRONMENT <> 'live'){
					print_r($this->db->error()) ;
				}
			}
		}
	}

	public function select($table, $field, $where='', $join='', $group='', $order='', $limit=''){
		if(trim($where) !== "") $where = 'WHERE ' . $where ;
		if(trim($group) !== "") $group = 'GROUP BY ' . $group ;
		if(trim($order) !== "") $order = 'ORDER BY ' . $order ;
		if(trim($limit) !== "") $limit = 'LIMIT ' . $limit ;

		$query = "SELECT {$field} FROM {$table} {$join} {$where} {$group} {$order} {$limit}" ;
		return $this->sql_exec($query, FALSE, FALSE) ;
	}

	public function getrow($o){
		return (array) $o->unbuffered_row() ;
	}

	public function getrow_for($o){
        return $o->result_array() ;
    }

	public function rows($o){
		return $o->num_rows() ;
	}

	public function fields($o){
		return $o->num_fields() ;
	}

	public function insert($table, $data, $save_log=TRUE){
		$field 	= array() ;
		$val 		= array() ;
		foreach ($data as $key => $value) {
			$field[] 	= $key ;
			$val[]		= $this->escape($value) ;
		}
		$field	= "(" . implode(",", $field) . ")" ;
		$val 		= "(" . implode(",", $val) . ")" ;
		$query	= "INSERT INTO {$table} {$field} VALUES {$val}" ;
		$this->sql_exec($query, $save_log) ;
	}

	public function edit($table, $data, $where='',$save_log=TRUE){
		if(trim($where) !== "") $where = 'WHERE ' . $where ;

		$udata 			= array() ;
		foreach ($data as $key => $value) {
			$udata[] 	= " {$key} = ".$this->escape($value)." " ;
		}
		$udata 	= implode(", ", $udata) ;
		$query	= "UPDATE {$table} SET {$udata} {$where}" ;
		$this->sql_exec($query, $save_log) ;
	}

	public function update($table, $data, $where='', $field_id='', $save_log=TRUE){
		if($field_id == '') $field_id = 'id';
		$dbdata = $this->select($table, $field_id, $where) ;
		if($this->rows($dbdata) > 0){
			$this->edit($table, $data, $where, $save_log) ;
		}else{
			$this->insert($table, $data, $save_log) ;
		}
	}

	public function delete($table, $where, $save_log=TRUE){
		if(trim($where) !== "") $where = 'WHERE ' . $where ;
		$query 	= "DELETE FROM {$table} {$where}" ;
		$this->sql_exec($query, $save_log) ;
	}

	public function delete_all($table){
		$query 	= "TRUNCATE TABLE {$table}" ;
		$this->sql_regcase($query, FALSE) ;
	}

	public function getsql(){
		return $this->db->last_query() ;
	}

	public function getval($field, $where, $table){
		$rerow 		= '' ;
		$dbdata 	= $this->select($table, $field, $where, "", "", "", "0,1") ;
		$row 		= $this->getrow($dbdata) ;
		if(strpos($field, ",") === FALSE && trim($field) !== "*" ){
			if(!empty($row)){
				$rerow 	= $row[$field] ;
			}
		}else{
			$rerow 	= $row ;
		}
		return $rerow ;
	}

	public function saveconfig($key, $val=''){
		$this->update("sys_config", array("title"=>$key, "val"=>$val), "title = " . $this->escape($key), "id") ;
	}

	public function getconfig($key){
		return $this->getval('val', "title = ". $this->escape($key), "sys_config") ;
	}

	public function getincrement($k,$l=true,$n=0 ){
		/*
			$k = Key about increment
			$l = Update increment?
			$n = Length (pad)
		*/
		$inc 	= 1 ;
		$k 		= "inc_" . $k ;
		$val 	= intval($this->getconfig($k)) ;
		$inc 	= ($val > 0) ? $val+1 : $inc ;
		if($l){
			$this->saveconfig($k, $inc) ;
		}
		return str_pad($inc, $n, "0", STR_PAD_LEFT) ;
	}

 	// func DB
    public function AddTable($cTableName,$cSQL,$cDatabase=''){
        if(!empty($cDatabase)){
            $cDatabase = " From " . $cDatabase ;
        }

        //$cTableName = strtolower(trim($cTableName)) ;
        $dbData = $this->db->query("Show Tables $cDatabase") ;
        $lAdd = true ;
        foreach($dbData->result_array() as $dbRow){
           foreach($dbRow as $key){
              if($key == $cTableName){
                $lAdd = false ;
              }
           }
        }
        //if($this->rows($dbData) > 0)$lAdd = false ;
        if($lAdd){
            $this->db->query($cSQL) ;
        }
    }

    function AddField($cTableName,$cFieldName,$cFieldType,$cDefault='',$cFieldAfter=''){
        $dbData =  $this->db->query("Show Fields From $cTableName") ;
        $lModif = true ;
        foreach($dbData->result_array() as $dbRow){
           foreach($dbRow as $key){
              if($key == $cFieldName){
                $lModif = false ;
              }
           }
        }
        if($lModif){
            if(!empty($cFieldAfter)){
                $cFieldAfter = " AFTER " . $cFieldAfter ;
            }
           $this->db->query("ALTER TABLE $cTableName ADD $cFieldName $cFieldType DEFAULT '$cDefault' $cFieldAfter") ;
        }
	}



    public function CheckDatabase(){
		$this->AddField("tbl_pengguna","pengguna_divisi","varchar(50)","","pengguna_level");
		$this->AddField("tbl_pengguna","pengguna_tampilhome","char(1)","","pengguna_divisi");
		
		$cSQL = "CREATE TABLE `tbl_inbox` (
				`ID` int(11) NOT NULL AUTO_INCREMENT,
				`Nama` varchar(40) DEFAULT NULL,
				`Email` varchar(60) DEFAULT NULL,
				`Subject` varchar(200) DEFAULT NULL,
				`Message` text,
				`Tgl` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				`Status` int(11) DEFAULT '1' COMMENT '1=Belum dilihat, 0=Telah dilihat',
				PRIMARY KEY (`ID`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		$this->AddTable('tbl_inbox',$cSQL);
    }
}
?>
