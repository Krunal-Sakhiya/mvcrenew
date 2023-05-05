<?php
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `customer` ORDER BY `customer_id` DESC";
			$customers = Ccc::getModel('Customer_Row')->fetchAll($query);

			$this->getView()->setTemplate('customer/grid.phtml')->setData(['customers' => $customers]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$this->getView()->setTemplate('customer/add.phtml');
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$id = (int) $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("Invalid ID", 1);
			}

			$customer = Ccc::getModel('Customer_Row')->load($id);
			$billingAddress = $customer->getBillingAddress();
			$shippingAddress = $customer->getShippingAddress();
			
			// $bId = $customer->billing_address_id;
			// $sId = $customer->shipping_address_id;
			// $billingAddress = Ccc::getModel('Customer_Row')->getBillingAddress($bId);
			// $shippingAddress = Ccc::getModel('Customer_Row')->getShippingAddress($sId);

			$this->getView()->setTemplate('customer/edit.phtml')->setData(['customer' => $customer, 'billingAddress' => $billingAddress, 'shippingAddress' => $shippingAddress]);
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

			$customer = $this->saveCustomer();
			$billingAddress = $this->saveBillingAddress($customer);
			$shippingAddress = $this->saveShippingAddress($customer);
			$customer->billing_address_id = $billingAddress->address_id;
			$customer->shipping_address_id = $shippingAddress->address_id;

			if (!$customer->save()) {
				throw new Exception("Customer data not saved.", 1);
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'customer', null, true);
	}

	public function saveCustomer()
	{
		$customerPost = $this->getRequest()->getPost('customer');
		if (!$customerPost) {
			throw new Exception("Data not found.", 1);
		}

		if ($id = (int) $this->getRequest()->getParam('id')) {
			$customer = Ccc::getModel('Customer_Row')->load($id);
			if (!$customer) {
				throw new Exception("Data not found.", 1);
			}
			$customer->update_at = date('Y-m-d h:i:s');
			
		} else {
			$customer = Ccc::getModel('Customer_Row');
			$customer->create_at = date('Y-m-d h-i-s');
		}

		$customer->setData($customerPost);
		if (!$customer->save()) {
			throw new Exception("Customer data not saved Succesfully.", 1);
		} else {
			return $customer;
		}
	}

	public function saveBillingAddress($customer)
	{
		$billingData = $this->getRequest()->getPost('billingAddress');
		if (!$billingData) {
			throw new Exception("Data not found.", 1);
		}

		$bId = $customer->billing_address_id;

		$billingAddress = $customer->getBillingAddress($bId);
		if (!$billingAddress) {
			$billingAddress = Ccc::getModel('Customer_Address_Row');
			$billingAddress->customer_id = $customer->customer_id;
		}

		$billingAddress->setData($billingData);
		if (!$billingAddress->save()) {
			throw new Exception("Billing Address Data not saved.", 1);
		} else {
			return $billingAddress;
		}
	}

	public function saveShippingAddress($customer)
	{
		$shippingData = $this->getRequest()->getPost('shippingAddress');
		if (!$shippingData) {
			throw new Exception("Data not found.", 1);
		}
		
		$sId = $customer->shipping_address_id;

		$shippingAddress = $customer->getShippingAddress($sId);
		if (!$shippingAddress) {
			$shippingAddress = Ccc::getModel('Customer_Address_Row');
			$shippingAddress->customer_id = $customer->customer_id;
		} 

		$shippingAddress->setData($shippingData);
		if (!$shippingAddress->save()) {
			throw new Exception("Shipping Address Data not saved.", 1);
		} else {
			return $shippingAddress;
		}
	}

	public function deleteAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("ID Not Found.", 1);
			}

			$customer = Ccc::getModel('Customer_Row')->load($id);
			if (!$customer->delete()) {
				throw new Exception("Customer data not deleted.", 1);
			}

			$bId = $customer->billing_address_id;
			$billingAddress = Ccc::getModel('Customer_Address_Row')->load($bId);
			if (!$billingAddress->delete()) {
				throw new Exception("Billing Address Data not deleted.", 1);
			}

			$sId = $customer->shipping_address_id;
			$shippingAddress = Ccc::getModel('Customer_Address_Row')->load($sId);
			if (!$shippingAddress->delete()) {
				throw new Exception("Shipping Address Data not deleted.", 1);
			}
				
		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'customer', null, true);
	}
}