<?php
class Model_Category_Resource extends Model_Core_Table_Resource
{
	public function __construct()
	{
		parent::__construct();
		$this->setResourceName('category')->setPrimarykey('category_id');
	}

	public function getStatusOptions()
	{
		return [
			Model_Category::STATUS_ACTIVE => Model_Category::STATUS_ACTIVE_LBL,
			Model_Category::STATUS_INACTIVE => Model_Category::STATUS_INACTIVE_LBL,
		];
	}
}