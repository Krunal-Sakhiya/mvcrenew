<?php
class Model_Core_Eav_Attribute extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT = 1;
	
	public function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Core_Eav_Attribute_Resource');
		$this->setCollectionClass('Model_Core_Eav_Attribute_Collection');
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

	public function getOptions()
	{
		$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = '{$this->attribute_id}';";
		$options = Ccc::getModel('Core_Eav_Attribute_Option')->fetchAll($query);
		return $options;
	}

	public function getEntityType()
   {
      $sql = "SELECT `entity_type_id`,`name` FROM `entity_type`";
      return $this->getResource()->getAdapter()->fetchPairs($sql);
   }
}