<?php
class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		$query = "SELECT * FROM `product` ORDER BY `product_id` DESC";
		$adapter = new Model_Core_Adapter();
		$products = $adapter->fetchAll($query);

		require_once 'view/product/grid.phtml';	
	}

	public function addAction()
	{
		require_once 'view/product/add.phtml';
	}

	public function editAction()
	{
		$request = new Model_Core_Request();
		$id = $request->getParam('id');

		$query = "SELECT * FROM `product` WHERE `product_id` = '{$id}' ";
		$adapter = new Model_Core_Adapter();
		$product = $adapter->fetchRow($query);
		require_once 'view/product/edit.phtml';
	}

	public function insertAction()
	{
		$request = new Model_Core_Request();
		$postData = $request->getPost();
		$postData['create_at'] = date('Y-m-d h:i:s');

		$query = "INSERT INTO `product`(`name`, `cost`, `price`, `sku`, `status`, `quantity`, `description`, `color`, `material`, `create_at`) VALUES ('$postData[name]','$postData[cost]','$postData[price]','$postData[sku]','$postData[status]','$postData[quantity]','$postData[description]','$postData[color]','$postData[material]', '$postData[create_at]')";

		$adapter = new Model_Core_Adapter();
		$result = $adapter->insert($query);

		header("location:index.php?c=product&a=grid");
	}

	public function updateAction()
	{
		$request = new Model_Core_Request();
		$id = $request->getParam('id');
		$postData = $request->getPost();
		$postData['update_at'] = date('Y-m-d h:i:s');

		$query = "UPDATE `product` SET 
							`name`='$postData[name]',
							`cost`='$postData[cost]',
							`price`='$postData[price]',
							`sku`='$postData[sku]',
							`status`='$postData[status]',
							`quantity`='$postData[quantity]',
							`description`='$postData[description]',
							`color`='$postData[color]',
							`material`='$postData[material]',
							`update_at`='$postData[update_at]'
							WHERE `product_id` = '{$id}'";
		$adapter = $this->getAdapter();
		$adapter->update($query);
		header("location:index.php?c=product&a=grid");
	}

	public function deleteAction()
	{
		$request = $this->getRequest();
		$id = $request->getParam('id');
		$query = "DELETE FROM `product` WHERE `product_id` = {$id}";
		$adapter = $this->getAdapter();
		$adapter->update($query);
		header("location:index.php?c=product&a=grid");
	}
}