<?php
class Block_Core_Eav_Attribute_Grid extends Block_Core_Grid
{
	function __construct()
	{
		parent::__construct();
		$this->prePareColumns();
		$this->prePareActions();
		$this->prePareButtons();
		$this->setTitle('Manage Eav Attribute');
	}

	public function getCollection()
	{
		$query = "SELECT count(`attribute_id`) FROM `eav_attribute` ORDER BY `attribute_id` DESC";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($query);

        $this->getPager()->setTotalRecord($totalRecord)->calculate();

		$query = "SELECT EA.* , ET.type_name 
					FROM `eav_attribute` EA 
					LEFT JOIN `entity_type` ET 
					ON EA.entity_type_id=ET.entity_type_id 
					LIMIT {$this->getPager()->getStartLimit()}, {$this->getPager()->getRecordPerPage()}";
		$attributes = Ccc::getModel('Core_Eav_Attribute')->fetchAll($query);
		return $attributes;
	}

	public function prePareColumns()
	{
		$this->addColumn('attribute_id', [
			'title' => 'Attribute Id'
		]);

		$this->addColumn('type_name', [
			'title' => 'Type Name'
		]);

		$this->addColumn('code', [
			'title' => 'Code'
		]);

		$this->addColumn('backend_type', [
			'title' => 'Backend Type'
		]);

		$this->addColumn('input_type', [
			'title' => 'Input Type'
		]);

		$this->addColumn('name', [
			'title' => 'Name'
		]);

		$this->addColumn('status', [
			'title' => 'Status'
		]);

		$this->addColumn('backend_model', [
			'title' => 'Backend Model'
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
		$this->addButton('attribute_id', [
			'title' => 'Add Attribute',
			'url' => $this->getUrl('add', 'eav_attribute')
		]);
	}
}