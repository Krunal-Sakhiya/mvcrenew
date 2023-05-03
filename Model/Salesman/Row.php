<?php
class Model_Salesman_Row extends Model_Core_Table_Row
{
	function __construct()
	{
		parent::__construct();
		$this->setTableClass('Model_Salesman');
	}

	public function getStatus()
	{
		if ($this->status) {
			return $this->status;
		}

		return Model_Salesman::STATUS_DEFAULT;
	}

	public function getStatusText($status)
	{
		$statuses = $this->getTable()->getStatusOptions();
		if (array_key_exists($this->status, $statuses)) {
			return $statuses[$this->status];
		}

		return $statuses[Model_Salesman::STATUS_DEFAULT];
	}
}