<?php

class DVUHStudiumdaten_model extends DB_Model
{
	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->dbTable = 'sync.tbl_dvuh_studiumdaten';
		$this->pk = 'studiumdaten_id';
	}
}
