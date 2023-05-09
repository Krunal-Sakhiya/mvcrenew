<?php
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Customer_Grid');
			$layout->getChild('content')->addChild('grid', $grid);
			echo $layout->toHtml();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$customer = Ccc::getModel('Customer');
			$billingAddress = Ccc::getModel('Customer_Address');
			$shippingAddress = Ccc::getModel('Customer_Address');

			$add = $layout->createBlock('Customer_Edit')->setData(['customer' => $customer, 'billingAddress' => $billingAddress, 'shippingAddress' => $shippingAddress]);
			$layout->getChild('content')->addChild('add', $add);
			echo $layout->toHtml();

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
			$layout = $this->getLayout();
			$customer = Ccc::getModel('Customer')->load($id);
			$billingAddress = $customer->getBillingAddress();
			$shippingAddress = $customer->getShippingAddress();

			$edit = $layout->createBlock('Customer_Edit')->setData(['customer' => $customer, 'billingAddress' => $billingAddress, 'shippingAddress' => $shippingAddress]);
			$layout->getChild('content')->addChild('edit', $edit);
			echo $layout->toHtml();

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
			$customer = Ccc::getModel('Customer')->load($id);
			if (!$customer) {
				throw new Exception("Data not found.", 1);
			}
			$customer->update_at = date('Y-m-d h:i:s');
			
		} else {
			$customer = Ccc::getModel('Customer');
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
			$billingAddress = Ccc::getModel('Customer_Address');
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
			$shippingAddress = Ccc::getModel('Customer_Address');
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

			$customer = Ccc::getModel('Customer')->load($id);
			if (!$customer->delete()) {
				throw new Exception("Customer data not deleted.", 1);
			}

			$bId = $customer->billing_address_id;
			$billingAddress = Ccc::getModel('Customer_Address')->load($bId);
			if (!$billingAddress->delete()) {
				throw new Exception("Billing Address Data not deleted.", 1);
			}

			$sId = $customer->shipping_address_id;
			$shippingAddress = Ccc::getModel('Customer_Address')->load($sId);
			if (!$shippingAddress->delete()) {
				throw new Exception("Shipping Address Data not deleted.", 1);
			}
				
		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'customer', null, true);
	}
}