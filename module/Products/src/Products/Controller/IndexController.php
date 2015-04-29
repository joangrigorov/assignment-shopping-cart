<?php

namespace Products\Controller;

use Products\Form\Product;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Main products controller
 *
 * @package Products\Controller
 */
class IndexController extends AbstractActionController
{

    /**
     * Lists all products
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Creates new product
     *
     * @return array
     */
    public function newAction()
    {
        /** @var Product $form */
        $form = $this->serviceLocator->get('Products\Form\Product');

        if ($this->request->isPost()) {
            $form->setData($this->params()->fromPost());
            if ($form->isValid()) {
                /** @var \Products\Entity\Product $product */
                $product = $form->getObject();
                /** @var \Products\Repository\ProductsRepository $productsRepository */
                $productsRepository = $this->serviceLocator->get('Products\Repository\ProductsRepository');
                $productsRepository->save($product);
                $this->flashMessenger()->addSuccessMessage('Product successfully created!');
                return $this->redirect()->toRoute('products');
            }
        }

        return ['form' => $form];
    }
}
