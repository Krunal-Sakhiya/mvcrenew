<?php
class Model_Product extends Model_Core_Table
{
	public function __construct()
	{
		parent::__construct();
		$this->setTableName('product')->setPrimarykey('product_id');
	}
}