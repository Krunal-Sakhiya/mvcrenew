<?php
class Model_Salesman_Resource extends Model_Core_Table_Resource
{
	public function __construct()
	{
		parent::__construct();
		$this->setResourceName('salesman')->setPrimarykey('salesman_id');
	}

	public function getStatusOptions()
	{
		return [
			Model_Salesman::STATUS_ACTIVE => Model_Salesman::STATUS_ACTIVE_LBL,
			Model_Salesman::STATUS_INACTIVE => Model_Salesman::STATUS_INACTIVE_LBL,
		];
	}
}