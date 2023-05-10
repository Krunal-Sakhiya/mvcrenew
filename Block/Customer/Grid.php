<?php
class Block_Customer_Grid extends Block_Core_Grid
{
	function __construct()
	{
		parent::__construct();
		$this->prePareColumns();
		$this->prePareActions();
		$this->prePareButtons();
		$this->setTitle('Manage Customer');
	}

	public function getCollection()
	{
		$query = "SELECT count(`customer_id`) FROM `customer` ORDER BY `customer_id` ASC";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

        $this->getPager()->setTotalRecord($totalRecord)->calculate();
        
		$query = "SELECT * FROM `customer` ORDER BY `customer_id` DESC LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getRecordPerPage()}";
		$customers = Ccc::getModel('Customer')->fetchAll($query);
		return $customers;
	}

	public function prePareColumns()
	{
		$this->addColumn('customer_id', [
			'title' => 'Customer Id'
		]);

		$this->addColumn('first_name', [
			'title' => 'First Name'
		]);

		$this->addColumn('last_name', [
			'title' => 'Last Name'
		]);

		$this->addColumn('email', [
			'title' => 'Email'
		]);

		$this->addColumn('gender', [
			'title' => 'Gender'
		]);

		$this->addColumn('mobile', [
			'title' => 'Mobile'
		]);

		$this->addColumn('status', [
			'title' => 'Status'
		]);

		$this->addColumn('company', [
			'title' => 'Company'
		]);

		$this->addColumn('create_at', [
			'title' => 'Create At'
		]);

		$this->addColumn('update_at', [
			'title' => 'Update At'
		]);
	}

	public function prePareActions()
	{
		$this->addAction('edit', [
			'title' => 'Edit',
			'method' => 'getEditUrl',
			'primaryKey' => 'id'
		]);

		$this->addAction('delete', [
			'title' => 'Delete',
			'method' => 'getDeleteUrl',
			'primaryKey' => 'id'
		]);
	}

	public function prePareButtons()
	{
		$this->addButton('customer_id', [
			'title' => 'Add Customer',
			'url' => $this->getUrl('add', 'customer')
		]);	
	}
}