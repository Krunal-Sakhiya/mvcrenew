<?php
class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `product` ORDER BY `product_id` DESC";
			$products = Ccc::getModel('Product_Row')->fetchAll($query);

			$this->getView()->setTemplate('product/grid.phtml')->setData(['products' => $products]);
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$this->getView()->setTemplate('product/add.phtml');
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

			$product = Ccc::getModel('Product_Row')->load($id);
			if (!$product) {
				throw new Exception("Data not Posted.", 1);
			}

			$this->getView()->setTemplate('product/edit.phtml')->setData(['product' => $product]);
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

			$postData = $this->getRequest()->getPost();
			if (!$postData) {
				throw new Exception("Data not Posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				$product = Ccc::getModel('Product_Row')->load($id);
				if (!$product) {
					throw new Exception("Data not Posted.", 1);
				}
				$product->update_at = date('Y-m-d h:i:s');

			} else {
				$product = Ccc::getModel('Product_Row');
				$product->create_at = date('Y-m-d h:i:s');
			}

			$product->setData($postData['product']);
			$result = $product->save();
			if (!$result) {
				throw new Exception("Product Data not Saved Successfully", 1);
			}

		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'product', null, true);
	}

	public function deleteAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("Id not Found.", 1);
			}

			$product = Ccc::getModel('Product_Row')->load($id);
			$result = $product->delete();
			if (!$result) {
				throw new Exception("Product Data Not Deleted.");
			}
				
		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'product', null, true);
	}
}