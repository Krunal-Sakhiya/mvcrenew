<?php
class Block_Product_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/grid.phtml');
	}

	public function getCollection()
	{
		$query = "SELECT * FROM `product` ORDER BY `product_id` ASC";
		$products = Ccc::getModel('Product')->fetchAll($query);
		return $products;
	}
}