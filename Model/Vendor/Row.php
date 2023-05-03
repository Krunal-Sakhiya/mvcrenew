<?php
class Model_Vendor_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Vendor');
	}
}