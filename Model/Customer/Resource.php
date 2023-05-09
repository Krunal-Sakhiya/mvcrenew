<?php
class Model_Customer_Resource extends Model_Core_Table_Resource
{
	public function __construct()
	{
		parent::__construct();
		$this->setResourceName('customer')->setPrimarykey('customer_id');
	}

	public function getStatusOptions()
	{
		return [
			Model_Customer::STATUS_ACTIVE => Model_Customer::STATUS_ACTIVE_LBL,
			Model_Customer::STATUS_INACTIVE => Model_Customer::STATUS_INACTIVE_LBL,
		];
	}
}