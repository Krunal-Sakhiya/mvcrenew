<?php
class Block_Category_Grid extends Block_Core_Grid
{
	function __construct()
	{
		parent::__construct();
		$this->prePareColumns();
		$this->prePareActions();
		$this->prePareButtons();
		$this->setTitle('Manage Category');
	}

	public function getCollection()
	{
		$query = "SELECT count(`category_id`) FROM `category` ORDER BY `category_id` DESC";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

        $this->getPager()->setTotalRecord($totalRecord)->calculate();
        
		$query = "SELECT * FROM `category` ORDER BY `category_id` DESC LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getRecordPerPage()}";
		$categorys = Ccc::getModel('Category')->fetchAll($query);
		return $categorys;
	}

	protected function prePareColumns()
	{
		$this->addColumn('category_id', [
			'title' => 'Category Id'
		]);

		$this->addColumn('name', [
			'title' => 'Name'
		]);

		$this->addColumn('description', [
			'title' => 'Description'
		]);

		$this->addColumn('status', [
			'title' => 'Status'
		]);

		$this->addColumn('create_at', [
			'title' => 'Create At'
		]);

		$this->addColumn('update_at', [
			'title' => 'Update At'
		]);
	}

	protected function prePareActions()
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
		$this->addButton('category_id', [
			'title' => 'Add Category',
			'url' => $this->getUrl('add', 'category')
		]);

	}
}