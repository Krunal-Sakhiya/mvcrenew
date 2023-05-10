<?php 
class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Salesman_Grid');
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
			$salesman = Ccc::getModel('Salesman');
			$address = Ccc::getModel('Salesman_Address');

			$add = $layout->createBlock('Salesman_Edit')->setData(['salesman' => $salesman, 'address' => $address]);
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

			$salesman = Ccc::getModel('Salesman')->load($id);
			if (!$salesman) {
				throw new Exception("Data not Posted.", 1);
			}

			$address = Ccc::getModel('Salesman_Address')->load($id);
			if (!$address) {
				throw new Exception("Data not Posted.", 1);
			}

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Salesman_Edit')->setData(['salesman' => $salesman, 'address' => $address]);
			$layout->getChild('content')->addChild('edit', $edit);
			echo $layout->toHtml();
			
		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}

	public function saveAction()
	{
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Request", 1);
			}

			$postData = $this->getRequest()->getPost();
			if (!$postData) {
				throw new Exception("Data not Found.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				$salesman = Ccc::getModel('Salesman')->load($id);
				if (!$salesman) {
					throw new Exception("Salesman Data not Found.", 1);
				}
				$salesman->update_at = date('Y-m-d h:i:s');
					
			} else {
				$salesman = Ccc::getModel('Salesman');
				$salesman->create_at = date('Y-m-d h:i:s');
			}

			$salesman->setData($postData['salesman']);
			$result = $salesman->save();
			if (!$result) {
				throw new Exception("Salesman Data Not Saved Successfully.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				$address = Ccc::getModel('Salesman_Address')->load($id);
				if (!$address) {
					throw new Exception("Salesman Address Data Not Found.", 1);
				}
					
			} else {
				$address = Ccc::getModel('Salesman_Address');
				$address->salesman_id = $result->salesman_id;
			}

			$address->setData($postData['address']);
			if (!$address->save()) {
				throw new Exception("Salesman Address Data Not Saved Successfully.", 1);
			}
			$this->getView()->getMessage()->addMessages("Salesman Data Saved Successfully.");

		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect('grid', 'salesman', null, true);
	}

	public function deleteAction()
	{
		try {
			$id = (int) $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("Invalid ID.", 1);
			}

			$salesman = Ccc::getModel('Salesman')->load($id);
			if (!$salesman->delete()) {
				throw new Exception("Salesman Data Not Deleted Succesfully", 1);
			}
			
			$this->getView()->getMessage()->addMessages("Salesman Data Deleted Succesfully.");

		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect('grid', 'salesman', null, true);
	}
}