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
		$query = "SELECT * FROM `eav_attribute` WHERE 1";
		$attributes = Ccc::getModel('Core_Eav_Attribute')->fetchAll($query);
		return $attributes;
	}

	public function prePareColumns()
	{
		$this->addColumn('attribute_id', [
			'title' => 'Attribute Id'
		]);

		$this->addColumn('entity_type_id', [
			'title' => 'Entity Type Id'
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
			'title' => 'delete',
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