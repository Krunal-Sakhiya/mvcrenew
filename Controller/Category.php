<?php
class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		try {
			$query = "SELECT * FROM `category` ORDER BY `category_id` ASC";
			$categorys = Ccc::getModel('Category_Row')->fetchAll($query);

			$this->getView()->setTemplate('category/grid.phtml')->setData(['categorys' => $categorys]);
			$this->render(); 
		} catch (Exception $e) {
			
		}
	}

	public function addAction()
	{
		try {
			$this->getView()->setTemplate('category/add.phtml');
			$this->render();
		} catch (Exception $e) {
			
		}
	}

	public function editAction()
	{
		try {
			$id = (int) $this->getRequest()->getParam('id');

			$category = Ccc::getModel('Category_Row')->load($id);

			$this->getView()->setTemplate('category/edit.phtml')->setData(['category' => $category]);
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
				throw new Exception("Data not found.", 1);
			}

				echo "<pre>";
			if ($id = (int) $this->getRequest()->getParam('id')) {
				$category = Ccc::getModel('Category_Row')->load($id);
				print_r($category);
				die();
				if (!$category) {
					throw new Exception("Data not found.", 1);
				}
					
				$category->update_at = date('Y-m-d h:i:s');
			} else {
				$category = Ccc::getModel('Category_Row');
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
			
			$category = Ccc::getModel('Category_Row')->load($id);
			if (!$category->delete()) {
				throw new Exception("Category Data Not Deleted.", 1);
			}
				
		} catch (Exception $e) {
			
		}
		$this->redirect('grid', 'category', null, true);
	}


}