<?php
class Model_Product extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE =  2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT= 1;

	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Product_Resource');
		$this->setCollectionClass('Model_Product_Collection');
	}

	public function getStatus()
	{
		if ($this->status) {
			return $this->status;
		}
		return self::STATUS_DEFAULT;
	}

	public function getStatusText($status)
	{
		$statuses = $this->getResource()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
			return $statuses[$this->status];
		}

		return $statuses[self::STATUS_DEFAULT];
	}

	public function getAttribute()
	{
		$query = "SELECT * FROM `eav_attribute` WHERE `entity_type_id` = 1";
		$attribute = Ccc::getModel('Core_Eav_Attribute')->fetchAll($query);
		return $attribute->getData();
	}

	public function getAttributeValue($attribute)
	{
		$query = "SELECT `value` FROM `product_{$attribute->backend_type}` WHERE `entity_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}';";
		$row = $this->getResource()->getAdapter()->fetchOne($query);
		return $row;
	}
}