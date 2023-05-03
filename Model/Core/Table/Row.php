<?php
class Model_Core_Table_Row
{
	protected $data = [];
	protected $table = null;
	protected $tableClass = 'Model_Core_Table';

	function __construct()
	{
		
	}

	public function setId($id)
	{
		$this->data[$this->getTable()->getPrinmaryKey()] = (int)$id;
		return $this;
	}

	public function getId()
	{
		$primaryKey = $this->getTable()->getPrimaryKey();
		return (int)$this->$primaryKey;
	}

	public function setTableClass($tableClass)
	{
		$this->tableClass = $tableClass;
		return $this;
	}

	public function getTableClass()
	{
		if ($this->tableClass) {
			return $this->tableClass;
		}

		$tableClass = new ($this->tableClass)();
		$this->setTableClass($tableClass);
		return $tableClass;
	}

	public function getTableName()
	{
		return $this->getTable()->getTableName();
	}

	public function getPrimaryKey()
	{
		return $this->getTable()->getPrimaryKey();
	}

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}

	public function getTable()
	{
		if ($this->table) {
			return $this->table;
		}

		$table = new ($this->tableClass)();
		$this->setTable($table);
		return $table;
	}

	public function __set($key,$value)
	{
		$this->data[$key] = $value;
	}

	public function __get($key)
	{
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
		return null;
	}

	public function setData(array $data)
	{
		$this->data = array_merge($this->data, $data) ;
		return $this;
	}

	public function getData($key=null)
	{
		if ($key == null) {
			return $this->data;
		}
		if (array_key_exists($key, $this->data)) {
			return $this->data[$key];
		}
		return null;
	}

	public function addData($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key=null)
	{
		if ($key == null) {
			$this->data = [];
		}
		if (array_key_exists($key,$this->data)) {
			unset($this->data[$key]);
		}
		return $this;
	}

	public function fetchAll($query)
	{
		$result = $this->getTable()->fetchAll($query);
		if (!$result) {
			return false;
		}

		foreach ($result as &$row) {
			$row = (new $this)->setData($row)->setTable($this->getTable());
		}
		return $result;
	}

	public function fetchRow($query)
	{
		$result = $this->getTable()->fetchRow($query);
		if ($result) {
			$this->data = $result;
			return $this;
		}
		return false;
	}

	public function delete()
	{
		$id = $this->getData($this->getPrimaryKey());
		if (!$id) {
			return false;
		}

		$condition[$this->getPrimaryKey()] = $id;
		$result = $this->getTable()->delete($condition);
		if ($result) {
			// $this->removeData();
			return true;
		}
		return false;
	}

	public function load($id,$column = null)
	{
		if (!$column) {
			$column = $this->getPrimaryKey();
		}
		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$column}` = {$id}";

		$result = $this->getTable()->fetchRow($query);
		if ($result) {
			$this->data = $result;
		}
		return $this;
	}

	public function save()
	{
		if (!array_key_exists($this->getPrimaryKey(), $this->data)) {
			$id = $this->getTable()->insert($this->data);
			if ($id) {
				$this->load($id);
				return $this;
			}
			return false;
		
		}else{
			$id = $this->getData($this->getPrimaryKey());
			$condition[$this->getPrimaryKey()] = $id;

			$result = $this->getTable()->update($this->data, $condition);
			if($result){
				$this->load($id);
				return true;
			}
			return false;		
		}
	}
}