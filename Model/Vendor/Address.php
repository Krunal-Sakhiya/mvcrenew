<?php
class Model_Vendor_Address extends Model_Core_Table
{
	function __construct()
	{
		parent::__construct();
		$this->setTableName('vendor_address')->setPrimarykey('address_id');
	}
}