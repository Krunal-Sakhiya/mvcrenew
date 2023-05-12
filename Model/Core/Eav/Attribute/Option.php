<?php
class Model_Core_Eav_Attribute_Option extends Model_Core_Table
{
	public function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Core_Eav_Attribute_Option_Resource');
		$this->setCollectionClass('Model_Core_Eav_Attribute_Option_Collection');
	}
}