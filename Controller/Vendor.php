<?php
class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `vendor` ORDER BY `vendor_id` DESC";
			$vendors = Ccc::getModel('Vendor_Row')->fetchAll($query);

			$this->getView()->setTemplate('vendor/grid.phtml')->setData(['vendors' => $vendors]);
			$this->render();
			
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$this->getView()->setTemplate('vendor/add.phtml');
			$this->render();
			
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$vendorId = $this->getRequest()->getParam('id');

			$vendor = Ccc::getModel('Vendor_Row')->load($vendorId);
			$address = Ccc::getModel('Vendor_Address_Row')->load($vendorId);

			$this->getView()->setTemplate('vendor/edit.phtml')->setData(['vendor' => $vendor, 'address' => $address]);
			$this->render();
			
		} catch (Exception $e) {
			
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
				$vendor = Ccc::getModel('Vendor_Row')->load($id);
				if (!$vendor) {
					throw new Exception("Invalid ID.", 1);
				}
				$vendor->update_at = date("Y-m-d H:i:s");
			} else{
				$vendor = Ccc::getModel('Vendor_Row');
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
				$vendorAddress = Ccc::getModel('Vendor_Address_Row')->load($id);
				if (!$vendorAddress) {
					throw new Exception("Invalid ID.", 1);
				}
			} else{
				$vendorAddress = Ccc::getModel('Vendor_Address_Row');
				$vendorAddress->vendor_id = $vendor->vendor_id;
			}

			$vendorAddress->setData($postDataAddress);
			if (!$vendorAddress->save()) {
				throw new Exception("Unable to Save Vendor.", 1);
			}
		} catch (Exception $e) {
			
		}
		$this->redirect('grid','vendor',null,true);
	}

	public function deleteAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("Invalid ID.", 1);
			}

			$vendor = Ccc::getModel('Vendor_Row')->load($id);
			$result = $vendor->delete();
			if (!$result) {
				throw new Exception("Vendor Data Not Deleted.", 1);
			}

			$address = Ccc::getModel("Vendor_Address_Row")->load($id);
			$result = $address->delete();
			if (!$result) {
				throw new Exception("Vendor Address Data Not Deleted.", 1);
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'vendor', null, true);
	}
}