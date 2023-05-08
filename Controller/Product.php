<?php
class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Grid');
			$layout->getChild('content')->addChild('grid', $grid);
			echo $layout->toHtml();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$product = Ccc::getModel('Product');
			$add = $layout->createBlock('Product_Edit')->setData(['product' => $product]);
			$layout->getChild('content')->addChild('add', $add);
			echo $layout->toHtml();
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

			$product = Ccc::getModel('Product')->load($id);
			if (!$product) {
				throw new Exception("Data not Posted.", 1);
			}

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Product_Edit')->setData(['product' => $product]);
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

			$postData = $this->getRequest()->getPost();
			if (!$postData) {
				throw new Exception("Data not Posted.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				$product = Ccc::getModel('Product')->load($id);
				if (!$product) {
					throw new Exception("Data not Posted.", 1);
				}
				$product->update_at = date('Y-m-d h:i:s');

			} else {
				$product = Ccc::getModel('Product');
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

			$product = Ccc::getModel('Product')->load($id);
			$result = $product->delete();
			if (!$result) {
				throw new Exception("Product Data Not Deleted.");
			}
				
		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'product', null, true);
	}
}