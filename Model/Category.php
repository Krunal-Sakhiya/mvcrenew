<?php
class Model_Category extends Model_Core_Table
{
	const STATUS_ACTIVE = 1;
	const STATUS_ACTIVE_LBL = 'Active';
	const STATUS_INACTIVE = 2;
	const STATUS_INACTIVE_LBL = 'Inactive';
	const STATUS_DEFAULT = 1;

	function __construct()
	{
		parent::__construct();
		$this->setTableName('category')->setPrimarykey('category_id');
	}

	public function getStatusOptions()
	{
		return [
			self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
			self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL,
		];
	}

	public function getParentCategories()
	{
		$query = "SELECT `category_id`, `path` FROM `category`;";
		$categories = $this->getResource()->getAdapter()->fetchPairs($query);
		return $categories;
	}

	public function prePathCategories()
	{
		$category = Ccc::getModel('Category');
		$query = "SELECT `category_id`, `name` FROM `{$category->getResource()->getResourceName()}` ORDER BY `path` ASC";
		$categories = $category->getResource()->getAdapter()->fetchPairs($query);

		$sql = "SELECT `category_id`, `path` FROM `{$category->getResource()->getResourceName()}` ORDER BY `path` ASC";
		$pathCategory = $category->getResource()->getAdapter()->fetchPairs($sql);

		foreach ($pathCategory as $category_id => $path) {
			$string = explode('=', $path);
			$final = [];
			foreach ($string as $key => $category_id) {
				$final[] = $categories[$category_id];
			}
			$categoriesName[$category_id] = implode('>', $final);
		}
		return $categoriesName;
	}

	public function getPathCategories($category_id)
	{
		return $this->prePathCategories()[$category_id];
	}

	public function updatePath()
	{
		if (!$this->getId()) {
			return false;
		}

		$oldPath = $this->path;

		$parent = Ccc::getModel('Category')->load($this->parent_id);
		if (!$parent) {
			$this->path = $this->getId();
		}
		else{
			$this->path = $parent->path.'='.$this->getId();
		}

		$this->save();
		
		$query = "UPDATE `category`
		SET `path` = REPLACE(`path`, '{$oldPath}=', '{$this->path}=')
		WHERE `path` LIKE '{$oldPath}=%' ORDER BY `path` ASC ";
		$this->getResource()->getAdapter()->update($query);

		return $this;
	}
}