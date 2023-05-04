<?php
class Model_Customer extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 1;
	const STATUS_DEFAULT = 1;

	function __construct()
	{
		parent::__construct();
		$this->setTableName('customer')->setPrimarykey('customer_id');
	}

	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL,
		];
	}
}