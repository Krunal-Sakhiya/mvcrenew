<?php
class Controller_Eav_Attribute extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Core_Eav_Attribute_Grid');
			$layout->getChild('content')->addChild('grid', $grid);
			echo $layout->toHtml(); 

		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$attribute = Ccc::getModel('Core_Eav_Attribute');
			$add = $layout->createBlock('Core_Eav_Attribute_Edit')->setData(['attribute' => $attribute]);
			$layout->getChild('content')->addChild('add', $add);
			echo $layout->toHtml();

		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}

	public function editAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("Invalid ID.", 1);
			}

			$attribute = Ccc::getModel('Core_Eav_Attribute')->load($id);
			if (!$attribute) {
				throw new Exception("Data not Posted.", 1);
			}

			$layout = $this->getLayout();
			$add = $layout->createBlock('Core_Eav_Attribute_Edit')->setData(['attribute' => $attribute]);
			$layout->getChild('content')->addChild('add', $add);
			echo $layout->toHtml();
			
		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}


	public function saveAction()
	{		
		try {
			echo "<pre>";
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Request.", 1);
			}

			$postData = $this->getRequest()->getPost();
			// print_r($postData);


			if ($id = $this->getRequest()->getParam('id')) {
				$attribute = Ccc::getModel('Core_Eav_Attribute')->load($id);
			} else {
				$attribute = Ccc::getModel('Core_Eav_Attribute');
			}

			$attribute->setData($postData['attribute']);
			if (!$attribute->save()) {
				throw new Exception("Attribute Data Not Saved Successfully.", 1);
			} else {
				$attributeId = $attribute->attribute_id;
				$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = '{$attributeId}'";
				$attributeOption = Ccc::getModel('Core_Eav_Attribute_Option')->fetchAll($query);

				if ($attributeOption) {
					foreach ($attributeOption->getData() as $row) {
						if (!array_key_exists($row->option_id, $postData['option']['exist']['name'])) {
							$row->setData(['option_id' => $row->option_id]);
							if (!$row->delete()) {
								throw new Exception("Option Data not Deleted. ", 1);
							}
						}
					}
				}
			
				if (array_key_exists('option', $postData)) {
					if (array_key_exists('new', $postData['option'])) {
						$position = $postData['option']['new']['position'];
						foreach ($postData['option']['new']['name'] as $id => $name) {
							$option['name'] = $name;
							$option['position'] = $position[$id];
							$option['attribute_id'] = $attributeId;

							$attributeOption = Ccc::getModel('Core_Eav_Attribute_Option');
							$attributeOption->setData($option);
							$attributeOption->save();
						}
					}

					if (array_key_exists('exist', $postData['option'])) {
						foreach ($postData['option']['exist']['name'] as $optionId => $name) {
							$option['name'] = $name;
							$option['attribute_id'] = $attributeId;
							$option['option_id'] = $optionId;

							$attributeOption = Ccc::getModel('Core_Eav_Attribute_Option');
							$attributeOption->setData($option);
							$attributeOption->save();
							unset($option);
						}

						foreach ($postData['option']['exist']['position'] as $optionId => $position) {
							$option['position'] = $position;
							$option['attribute_id'] = $attributeId;
							$option['option_id'] = $optionId;

							$attributeOption = Ccc::getModel('Core_Eav_Attribute_Option');
							$attributeOption->setData($option);
							$attributeOption->save();
							unset($option);
						}
					}
				}
			}

			$this->getView()->getMessage()->addMessages("Attribute Data Saved Successfully.");

		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
			
		$this->redirect('grid', 'eav_attribute', null, true);
	}

	public function deleteAction()
	{
		try {
			$attributeId = $this->getRequest()->getParam('id');
			if (!$attributeId) {
				throw new Exception("ID not found.", 1);
			}

			$attribute = Ccc::getModel('Core_Eav_Attribute'); 
			$result = $attribute->load($attributeId)->delete();
			if (!$result) {
				throw new Exception("Attribute data not deleted successfully.", 1);
			}
			$this->getView()->getMessage()->addMessages('Attribute data deleted Successfully.');
			
		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect('grid', 'eav_attribute', null, true);
	}
}