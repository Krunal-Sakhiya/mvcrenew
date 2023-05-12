<?php
class Block_Core_Eav_Attribute_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/eav/attribute/edit.phtml');
	}

	public function getRow()
	{
		$row = $this->getData('attribute');
		return $row;
	}

	public function getAttributeOption()
	{
		$attributeId = Ccc::getModel('Core_Request')->getParam('attribute_id');

		if (!$attributeId) {
			return Ccc::getModel('Core_Eav_Attribute_Option');
		}

		$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = {$attributeId}";
		$attributeOptions = Ccc::getModel('Core_Eav_Attribute_Option')->fetchAll($query);
		return $attributeOptions;
	}
}