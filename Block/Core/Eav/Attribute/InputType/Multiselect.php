<?php
class Block_Core_Eav_Attribute_InputType_Multiselect extends Block_Core_Template
{
	protected $attribute = null;
	protected $row = null;

	function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/eav/attribute/inputtype/multiselect.phtml');
	}

	public function getAttribute()
    {
        return $this->attribute;
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function setRow($row)
    {
        $this->row = $row;
        return $this;
    }
}