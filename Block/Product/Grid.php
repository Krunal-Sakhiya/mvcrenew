<?php
class Block_Product_Grid extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('product/grid.phtml');
	}
}