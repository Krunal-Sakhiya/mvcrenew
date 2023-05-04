<?php
class Model_Customer_Address extends Model_Core_Table
{
	function __construct()
	{
		parent::__construct();
		$this->setTableName('customer_address')->setPrimarykey('address_id');
	}
}