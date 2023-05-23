<?php
class Block_Core_Eav_Attribute_InputType extends Block_Core_Template
{
	protected $attribute = null;
	protected $row = null;

	function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/eav/attribute/inputtype.phtml');
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

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getInputTypeField()
    {
    	$attribute = $this->getAttribute();

    	if ($attribute->input_type == 'text') {
    		return $this->getLayout()
    				->createBlock('Core_Eav_Attribute_InputType_Text')
    				->setAttribute($attribute)
    				->setRow($this->getRow());

    	} elseif ($attribute->input_type == 'textArea') {
    		return $this->getLayout()
    				->createBlock('Core_Eav_Attribute_InputType_Textarea')
    				->setAttribute($attribute)
    				->setRow($this->getRow());

    	} elseif ($attribute->input_type == 'select') {
    		return $this->getLayout()
    				->createBlock('Core_Eav_Attribute_InputType_Select')
    				->setAttribute($attribute)
    				->setRow($this->getRow());

    	} elseif ($attribute->input_type == 'multiselect') {
    		return $this->getLayout()
    				->createBlock('Core_Eav_Attribute_InputType_Multiselect')
    				->setAttribute($attribute)
    				->setRow($this->getRow());

    	} else {
    		echo "Invalid Input Type.";
    	}
    }
}