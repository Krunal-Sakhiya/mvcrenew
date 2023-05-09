<?php
class Block_Vendor_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('vendor/edit.phtml');
	}

	public function getRow()
	{
		$vendor =  $this->getData('vendor');
		$address = $this->getData('address');

		$allData = [$vendor, $address];
		return $allData;
	}
}