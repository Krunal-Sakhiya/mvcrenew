<?php
class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$grid = $layout->createBlock('Category_Grid');
			$layout->getChild('content')->addChild('grid', $grid);
			echo $layout->toHtml();
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$category = Ccc::getModel('Category');
			$add = $layout->createBlock('Category_Edit')->setData(['category' => $category]);
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

			$category = Ccc::getModel('Category')->load($id);
			if (!$category) {
				throw new Exception("Data not Posted.", 1);
			}

			$layout = $this->getLayout();
			$edit = $layout->createBlock('Category_Edit')->setData(['category' => $category]);
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
				throw new Exception("Data not found.", 1);
			}

			if ($id = (int) $this->getRequest()->getParam('id')) {
				$category = Ccc::getModel('Category')->load($id);
				if (!$category) {
					throw new Exception("Data not found.", 1);
				}
					
				$category->update_at = date('Y-m-d h:i:s');
			} else {
				$category = Ccc::getModel('Category');
				$category->create_at = date('Y-m-d h-i-s');
			}

			$category->setData($postData['category']);
			if (!$category->save()) {
				throw new Exception("Category Data Not Saved Successfully.", 1);
			}
				
		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'category', null, true);
	}

	public function deleteAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if (!$id) {
				throw new Exception("ID Not Found.", 1);
			}
			
			$category = Ccc::getModel('Category')->load($id);
			if (!$category->delete()) {
				throw new Exception("Category Data Not Deleted.", 1);
			}
				
		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'category', null, true);
	}


}