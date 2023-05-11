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
		$category = $this->getData('category');

		$parentCategories = Ccc::getModel('Category')->getParentCategories();
		foreach ($parentCategories as $category_id => $path) {
			if ($category->path) {
				if (str_contains($path, $category->path)) {
					unset($parentCategories[$category_id]);					
				}
			}
		}

		$final = [$category, $parentCategories];
		return $final;
	}
}