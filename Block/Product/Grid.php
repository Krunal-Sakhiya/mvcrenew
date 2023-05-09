<?php
class Block_Product_Grid extends Block_Core_Grid
{
	protected $title = null;

	function __construct()
	{
		parent::__construct();
		$this->prePareColumns();
		$this->prePareActions();
		$this->prePareButtons();
		$this->setTitle('Manage Product');
	}

	public function getCollection()
	{
		$query = "SELECT * FROM `product` ORDER BY `product_id` ASC";
		$products = Ccc::getModel('Product')->fetchAll($query);
		return $products;
	}

	protected function prePareColumns()
	{
		$this->addColumn('product_id', [
			'title' => 'Product Id'
		]);

		$this->addColumn('name', [
			'title' => 'Name'
		]);

		$this->addColumn('sku', [
			'title' => 'SKU'
		]);

		$this->addColumn('cost', [
			'title' => 'Cost'
		]);

		$this->addColumn('price', [
			'title' => 'Price'
		]);

		$this->addColumn('quantity', [
			'title' => 'Quantity'
		]);

		$this->addColumn('description', [
			'title' => 'Description'
		]);

		$this->addColumn('status', [
			'title' => 'Status'
		]);

		$this->addColumn('color', [
			'title' => 'Color'
		]);

		$this->addColumn('material', [
			'title' => 'Material'
		]);

		$this->addColumn('small_id', [
			'title' => 'Small Id'
		]);

		$this->addColumn('thumbnail_id', [
			'title' => 'Thumbnail Id'
		]);

		$this->addColumn('base_id', [
			'title' => 'Base ID'
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
		$this->addAction('media', [
			'title' => 'Media',
			'method' => 'getMediaUrl',
			'primaryKey' => 'product_id'
		]);

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

	public function getMediaUrl($row, $key)
	{
        return $this->getUrl('grid', 'product_media', ['id' => $row->getId()]);
	}

	public function prePareButtons()
	{
		$this->addButton('product_id', [
			'title' => 'Add Product',
			'url' => $this->getUrl('add', 'product')
		]);

	}
}