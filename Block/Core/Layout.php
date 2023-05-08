<?php
class Block_Core_Layout extends Block_Core_Template
{
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/layout/3columns.phtml');
		$this->prePareChildren();	
	}

	public function prePareChildren()
	{
		$head = $this->createBlock('Html_Head');
		$this->addChild('head', $head);

		$header = $this->createBlock('Html_Header');
		$this->addChild('header', $header);

		$footer = $this->createBlock('Html_Footer');
		$this->addChild('footer', $footer);

		$content = $this->createBlock('Html_Content');
		$this->addChild('content', $content);

		$left = $this->createBlock('Html_Left');
		$this->addChild('left', $left);

		$right = $this->createBlock('Html_Right');
		$this->addChild('right', $right);
		
	}

	public function createBlock($block)
	{
		$blockClassName = 'Block_'.$block;
		$block = new $blockClassName;
		$block->setLayout($this);
		return $block;
	}
}