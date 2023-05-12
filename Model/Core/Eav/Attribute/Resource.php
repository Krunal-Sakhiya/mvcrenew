<?php
class Model_Core_Eav_Attribute_Resource extends Model_Core_Table_Resource
{
	public function __construct()
	{
		parent::__construct();
		$this->setResourceName('eav_attribute')->setPrimaryKey('attribute_id');
	}

	public function getStatusOptions()
	{
		return [
			Model_Core_Eav_Attribute::STATUS_ACTIVE => Model_Core_Eav_Attribute::STATUS_ACTIVE_LBL,
			Model_Core_Eav_Attribute::STATUS_INACTIVE => Model_Core_Eav_Attribute::STATUS_INACTIVE_LBL,
		];
	}
}