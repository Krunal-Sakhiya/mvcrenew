<?php
class Model_Vendor_Resource extends Model_Core_Table_Resource
{
	public function __construct()
	{
		parent::__construct();
		$this->setResourceName('vendor')->setPrimarykey('vendor_id');
	}

	public function getStatusOptions()
	{
		return [
			Model_Vendor::STATUS_ACTIVE => Model_Vendor::STATUS_ACTIVE_LBL,
			Model_Vendor::STATUS_INACTIVE => Model_Vendor::STATUS_INACTIVE_LBL,
		];
	}
}