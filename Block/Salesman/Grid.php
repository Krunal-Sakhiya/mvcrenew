<?php
class Block_Salesman_Grid extends Block_Core_Grid
{
	function __construct()
	{
		parent::__construct();
		$this->prePareColumns();
		$this->prePareActions();
		$this->prePareButtons();
		$this->setTitle('Manage Salesman');
	}

	public function getCollection()
	{
		$query = "SELECT count(`salesman_id`) FROM `salesman` ORDER BY `salesman_id` DESC";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

        $this->getPager()->setTotalRecord($totalRecord)->calculate();
        
		$query = "SELECT * FROM `salesman` ORDER BY `salesman_id` DESC LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getRecordPerPage()}";
		$salesmans = Ccc::getModel('Salesman')->fetchAll($query);
		return $salesmans;
	}

	public function prePareColumns()
	{
		$this->addColumn('salesman_id', [
			'title' => 'Salesman Id'
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
		$this->addButton('salesman_id', [
			'title' => 'Add Salesman',
			'url' => $this->getUrl('add', 'salesman')
		]);	
	}
}