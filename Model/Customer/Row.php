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

	public function getBillingAddress($id)	
	{
		$customerAddress = Ccc::getModel('Customer_Address_Row');
		if ($id) {
			$query = "SELECT * FROM `{$customerAddress->getTableName()}` WHERE `{$customerAddress->getPrimaryKey()}` = '{$id}'";
			return $customerAddress->fetchRow($query);
		}
		return null;
	}

	public function getShippingAddress($id)
	{
		$customerAddress = Ccc::getModel('Customer_Address_Row');
		if ($id) {
			$query = "SELECT * FROM `{$customerAddress->getTableName()}` WHERE `{$customerAddress->getPrimaryKey()}` = '{$id}'";
			return $customerAddress->fetchRow($query);
		}
		return null;
	}

	public function getAddress()
	{
		$customerAddress = Ccc::getModel('Customer_Address_Row');
		$query = "SELECT * FROM `{$customerAddress->geTableName()}` WHERE `{$customerAddress->getPrimaryKey()}` = '{$this->customer_id}'";
		return $customerAddress->fetchRow($query);
	}
}