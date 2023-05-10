<?php
class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Vendor_Grid');
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
			$vendor = Ccc::getModel('Vendor');
			$address = Ccc::getModel('Vendor_Address');

			$add = $layout->createBlock('Vendor_Edit')->setData(['vendor' => $vendor, 'address' => $address]);
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

			$vendor = Ccc::getModel('Vendor')->load($id);
			if (!$vendor) {
				throw new Exception("Data not Posted.", 1);
			}

			$address = Ccc::getModel('Vendor_Address')->load($id);
			if (!$address) {
				throw new Exception("Data not Posted.", 1);
			}

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Vendor_Edit')->setData(['vendor' => $vendor, 'address' => $address]);
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
				throw new Exception("Invalid Request.", 1);
			}

			$postData = $this->getRequest()->getPost('vendor');
			if (!$postData) {
				throw new Exception("Invalid Data Posted.", 1);
			}

			if ($id = (int)$this->getRequest()->getParam('id')) {
				$vendor = Ccc::getModel('Vendor')->load($id);
				if (!$vendor) {
					throw new Exception("Invalid ID.", 1);
				}
				$vendor->update_at = date("Y-m-d H:i:s");
			} else{
				$vendor = Ccc::getModel('Vendor');
				$vendor->create_at = date("Y-m-d H:i:s");
			}

			$vendor->setData($postData);
			if (!$vendor->save()) {
				throw new Exception("Unable to Save Vendor.", 1);
			}

			$postDataAddress = $this->getRequest()->getPost('address');
			if (!$postDataAddress) {
				throw new Exception("Invalid Data Posted.", 1);
			}

			if ($id = (int)$this->getRequest()->getParam('id')) {
				$vendorAddress = Ccc::getModel('Vendor_Address')->load($id);
				if (!$vendorAddress) {
					throw new Exception("Invalid ID.", 1);
				}
			} else{
				$vendorAddress = Ccc::getModel('Vendor_Address');
				$vendorAddress->vendor_id = $vendor->vendor_id;
			}

			$vendorAddress->setData($postDataAddress);
			if (!$vendorAddress->save()) {
				throw new Exception("Unable to Save Vendor.", 1);
			}

			$this->getView()->getMessage()->addMessages("Vendor Data Saved Succesfully.");
		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect('grid','vendor',null,true);
	}

	public function deleteAction()
	{
		try {
			$id = (int) $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("Error Processing Request", 1);
			}

			$vendor = Ccc::getModel('Vendor')->load($id);
			if (!$vendor) {
				throw new Exception("Error Processing Request", 1);
			}
			if (!$vendor->delete()) {
				throw new Exception("Vendor Data Not Deleted Succesfully", 1);
			}

			$this->getView()->getMessage()->addMessages("Vendor Data Deleted Succesfully.");

		} catch (Exception $e) {
			$this->getView()->getMessage()->addMessages($e->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect('grid', 'vendor', null, true);
	}
}