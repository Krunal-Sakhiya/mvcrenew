<?php
class Model_Customer extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT = 1;

	function __construct()
	{
		parent::__construct();
		$this->setResourceClass('Model_Customer_Resource');
		$this->setCollectionClass('Model_Customer_Collection');
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

	public function getBillingAddress(){
		return Ccc::getModel('Customer_Address')->load($this->billing_address_id);
	}

	public function getShippingAddress(){
		return Ccc::getModel('Customer_Address')->load($this->shipping_address_id);
	}

	public function getAddress(){
		return Ccc::getModel('Customer_Address')->load($this->customer_id);
	}
}