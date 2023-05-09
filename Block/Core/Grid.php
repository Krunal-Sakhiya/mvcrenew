<?php
class Block_Core_Grid extends Block_Core_Template
{
    protected $title = null;
    protected $pager = null;
    protected $_buttons = [];
    protected $_columns = [];
    protected $_actions = [];

    public function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/grid.phtml');
        $this->_prePareColumns();
        $this->_prePareActions();
        $this->_prePareButtons();
        $this->setTitle('Manage Grid');
	}

    public function setColumns(array $columns)
	{
		$this->_columns = $columns;
		return $this;
	}

	public function getColumns()
	{
		return $this->_columns;
	}

	public function addColumn($key, $value)
	{
		$this->_columns[$key] = $value;
		return $this;
	}

	public function removeColumn($key = null)
	{
        unset($this->_columns[$key]);
	}

    public function getColumn($key)
    {
        if(array_key_exists($key, $this->_columns))
        {
            return $this->_columns[$key];    
        }

        return null;
    }

    public function _prePareColumns()
    {
        return $this;
    }

    public function setActions(array $actions)
	{
		$this->_actions = $actions;
		return $this;
	}

	public function getActions()
	{
		return $this->_actions;
	}

	public function addAction($key, $value)
	{
		$this->_actions[$key] = $value;
		return $this;
	}

	public function removeAction($key = null)
	{
        unset($this->_actions[$key]);
	}

    public function getAction($key)
    {
        if(array_key_exists($key, $this->_actions))
        {
            return $this->_actions[$key];    
        }

        return null;
    }

    public function _prePareActions()
    {
        return $this;
    }

    public function getEditUrl($row, $key, $primaryKey)
    {
        return $this->getUrl($key, null, [$primaryKey => $row->getId()]);
    }

    public function getDeleteUrl($row, $key, $primaryKey)
    {
        return $this->getUrl($key, null, [$primaryKey => $row->getId()]);
    }

    public function getColumnValue($row, $key)
    {
        if ($key == 'status') {
            return $row->getStatusText($key);   
        }
        if ($key == 'path') {
            return $row->getPathCategories($row->getId());
        }
        return $row->$key;
    }

    public function setButtons(array $buttons)
	{
		$this->_buttons = $buttons;
		return $this;
	}

	public function getButtons()
	{
		return $this->_buttons;
	}

	public function addButton($key, $value)
	{
		$this->_buttons[$key] = $value;
		return $this;
	}

	public function removeButton($key = null)
	{
        unset($this->_buttons[$key]);
	}

    public function getButton($key)
    {
        if(array_key_exists($key, $this->actions))
        {
            return $this->_buttons[$key];    
        }

        return null;
    }

    public function _prePareButtons()
    {
        return $this;
    }

    public function setTitle($title)
	{
		$this->title = $title;
		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}

    public function getPager()
    {
        if ($this->pager) {
        	return $this->pager;
        }

        $pager = new Model_Core_Pager();
        $this->setPager($pager);
        return $pager;
    }

    public function setPager($pager)
    {
        $this->pager = $pager;
        return $this;
    }
}