<?php
class Model_Customer_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Customer');
	}

	public function getStatus()
	{
		if ($this->status) {
			return $this->status;
		}

		return Model_Customer::STATUS_DEFAULT;
	}

	public function getStatusText($status)
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
			return $statuses[$this->status];
		}

		return $statuses[Model_Customer::STATUS_DEFAULT];
	}

	public function getBillingAddress(){
		return Ccc::getModel('Customer_Address_Row')->load($this->billing_address_id);
	}

	public function getShippingAddress(){
		return Ccc::getModel('Customer_Address_Row')->load($this->shipping_address_id);
	}

	public function getAddress(){
		return Ccc::getModel('Customer_Address_Row')->load($this->customer_id);
	}
}