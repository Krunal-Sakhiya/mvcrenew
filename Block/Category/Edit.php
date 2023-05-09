<?php
class Block_Category_Edit extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('category/edit.phtml');
	}

	public function getRow()
	{
		$row = $this->getData('category');
		return $row;
	}
}