<?php 
class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `salesman` ORDER BY `salesman_id` DESC";
			$salesmans = Ccc::getModel('Salesman_Row')->fetchAll($query);

			$this->getView()->setTemplate('salesman/grid.phtml')->setData(['salesmans' => $salesmans]);
			$this->render();

		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$this->getView()->setTemplate('salesman/add.phtml');
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("Invalid ID.", 1);
			}

			$salesman = Ccc::getModel('Salesman_Row')->load($id);
			$address = Ccc::getModel('Salesman_Address_Row')->load($id);

			$this->getView()->setTemplate('salesman/edit.phtml')->setData(['salesman' => $salesman, 'address' => $address]);
			$this->render();
		} catch (Exception $e) {
			
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
				$salesman = Ccc::getModel('Salesman_Row')->load($id);
				if (!$salesman) {
					throw new Exception("Salesman Data not Found.", 1);
				}
				$salesman->update_at = date('Y-m-d h:i:s');
					
			} else {
				$salesman = Ccc::getModel('Salesman_Row');
				$salesman->create_at = date('Y-m-d h:i:s');
			}

			$salesman->setData($postData['salesman']);
			$result = $salesman->save();
			if (!$result) {
				throw new Exception("Salesman Data Not Saved Successfully.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				$address = Ccc::getModel('Salesman_Address_Row')->load($id);
				if (!$address) {
					throw new Exception("Salesman Address Data Not Found.", 1);
				}
					
			} else {
				$address = Ccc::getModel('Salesman_Address_Row');
				$address->salesman_id = $result->salesman_id;
			}

			$address->setData($postData['address']);
			if (!$address->save()) {
				throw new Exception("Salesman Data Not Saved Successfully.", 1);
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'salesman', null, true);
	}

	public function deleteAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("ID Not Found.", 1);
			}

			$salesman = Ccc::getModel('Salesman_Row')->load($id);
			$result = $salesman->delete();
			if (!$result) {
				throw new Exception("Salesman Data Not Deleted.", 1);
			}

			$address = Ccc::getModel('Salesman_Address_Row')->load($id);
			$result = $address->delete();
			if (!$result) {
				throw new Exception("Salesman Address Data Not Deleted.", 1);
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'salesman', null, true);
	}
}